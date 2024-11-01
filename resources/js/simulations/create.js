"use strict";

import { SELECTORS } from "./constants";
import { refreshSections } from "./sections";
import Toast from "../services/ToastrService";
import HttpClient from "../services/HttpClient";
import LoaderService from "../services/LoaderService";
import ValidationService from "../services/ValidationService";

/**
 * Maneja la creación de una nueva simulación
 * @description Envía la petición al servidor para crear una nueva simulación
 *             y maneja la respuesta incluyendo la actualización de la UI
 * @throws {Error} Si hay un error en la petición al servidor
 */
const createSimulation = () => {
    const button = document.querySelector(SELECTORS.BTN_CREATE);
    const container = document.querySelector(SELECTORS.CONTAINER);

    const config = {
        success: async (response) => {
            ValidationService.hideValidationErrors(container);
            Toast.success(
                response?.message ?? "Simulación creada correctamente"
            );
            LoaderService.hideLoader(container);
            LoaderService.toggleButton({
                button,
                disabled: false,
                restoreText: true,
            });
            await refreshSections();
        },
        error: (error) => {
            LoaderService.hideLoader(container);
            LoaderService.toggleButton({
                button,
                disabled: false,
                restoreText: true,
            });

            const errorData = error.response?.data || error;
            if (errorData.errors) {
                ValidationService.showValidationErrors({
                    scroll: true,
                    form: container,
                    errors: errorData?.errors || errorData?.validaciones,
                });
            }
            Toast.error(errorData?.message ?? "Error al crear la simulación");
        },
    };

    LoaderService.toggleButton({
        button,
        disabled: true,
        text: "Simulando...",
    });
    HttpClient.post(route("simulations.store"), {}, config);
};

(() => {
    document.addEventListener("DOMContentLoaded", () => {
        const btnCreate = document.querySelector(SELECTORS.BTN_CREATE);
        if (btnCreate) {
            btnCreate.addEventListener("click", createSimulation);
        }
    });
})();
