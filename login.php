<?php session_start(); 
function verif($value)
{
    $value=htmlspecialchars($value);
    $value=addslashes($value);
    $value=trim($value);
    return $value;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<style>
    label{color:blue; font-weight:bold;
    }
    </style>
    <meta charset="utf-8">
    <title>Entreprise 20</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="sweetalert/dist/sweetalert.css" rel="stylesheet">
    <script src="sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
	<?php include('layouts/topbar.php');?>

    <!-- Contact Start -->
    <div class="container-fluid  bg-primary" id="contact">
        <div class="container">
            <nav class="navbar navbar-dark navbar-expand-lg py-0">
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-white fw-bold d-block">Entreprise<span class="text-secondary">20</span> </h1>
                </a>
            </nav>
        </div>
    </div>
   
    <div class="container-fluid py-5 mb-5">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4  wow fadeIn" data-wow-delay=".5s">
                	<div class="card  rounded contact-form">
                        
                        	<div class="card-header bg-primary text-center text-white"> 
                            <img style="width: 100px; height: 100px" src="img/pres.png" alt="" />
                            <h3 class="text-white">Connectez-vous ici</h3>
                        </div>
                        <div class="card-body">
                             <form method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required autocomplete="off"/>
                                    <!--<div id="emailHelp" class="form-text">Nous ne partagerons jamais votre email avec personne.</div> -->
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                                    <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" required autocomplete="off"/>
                                    <div class="mt-2">
                                        <a href="email.php" class="text-decoration-none">Mot de passe oublié?</a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="connecter">Se connecter</button>
                                </div>
                            </form>
                        </div>
                        <div class="mt-3">
                                <p>Pas de compte ? <a href="choix.php" class="text-decoration-none"> Créer un compte</a></p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->




    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Javascript -->
    <script src="js/main.js"></script>
    
<?php
if (isset($_POST["connecter"]))
{
	$email=verif($_POST["email"]);
	$pwd=$_POST["pwd"];
	
	if($email<>"" and $pwd<>"" )
	{
		include("connexion_bd.php");

        $req=$cnx->prepare("select type from utilisateurs where email=:em");
		$req->execute(array("em"=>$email)) or die(print_r($req->errorInfo()));
		$res=$req->fetch();
		if($req->rowCount()==1)
		{
			if($res[0]=="A")
			{
				$req2=$cnx->prepare("select * from utilisateurs where email=:em and mdp=:mdp and type='A'" );
				$req2->execute(array("em"=>$email, "mdp"=>$pwd)) or die(print_r($req2->errorInfo()));
				$result=$req2->fetch();
                if($result)
                {
                    echo '<script>document.location.replace("admin/app.php");	</script>';
                    $_SESSION["acces"]="oui";
                    $_SESSION["id"]=$result[0];
                    $_SESSION["type"]=$result[12];
                    $_SESSION["email"]=$email;
                    $_SESSION["nom"]=$result[1];
                    $_SESSION["prenom"]=$result[2];
                   
					exit();
                }
                else
                {
                    echo '<script>swal("", "Désole. Le mot de passe n`\est pas valide","warning");	</script>';
					exit();
                }
                
			}
			
			if($res[0]=="C")
			{
				$req3=$cnx->prepare("select * from utilisateurs where email=:em");
				$req3->execute(array("em"=>$email)) or die(print_r($req3->errorInfo()));
				$result=$req3->fetch();
				if($result && password_verify($pwd, $result[11]))
				{
                    $_SESSION["acces"]="oui";
                    $_SESSION["id"]=$result[0];
					$_SESSION["type"]=$result[12];
					$_SESSION["email"]=$result[3];
					$_SESSION["nom"]=$result[1];
					$_SESSION["prenom"]=$result[2];
                    $_SESSION["latitude"]=$result[8];
                    $_SESSION["longitude"]=$result[7];
                    echo '<script>document.location.replace("artisan.php");	</script>';
				}
				else
				{
					echo '<script> swal("","Le mot de passe est eronné","error");</script>';
					exit();
				}
			}
				
            if($res[0]=="P")
            {
				$req4=$cnx->prepare("select * from utilisateurs where email=:em");
				$req4->execute(array("em"=>$email)) or die(print_r($req4->errorInfo()));
				$result=$req4->fetch();
                if($result && password_verify($pwd, $result[11]))
				{
                    $_SESSION["acces"]="oui";
                    $_SESSION["id"]=$result[0];
                    $_SESSION["type"]=$result[12];
                    $_SESSION["email"]=$result[3];
                    $_SESSION["nom"]=$result[1];
                    $_SESSION["prenom"]=$result[2];
                    $_SESSION["latitude"]=$result[8];
                    $_SESSION["longitude"]=$result[7];
                    echo '<script>document.location.replace("espace_artisan.php");	</script>';
                    echo '<script>document.getElementById("profil").style.display="block"; 
                            document.getElementById("artisan").style.display="block"; 
                        </script>';
                }
                else
                {
                    echo '<script> swal("","Le mot de passe est eronné ","error");</script>';
                }
            }
        }
        else
        {
            echo '<script> swal("","Cette adresse email n\'est pas valide","error");</script>';
        }
    }
	else
	{
		echo '<script> swal("","veuillez renseigner tous les champs SVP! ","error");</script>';
	}
}
?>
    
</body>

</html>