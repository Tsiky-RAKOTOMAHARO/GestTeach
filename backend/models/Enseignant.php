<?php 

    class Enseignant {
    private $connexion;

    // attributs
    public $matricule;
    public $nom;
    public $prenom;
    public $tauxHoraire;
    public $nombreHeure;
    
    public function __construct($db){
        $this->connexion = $db;
    }
    
    // methode
    public function getAll(){
        $sql = "SELECT * FROM Enseignant"; 
        $result = mysqli_query($this->connexion, $sql);

        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }
    public function create(){

        $stmt = mysqli_prepare($this->connexion, "INSERT INTO Enseignant(nom, prenom, tauxHoraire, nombreHeure) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "ssdi", $this->nom, $this->prenom, $this->tauxHoraire, $this->nombreHeure);

        return mysqli_stmt_execute($stmt); //retourne true /false

    }
    public function update(){

        $stmt = mysqli_prepare(
                $this->connexion,
                "UPDATE Enseignant SET nom=?, prenom=?, tauxHoraire=?, nombreHeure=? WHERE matricule=?"
        );

        mysqli_stmt_bind_param($stmt, "ssdii", $this->nom, $this->prenom, $this->tauxHoraire, $this->nombreHeure, $this->matricule);


        return mysqli_stmt_execute($stmt); //retourne true /false
        
    }
    public function delete(){

        $stmt = mysqli_prepare($this->connexion,"DELETE FROM Enseignant WHERE matricule=?");
        mysqli_stmt_bind_param($stmt, "i", $this->matricule);

        
        return mysqli_stmt_execute($stmt); //retourne true /false

    }
}

?>