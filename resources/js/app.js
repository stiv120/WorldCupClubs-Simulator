import "./bootstrap";

// Importar los estilos
import "../css/app.css";

// Importar Bootstrap
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

// Importar Font Awesome
import "@fortawesome/fontawesome-free/css/all.min.css";

// Importar y configurar Toastr
import "toastr/build/toastr.min.css";

// Importar Ziggy correctamente
import { route } from "ziggy-js";
window.route = route;
