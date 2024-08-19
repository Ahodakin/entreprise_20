
<?php
session_start();
if(!$_SESSION["id"])
{
	header("location:login.php");
}
 include('layouts/app.php');
 include('connexion_bd.php');
?>
 <div class="container-fluid">
<?php
if (isset($_POST['verifier'])){
	$matr=$_POST["matr"]; 
	$code=$_POST['coderetr'] ;
	if($matr<>"" and $code<>"")
	{   
		$req=$cnx->prepare("select * from reservation where matricule=:ma and codeReserv=:co and valide='0'");
		$req->execute(array("ma"=>$matr,"co"=>$code)) or die (print_r($req->errorInfo()));
		
		$reqt=$cnx->prepare("select count(*) from reservation where matricule=:ma and codeReserv=:co and valide='0'");
		$reqt->execute(array("ma"=>$matr,"co"=>$code)) or die (print_r($reqt->errorInfo()));
		$res=$reqt->fetch();
			?>
			<h4>Vérification de réservation</h4>
     		<table class="table table-bordered">
				 
     			<thead>
     				<tr>
						<th>Matricule</th>
						<th>Nom du livre</th>
						<th>Date de reservation</th>
						<th>Code de Retrait</th>
						<th colspan="2">Actions</th>
     				</tr>
     			</thead> 
     			<tbody>
		<?php
		
		if($res[0]==2)
		{
			$resultat=$req->fetch();
			echo'<tr align="center">
			<td rowspan="2">'.$resultat[1].'</td>
			<td>'.$resultat[2].'</td>
			<td rowspan="2">'.$resultat[3].'</td>
			<td rowspan="2">'.$resultat[6].'</td>
			<td rowspan="2"><a href="valider.php?code='.$resultat[6].'" class="btn btn-danger">Valider</a></td>
			<td rowspan="2"><a href="retour.php?code='.$resultat[6].'" class="btn btn-danger">Retour</a></td>
			</tr>';
			$resultat=$req->fetch();
			echo'<tr>
			<td>'.$resultat[2].'</td>
			</tr>
			';
		}
		else{
			$resultat=$req->fetch();
			echo'<tr align="center">
			<td>'.$resultat[1].'</td>
			<td>'.$resultat[2].'</td>
			<td>'.$resultat[3].'</td>
			<td>'.$resultat[6].'</td>
			<td><a href="valider.php?code='.$resultat[6].'" class="btn btn-danger">Valider</a></td>
			</tr>';
		}
	}
	else
	{
		echo'Aucune réservation ne correspond à ces données';
	}
}
?>
</div>
</body>