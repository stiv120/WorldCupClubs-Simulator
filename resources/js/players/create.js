"use strict";

import { SELECTORS } from "./constants";
import { refreshPlayersList } from "./list";
import Toast from "../services/ToastrService";
import HttpClient from "../services/HttpClient";
import LoaderService from "../services/LoaderService";
import { validateForm } from "../validators/FormValidator";
import ValidationService from "../services/ValidationService";
import { initComponents, clearValidationErrors } from "./components";

/**
 * Maneja la creación de un nuevo jugador
 * @param {HTMLFormElement} form - Formulario de creación del jugador
 * @description Procesa el formulario, envía los datos al servidor y maneja la respuesta
 *             incluyendo la actualización de la UI y manejo de errores
 * @throws {Error} Si hay un error en la validación o en la petición al servidor
 */
const createPlayer = (form) => {
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    const container = form.querySelector(".modal-body") || form;
    const modal = document.getElementById("modalCrearJugador");

    const config = {
        success: async (response) => {
            Toast.success(response?.message ?? "Jugador creado correctamente");
            clearValidationErrors(form);
            form.reset();
            LoaderService.hideLoader(container);
            LoaderService.toggleButton({
                button: submitButton,
                disabled: false,
                restoreText: true,
                btnTextClass: ".btnGuardarJugadorText",
            });
            modal.querySelector('[data-bs-dismiss="modal"]').click();
            await refreshPlayersList();
        },
        error: (error) => {
            LoaderService.hideLoader(container);
            LoaderService.toggleButton({
                disabled: false,
                restoreText: true,
                button: submitButton,
                btnTextClass: ".btnGuardarJugadorText",
            });

            const errorData = error.response?.data || error;
            if (errorData.errors) {
                ValidationService.showValidationErrors({
                    form,
                    scroll: true,
                    errors: errorData?.errors,
                });
            }
            Toast.error(errorData?.message ?? "Error al crear el jugador");
        },
    };

    LoaderService.showLoader(container);
    LoaderService.toggleButton({
        disabled: true,
        button: submitButton,
        text: "Guardando...",
        btnTextClass: ".btnGuardarJugadorText",
    });
    HttpClient.post(route("players.store"), formData, config);
};

(() => {
    initComponents();
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector(SELECTORS.FORM_CREATE);
        if (form) {
            validateForm(form, createPlayer);
        }
    });
})();
