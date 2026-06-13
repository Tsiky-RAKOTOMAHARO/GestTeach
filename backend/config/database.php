<?php

// lecture .env, file() le transforme en tableau
$lines = file(__DIR__ . '/../../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}


$host = '127.0.0.1';        
$dbname = 'gestTeach';    // nom DB
$user = $_ENV['DB_USER'];            
$password = $_ENV['DB_PASSWORD'];

    // connection 
    $connexion = mysqli_connect($host, $user, $password, $dbname);

    // verification
    if(!$connexion){
      http_response_code(500);
      header('Content-Type: application/json');
      echo json_encode(['error' => mysqli_connect_error()]);
      exit();
    }
?>