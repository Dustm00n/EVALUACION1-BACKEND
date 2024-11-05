# API REST de Gestión de Usuarios

Esta API proporciona endpoints para realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) sobre usuarios.

## Configuración Inicial

1. Asegúrese de tener instalado:
   - PHP 7.0 o superior
   - MySQL/MariaDB
   - Servidor web (Apache/Nginx)

2. Configure la base de datos:
   ```sql
   CREATE DATABASE api;
   USE api;
   
   CREATE TABLE usuarios (
     id INT AUTO_INCREMENT PRIMARY KEY,
     nombre VARCHAR(100) NOT NULL,
     email VARCHAR(100) NOT NULL
   );
   ```

3. Ajuste las credenciales de la base de datos en `configapi.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root'); 
   define('DB_PASS', '');
   define('DB_NAME', 'api');
   ```

## Endpoints Disponibles

### Obtener Usuarios
- **GET** `/api/v1/usuarios`
  - Obtiene lista de todos los usuarios
- **GET** `/api/v1/usuarios/{id}`
  - Obtiene un usuario específico por ID

### Crear Usuario
- **POST** `/api/v1/usuarios`
  - Crea un nuevo usuario
  - Cuerpo de la petición (JSON):
    ```json
    {
        "nombre": "Juan Pérez",
        "email": "juan@ejemplo.com"
    }
    ```

### Actualizar Usuario
- **PUT** `/api/v1/usuarios/{id}`
  - Actualiza un usuario existente
  - Cuerpo de la petición (JSON):
    ```json
    {
        "nombre": "Juan Pérez Actualizado",
        "email": "juan.nuevo@ejemplo.com"
    }
    ```

### Eliminar Usuario
- **DELETE** `/api/v1/usuarios/{id}`
  - Elimina un usuario por ID

## Ejemplos de Uso

### Usando cURL

1. Obtener todos los usuarios:
   ```
   curl -X GET http://localhost/api/v1/usuarios
   ```

2. Obtener un usuario específico (ID: 1):
   ```
   curl -X GET http://localhost/api/v1/usuarios/1
   ```

3. Crear un nuevo usuario:
   ```
   curl -X POST http://localhost/api/v1/usuarios \
   -H "Content-Type: application/json" \
   -d '{"nombre":"María García","email":"maria@ejemplo.com"}'
   ```

4. Actualizar un usuario (ID: 1):
   ```
   curl -X PUT http://localhost/api/v1/usuarios/1 \
   -H "Content-Type: application/json" \
   -d '{"nombre":"María García Actualizada","email":"maria.nueva@ejemplo.com"}'
   ```

5. Eliminar un usuario (ID: 1):
   ```
   curl -X DELETE http://localhost/api/v1/usuarios/1
   ```

## Notas Importantes

- Asegúrese de que el archivo `configapi.php` esté en el directorio correcto y sea accesible.
- Verifique que los permisos del servidor web sean adecuados para ejecutar scripts PHP.
- Para pruebas en entorno de desarrollo, puede usar herramientas como Postman o Insomnia para interactuar con la API de manera más sencilla.
- En un entorno de producción, considere implementar medidas de seguridad adicionales como autenticación y limitación de tasa.

¡Disfrute usando esta API CRUD de usuarios!

