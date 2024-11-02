class ValidationService {
    /**
     * Muestra los errores de validación en el formulario
     * @param {Object} config - Configuración
     * @param {HTMLElement} config.form - El formulario donde se mostrarán los errores
     * @param {Object} config.errors - Objeto de errores del backend
     * @param {boolean} [config.scroll=true] - Si debe hacer scroll al contenedor de errores
     * @param {string} [config.divValidacionClass='.div-validacion'] - Clase del contenedor de validación
     * @param {string} [config.mensajeValidacionClass='.mensaje-validacion'] - Clase del contenedor de mensajes
     */
    showValidationErrors(config = {}) {
        const {
            form,
            errors,
            scroll = true,
            divValidacionClass = ".div-validacion",
            mensajeValidacionClass = ".mensaje-validacion",
        } = config;

        if (!form || !errors) return;

        const divValidacion = form.querySelector(divValidacionClass);
        const mensajeValidacion = divValidacion?.querySelector(
            mensajeValidacionClass
        );

        if (!divValidacion || !mensajeValidacion) return;

        // Limpiar mensajes anteriores
        mensajeValidacion.innerHTML = "";

        // Procesar errores y asegurarse de que sea un array
        let errorMessages = this.processErrors(errors);

        // Si no hay errores, no mostrar nada
        if (!errorMessages.length) return;

        // Agregar nuevos mensajes
        errorMessages.forEach((error) => {
            const li = document.createElement("li");
            li.textContent = error;
            mensajeValidacion.appendChild(li);
        });

        // Mostrar el div de validación
        divValidacion.classList.remove("d-none");
        divValidacion.classList.add("d-block");

        // Scroll al contenedor de errores
        if (scroll) {
            const modal = divValidacion.closest(".modal");
            if (modal) {
                modal.scrollTo({ top: 0, behavior: "smooth" });
            } else {
                divValidacion.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        }
    }

    /**
     * Procesa los errores del backend y los convierte en un array de mensajes
     * @param {Object} errors - Objeto de errores del backend
     * @returns {Array} Array de mensajes de error
     */
    processErrors(errors) {
        if (!errors) return [];

        // Si es un array simple
        if (Array.isArray(errors)) return errors;

        // Si es un objeto con errores
        if (typeof errors === "object") {
            // Manejar diferentes estructuras de error
            if (errors.errors) {
                return Object.values(errors.errors).flat();
            }

            return Object.values(errors)
                .flat()
                .filter((error) => error !== null && error !== undefined);
        }

        // Si es un string simple
        if (typeof errors === "string") {
            return [errors];
        }

        return [];
    }

    /**
     * Oculta los errores de validación del formulario
     * @param {Object} config - Configuración
     * @param {HTMLElement} config.form - El formulario donde se ocultarán los errores
     * @param {string} [config.divValidacionClass='.div-validacion'] - Clase del contenedor de validación
     * @param {string} [config.mensajeValidacionClass='.mensaje-validacion'] - Clase del contenedor de mensajes
     */
    hideValidationErrors(config = {}) {
        const {
            form,
            divValidacionClass = ".div-validacion",
            mensajeValidacionClass = ".mensaje-validacion",
        } = config;

        if (!form) return;

        const divValidacion = form.querySelector(divValidacionClass);
        if (divValidacion) {
            divValidacion.classList.remove("d-block");
            divValidacion.classList.add("d-none");
            const mensajeValidacion = divValidacion.querySelector(
                mensajeValidacionClass
            );
            if (mensajeValidacion) {
                mensajeValidacion.innerHTML = "";
            }
        }
    }
}

export default new ValidationService();
