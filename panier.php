<?php
session_start();
include('layouts/app.php');
require_once('fonctions_panier.php');

$erreur=false;
$action=(isset($_POST['action'])?$_POST['action']:(isset($_GET['action'])?$_GET['action']:null));
if($action!==null)
{
	if(!in_array($action,array('ajout','suppression','refresh')))
	
		$erreur=true;
		$d=(isset($_POST['d']) ?$_POST['d']:(isset($_GET['d'])?$_GET['d']:null));
		$l=(isset($_POST['l']) ?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
		$q=(isset($_POST['q']) ?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
		$p=(isset($_POST['p']) ?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));
		
		$l=preg_replace('#\v#','',$l);
		$p=floatval($p);
		if(is_array($q))
		{
			$qteProd=array();
			$i=0;
			foreach($q as $contenu)
			{
				$qteProd[$i++]=intval($contenu);
				
			}
		}
		else
		{
			$q=intval($q);
		}
}
if(!$erreur)
{
	switch($action)
	{
		case "ajout":
		ajouterArticle($d,$l,$q,$p);
		break;
		
		case "suppression":
		supprimerProduit($l);
		break;
		
		case "refresh":
		for($i=0;$i<count($qteProd);$i++)
		{
			modifierQteProduit($_SESSION['panier']['libelleProduit'][$i],round($qteProd[$i]));
		}
		break;
		
		default :
		break;
	}
}
?>
<div class="container-fluid py-3 mb-3">
 	<div class="row">
 		<div class="col-sm-3">
     		<?php include('menu.php'); ?>
 		</div>
        <div class="col-sm-9 ">
			<div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0 bg-primary text-center">
                            <h2 class="text-white">Votre Panier</h2>
                        </div>
                    </div>
            		<div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                                 <table class="table table-hover table-bordered">
                                    <thead>
                                       <tr>
									   	 
                                          <th>Nom du Produit</th>
                                          <th>Quantité</th>
                                          <th>Prix unitaire</th>
                                          <th>Total HT</th>
                                          <th>Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                
							 <?php
								if(isset($_GET['deletepanier']) && $_GET['deletepanier']==true)
								{
									supprimerPanier();
								}
		
								if(creationPanier())
								{
									$nbre=count($_SESSION['panier']['libelleProduit']);
									if($nbre<=0)
									{
										
										echo'<div class="text-danger text-center"><h1>Ooops, Panier vide</h1></div>';
										echo'<a class="text-danger text-secondary" href="boutique_view.php">Retour</a></div>';
										exit();
									}
									else
									{
										for($i=0; $i<$nbre;$i++)
										{
							?>
            		<tr>
                    <form method="post" action="">
					
                	<td><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></td>
                    <td><select class="span1" name="q[]" onChange="this.form.submit();" >
						<?php for($j=1;$j<=10; $j++){ ?>
						<option value="<?php echo $j;?>" <?php if($j==$_SESSION['panier']['qteProduit'][$i]) {?> selected <?php } ?>><?php echo $j;?></option><?php }?>
						</select><input type="submit" value="rafraichir" style="visibility:hidden;"/>
                    	<input type="hidden" name="action" value="refresh"/>&nbsp;
					</td>
                    <td><?php echo $_SESSION['panier']['prixProduit'][$i]; ?></td>
                    <td><?php echo $_SESSION['panier']['prixProduit'][$i]*$_SESSION['panier']['qteProduit'][$i]; ?></td>
                    <td><a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]);?>" title="Retirer l'article du panier"><i class="fa fa-trash"></i></a></td>
                    </form>
                   </tr>
                         <?php 
				     } 
			           	?>
     				
				
     			</tbody>
                 <?php 
									}} 
			           	?>
     		
     	
     	<div class="text-right">
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
     	<div class="clearfix"></div>
     	<div class="text-center">
     	<a href="validation.php" class="btn btn-success pull-right"> Valider votre panier </a>
        <a href="boutique_view.php" class="btn btn-primary"> Continuer mes achats </a>
        <br><br>
        
        </div>
</div>
     </div>	
 </div>
</body>
</html>