<?php 

    class Enseignant {
    private $connexion;

    // attributs
    public $id;
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

        $stmt = mysqli_prepare($this->connexion, "INSERT INTO Enseignant(matricule, nom, prenom, tauxHoraire, nombreHeure) VALUES (?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "sssdi", $this->matricule, $this->nom, $this->prenom, $this->tauxHoraire, $this->nombreHeure);

        return mysqli_stmt_execute($stmt); //retourne true /false

    }
    public function update(){

        $stmt = mysqli_prepare(
                $this->connexion,
                "UPDATE Enseignant SET matricule=?, nom=?, prenom=?, tauxHoraire=?, nombreHeure=? WHERE id=?"
        );

        mysqli_stmt_bind_param($stmt, "sssdii", $this->matricule, $this->nom, $this->prenom, $this->tauxHoraire, $this->nombreHeure, $this->id);


        return mysqli_stmt_execute($stmt); //retourne true /false
        
    }
    public function delete(){

        $stmt = mysqli_prepare($this->connexion,"DELETE FROM Enseignant WHERE id=?");
        mysqli_stmt_bind_param($stmt, "i", $this->id);

        
        return mysqli_stmt_execute($stmt); //retourne true /false

    }
}

?>