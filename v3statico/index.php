<?php
require_once 'auth.php';
require_once 'services.php';
require_once 'about.php';

// Obtener la ruta solicitada
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);
$pathSegments = explode('/', trim($path, '/'));

// Verificar la ruta y aplicar autenticación si es necesario
if (isset($pathSegments[3])) {
    switch ($pathSegments[3]) {
        case 'services':
            require_once 'auth.php'; // Aplicar autenticación para /services
            $data = getServices();
            break;
        case 'about':
            $data = getAbout();
            break;
        default:
            http_response_code(404);
            $data = ['error' => 'Not Found'];
            break;
    }
} else {
    $data = [
        'services' => getServices(),
        'about' => getAbout()
    ];
}

// Return del contenido
echo json_encode($data);
?>