import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/app.js",
                "resources/css/app.css",
                "resources/js/teams/index.js",
                "resources/js/players/index.js",
            ],
            refresh: true,
        }),
    ],
    server: {
        hmr: { host: "0.0.0.0" },
        host: "0.0.0.0",
        port: 8081,
        watch: {
            usePolling: true,
            interval: 1000,
            followSymlinks: true,
            ignored: ["node_modules/**", ".git/**"],
        },
    },
    resolve: {
        alias: {
            "~bootstrap": "bootstrap",
        },
    },
});
