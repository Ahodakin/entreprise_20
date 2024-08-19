<?php
require_once('fonctions_panier.php');
?>
    <div class="card border-dark mb-3" style="max-width: 18rem;">
		<h4><div class="card-header bg-primary text-center text-white">Nos Produits</div></h4>
     	<div class="card-body text-dark">
            <?php
			/*
               include("connexion_bd.php");
			
                $req=$cnx->query("select * from categorie");
                while($res=$req-> fetch())
                {
                    echo '<a href="categorie_article.php?cat='.$res[0].'"> '.$res[1].' </a><br>';
                }
					*/
            ?>
     		
     	</div>
    </div>
	<div class="card border-dark mb-3" style="max-width: 18rem;">
     	<h4><div class="card-header bg-primary text-center text-white">Info panier</div></h4>
     	<div class="card-body text-primary">
     		<?php
				$nbre=compterProduit();
				if($nbre!=0)
				{
		    	echo $nbre .' article(s) dans le panier';
				}
				else
				{
					echo'Votre panier est vide';
				}
			?>
           <a href="panier.php"> <img src="img/panier.png" height="20" width="20"></a>
            
     	</div>
    </div>
</body>
</html>