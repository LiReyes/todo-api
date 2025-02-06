<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Proyecto TODO-API

Este es un proyecto API basado en Laravel que utiliza MariaDB como base de datos. A continuación, se detallan los pasos necesarios para correr el proyecto en tu entorno local.

## Requisitos previos

- [Docker](https://www.docker.com/products/docker-desktop) para ejecutar el contenedor de MariaDB.
- [PHP](https://www.php.net/downloads.php) (recomendado PHP 8.2).
- [Composer](https://getcomposer.org/) para gestionar las dependencias de PHP.
- [Laravel](https://laravel.com/docs/9.x) (si se quiere usar el CLI de Laravel).

## Pasos para ejecutar el proyecto

"Se ejecutan todos en la raiz del proyecto"

### 1. Levantar el contenedor Docker para MariaDB

Primero, necesitamos levantar el contenedor de MariaDB utilizando Docker. En la terminal, navega al directorio del proyecto y ejecuta el siguiente comando:

```bash
docker compose up
```

Esto descargará y ejecutará el contenedor de MariaDB para la base de datos. Asegúrate de que el contenedor se haya levantado correctamente antes de proceder.

### 2. Instalar dependencias de PHP

Una vez que el contenedor de MariaDB esté corriendo, ejecuta los siguientes comandos para instalar las dependencias de PHP necesarias:

```bash
composer install
composer update
```

### 3. Copiar .env.example 

Crear .env y copiar el contenido del .env.example
y remplazar el aparto de la BD con estos valores:

```bash
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=todo-db
DB_USERNAME=root
DB_PASSWORD=root
```

Esto descargará todas las dependencias especificadas en el archivo `composer.json` para el proyecto Laravel.

### 4. Ejecutar migraciones y sembrado de datos

Para crear las tablas en la base de datos y llenar con datos de prueba, ejecuta el siguiente comando:

```bash
php artisan migrate:refresh --seed
```

Este comando refresca las migraciones y ejecuta las semillas, asegurando que tu base de datos esté lista para usarse.

### 5. Levantar el servidor de desarrollo

Finalmente, levanta el servidor de desarrollo de Laravel para comenzar a interactuar con la API:

```bash
php artisan serve
```

Esto iniciará el servidor en `http://127.0.0.1:8000`, y podrás acceder a la API a través de este URL.

---

```bash
API URL = http://127.0.0.1:8000 o http://localhost:8000
```
# Endpoint: http://localhost:8000/api/users/

### Métodos Permitidos:
- `GET`: Obtener una lista de usuarios o un usuario específico.
- `POST`: Crear un nuevo usuario.
- `PUT`: Actualizar un usuario existente.
- `PATCH`: Actualizar parcialmente un usuario.
- `DELETE`: Eliminar un usuario.

### Filtros Disponibles:
Puedes aplicar filtros para buscar usuarios según los siguientes campos:
- `username`
- `UserUsername`
- `UserEmail`
- `email`

### Parámetros de Filtrado:
- Para filtrar por un campo específico, agrega el parámetro `filter[<campo>]` en la consulta. Ejemplo: `filter[username]=john`.
- Además, puedes usar el parámetro `sort` para ordenar los resultados, en DESC = '-'
- `perPage` para limitar la cantidad de registros por página y habilita el enpaginado

### Ejemplos:

#### Filtrar por `username` en un `GET`:
```bash
GET http://localhost:8000/api/users?filter[username]=john&sort=-email&perPage=5
```

# Endpoint: http://localhost:8000/api/tasks/


### Métodos Permitidos:
- `GET`: Obtener una lista de tareas o una tarea específica.
- `POST`: Crear una nueva tarea.
- `PUT`: Actualizar una tarea existente.
- `PATCH`: Actualizar parcialmente una tarea.
- `DELETE`: Eliminar una tarea.

### Filtros Disponibles:
Puedes aplicar filtros para buscar tareas según los siguientes campos:
- `TaskUser_id` (equivalente a `user_id`)
- `TaskTitle` (equivalente a `title`)
- `TaskDescription` (equivalente a `description`)
- `TaskStatus` (equivalente a `status`)

### Parámetros de Filtrado:
- Para filtrar por un campo específico, agrega el parámetro `filter[<campo>]` en la consulta. Ejemplo: `filter[TaskUser_id]=1`.
- Además, puedes usar el parámetro `sort` para ordenar los resultados y `perPage` para limitar la cantidad de registros por página.

### Ejemplos:

#### Filtrar por `TaskUser_id` en un `GET`:
```bash
GET http://localhost:8000/api/tasks?filter[TaskUser_id]=1
