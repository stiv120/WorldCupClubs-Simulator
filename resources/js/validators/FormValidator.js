import validator from "validator";
import Toast from "../services/ToastrService";

class FormValidator {
    constructor(form, callback) {
        this.form = form;
        this.errors = {};
        this.callback = callback;

        // Deshabilitar la validación nativa del HTML5
        this.form.setAttribute("novalidate", "true");

        // Agregar el listener del submit
        this.form.addEventListener("submit", this.handleSubmit.bind(this));

        // Agregar validación en tiempo real
        this.form
            .querySelectorAll("input, select, textarea")
            .forEach((field) => {
                field.addEventListener("input", () =>
                    this.validateField(field)
                );
                field.addEventListener("change", () =>
                    this.validateField(field)
                );
            });

        // Exponer el método reset en el formulario
        this.form.resetValidation = () => this.reset();
    }

    handleSubmit(e) {
        e.preventDefault();

        if (this.validate()) {
            // Si la validación pasa, ejecutar el callback
            this.callback(this.form);
        } else {
            // Si hay errores de validación, mostrar Toast
            Toast.error("¡Errores de validación!");
        }
    }

    validate() {
        this.errors = {};
        let isValid = true;

        const fields = this.form.querySelectorAll("input, select, textarea");

        fields.forEach((field) => {
            const value = field.value.toString().trim();
            const name = field.name;

            // Validar required
            if (field.hasAttribute("required") && validator.isEmpty(value)) {
                this.addError(name, "Este campo es requerido");
                isValid = false;
            }

            // Validar archivos
            if (field.type === "file" && field.files.length > 0) {
                const file = field.files[0];
                const accept = field.getAttribute("accept");
                const maxSize = field.getAttribute("data-max-size") || 5242880; // 5MB por defecto

                if (accept && accept.length > 0) {
                    const allowedTypes = accept
                        .split(",")
                        .map((type) => type.trim());
                    const fileType = file.type;
                    if (
                        !allowedTypes.some((type) => {
                            if (type.endsWith("/*")) {
                                const baseType = type.split("/")[0];
                                return fileType.startsWith(baseType);
                            }
                            return type === fileType;
                        })
                    ) {
                        this.addError(name, "Tipo de archivo no permitido");
                        isValid = false;
                    }
                }

                if (file.size > maxSize) {
                    this.addError(name, "El archivo es demasiado grande");
                    isValid = false;
                }
            }
        });

        this.showErrors();
        return isValid;
    }

    addError(field, message) {
        if (!this.errors[field]) {
            this.errors[field] = [];
        }
        this.errors[field].push(message);
    }

    showErrors() {
        // Limpiar todos los estados
        this.form
            .querySelectorAll("input, select, textarea")
            .forEach((field) => {
                field.classList.remove("is-invalid", "is-valid");
                field.style.borderColor = "";
                field.style.boxShadow = "";
            });

        // Limpiar mensajes de error
        this.form
            .querySelectorAll(".error-message")
            .forEach((el) => el.remove());

        // Mostrar nuevos estados
        Object.entries(this.errors).forEach(([field, messages]) => {
            const input = this.form.querySelector(`[name="${field}"]`);
            if (input) {
                this.showFieldValidation(input);
            }
        });
    }

    validateField(field) {
        const value = field.value.toString().trim();
        const name = field.name;

        // Limpiar errores previos del campo
        delete this.errors[name];

        // Validar required
        if (field.hasAttribute("required") && validator.isEmpty(value)) {
            this.addError(name, "Este campo es requerido");
        }

        this.showFieldValidation(field);
    }

    showFieldValidation(field) {
        // Remover clases y estilos previos
        field.classList.remove("is-invalid", "is-valid");
        field.style.borderColor = "";
        field.style.boxShadow = "";

        // Remover mensaje de error previo
        const errorDiv = field.nextElementSibling;
        if (errorDiv?.classList.contains("error-message")) {
            errorDiv.remove();
        }

        if (this.errors[field.name]) {
            // Mostrar error
            field.classList.add("is-invalid");
            field.style.borderColor = "#dc3545";
            field.style.boxShadow = "0 0 0 0.25rem rgba(220, 53, 69, 0.25)";

            const errorDiv = document.createElement("div");
            errorDiv.className = "error-message invalid-feedback";
            errorDiv.textContent = this.errors[field.name][0];
            field.parentNode.insertBefore(errorDiv, field.nextSibling);
        } else if (field.value.trim() !== "") {
            // Mostrar válido
            field.classList.add("is-valid");
            field.style.borderColor = "#198754";
            field.style.boxShadow = "0 0 0 0.25rem rgba(25, 135, 84, 0.25)";
        }
    }

    reset() {
        // Resetear el formulario
        this.form.reset();

        // Limpiar errores
        this.errors = {};

        // Limpiar estados de validación
        this.form
            .querySelectorAll("input, select, textarea")
            .forEach((field) => {
                field.classList.remove("is-invalid", "is-valid");
                field.style.borderColor = "";
                field.style.boxShadow = "";
            });

        // Limpiar mensajes de error
        this.form
            .querySelectorAll(".error-message")
            .forEach((el) => el.remove());
    }
}

// Función helper para facilitar el uso
export function validateForm(form, callback) {
    return new FormValidator(form, callback);
}

export default FormValidator;
