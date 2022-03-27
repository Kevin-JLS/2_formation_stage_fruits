<?php 

require_once("classes/FruitClass.php");
require_once("classes/bdd.php");

class panierManager {

    public static function setPaniersFromDB() {
        $pdo = monPDO::getPDO();
        $statement = $pdo->prepare("select id, NomClient from panier ");
        $statement->execute();
        $paniers = $statement->fetchAll();
        foreach($paniers as $panier) {
            Panier::$paniers[] = new Panier($panier['id'], $panier['NomClient']);
        }
    }

    public static function getFruitPanier($identifiant) {
        $pdo = monPDO::getPDO();
        $req = "select f.nom as fruit, f.poids as poids, f.prix as prix from panier p inner join fruit f on f.id = p.id where p.id = :id";
        $statement = $pdo->prepare($req);
        $statement->bindValue(":id", $identifiant, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function getNbPanierInDB(){
        $pdo = monPDO::getPDO();
        $req = "select count(*) as nbPanier from panier";
        $statement = $pdo->prepare($req);
        $statement->execute();
        $resultat = $statement->fetch(); 
        return $resultat['nbPanier'];
    }

    public static function insertIntoDB($identifiant, $nom) {
        $pdo = monPDO::getPDO();
        $req = "insert into panier (id, NomClient) values (:id, :nom)";
        $statement = $pdo->prepare($req);
        $statement->bindValue(":id", $identifiant, PDO::PARAM_INT);
        $statement->bindValue(":nom", $nom, PDO::PARAM_STR);

        try{
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Erreur : ".$e->getMessage();
            return false;
        }
    }

    public static function getPaniers(){
        $pdo = monPDO::getPDO();
        $stmt = $pdo->prepare("Select id, NomClient from panier");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
    

?>