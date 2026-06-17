<?php

    require_once __DIR__ . '/../models/Enseignant.php';

    class EnseignantController {
    private $model;

    public function __construct($db){
        $this->model = new Enseignant($db);
    }

    public function getAll(){
        $data = $this->model->getAll();
        echo json_encode($data);
    }

    public function create(){
        // lire le body JSON
        $body = json_decode(file_get_contents('php://input'), true);

        // assigner aux attributs du model
        $this->model->matricule = $body['matricule'];
        $this->model->nom = $body['nom'];
        $this->model->prenom = $body['prenom'];
        $this->model->tauxHoraire = $body['tauxHoraire'];
        $this->model->nombreHeure = $body['nombreHeure'];

        // appeler create()
        $status = $this->model->create();

        // 4. renvoyer succès/erreur
        if(!$status){
            http_response_code(500);
            echo json_encode(['error' => 'Une erreur s\' produit.']);
            exit();
        }else
            echo json_encode(['status' => 'success']);
    }
    public function update(){

        $body = json_decode(file_get_contents('php://input'), true);

        $this->model->matricule = $body['matricule'];
        $this->model->nom = $body['nom'];
        $this->model->prenom = $body['prenom'];
        $this->model->tauxHoraire = $body['tauxHoraire'];
        $this->model->nombreHeure = $body['nombreHeure'];

        $status = $this->model->update();

        if(!$status){
            http_response_code(500);
            echo json_encode(['error' => 'Une erreur s\' produit.']);
            exit();
        }else
            echo json_encode(['status' => 'success']);
        
    }
    public function delete(){
        
        $body = json_decode(file_get_contents('php://input'), true);

        $this->model->matricule = $body['matricule'];

        $status = $this->model->delete();

        if(!$status){
            http_response_code(500);
            echo json_encode(['error' => 'Une erreur s\' produit.']);
            exit();
        }else
            echo json_encode(['status' => 'success']);

    }
}

?>