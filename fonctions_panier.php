<?php
function creationPanier()
{
	if(!isset($_SESSION['panier']))
	{
		$_SESSION['panier']=array();
		$_SESSION['panier']['idproduit']=array();
		$_SESSION['panier']['libelleProduit']=array();
		$_SESSION['panier']['qteProduit']=array();
		$_SESSION['panier']['prixProduit']=array();
		$_SESSION['panier']['verrou']=false;
		
	}
	return true;
}

function ajouterArticle($idproduit,$libelleProduit,$qteProduit,$prixProduit)
{
	if(creationPanier() && !isVerrouiller())
	{
		$positionProduit=array_search($libelleProduit,$_SESSION['panier']['libelleProduit']);
		if($positionProduit!==false) //si le produit est dans le panier
		{
			$_SESSION['panier']['qteProduit'][$positionProduit]+=$qteProduit;
		}
		else
		{
			array_push($_SESSION['panier']['idproduit'],$idproduit);
			array_push($_SESSION['panier']['libelleProduit'],$libelleProduit);
			array_push($_SESSION['panier']['qteProduit'],$qteProduit);
			array_push($_SESSION['panier']['prixProduit'],$prixProduit);
			//array_push($_SESSION['panier']['tva'],$tva);
		}
	}
	else
	{
		echo"Erreur, veuillez contacter l'administrateur";
	}
	
}

function modifierQteProduit($libelleProduit,$qteProduit)
{
	if(creationPanier() && !isVerrouiller())
	{
		if($qteProduit>0)//si la qte est positive
		{
			$positionProduit=array_search($libelleProduit,$_SESSION['panier']['libelleProduit']);//recherche du produit dans le panier
			if($positionProduit!==false)
			{
				$_SESSION['panier']['qteProduit'][$positionProduit]=$qteProduit;
			}
		}
		else
		{
			supprimerProduit($libelleProduit);
		}
	}
	else
	{
		echo"Erreur, veuillez contacter l'administrateur";
	}
}
function supprimerProduit($libelleProduit)
{
	if(creationPanier() && !isVerrouiller())
	{
		$tmp=array();
		$tmp['idproduit']=array();
		$tmp['libelleProduit']=array();
		$tmp['qteProduit']=array();
		$tmp['prixProduit']=array();
		$tmp['verrou']=$_SESSION['panier']['verrou'];
		for($i=0; $i<count($_SESSION['panier']['libelleProduit']);$i++)
		{
			if($_SESSION['panier']['libelleProduit'][$i]!==$libelleProduit)
			{
				array_push($tmp['idproduit'],$_SESSION['panier']['idproduit'][$i]);
				array_push($tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
				array_push($tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
				array_push($tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
			}
		}
		$_SESSION['panier']=$tmp;
		unset($tmp);
	}
	else
	{
		echo"Erreur, veuillez contacter l'administrateur";
	}
}
function montantGlobal()
{
	$total=0;
	for($i=0; $i<count($_SESSION['panier']['libelleProduit']);$i++)
	{
		$total+=$_SESSION['panier']['qteProduit'][$i]*$_SESSION['panier']['prixProduit'][$i];
	}
	return $total;
}

function montantGlobalTva()
{
	$total=0;
	for($i=0; $i<count($_SESSION['panier']['libelleProduit']);$i++)
	{
		$total+=$_SESSION['panier']['qteProduit'][$i]*$_SESSION['panier']['prixProduit'][$i];
	}
	$monttva=($total*20)/100;
	return $total+$monttva;
}

function supprimerPanier()
{
		unset($_SESSION['panier']);
}
function isVerrouiller()
{
	if(isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
	{
		return true;
	}
	else
	{
		return false;
	}
}
function compterProduit()
{
	if(isset($_SESSION['panier']))
	{
		return count($_SESSION['panier']['libelleProduit']);
	}
	else
	{
		return 0;
	}
}
?>
</body>
</html>