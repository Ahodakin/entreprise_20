<?php
session_start();
include('layouts/app.php');
require_once('fonctions_panier.php');
require_once('connexion_bd.php');

?>

<div class="container">
<div class="row">
	<div class="col-md-6"><h4 class="text-center text-danger">Adresse de livraison de <?php echo $_SESSION['nom'].'   '.$_SESSION['prenom'];?></h4></div>
	
 </div><hr>
 	<div class="row">
 		<div class="col-sm-3">
     	
 		</div>
        <div class="col-sm-9">
        <h4> Votre commande vous sera livrée à l'adresse indiquée ci dessous</h4>
          
           <br>
			
        <div class="col-4">
          <form method ="post">
            <div class="from-group">
                  <label>Adresse</label>
                  <input type="text" class="form-control form-control-sm" name="adresse">
                </div>

                <div class="from-group">
                  <label>Ville</label>
                  <input type="text" class="form-control form-control-sm" name="ville">
                </div>

                <div class="from-group">
                  <label>Contact</label>
                  <input type="text" class="form-control form-control-sm" name="contact">
                </div>

                <div class="from-group">
                  <label>Autres informations</label>
                  <textarea class="form-control form-control-sm" name="autres"></textarea>
                </div>
          </form>
        </div>
           
            <hr />
            <div class="text-left">
            
            <a href="validation.php" class="btn btn-primary btn-sm">Valider l'adresse</a>
           
         
            </div>
        </div>
    </div>
</div>


</body>
</html>