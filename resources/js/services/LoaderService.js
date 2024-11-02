class LoaderService {
    /**
     * Inicializa el servicio con la plantilla del loader
     */
    constructor() {
        this.loaderTemplate = `
            <div class="loader-container">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>
        `;
    }

    /**
     * Agrega y muestra el loader en el contenedor especificado
     * @param {HTMLElement} container - Elemento donde se mostrará el loader
     */
    showLoader(container) {
        const loaderElement = document.createElement("div");
        loaderElement.innerHTML = this.loaderTemplate;
        loaderElement.classList.add("loader-wrapper");
        container.style.position = "relative";
        container.appendChild(loaderElement);
    }

    /**
     * Elimina el loader del contenedor especificado
     * @param {HTMLElement} container - Elemento que contiene el loader
     */
    hideLoader(container) {
        const loader = container.querySelector(".loader-wrapper");
        if (loader) {
            loader.remove();
        }
    }

    /**
     * Controla el estado y texto de un botón
     * @param {Object} config - Configuración del botón
     * @param {HTMLElement} config.button - Elemento botón a modificar
     * @param {boolean} [config.disabled=true] - Estado de deshabilitado del botón
     * @param {string} [config.text=null] - Nuevo texto a mostrar
     * @param {boolean} [config.restoreText=false] - Indica si restaurar el texto original
     * @param {string} [config.btnTextClass=".btnGuardarText"] - Selector del elemento de texto
     */
    toggleButton({
        button,
        disabled = true,
        text = null,
        restoreText = false,
        btnTextClass = ".btnGuardarText",
    }) {
        if (!button) return;

        // Actualizar estado del botón
        button.disabled = disabled;

        // Buscar elemento de texto
        const textSpan = button.querySelector(btnTextClass);
        if (!textSpan) return;

        // Almacenar texto original si es necesario
        if (text && !button.dataset.originalText) {
            button.dataset.originalText = textSpan.textContent;
        }

        // Actualizar o restaurar texto
        if (text && disabled) {
            textSpan.textContent = text;
        } else if (restoreText && button.dataset.originalText) {
            textSpan.textContent = button.dataset.originalText;
        }
    }
}

export default new LoaderService();
