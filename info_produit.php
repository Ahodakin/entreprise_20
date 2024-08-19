<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<?php
	session_start();
	if(!$_SESSION['id'])
	{
		header("location:login.php");
	}
     include('layouts/app.php');
     ?>
	 
 <div class="container-fluid blog my-4">
 	<div class="row">
   		<div class="col-sm-2">
			<?php
			
				$p=$_GET['p'];
				include('connexion_bd.php');
				$req=$cnx-> prepare("select * from boutique_pro where id_prod=:p");
				$req->execute(array("p"=>$p));
				$res=$req->fetch();
			?>
    	</div>
 	<div class="col-sm-8">
	 <div class="card border-primary">
	 	<div class="card-header text-center bg-primary"><h3 class="text-white">Information sur le produit</div>
			<div class="card-body">
        		<div class="row">
        			<div class="col-sm-5">
						<img src="boutique/<?php echo $res[4];?>" class="card-img-top" alt="" width="100%" height="100%" style="border:2px solid;">
        			</div>
                    <div class="col-sm-7">
               			<h2> <?php echo $res[1];?></h2>
                        <p> <?php echo $res[5];?></p>
                        <p> Prix: <?php echo $res[2];?> F FCA</p><br><br>
                       <a class="btn btn-success btn-sm" href="panier.php?action=ajout&amp;d=<?php echo $res[0]; ?>&amp;l=<?php echo $res[1]; ?>&amp;q=1&amp;p=<?php echo $res[2]; ?>">Ajouter au panier<i class="bi bi-cart"></i></a>
					   <button class="btn btn-primary btn-sm" onclick="window.history.back();">Retour</button>
					</div>
        		</div>
			</div>
		</div>
	</div>
</div>
</div>


</body>
</html>

