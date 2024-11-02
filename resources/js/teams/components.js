"use strict";

import { SELECTORS } from "./constants";
import ValidationService from "../services/ValidationService";

/**
 * Limpia los errores de validación del formulario
 * @param {HTMLFormElement} form - Formulario a limpiar
 */
const clearValidationErrors = (form) => {
    // Limpia los errores de validación de los inputs y selects
    const inputs = form.querySelectorAll("input, select");
    inputs.forEach((input) => {
        // Remueve las clases de validación
        input.classList.remove("is-invalid", "is-valid");

        // Remueve el mensaje de error si existe
        const feedbackElement = input.parentElement.querySelector(
            ".invalid-feedback, .error-message"
        );
        if (feedbackElement) {
            feedbackElement.remove();
        }

        // Remueve los estilos de validación
        input.style.borderColor = "";
        input.style.boxShadow = "";
    });

    // Limpia los errores del ValidationService
    ValidationService.hideValidationErrors({ form });

    // Resetea la validación del FormValidator si existe
    if (form.resetValidation) {
        form.resetValidation();
    }
};

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
                clearValidationErrors(form);
                form.reset();
            }
        }
    });
};

export { initComponents, clearValidationErrors };
