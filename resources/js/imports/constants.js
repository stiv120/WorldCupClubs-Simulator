"use strict";

/**
 * Módulo de constantes para importaciones
 * @module Imports/Constants
 */

/**
 * Selectores DOM utilizados en el módulo de importaciones
 * @constant {Object} SELECTORS
 * @property {string} FORM - Selector del formulario de importación CSV
 * @property {string} FILE_INPUT - Selector del input para archivo CSV
 * @property {string} CONTAINER - Selector del contenedor principal de importaciones
 * @property {string} BTN_IMPORT - Selector del botón para iniciar importación
 */
export const SELECTORS = {
    // Formulario
    FORM: "#importForm",

    // Inputs
    FILE_INPUT: "#archivoCsv",

    // Contenedores
    CONTAINER: ".import-container",

    // Botones
    BTN_IMPORT: "#importForm button[type='submit']",
};

/**
 * Textos para estados del loader
 * @constant {Object} LOADER_TEXT
 * @property {string} IMPORTING - Texto mostrado durante la importación
 * @property {string} DEFAULT - Texto por defecto del botón
 */
export const LOADER_TEXT = {
    IMPORTING: "Importando...",
    DEFAULT: "Importar",
};
