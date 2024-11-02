import HttpClient from "./HttpClient";
import validator from "validator";

class FormService {
    constructor() {
        this.errors = [];
    }

    /**
     * Valida los datos del formulario antes de enviar
     * @param {FormData} formData
     * @param {Object} rules - Reglas de validación
     * @returns {boolean}
     */
    validateForm(formData, rules) {
        this.errors = [];
        let isValid = true;

        // Recorre cada campo y sus reglas
        for (const [field, validations] of Object.entries(rules)) {
            const value = formData.get(field)?.toString() || "";

            for (const rule of validations) {
                if (!this.validateField(field, value, rule)) {
                    isValid = false;
                    break;
                }
            }
        }

        return isValid;
    }

    /**
     * Valida un campo específico
     * @param {string} field
     * @param {string} value
     * @param {Object} rule
     * @returns {boolean}
     */
    validateField(field, value, rule) {
        switch (rule.type) {
            case "required":
                if (validator.isEmpty(value)) {
                    this.addError(
                        field,
                        rule.message || "Este campo es requerido"
                    );
                    return false;
                }
                break;

            case "email":
                if (!validator.isEmpty(value) && !validator.isEmail(value)) {
                    this.addError(field, rule.message || "Email inválido");
                    return false;
                }
                break;

            case "length":
                if (
                    !validator.isEmpty(value) &&
                    !validator.isLength(value, rule.options)
                ) {
                    this.addError(
                        field,
                        rule.message ||
                            `Debe tener entre ${rule.options.min} y ${rule.options.max} caracteres`
                    );
                    return false;
                }
                break;

            // Agrega más validaciones según necesites
        }

        return true;
    }

    /**
     * Agrega un error a la lista
     * @param {string} field
     * @param {string} message
     */
    addError(field, message) {
        this.errors.push({ field, message });
    }

    /**
     * Muestra los errores en el formulario
     * @param {HTMLFormElement} form
     */
    showErrors(form) {
        // Limpia errores anteriores
        form.querySelectorAll(".is-invalid").forEach((el) =>
            el.classList.remove("is-invalid")
        );
        form.querySelectorAll(".invalid-feedback").forEach((el) => el.remove());

        // Muestra nuevos errores
        this.errors.forEach((error) => {
            const field = form.querySelector(`[name="${error.field}"]`);
            if (field) {
                field.classList.add("is-invalid");
                const feedback = document.createElement("div");
                feedback.className = "invalid-feedback";
                feedback.textContent = error.message;
                field.parentNode.appendChild(feedback);
            }
        });
    }

    /**
     * Envía el formulario si pasa las validaciones
     * @param {HTMLFormElement} form
     * @param {Object} rules
     * @returns {Promise}
     */
    async submitForm(form, rules) {
        const formData = new FormData(form);

        if (!this.validateForm(formData, rules)) {
            this.showErrors(form);
            return false;
        }

        try {
            const response = await HttpClient.post(form.action, formData);
            return response;
        } catch (error) {
            if (error.validationErrors) {
                // Maneja errores de validación del servidor
                this.errors = Object.entries(error.validationErrors).map(
                    ([field, messages]) => ({
                        field,
                        message: messages[0],
                    })
                );
                this.showErrors(form);
            }
            throw error;
        }
    }
}

export default new FormService();
