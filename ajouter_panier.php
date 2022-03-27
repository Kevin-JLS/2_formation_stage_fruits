<?php 

require_once("classes/FruitClass.php");
require_once("classes/PanierClass.php");
require_once("classes/bdd.php");
require_once("classes/paniers_manager.php");
include("common/header.php");
include("common/menu.php");

?>

<div class="container mt-5">

     <h1>Ajouter un panier</h1>

    <form action="#" method="POST" class="mt-5">
        <div class="row">
            <div class="col">
                <label for="client">Nom du client : </label>
                <input class="form-control" type="text" name="client" id="client" required>
            </div>
            <div class="col">
                <label for="nb_pommes">Nombre de pommes : </label>
                <input class="form-control" type="number" name="nb_pommes" id="nb_pommes" required>
            </div>
            <div class="col">
                <label for="nb_cerises">Nombre de cerises : </label>
                <input class="form-control" type="number" name="nb_cerises" id="nb_cerises" required>
            </div>
        </div>
        <input class="btn btn-success mt-3" type="submit" value="Créer le panier">
    </form>

    <?php 
    
        if(isset($_POST['client']) && !empty($_POST['client'])) {

            $p = new Panier(Panier::generateUniqueId(), $_POST["client"]);
            $res = $p->saveInDB();
            
            if($res) {
                $nb_pommes = (int)$_POST['nb_pommes'];
                $nb_cerises = (int)$_POST['nb_cerises'];

                $compteur = 1;
                $nbFruitInDB = Fruit::genererUniqueID();
                for($i = 0; $i < $nb_pommes; $i++) {
                    $fruit = new Fruit("pomme".($nbFruitInDB+$compteur), rand(120, 160), 20);
                    $fruit->saveInDB($p->getIdentifiant());
                    $p->addFruit($fruit);
                    $compteur ++;
                }
                for($i = 0; $i < $nb_cerises; $i++) {
                    $fruit = new Fruit("cerise".($nbFruitInDB+$compteur), rand(40, 70), 26);
                    $fruit->saveInDB($p->getIdentifiant());
                    $p->addFruit($fruit);
                    $compteur ++;
                }

                echo '<div class="alert alert-success mt-3" role="alert">L\'ajout du nouveau panier a reussi.</div>';
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">L\'ajout n\'a pas fonctionné.</div>';
            }     
        }

    ?>

</div>

<?php 
    include("common/footer.php");
?>