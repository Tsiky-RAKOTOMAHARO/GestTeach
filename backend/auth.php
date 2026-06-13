<?php
require_once 'config/cors.php';
require_once 'config/database.php';
require_once 'controllers/AuthController.php';

require_once __DIR__ . '/config/cors.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/EnseignantController.php';

header('Content-Type: application/json');

$controller = new AuthController($connexion);
$controller->login();

?>