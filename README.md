<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Logo Laravel">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Estado de construcción">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Descargas totales">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Última versión estable">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="Licencia">
  </a>
</p>

## Acerca de Laravel

Laravel es un framework de aplicaciones web con una sintaxis expresiva y elegante. Creemos que el desarrollo debe ser una experiencia agradable y creativa para ser realmente satisfactorio. Laravel elimina el dolor del desarrollo facilitando tareas comunes utilizadas en muchos proyectos web, tales como:

-   [Motor de enrutamiento simple y rápido](https://laravel.com/docs/routing).
-   [Potente contenedor de inyección de dependencias](https://laravel.com/docs/container).
-   Múltiples back-ends para almacenamiento de [sesión](https://laravel.com/docs/session) y [caché](https://laravel.com/docs/cache).
-   Expresivo e intuitivo [ORM de base de datos](https://laravel.com/docs/eloquent).
-   Base de datos agnóstica [migraciones de esquema](https://laravel.com/docs/migrations).
-   [Procesamiento robusto de tareas en segundo plano](https://laravel.com/docs/queues).
-   [Transmisión de eventos en tiempo real](https://laravel.com/docs/broadcasting).

Laravel es accesible, potente y proporciona las herramientas necesarias para aplicaciones grandes y robustas.

## Acerca de este proyecto

Este proyecto es un sistema de simulación de torneos de fútbol que permite gestionar equipos, jugadores y simular torneos. El proyecto está estructurado en varios módulos principales:

## 1. Gestión de Equipos y Jugadores

-   **Equipos**:

    -   CRUD completo para gestionar equipos de fútbol
    -   Cada equipo incluye información como nombre, país y bandera
    -   Validación de datos mediante form requests
    -   Carga de imágenes para banderas de equipos

-   **Jugadores**:
    -   CRUD completo para gestionar jugadores
    -   Cada jugador está asociado a un equipo
    -   Información detallada: nombre, posición, nacionalidad, edad, número de camiseta
    -   Carga de fotos de jugadores

## 2. Sistema de Simulación

-   Simulación de torneos con 8 equipos
-   Cada equipo debe tener mínimo 11 jugadores
-   Sistema de eliminación directa
-   Generación automática de resultados
-   Visualización de estadísticas del torneo

## 3. Importación de Datos

-   Importación masiva de equipos y jugadores mediante archivos CSV
-   Validación del formato y datos requeridos
-   Procesamiento automático de la información

## 4. Arquitectura y Diseño

El proyecto sigue una arquitectura limpia basada en:

-   **Arquitectura Hexagonal**
-   **Domain-Driven Design (DDD)**
-   Estructura modular en la carpeta `src/`:
    -   Team (Equipos)
    -   Player (Jugadores)
    -   Simulation (Simulaciones)
    -   Import (Importaciones)

Cada módulo contiene tres capas principales:

-   **Application**: Casos de uso y servicios de aplicación
-   **Domain**: Entidades, repositorios y reglas de negocio
-   **Infrastructure**: Controladores, rutas y persistencia

## 5. Pruebas

El proyecto incluye pruebas exhaustivas:

-   Pruebas unitarias para cada módulo
-   Pruebas de integración para flujos completos
-   Cobertura de casos de éxito y error
-   Testing de:
    -   Operaciones CRUD
    -   Validaciones de datos
    -   Importación de archivos
    -   Simulación de torneos

## Instalación

1. Clonamos el repositorio:
    ```sh
    git clone https://github.com/stiv120/WorldCupClubs-Simulator.git
    ```
2. Accedemos al directorio en la ruta donde lo descargamos:

    ```sh
    cd WorldCupClubs-Simulator
    ```

## Mediante docker

Dado que nuestra aplicación se ha integrado con Docker, si queremos usarlo, debemos tener instalado Docker Desktop en nuestra máquina, si no lo tienes, aquí tienes el enlace de descarga: https://www.docker.com/products/docker-desktop/ para que nuestra aplicación y los comandos que se dan a continuación funcionen.

## Iniciamos la aplicación

1. Ejecutamos el siguiente comando:

    ```sh
    docker compose up -d
    ```

    Esto levantará el contenedor, con todos los servicios que necesitamos para ejecutar nuestra aplicación, incluido el servidor a través del cual accederemos a ella a través de este enlace: http://localhost:8081 para ver la aplicación.

2. Accedemos a nuestro contenedor usando el siguiente comando:

    ```sh
    docker exec -it app bash
    ```

3. Luego usando el siguiente comando instalamos las dependencias de Laravel

    ```sh
    composer install
    ```

4. Copiamos el archivo .env.example a .env

    ```sh
    cp .env.example .env
    ```

5. Generamos la clave de la aplicación.

    ```sh
    php artisan key:generate
    ```

6. Generamos la clave de pruebas.

    ```sh
    php artisan key:generate --env=testing
    ```

7. Ejecutamos las migraciones de nuestra bd del sistema utilizando el siguiente comando:

    ```sh
    php artisan migrate
    ```

8. Ejecutamos el compilador de los assets

    ```sh
    npm run build
    ```

## Pruebas

1. Para ejecutar las pruebas, accedemos a nuestro contenedor mediante el siguiente comando:

    ```sh
    docker exec -it app bash
    ```

2. Una vez dentro de nuestro contenedor, ejecutamos el siguiente comando:

    ```sh
    php artisan test
    ```

    Esto ejecuta el observador de pruebas en modo interactivo.

3. Nota: Si los test nos fallan y sale mensaje de que no se puede conectar test_db, ejecutamos el siguiente comando:

    ```sh
    php artisan migrate --env=testing
    ```

Nos va a preguntar que si querems crearla colocmos la letra y, le damos enter y después Y volvemos a ejecutar el comando anterior para correr las pruebas y podemos comprobar que funcionan.

## Acceder a phpMyAdmin

Accedemos a través del siguiente enlace: http://localhost:8080, podemos ver que nuestras base de datos de pruebas y de producción se han creado correctamente.

## Acceso del sistema

Una vez que la aplicación esté corriendo, puedes acceder a las siguientes rutas:

### Gestión de Equipos

-   **Lista de Equipos**: `http://localhost:8081/equipos` GET
    -   Vista principal de equipos registrados
    -   Operaciones disponibles:
        -   Crear equipo: `http://localhost:8081/equipos/guardar` POST
        -   Ver lista: `http://localhost:8081/equipos/cargar` GET

### Gestión de Jugadores

-   **Lista de Jugadores**: `http://localhost:8081/jugadores` GET
    -   Vista principal de jugadores registrados
    -   Operaciones disponibles:
        -   Crear jugador: `http://localhost:8081/jugadores/guardar` POST
            -   Ver lista: `http://localhost:8081/jugadores/cargar` GET

### Simulación de Torneos

-   **Inicio de Simulación**: `http://localhost:8081/simulaciones` GET
    -   Vista principal para iniciar una nueva simulación
    -   Operaciones disponibles:
        -   Crear simulación: `http://localhost:8081/simulaciones/guardar` POST
        -   Ver resultados: `http://localhost:8081/simulaciones/resultados` GET

### Importación de Datos

-   **Importar CSV**: `http://localhost:8081/importaciones` GET
    -   Vista principal para importación
    -   Operaciones disponibles:
        -   Subir archivo: `http://localhost:8081/importaciones/guardar` POST

### Notas importantes:

-   El sistema utiliza rutas amigables y RESTful
-   Todas las URLs base comienzan con `http://localhost:8081`
-   Las operaciones para crear se manejan mediante formularios en las vistas correspondientes
-   Los archivos CSV deben seguir el formato especificado en la documentación
