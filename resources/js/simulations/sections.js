"use strict";

import HttpClient from "../services/HttpClient";
import LoaderService from "../services/LoaderService";

/**
 * Actualiza la lista de jugadores en la tabla
 * @async
 * @function refreshSections
 * @description Realiza una petición al servidor para obtener la lista actualizada de jugadores
 *             y actualiza el contenido de la tabla en el DOM
 * @returns {Promise<void>}
 * @throws {Error} Si hay un error en la petición HTTP
 */
export const refreshSections = async () => {
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
    await HttpClient.get(route("simulations.sections"), config);
};
