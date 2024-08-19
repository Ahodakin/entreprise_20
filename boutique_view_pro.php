<?php
session_start();
if(!$_SESSION["id"])
{
    header("location:login.php");
    exit();
}
include('layouts/app.php');
include('connexion_bd.php');
$requete=$cnx->prepare("select id_artisan from boutique where id_artisan=:id");
$requete->execute(array("id"=>$_SESSION["id"]));
$rep=$requete->fetch();
if(!$rep)
{
	echo '<script>swal("","Desole! Vous ne pouvez pas afficher de produit car vous n\avez pas encore de boutique","warning");</script>';
	exit();
}
?>
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
<br>
 <div class="container-fluid blog my-0">
 <div class="row justify-content-center">

   
 <?php
    // select de l'id de la boutique dans laquelle se trouve le produit
  
   $reqt=$cnx->prepare("select id_btk from boutique where id_artisan=:id");
   $reqt->execute(array("id"=>$_SESSION["id"])) or die(print_r($reqt->errorCode()));
   $resu=$reqt->fetch();
?>
<div class="col-sm-11">
	<div class="row">
			<?php
					 // pagination
					 $requete=$cnx->prepare("select count(*) from boutique_pro where id_btk=:id");
					 $requete->execute(array("id"=>$resu[0]));
					 $count=$requete->fetch();
					 $nbre_elt_par_page=12;
					 $nbre_pages=ceil($count[0]/$nbre_elt_par_page);

					 @$page=$_GET["page"];
					 if(empty($page) or $page>$nbre_pages) $page=1;
					 $debut=($page-1)*$nbre_elt_par_page;


					$req=$cnx-> prepare("select * from boutique_pro where id_btk=:id limit $debut, $nbre_elt_par_page ");
                    $req->execute(array("id"=>$resu[0])) or die(print_r($req->errorInfo()));
					while ($res=$req->fetch()) {
					?>
                    
                    <div class="card col-sm-3 border-primary">
   						<img src="boutique/<?php echo $res[4];?>" class="card-img-top" alt="" width="100" height="150" >
    						<div class="card-body">
     							 <h6 class="card-title"><?php echo $res[1];?></h6>
      							 <p class="card-text"> <?php echo $res[2];?> FCFA</p>
    						</div>
   						    <div class="card-footer text-center">
      						<small>
                            <a class="btn btn-primary btn-sm" href="modif_produit.php?p=<?php echo $res[0];?>"><i class="bi bi-pen"></i></a>   
                            <a class="btn btn-success btn-sm" href="supprime_produit.php?p=<?php echo $res[0];?>"><i class="bi bi-trash"></i></a></small>
    						</div>
					</div>
                <?php
					}
			?>
	</div>
	<?php
	// affichage des numéros de pages
                                    for($i=1;$i<=$nbre_pages;$i++)
                                    {
                                       if($page !=$i)
                                       echo '<a class="btn btn-outline-primary btn-sm m-2 p-2" href="?page='.$i.'">'.$i.'</a>';
                                       else
                                       echo '<a class="btn btn-primary btn-sm m-2 p-2 text-white">'.$i.'</a>';
                                    }

                                 ?>
</div>
</div>
</div> 