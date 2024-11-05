<?php

// Configuración de cabeceras para API REST
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');



// Manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a base de datos (ajusta los valores según tu configuración)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'api');

// Crear conexión
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode([
        'error' => true,
        'mensaje' => 'Error de conexión: ' . $conn->connect_error
    ]));
}

// Función para validar el token
function validarToken() {
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        return false;
    }

    $authHeader = $headers['Authorization'];
    if (empty($authHeader) || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        return false;
    }

    $token = $matches[1];
    // Verificamos si el token es 'ciisa'
    return $token === 'ciisa';
}

// Verificar el método OPTIONS para CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Verificar token ANTES de procesar cualquier solicitud
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

// Procesar solicitud según método HTTP
switch($method) {
    case 'GET':
        if ($recurso === 'usuarios') {
            if (isset($request[1])) {
                // Obtener un usuario específico
                $id = $request[1];
                $sql = "SELECT * FROM usuarios WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $response = $result->fetch_assoc();
            } else {
                // Obtener todos los usuarios
                $sql = "SELECT * FROM usuarios";
                $result = $conn->query($sql);
                $response = [];
                while($row = $result->fetch_assoc()) {
                    $response[] = $row;
                }
            }
        }
        break;
        
    case 'POST':
        if ($recurso === 'usuarios') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['nombre']) && isset($data['email'])) {
                $nombre = $conn->real_escape_string($data['nombre']);
                $email = $conn->real_escape_string($data['email']);
                $sql = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("ss", $nombre, $email);
                    if ($stmt->execute()) {
                        $response = [
                            'error' => false,
                            'mensaje' => 'Usuario creado exitosamente',
                            'id' => $conn->insert_id
                        ];
                    } else {
                        $response = ['error' => true, 'mensaje' => 'Error al crear usuario: ' . $stmt->error];
                    }
                    $stmt->close();
                } else {
                    $response = ['error' => true, 'mensaje' => 'Error en la preparación de la consulta: ' . $conn->error];
                }
            } else {
                $response = ['error' => true, 'mensaje' => 'Datos incompletos'];
            }
        }
        break;
        
    case 'PUT':
        if ($recurso === 'usuarios' && isset($request[1])) {
            $id = $request[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $data['nombre'], $data['email'], $id);
            
            if ($stmt->execute()) {
                $response = ['error' => false, 'mensaje' => 'Usuario actualizado exitosamente'];
            } else {
                $response = ['error' => true, 'mensaje' => 'Error al actualizar usuario'];
            }
        }
        break;
        
    case 'DELETE':
        if ($recurso === 'usuarios' && isset($request[1])) {
            $id = $request[1];
            $sql = "DELETE FROM usuarios WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $response = ['error' => false, 'mensaje' => 'Usuario eliminado exitosamente'];
            } else {
                $response = ['error' => true, 'mensaje' => 'Error al eliminar usuario'];
            }
        }
        break;
        
    default:
        // Método no permitido
        http_response_code(405);
        $response = ['error' => true, 'mensaje' => 'Método no permitido'];
        break;
}

// Enviar respuesta
echo json_encode($response);

// Cerrar conexión
$conn->close();
