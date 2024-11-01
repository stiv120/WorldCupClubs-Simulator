"use strict";

import { SELECTORS } from "./constants";
import ValidationService from "../services/ValidationService";

/**
 * Limpia los errores de validación del formulario
 * @param {HTMLFormElement} form - Formulario a limpiar
 * @description Elimina todas las marcas de validación, mensajes de error
 *             y restaura el estado original de los campos
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
 * Inicializa los componentes y eventos del módulo de jugadores
 * @function initComponents
 * @description Configura los listeners para manejar el cierre del modal,
 *             limpieza del formulario y otros eventos relacionados
 */
const initComponents = () => {
    document.addEventListener("click", function (e) {
        if (e.target.matches(SELECTORS.CLOSE_MODAL)) {
            const form = document.querySelector(SELECTORS.FORM_CREATE);
            if (form) {
                clearValidationErrors(form);
                form.reset();
            }
        }
    });
};

export { initComponents, clearValidationErrors };
