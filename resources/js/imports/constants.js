"use strict";

/**
 * Selectores DOM utilizados en el módulo de importaciones
 * @constant {Object} SELECTORS
 * @property {string} FORM - Selector del formulario de importación
 * @property {string} CONTAINER - Selector del contenedor principal
 * @property {string} BTN_IMPORT - Selector del botón de importar
 * @property {string} FILE_INPUT - Selector del input de archivo
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
 * Textos utilizados en el loader
 * @constant {Object} LOADER_TEXT
 */
export const LOADER_TEXT = {
    IMPORTING: "Importando...",
    DEFAULT: "Importar",
};
