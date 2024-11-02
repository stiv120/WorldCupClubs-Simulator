"use strict";

import HttpClient from "../services/HttpClient";
import LoaderService from "../services/LoaderService";

/**
 * Módulo para mostrar resultados de simulaciones
 * @module Simulations/Results
 */

/**
 * Actualiza la vista de resultados de la simulación
 * @async
 * @function refreshResults
 * @description Obtiene y muestra los resultados actualizados:
 * - Realiza petición al servidor por resultados actuales
 * - Actualiza el contenedor con los nuevos datos
 * - Muestra loader durante la carga
 * - Maneja errores de la petición
 * @returns {Promise<void>}
 * @throws {Error} Si hay error en la petición HTTP
 */
export const refreshResults = async () => {
    const tableContainer = document.querySelector(".divSeccionesSimulaciones");

    if (!tableContainer) return;

    LoaderService.showLoader(tableContainer);

    const config = {
        success: (response) => {
            if (typeof response === "string") {
                tableContainer.innerHTML = response;
            } else if (response?.html) {
                tableContainer.innerHTML = response.html;
            }
            LoaderService.hideLoader(tableContainer);
        },
        error: () => {
            LoaderService.hideLoader(tableContainer);
        },
    };
    await HttpClient.get(route("simulations.results"), config);
};
