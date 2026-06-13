<?php
require_once __DIR__ . '/config/cors.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/EnseignantController.php';
require_once __DIR__ . '/controllers/AuthController.php'; 

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];  // méthode HTTP
$uri = $_SERVER['REQUEST_URI'];        // URL demandée

$action = $_GET['action'] ?? '';

if ($action === 'login') {
    
    if ($method === 'POST') {
        $authController = new AuthController($connexion);
        $authController->login();
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Méthode non autorisée pour cette action']);
    }

} else {
    
    //Routage CRUD Enseignant
    $controller = new EnseignantController($connexion);

    switch($method){
        case 'GET':
            $controller->getAll();
            break;
        case 'POST':
            $controller->create();
            break;
        case 'PUT':
            $controller->update();
            break;
        case 'DELETE':
            $controller->delete();
            break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Méthode non autorisée']);
    }
}

?>