import toastr from "toastr";

/**
 * Servicio para mostrar notificaciones toast
 */
class ToastrService {
    /**
     * Muestra una notificación toast
     * @param {Object} config - Configuración de la notificación
     * @param {string} [config.estado] - Tipo de notificación (success, error, warning, info)
     * @param {string} [config.mensaje] - Mensaje a mostrar
     * @param {Object} [config.options] - Opciones adicionales de toastr
     */
    show(config = {}) {
        const { estado, mensaje, ...options } = config;

        // Configuración por defecto mezclada con las opciones recibidas
        toastr.options = {
            debug: false,
            onclick: null,
            timeOut: 5000,
            closeButton: false,
            newestOnTop: false,
            progressBar: false,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            showDuration: 500,
            hideDuration: 1000,
            extendedTimeOut: 1000,
            preventDuplicates: false,
            positionClass: "toast-bottom-left",
            ...options,
        };

        if (estado && mensaje) {
            toastr[estado](mensaje);
        }
    }

    /**
     * Muestra una notificación de éxito
     * @param {string} mensaje - Mensaje a mostrar
     * @param {Object} [options={}] - Opciones adicionales de toastr
     */
    success(mensaje, options = {}) {
        this.show({ estado: "success", mensaje, ...options });
    }

    /**
     * Muestra una notificación de error
     * @param {string} mensaje - Mensaje a mostrar
     * @param {Object} [options={}] - Opciones adicionales de toastr
     */
    error(mensaje, options = {}) {
        this.show({ estado: "error", mensaje, ...options });
    }

    /**
     * Muestra una notificación de advertencia
     * @param {string} mensaje - Mensaje a mostrar
     * @param {Object} [options={}] - Opciones adicionales de toastr
     */
    warning(mensaje, options = {}) {
        this.show({ estado: "warning", mensaje, ...options });
    }

    /**
     * Muestra una notificación de información
     * @param {string} mensaje - Mensaje a mostrar
     * @param {Object} [options={}] - Opciones adicionales de toastr
     */
    info(mensaje, options = {}) {
        this.show({ estado: "info", mensaje, ...options });
    }
}

export default new ToastrService();
