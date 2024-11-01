"use strict";

import { SELECTORS, LOADER_TEXT } from "./constants";
import Toast from "../services/ToastrService";
import HttpClient from "../services/HttpClient";
import LoaderService from "../services/LoaderService";
import { validateForm } from "../validators/FormValidator";
import ValidationService from "../services/ValidationService";

/**
 * Maneja la importación del archivo CSV
 * @param {HTMLFormElement} form - Formulario de importación
 */
const handleImport = (form) => {
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    const container = form.closest(".card-body");

    /**
     * Configuración para la petición HTTP
     * @type {Object}
     */
    const config = {
        /**
         * Callback ejecutado cuando la importación es exitosa
         * @param {Object} response - Respuesta del servidor
         */
        success: (response) => {
            Toast.success(
                response?.message ?? "Archivo importado correctamente"
            );
            form.reset();
            LoaderService.hideLoader(container);
            LoaderService.toggleButton({
                button: submitButton,
                disabled: false,
                restoreText: true,
                text: LOADER_TEXT.DEFAULT,
            });
        },

        /**
         * Callback ejecutado cuando ocurre un error
         * @param {Object} error - Error devuelto por el servidor
         */
        error: (error) => {
            LoaderService.hideLoader(container);
            LoaderService.toggleButton({
                button: submitButton,
                disabled: false,
                restoreText: true,
                text: LOADER_TEXT.DEFAULT,
            });

            const errorData = error.response?.data || error;
            if (errorData.errors) {
                ValidationService.showValidationErrors({
                    form: container,
                    errors: errorData.errors,
                    scroll: true,
                });
            }
            Toast.error(errorData?.message ?? "Error al importar el archivo");
        },
    };

    // Mostrar loader y deshabilitar botón
    LoaderService.showLoader(container);
    LoaderService.toggleButton({
        button: submitButton,
        disabled: true,
        text: LOADER_TEXT.IMPORTING,
    });

    // Enviar petición al servidor
    HttpClient.post(route("imports.store"), formData, config);
};

// Inicialización del módulo
(() => {
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector(SELECTORS.FORM);
        if (form) {
            validateForm(form, handleImport);
        }
    });
})();
