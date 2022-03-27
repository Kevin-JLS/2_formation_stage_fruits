<?php 

require_once("classes/fruits_manager.php");

class Fruit {

     private $nom;
     private $poids;
     private $prix;

     public static $fruits = [];

     function __construct($nom, $poids, $prix)
     {
          $this->nom = $nom;
          $this->poids = $poids;
          $this->prix = $prix;
     }

    function getNom() { return $this->nom; }
    function getPrix() { return $this->prix; }
    function getPoids() { return $this->poids; }

     public function __toString() {
          $affichage = $this->getAffichageIMG();
          $affichage .= "Nom : " . $this->nom . '<br />';
          $affichage .= "Poids : " . $this->poids . '<br />';
          $affichage .= "Prix : " . $this->prix . '<br />';
          return $affichage; 
     }

    // Afficher la liste des fruits
     public function afficherListeFruit(){
          $affichage = '<div class="card text-center" style="min-width:200px">';
               $affichage .= $this->getAffichageIMG();
               $affichage .= '<div class="card-body">';
                    $affichage .= '<h5 class="card-title">Nom : ' . $this->nom . '</h5>';
                    $affichage .= '<p class="card-text">Poids : ' . $this->poids . '<br />';
                    $affichage .= "Prix : " . $this->prix . "<br />";
                    $affichage .= "Panier : ";
                    $paniers = panierManager::getPaniers();
                    $panierDuFruit = fruitManager::getPanierFromFruit($this->nom);
                    $affichage .= "<form action='#' method='POST'>";
                         $affichage .= '<input type="hidden" name="idFruit" id="idFruit" value="'.$this->nom.'" />';
                         $affichage .= '<select name="idPanier" id="idPanier" class="form-control form-control-sm" onChange="submit()">';
                         $affichage .='<option value=""></option>';
                         foreach($paniers as $panier){                           
                              if($panierDuFruit === $panier['id']){
                                   $affichage .='<option value="'.$panier['id'].'" selected>'.$panier['NomClient'].'</option>';
                              } else {
                                   $affichage .='<option value="'.$panier['id'].'">'.$panier['NomClient'].'</option>';
                              }
                         }
                         $affichage .= '</select>';
                    $affichage .= "</form>";
                    $affichage .= "</p>";
               $affichage .= "</div>";
          $affichage .= "</div>";
          return $affichage;
     }

     // Modifier un fruit
     public function saveInDB($idPanier) {
          return fruitManager::insertIntoDB($this->nom, $this->poids, $this->prix, $idPanier);
     }

     // Gérer l'affichage des images des fruits  
     private function getAffichageIMG() {
          if(preg_match("/cerise/",$this->nom)) {
               return "<img class='card-img-top mx-auto mt-3' style='width:120px;' src='sources/images/cerise.png' alt='cerise'/> <br> ";
          }
          if(preg_match("/pomme/",$this->nom)) {
               return "<img class='card-img-top mx-auto mt-3' style='width:80px;' src='sources/images/pomme.png' alt='pomme'/> <br> ";
          }
     }

     public function getImageSmall() {
          if(preg_match("/cerise/",$this->nom)) {
               return "<img class='card-img-top mx-auto mt-3' style='width:60px;' src='sources/images/cerise.png' alt='cerise'/> <br> ";
          }
          if(preg_match("/pomme/",$this->nom)) {
               return "<img class='card-img-top mx-auto mt-3' style='width:40px;' src='sources/images/pomme.png' alt='pomme'/> <br> ";
          }
     }

     public static function genererUniqueID(){
          return fruitManager::getNbFruitsInDB() + 1;
     }
}

?>