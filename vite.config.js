import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/teams/index.js",
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
