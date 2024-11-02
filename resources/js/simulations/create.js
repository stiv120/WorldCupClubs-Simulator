"use strict";

import { SELECTORS } from "./constants";
import Toast from "../services/ToastrService";
import HttpClient from "../services/HttpClient";
import LoaderService from "../services/LoaderService";
import ValidationService from "../services/ValidationService";
import { refreshResults } from "./results";

/**
 * Módulo para la creación de simulaciones
 * @module Simulations/Create
 */

/**
 * Maneja la creación de una nueva simulación de torneo
 * @function createSimulation
 * @description Gestiona el proceso de crear una nueva simulación:
 * - Envía la petición al servidor para iniciar la simulación
 * - Maneja estados de carga y errores
 * - Actualiza la UI con los resultados
 * - Valida que haya 8 equipos seleccionados
 * - Verifica que cada equipo tenga mínimo 11 jugadores
 * @throws {Error} Si hay errores de validación o en la petición
 */
const createSimulation = () => {
    const button = document.querySelector(SELECTORS.BTN_CREATE);
    const container = document.querySelector(SELECTORS.RESULTS_CONTAINER);

    LoaderService.showLoader(container);

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
            await refreshResults();
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
