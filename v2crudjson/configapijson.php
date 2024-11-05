<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ruta al archivo JSON
define('JSON_FILE', __DIR__ . '/data/usuarios.json');

// Función para validar el token
function validarToken() {
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        return false;
    }
    $authHeader = $headers['Authorization'];
    return str_replace('Bearer ', '', $authHeader) === 'ciisa';
}

// Funciones auxiliares para manejar el JSON
function leerDatos() {
    if (!file_exists(JSON_FILE)) {
        return ['usuarios' => []];
    }
    return json_decode(file_get_contents(JSON_FILE), true);
}

function guardarDatos($datos) {
    file_put_contents(JSON_FILE, json_encode($datos, JSON_PRETTY_PRINT));
}

// Verificar token
if (!validarToken()) {
    http_response_code(401);
    echo json_encode([
        'error' => true,
        'mensaje' => 'Token no válido o no proporcionado'
    ]);
    exit;
}

$response = ['error' => true, 'mensaje' => 'Recurso no encontrado o método no permitido'];

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$recurso = $request[0] ?? null;

switch($method) {
    case 'GET':
        if ($recurso === 'usuarios') {
            $datos = leerDatos();
            if (isset($request[1])) {
                // Obtener usuario específico
                $id = (int)$request[1];
                $usuario = array_filter($datos['usuarios'], function($u) use ($id) {
                    return $u['id'] === $id;
                });
                $response = reset($usuario) ?: ['error' => true, 'mensaje' => 'Usuario no encontrado'];
            } else {
                // Obtener todos los usuarios
                $response = $datos['usuarios'];
            }
        }
        break;
        
    case 'POST':
        if ($recurso === 'usuarios') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['nombre']) && isset($data['email'])) {
                $datos = leerDatos();
                // Generar nuevo ID
                $maxId = 0;
                foreach ($datos['usuarios'] as $usuario) {
                    $maxId = max($maxId, $usuario['id']);
                }
                $nuevoUsuario = [
                    'id' => $maxId + 1,
                    'nombre' => $data['nombre'],
                    'email' => $data['email']
                ];
                $datos['usuarios'][] = $nuevoUsuario;
                guardarDatos($datos);
                $response = [
                    'error' => false,
                    'mensaje' => 'Usuario creado exitosamente',
                    'usuario' => $nuevoUsuario
                ];
            } else {
                $response = ['error' => true, 'mensaje' => 'Datos incompletos'];
            }
        }
        break;
        
    case 'PUT':
        if ($recurso === 'usuarios' && isset($request[1])) {
            $id = (int)$request[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $datos = leerDatos();
            $encontrado = false;
            
            foreach ($datos['usuarios'] as &$usuario) {
                if ($usuario['id'] === $id) {
                    $usuario['nombre'] = $data['nombre'] ?? $usuario['nombre'];
                    $usuario['email'] = $data['email'] ?? $usuario['email'];
                    $encontrado = true;
                    break;
                }
            }
            
            if ($encontrado) {
                guardarDatos($datos);
                $response = ['error' => false, 'mensaje' => 'Usuario actualizado exitosamente'];
            } else {
                $response = ['error' => true, 'mensaje' => 'Usuario no encontrado'];
            }
        }
        break;
        
    case 'DELETE':
        if ($recurso === 'usuarios' && isset($request[1])) {
            $id = (int)$request[1];
            $datos = leerDatos();
            $initialCount = count($datos['usuarios']);
            
            $datos['usuarios'] = array_filter($datos['usuarios'], function($u) use ($id) {
                return $u['id'] !== $id;
            });
            
            if (count($datos['usuarios']) < $initialCount) {
                guardarDatos($datos);
                $response = ['error' => false, 'mensaje' => 'Usuario eliminado exitosamente'];
            } else {
                $response = ['error' => true, 'mensaje' => 'Usuario no encontrado'];
            }
        }
        break;
}

echo json_encode($response);