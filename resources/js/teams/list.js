"use strict";

import HttpClient from "../services/HttpClient";
import LoaderService from "../services/LoaderService";

/**
 * Actualiza la lista de equipos en la tabla
 * @async
 * @function refreshTeamsList
 * @description Realiza una petición al servidor para obtener la lista actualizada de equipos
 * y actualiza el contenido de la tabla en el DOM
 * @returns {Promise<void>}
 */
export const refreshTeamsList = async () => {
    // Obtener el contenedor de la tabla
    const tableContainer = document.querySelector(".divListadoEquipos");

    if (!tableContainer) return;

    // Mostrar loader mientras se obtienen los datos
    LoaderService.showLoader(tableContainer);

    /**
     * Configuración para la petición HTTP
     * @type {Object}
     */
    const config = {
        /**
         * Callback ejecutado cuando la obtención es exitosa
         * @param {Object|string} response - Respuesta del servidor
         */
        success: (response) => {
            if (typeof response === "string") {
                tableContainer.innerHTML = response;
            } else if (response?.html) {
                tableContainer.innerHTML = response.html;
            }
            LoaderService.hideLoader(tableContainer);
        },
        /**
         * Callback ejecutado cuando ocurre un error
         */
        error: () => {
            LoaderService.hideLoader(tableContainer);
        },
    };
    // Realizar la petición al servidor
    await HttpClient.get(route("teams.list"), config);
};
