<?php 

require_once("classes/FruitClass.php");
require_once("classes/bdd.php");

class fruitManager {

     public static function setFruitsFromDatabase() {
          $pdo = monPDO::getPDO();
          $statement = $pdo->prepare("select f.nom as Nom, f.poids as Poids, f.prix as Prix, p.NomClient as Client from fruit f inner join panier p on f.Id = p.Id");
          $statement->execute();
          $fruits = $statement->fetchAll();
          foreach($fruits as $fruit) {
               Fruit::$fruits[] = new Fruit($fruit['Nom'], $fruit['Poids'], $fruit['Prix']);
          }
     }

     public static function getNbFruitsInDB() {
          $pdo = monPDO::getPDO();
          $req = "select count(*) as nbFruit from fruit";
          $statement = $pdo->prepare($req);
          $statement->execute();
          $resultat = $statement->fetch();
          return $resultat['nbFruit'];
     }

     public static function insertIntoDB($nom, $poids, $prix, $idPanier){
          $pdo = monPDO::getPDO();
          $req = "insert into fruit values (:nom, :poids, :prix, :idPanier)";
          $statement = $pdo->prepare($req);
          $statement->bindValue(":nom", $nom, PDO::PARAM_STR);
          $statement->bindValue(":poids", $poids, PDO::PARAM_INT);
          $statement->bindValue(":prix", $prix, PDO::PARAM_INT);
          $statement->bindValue(":idPanier", $idPanier, PDO::PARAM_INT);

          try{
               return $statement->execute();
          } catch (PDOException $e) {
               echo "Erreur : ".$e->getMessage();
               return false;
          }
     }

     public static function updateFruitDB($idFruitToUpdate,$poidsFruitToUpdate,$prixFruitToUpdate){
          $pdo = monPDO::getPDO();
          $req = "update fruit set Poids=:poids,Prix=:prix where nom = :id";
          $stmt = $pdo->prepare($req);
          $stmt->bindValue(":id", $idFruitToUpdate, PDO::PARAM_STR);
          $stmt->bindValue(":poids", $poidsFruitToUpdate, PDO::PARAM_INT);
          $stmt->bindValue(":prix", $prixFruitToUpdate, PDO::PARAM_INT);
          try{
               return $stmt->execute();
          } catch (PDOException $e){
               echo "Erreur : ". $e->getMessage();
               return false;
          }
     }

     public static function deleteFruitFromPanier($idFruitToUpdate){
          $pdo = monPDO::getPDO();
          $req = "update fruit set id = null where nom = :id";
          $stmt = $pdo->prepare($req);
          $stmt->bindValue(":id", $idFruitToUpdate, PDO::PARAM_STR);
          try{
               return $stmt->execute();
          } catch (PDOException $e){
               echo "Erreur : ". $e->getMessage();
               return false;
          }
     }

     public static function getPanierFromFruit($nom){
          $pdo = monPDO::getPDO();
          $stmt = $pdo->prepare("Select p.id as Client from fruit f inner join panier p on f.id = p.id where f.nom = :nom");
          $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
          $stmt->execute();
          $client = $stmt->fetch();
          return $client['Client'];
     }

     public static function updatePanierForFruitDB($idFruit,$idPanier){
          $pdo = monPDO::getPDO();
          $req = "update fruit set id = :idPanier where nom = :idFruit";
          $stmt = $pdo->prepare($req);
          $stmt->bindValue(":idFruit", $idFruit, PDO::PARAM_STR);
          $stmt->bindValue(":idPanier", $idPanier, PDO::PARAM_INT);
          try{
               return $stmt->execute();
          } catch (PDOException $e){
               echo "Erreur : ". $e->getMessage();
               return false;
          }
     }
}

?>