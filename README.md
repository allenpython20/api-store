# Proyecto de Tienda de Tecnología

Este proyecto es un REST Server desarrollado en CodeIgniter 4, utilizando PHP 7.4. El propósito de este servidor es facilitar la gestión y operación de una tienda de productos tecnológicos.

## Características Principales

- **Gestión de Usuarios:** El sistema permite la creación, edición, eliminación y listado de usuarios. La tabla de usuarios tiene una relación de clave foránea con la tabla de roles.

- **Roles y Permisos:** Los usuarios están asociados a roles que determinan sus permisos. La gestión de roles se realiza a través de la tabla de roles.

- **Gestión de Categorías:** Las categorías de productos están definidas en la tabla de categorías y se relacionan mediante una clave foránea con la tabla de usuarios.

- **Gestión de Productos:** Los productos están asociados a usuarios y categorías a través de claves foráneas. Se permite la creación, edición, eliminación y listado de productos.

- **Autenticación JWT:** El sistema cuenta con autenticación utilizando JSON Web Tokens (JWT) para garantizar la seguridad y la integridad de las comunicaciones.

## Configuración

### Requisitos

- PHP 7.4 o superior.
- [CodeIgniter 4](https://codeigniter.com/).

### Instalación

1. Clona el repositorio en tu entorno local.

```bash
git clone https://github.com/allenpython20/api-store.git
```
2. Ejecuta el siguiente comando en la raíz del proyecto para instalar las dependencias.

```bash
composer install
```

3. Configura la base de datos en .env con tus credenciales.
```bash
DB_HOST=tu_host
DB_DATABASE=tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```
4. Ejecuta las migraciones para crear las tablas necesarias.
```bash
php spark migrate
```
5. Inicia el servidor local.
```bash
php spark seve
```

### Documentación
- [Postman](https://documenter.getpostman.com/view/12106004/2s9YCBvVjw)

