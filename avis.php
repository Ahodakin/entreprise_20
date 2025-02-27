<?php 
session_start();
if(!$_SESSION['id'])
{
    heade('location:login.php');
}
include("connexion_bd.php"); include("layouts/app.php");?>
<!DOCTYPE html>

<html lang="fr">

<head>
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
</head>

<body>


    <!-- Contact Start -->
    <div class="container-fluid py-5 mb-5">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-5  wow fadeIn" data-wow-delay=".5s">
                	<div class="card broder-primary">
                        
                        	<div class="card-header bg-primary text-center text-white"> <h3 class="text-white">Votre avis sur la plateforme</h3> </div>
                            <div class="card-body">
                            <form method="post">
                            <div class="mb-3">
                                
                                <textarea  name="avis" class="form-control" rows="10" cols="50"></textarea>
                            </div>
                            <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-sm" name="envoyer">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

<?php
if(isset($_POST['envoyer']))
{
    $avis=$_POST["avis"];
    $req=$cnx->prepare("insert into avis (contenu, id_client) values (:c, :i)");
    $req->execute(array("c"=>$avis, "i"=>$_SESSION["id"]));
    $res=$cnx->errorCode();
    if($res)
    {
        echo'<script>swal("", "Merci pour cet avis donné");</script>';
    }
    else
    {
        echo '<script>swal("", "Votre avis n\' a pu etre enregistré. Resseayer plus tard","error");</script>';
    }
}
?>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Javascript -->
    <script src="js/main.js"></script>
</body>

</html>