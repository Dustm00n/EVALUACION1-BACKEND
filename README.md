# API REST de Gestión de Usuarios

Esta API proporciona endpoints para realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) sobre usuarios, con dos implementaciones diferentes:

## 1. API con Base de Datos MySQL (v1)
Implementación que utiliza una base de datos MySQL para almacenar los datos de usuarios.

### Configuración Inicial MySQL
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

### Endpoints MySQL
- GET /v1/usuarios - Obtiene todos los usuarios
- GET /v1/usuarios/{id} - Obtiene un usuario específico
- POST /v1/usuarios - Crea un nuevo usuario
- PUT /v1/usuarios/{id} - Actualiza un usuario existente
- DELETE /v1/usuarios/{id} - Elimina un usuario

## 2. API con Archivo JSON (v2)
Implementación alternativa que utiliza un archivo JSON como almacenamiento de datos.

### Configuración Inicial JSON
1. Requisitos:
   - PHP 7.0 o superior
   - Servidor web (Apache/Nginx)
   - Permisos de escritura en el directorio data/

2. Estructura del archivo JSON (data/usuarios.json):
   ```json
   {
       "usuarios": [
           {
               "id": 1,
               "nombre": "Juan Pérez",
               "email": "juan@ejemplo.com"
           }
       ]
   }
   ```

### Endpoints JSON
- GET /v2crudjson/usuarios - Obtiene todos los usuarios
- GET /v2crudjson/usuarios/{id} - Obtiene un usuario específico
- POST /v2crudjson/usuarios - Crea un nuevo usuario
- PUT /v2crudjson/usuarios/{id} - Actualiza un usuario existente
- DELETE /v2crudjson/usuarios/{id} - Elimina un usuario

## Autenticación
Ambas versiones utilizan autenticación por token:
- Token requerido: 'ciisa'
- Debe enviarse en el header: Authorization: Bearer ciisa


¡Disfrute usando esta API CRUD de usuarios!

