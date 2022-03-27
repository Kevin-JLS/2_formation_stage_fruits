
<?php 
    include("common/header.php");
    include("common/menu.php");
?>

<div class="container mt-5">

     <h1>Mini projet PHP POO - Stage 2022</h1>

     <div class="row">
          <div class="col">
               <h2 class="text-center m-5">Gestion des paniers</h2>
               <div class="mx-auto" style="width:300px;">
                    <a class="btn btn-outline-primary d-block" href="afficher_paniers.php" role="button">Paniers</a>
               </div>           
          </div>
          <div class="col">
               <h2 class="text-center m-5">Gestion des fruits</h2>
               <div class="mx-auto" style="width:300px;">
                    <a class="btn btn-outline-primary d-block" href="afficherFruits.php" role="button">Fruits</a>
               </div>       
          </div>
     </div>
</div>

<?php include("common/footer.php"); ?>