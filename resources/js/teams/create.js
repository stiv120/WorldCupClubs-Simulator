"use strict";

import { Modal } from "bootstrap";
import { SELECTORS } from "./constants";
import { refreshTeamsList } from "./list";
import { initComponents } from "./components";
import Toast from "../services/ToastrService";
import HttpClient from "../services/HttpClient";
import LoaderService from "../services/LoaderService";
import { validateForm } from "../validators/FormValidator";
import ValidationService from "../services/ValidationService";

/**
 * Maneja la creación de un nuevo equipo
 * @param {HTMLFormElement} form - Formulario de creación del equipo
 */
const createTeam = (form) => {
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    const container = form.querySelector(".modal-body") || form;
    const modal = document.getElementById("modalCrearEquipo");

    /**
     * Configuración para la petición HTTP
     * @type {Object}
     */
    const config = {
        /**
         * Callback ejecutado cuando la creación es exitosa
         * @param {Object} response - Respuesta del servidor
         */
        success: async (response) => {
            Toast.success(response?.message ?? "Equipo creado correctamente");
            ValidationService.hideValidationErrors({ form });
            form.reset();
            LoaderService.hideLoader(container);
            LoaderService.toggleButton({
                button: submitButton,
                disabled: false,
                restoreText: true,
                btnTextClass: ".btnGuardarEquipoText",
            });
            modal.querySelector('[data-bs-dismiss="modal"]').click();
            await refreshTeamsList();
        },

        /**
         * Callback ejecutado cuando ocurre un error
         * @param {Object} error - Error devuelto por el servidor
         */
        error: (error) => {
            LoaderService.hideLoader(container);
            LoaderService.toggleButton({
                disabled: false,
                restoreText: true,
                button: submitButton,
                btnTextClass: ".btnGuardarEquipoText",
            });

            const errorData = error.response?.data || error;
            if (errorData.errors || errorData.validaciones) {
                ValidationService.showValidationErrors({
                    form,
                    scroll: true,
                    errors: errorData?.errors || errorData?.validaciones,
                });
            }
            Toast.error(errorData?.message ?? "Error al crear el equipo");
        },
    };

    // Mostrar loader y deshabilitar botón
    LoaderService.showLoader(container);
    LoaderService.toggleButton({
        disabled: true,
        button: submitButton,
        text: "Guardando...",
        btnTextClass: ".btnGuardarEquipoText",
    });

    // Enviar petición al servidor
    HttpClient.post(route("teams.store"), formData, config);
};

// Inicialización del módulo
(() => {
    initComponents();
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector(SELECTORS.FORM_CREATE);
        if (form) {
            validateForm(form, createTeam);
        }
    });
})();
