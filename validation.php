<?php
session_start();
if(!$_SESSION['panier'] && !$_SESSION["id"])
{
    header("location:login.php");
}
include('layouts/app.php');
require_once('fonctions_panier.php');
include('connexion_bd.php');
if(isset($_SESSION['panier']) and isset($_SESSION['id']))
{
?>

<div class="container-fluid blog my-4">
 	<div class="row">
   		<div class="col-sm-3">
     		<?php include('menu.php'); ?>
 		</div>
        <div class="col-sm-9 wow fadeIn" data-wow-delay=".5s">
			<div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0 bg-primary text-center">
                            <h2 class="text-white">Recapitulatif de la commande</h2>
                        </div>
                    </div>
            		<div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                                 <table class="table table-hover table-bordered">
                                    <thead>
                                       <tr>
                                       <th>Id du Produit</th>
                                          <th>Nom du Produit</th>
                                          <th>Quantité</th>
                                          <th>Prix unitaire</th>
                                          <th>Total HT</th>
                                       </tr>
                                    </thead>
                                    <tbody>
     					<tbody>
                			<?php
								if(creationPanier())
								{
									$nbre=count($_SESSION['panier']['libelleProduit']);
									
										for($i=0; $i<$nbre;$i++)
										{
							?>
            		<tr>
                    <td><?php echo $_SESSION['panier']['idproduit'][$i]; ?></td>
                	<td><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></td>
                    <td><?php echo $_SESSION['panier']['qteProduit'][$i]; ?></td>
                    <td><?php echo $_SESSION['panier']['prixProduit'][$i]; ?></td>
                    <td><?php echo $_SESSION['panier']['prixProduit'][$i]*$_SESSION['panier']['qteProduit'][$i]; ?></td>
                   </tr>
                         <?php 
				            } 
			           	?>
     				
				
     			</tbody>
                 <?php 
									}
			           	?>
                        <tr class="bg-light"><td colspan="4"></td></tr>
     		<tr >
                <td colspan="3" align="right">Total HT</td>
                <td><?php echo montantGlobal();?> F CFA</td>
            </tr>
            <tr>
                <td colspan="3"  align="right">Total TVA</td>
                <td><?php echo montantGlobalTva()- montantGlobal();?> F CFA</td>
            </tr><tr>
                <td colspan="3"  align="right">Total TTC</td>
                <td><?php echo montantGlobalTva();?> F CFA</td>
            </tr>
         </table>
                                </div>
        <div class="">
      
     	<div class="clearfix"></div>
     	<div class="text-center">
        <form method="post">
        <a href="panier.php" class="btn btn-success btn-sm"> Retour </a>
        <button type="submit" class="btn btn-primary btn-sm" name="valider"> Valider la commande </button>
        </form>
        <br><br>
        
        </div>
</div>
     </div>	
 </div>
<?php 
}
?>

<?php
if(isset($_POST["valider"]))
{
    $num=$_SESSION["num"];
    $panier_user=$_SESSION["panier"]["idproduit"];
    $datecmde=date('d/m/Y');
    $req=$cnx->prepare("insert into commande(id_client, montant, datecmde,id_artisan, paye) values (:cli,:mo, :da,:idar, :pa)");
    $req->execute(array("cli"=>$_SESSION['id'],"mo"=> montantGlobalTva(),"da"=>$datecmde,"idar"=>$num,"pa"=>'0' )) or die(print_r($req->errorInfo()));
    $id_client=$_SESSION["id"];
    $id_cmde=$cnx->lastInsertId();
    for($i=0;$i<count($_SESSION['panier']["idproduit"]); $i++)
    { 
       
        $id_prod=$_SESSION["panier"]['idproduit'][$i];
        $qte=$_SESSION["panier"]['qteProduit'][$i];
        $prix=$_SESSION["panier"]['prixProduit'][$i];
        $total=$qte*$prix;      

        $req2=$cnx->prepare("insert into ligne_commande(id_prod, id_cmde, prix,qte, total) values    (:p, :c, :pr, :qt, :to)");
        $req2->execute(array("p"=>$id_prod,"c"=>$id_cmde,"pr"=>$prix, "qt"=>$qte,"to"=>$total)) or die(print_r($req->errorInfo()));
       
    }
    $res=$cnx->errorCode();
    if($res)
    {
        echo '<script> swal({
            title: "",
            text: "Votre commande a été bien enregistrée",
            type: "success"
            }, function(){
                window.location= "payement.php";
            });
    </script>';
    }
    else
    {
        echo'<script>swal("","Votre commande n\'a pu $etre enregistrée","error");</script>';

    }
    
}
?>
</body>
</html>