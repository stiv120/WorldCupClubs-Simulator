import axios from "axios";

/**
 * Clase para manejar peticiones HTTP usando axios
 */
class HttpClient {
    /**
     * Realiza una petición GET
     * @param {string} url - URL del endpoint
     * @param {Object} [config={}] - Configuración adicional de la petición
     * @returns {Promise<any>} Respuesta del servidor
     */
    static async get(url, config = {}) {
        return await this.request({
            method: "GET",
            url,
            ...config,
        });
    }

    /**
     * Realiza una petición POST
     * @param {string} url - URL del endpoint
     * @param {Object|FormData} data - Datos a enviar
     * @param {Object} [config={}] - Configuración adicional de la petición
     * @returns {Promise<any>} Respuesta del servidor
     */
    static async post(url, data, config = {}) {
        return await this.request({
            method: "POST",
            url,
            data,
            ...config,
        });
    }

    /**
     * Realiza una petición HTTP genérica
     * @param {Object} config - Configuración de la petición
     * @param {string} config.method - Método HTTP
     * @param {string} config.url - URL del endpoint
     * @param {Object} [config.data] - Datos a enviar
     * @param {Function} [config.success] - Callback de éxito
     * @param {Function} [config.error] - Callback de error
     * @returns {Promise<any>} Respuesta del servidor
     */
    static async request(config) {
        try {
            const response = await axios(config);
            if (config.success) {
                config.success(response.data);
            }
            return response.data;
        } catch (error) {
            if (config.error) {
                config.error(error);
            }
            throw error;
        }
    }
}

export default HttpClient;
