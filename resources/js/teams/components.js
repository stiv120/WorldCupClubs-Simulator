"use strict";

import { SELECTORS } from "./constants";
import ValidationService from "../services/ValidationService";

/**
 * Inicializa los componentes y eventos del módulo de equipos
 * @function
 * @description Configura los listeners para manejar el cierre del modal y limpieza del formulario
 */
const initComponents = () => {
    /**
     * Maneja el evento click en el botón de cerrar del modal
     * @param {Event} e - Evento del click
     */
    document.addEventListener("click", function (e) {
        // Verifica si el click fue en el botón de cerrar
        if (e.target.matches(SELECTORS.CLOSE_MODAL)) {
            // Busca el formulario de creación
            const form = document.querySelector(SELECTORS.FORM_CREATE);
            if (form) {
                // Limpia los errores de validación y resetea el formulario
                ValidationService.hideValidationErrors({ form });
                form.reset();
            }
        }
    });
};

export { initComponents };
