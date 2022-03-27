<?php 
    require_once("classes/FruitClass.php");
    require_once("classes/PanierClass.php");
    require_once("classes/bdd.php");
    require_once("classes/paniers_manager.php");
    require_once("classes/fruits_manager.php");
    include("common/header.php");
    include("common/menu.php");
?>

<div class="container mt-5 mb-5">

    <?php 

     // Modification
     if(isset($_POST['idFruit']) && $_POST['type'] === "modification"){
          $idFruitToUpdate = $_POST['idFruit'];
          $poidsFruitToUpdate = (int) $_POST['poidsFruits'];
          $prixFruitToUpdate = (int) $_POST['prixFruits'];
          $res = fruitManager::updateFruitDB($idFruitToUpdate,$poidsFruitToUpdate,$prixFruitToUpdate);
          if($res){
               echo '<div class="alert alert-success mt-3" role="alert">La modification a bien été effectuée</div>';
          } else {
               echo '<div class="alert alert-danger mt-3" role="alert">La modification n\'a pas été effectuée</div>';
          }
     // Suppression d'un fruit
     } else if(isset($_POST['idFruit']) && $_POST['type'] === "supprimer"){
          $idFruitToUpdate = $_POST['idFruit'];
          $res = fruitManager::deleteFruitFromPanier($idFruitToUpdate);
          if($res){
               echo '<div class="alert alert-success mt-3" role="alert">La suppression a bien été effectuée</div>';
          } else {
               echo '<div class="alert alert-danger mt-3" role="alert">La suppression n\'a pas été effectuée en BD</div>';
          }
     }

     panierManager::setPaniersFromDB();

     foreach(Panier::$paniers as $panier) {
          $panier->setFruitToPanierFromDB();
          echo $panier;
     }

    ?>

</div>

<?php include("common/footer.php"); ?>