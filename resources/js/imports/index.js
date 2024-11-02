"use strict";

/**
 * Módulo principal de importaciones
 * @module Imports/Index
 */

import { SELECTORS, LOADER_TEXT } from "./constants";
import Toast from "../services/ToastrService";
import HttpClient from "../services/HttpClient";
import LoaderService from "../services/LoaderService";
import { validateForm } from "../validators/FormValidator";
import ValidationService from "../services/ValidationService";

/**
 * Maneja el proceso de importación de archivos CSV
 * @function handleImport
 * @param {HTMLFormElement} form - Formulario que contiene el archivo a importar
 * @description Gestiona el proceso completo de importación:
 * - Recolecta datos del formulario
 * - Muestra estados de carga
 * - Envía archivo al servidor
 * - Maneja respuestas y errores
 * - Actualiza la UI según el resultado
 *
 * @throws {Error} Si hay errores de validación o en la petición
 */
const handleImport = (form) => {
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    const container = form.closest(".card-body");

    /**
     * Configuración de la petición HTTP
     * @typedef {Object} ImportConfig
     * @property {Function} success - Callback para respuesta exitosa
     * @property {Function} error - Callback para manejo de errores
     */

    /**
     * Callback ejecutado cuando la importación es exitosa
     * @param {Object} response - Respuesta del servidor
     */
    const successCallback = (response) => {
        Toast.success(response?.message ?? "Archivo importado correctamente");
        form.reset();
        LoaderService.hideLoader(container);
        LoaderService.toggleButton({
            button: submitButton,
            disabled: false,
            restoreText: true,
            text: LOADER_TEXT.DEFAULT,
        });
    };

    /**
     * Callback ejecutado cuando ocurre un error
     * @param {Object} error - Error devuelto por el servidor
     */
    const errorCallback = (error) => {
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
    };

    // Mostrar loader y deshabilitar botón
    LoaderService.showLoader(container);
    LoaderService.toggleButton({
        button: submitButton,
        disabled: true,
        text: LOADER_TEXT.IMPORTING,
    });

    // Enviar petición al servidor
    HttpClient.post(route("imports.store"), formData, {
        success: successCallback,
        error: errorCallback,
    });
};

/**
 * Inicialización del módulo
 * @description
 * - Espera a que el DOM esté cargado
 * - Configura el formulario de importación
 * - Establece validaciones
 * - Vincula el manejador de importación
 */
(() => {
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector(SELECTORS.FORM);
        if (form) {
            validateForm(form, handleImport);
        }
    });
})();
