<?php
require_once 'auth.php';
require_once '../configdb.php';

// Verificar si el usuario está autenticado
if (!isAuthenticated()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Obtener el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Conectar a la base de datos
$pdo = getDbConnection();

// Manejar las operaciones CRUD
switch ($method) {
    case 'GET':
        // Leer todos los servicios o un servicio específico
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $pdo->prepare('SELECT * FROM services WHERE id = ?');
            $stmt->execute([$id]);
            $data = $stmt->fetch();
        } else {
            $stmt = $pdo->query('SELECT * FROM services');
            $data = $stmt->fetchAll();
        }
        break;
    case 'POST':
        // Crear un nuevo servicio
        $input = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('INSERT INTO services (titulo_esp, titulo_eng, descripcion_esp, descripcion_eng, activo) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $input['titulo']['esp'],
            $input['titulo']['eng'],
            $input['descripcion']['esp'],
            $input['descripcion']['eng'],
            $input['activo']
        ]);
        $data = ['id' => $pdo->lastInsertId()];
        break;
    case 'PUT':
        // Actualizar un servicio existente
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $input = json_decode(file_get_contents('php://input'), true);
            $stmt = $pdo->prepare('UPDATE services SET titulo_esp = ?, titulo_eng = ?, descripcion_esp = ?, descripcion_eng = ?, activo = ? WHERE id = ?');
            $stmt->execute([
                $input['titulo']['esp'],
                $input['titulo']['eng'],
                $input['descripcion']['esp'],
                $input['descripcion']['eng'],
                $input['activo'],
                $id
            ]);
            $data = ['message' => 'Service updated'];
        } else {
            http_response_code(400);
            $data = ['error' => 'ID is required'];
        }
        break;
    case 'DELETE':
        // Eliminar un servicio existente
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $pdo->prepare('DELETE FROM services WHERE id = ?');
            $stmt->execute([$id]);
            $data = ['message' => 'Service deleted'];
        } else {
            http_response_code(400);
            $data = ['error' => 'ID is required'];
        }
        break;
    default:
        http_response_code(405);
        $data = ['error' => 'Method not allowed'];
        break;
}

// Devolver la respuesta en formato JSON
echo json_encode($data);
?>