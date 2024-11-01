"use strict";

/**
 * Selectores DOM utilizados en el módulo de jugadores
 * @constant {Object} SELECTORS
 * @property {string} FORM_CREATE - Selector del formulario de creación
 * @property {string} CLOSE_MODAL - Selector del botón para cerrar el modal
 * @property {string} SAVE - Selector del botón de guardar
 * @property {string} MODAL - Selector del modal de creación
 * @property {string} TABLE - Selector de la tabla de jugadores
 */
export const SELECTORS = {
    // Formularios
    FORM_CREATE: "#formCrearJugador",

    // Botones
    CLOSE_MODAL: ".btnCerrarModalJugador",
    SAVE: ".btnGuardarJugador",

    // Otros elementos
    MODAL: "#modalCrearJugador",
    TABLE: "#playersTable",
};
