<?php 

require_once("classes/FruitClass.php");
require_once("classes/PanierClass.php");
require_once("classes/bdd.php");
require_once("classes/fruits_manager.php");
include("common/header.php");
include("common/menu.php");

?>

<div class="container mt-5">

     <h1>Fruits</h1>

    <?php 

     if(isset($_POST['idPanier'])){
          $idFruit = $_POST['idFruit'];
          $idPanier = (int) $_POST['idPanier'];
          $res = fruitManager::updatePanierForFruitDB($idFruit,$idPanier);
          if($res){
               echo '<div class="alert alert-success mt-2" role="alert">La modification a été effectuée en BD</div>';
          } else {
               echo '<div class="alert alert-danger mt-2" role="alert">La modification n\'a pas été effectuée en BD</div>';
          }
     }

        fruitManager::setFruitsFromDatabase();

        echo '<div class="row">';

          foreach(Fruit::$fruits as $fruit) {
               echo '<div class="col-sm mb-2">';
               echo $fruit->afficherListeFruit();
               echo '</div>';    
          }
            
        echo '</div>';

    ?>

</div>

<?php 
    include("common/footer.php");
?>