<?php
class AuthController {
    private $connexion;

    public function __construct($db){
        $this->connexion = $db;
    }

    public function login(){
        //lire body JSON
        $body = json_decode(file_get_contents('php://input'), true);
        $userName = $body['userName'];
        $userPassword = $body['userPassword'];

        //chercher userName en base
        $stmt = mysqli_prepare($this->connexion, "SELECT * FROM Utilisateur WHERE userName=?");
        mysqli_stmt_bind_param($stmt,"s", $userName);

        $success = mysqli_stmt_execute($stmt);

        // verification execution
        if(!$success){
            http_response_code(500);
            echo json_encode(['error' => mysqli_error($this->connexion)]);
            exit();
        }

        // recuperation info db
        $result = mysqli_stmt_get_result($stmt);
        $utilisateur = mysqli_fetch_assoc($result);

        // username introuvable 
        if(!$utilisateur){
            http_response_code(401);
            echo json_encode(['error' => 'Indentifiants incorrects']);
            exit();
        }

        // verification mot de passe
        if(!password_verify($userPassword,$utilisateur['userPassword'])){
            http_response_code(401);
            echo json_encode(['error' => 'Mot de passe incorrect']);
            exit();
        }

        // reponse
        echo json_encode([
            'status' => 'Succes',
            'message' => 'Authentification reussi'
        ]);
    }
}