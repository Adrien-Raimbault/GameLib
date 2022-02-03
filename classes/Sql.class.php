<?php

// Création d'une class Sql,
// constructor qui fasse la connection

// destructeur qui déconnecte
// method qui fasse l'insertion

class Sql {
    private string $serverName = "localhost";
    private string $userName = "root";
    private string $userDB = "exercice";
    private string $userPassword= "root";
    private object $connexion;
    
    public function __construct()
    {
        try {
            $this->connexion = new PDO("mysql:host=$this->serverName; dbname=$this->userDB", $this->userName, $this->userPassword);
        }
        
        catch (PDOException $e){
            $this->connexion->rollBack();
            die("Erreur : " . $e->getMessage());
        }
    }

    public function insert(sql){
        $this->connexion->beginTransaction();
        $this->connexion->exec($sql);
        $this->connexion->commit();
        echo "<p>Insertion effectuée</p>";
    }
    
    public function __destruct()
    {
        unset($this->connexion);
    }
}