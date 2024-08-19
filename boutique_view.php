<?php
session_start();
if(!$_SESSION["id"])
{
	header("location:login.php");
}
include('layouts/app.php');
?>
<br>
 <div class="container-fluid blog my-2">
 <div class="row justify-content-center">
 <head>
	<style>
		img{
    width: 100px;
    transition: transform .1s;
    }

    img:hover{
        -ms-transform: scale(1.5); /* IE 9 */
        -webkit-transform: scale(1.5); /* Safari 3-8 */
        transform: scale(1.5);
        }
		</style>

</head>
   
 <?php
    // select de l'id de la boutique dans laquelle se trouve le produit
   include('connexion_bd.php');
   $reqt=$cnx->prepare("select id_btk from boutique where id_artisan=:id");
   $reqt->execute(array("id"=>$_SESSION["num"])) or die(print_r($reqt->errorCode()));
   $resu=$reqt->fetch();
?>
<div class="col-sm-12">
	<div class="row justify-content" >
			<?php


					 // pagination
					 $requete=$cnx->prepare("select count(*) from boutique_pro where id_btk=:id");
					 $requete->execute(array("id"=>$resu[0]));
					 $count=$requete->fetch();
					 $nbre_elt_par_page=8;
					 $nbre_pages=ceil($count[0]/$nbre_elt_par_page);

					 @$page=$_GET["page"];
					 if(empty($page) or $page>$nbre_pages) $page=1;
					 $debut=($page-1)*$nbre_elt_par_page;

					include("connexion_bd.php");
					$req=$cnx-> prepare("select * from boutique_pro where id_btk=:id limit $debut, $nbre_elt_par_page ");
                    $req->execute(array("id"=>$resu[0])) or die(print_r($req->errorInfo()));
					while ($res=$req->fetch()) {
					?>
                    
                    <div class="card col-sm-2 border-primary m-1">
   						<img src="boutique/<?php echo $res[4];?>" class="card-img-top" alt="" width="100" height="150" >
    						<div class="card-body">
     							 <h6 class="card-title"><?php echo $res[1];?></h6>
      							 <p class="card-text"> <?php echo $res[2];?> FCFA</p>
    						</div>
   						    <div class="card-footer text-center">
      						<small>
                            <a class="btn btn-primary btn-sm" href="info_produit.php?p=<?php echo $res[0];?>"><i class="bi bi-plus"></i> d'info
                            <a class="btn btn-success btn-sm" href="panier.php?action=ajout&amp;d=<?php echo $res[0]; ?>&amp;l=<?php echo $res[1]; ?>&amp;q=1&amp;p=<?php echo $res[2]; ?>">Ajouter <i class="bi bi-cart"></i></a>
							</small>
    						</div>
					</div>
                <?php
					}
			?>
	</div>
	<?php
        for($i=1;$i<=$nbre_pages;$i++)
        {
            if($page !=$i)
                echo '<a class="btn btn-outline-primary btn-sm m-2 p-2" href="?page='.$i.'">'.$i.'</a>';
             else
                echo '<a class="btn btn-primary btn-sm m-2 p-2 text-white">'.$i.'</a>';
        }
	?>


	</div></div>
</div> 