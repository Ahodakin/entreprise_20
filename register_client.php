<!DOCTYPE html>
<html lang="fr">

<head>
<?php
function verif($value)
{
    $value=htmlspecialchars($value);
    $value=addslashes($value);
    $value=trim($value);
    return $value;
}
?>
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
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
</head>

<body>

<?php include ("connexion_bd.php");include ("layouts/topbar.php"); ?>
    <!-- Contact Start -->
    <div class="container-fluid  mb-5 bg-primary" id="contact">
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
                <div class="col-3"> </div>
                <div class="col-5  wow fadeIn" data-wow-delay=".5s">
                	<div class="card  rounded contact-form">
                        <div class="card-header bg-primary text-center"> 
                            <h2 class="text-white">Inscription Client</h2>
                        </div>
                        <div class="card-body">
                        <form method="post">
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="exampleInputname" class="form-label">Nom</label>
                                    <input type="text" name="nom" class="form-control" required />
                                </div>
                                <div class="col">
                                    <label for="exampleInputprenom" class="form-label">Prénom</label>
                                    <input type="text" name="prenom" class="form-control" required />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                                <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" required />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Confirmer le Mot de passe</label>
                                <input type="password" name="cpwd" class="form-control" id="exampleInputPassword1" required />
                            </div>
                            <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="creer">Créer un compte</button>
                            </div>
                            
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
if(isset($_POST["creer"]))
{
    $nom=verif($_POST["nom"]);
    $prenom=verif($_POST["prenom"]);
    $email=verif($_POST["email"]);
    $pwd=$_POST["pwd"];
    $cpwd=$_POST["cpwd"];
    $type="C";

    if($pwd<>$cpwd)
    {
        echo '<script>
                swal("","Les mots de pass ne concordent pas ","error");
            </script>';
            exit();
    }
   

    $pwd=password_hash($pwd, PASSWORD_DEFAULT);
    $req=$cnx->prepare("insert into utilisateurs(nom, prenom, email, mdp, type) values(:no,:pr,:em, :pw,:ty)");
    $req->execute(array("no"=>$nom, "pr"=>$prenom,"em"=>$email,"pw"=>$pwd, "ty"=>$type)) or die (print($req->errorInfo()));
    $res=$cnx->errorCode();
    if($res)
    {
        echo '<script> swal({
                    title: "",
                    text: "Votre inscription s\'est effectuée avec succès",
                    type: "success"
                    }, function(){
                        window.location= "login.php";
                    });
             </script>';
           
            /*$_SESSION["email"]=$email;
			$_SESSION["nom"]=$nom;
            $_SESSION["type"]=$type;
            $_SESSION["prenom"]=$prenom;*/
    }
    else
    {
        echo '<script>
                swal("","Ouups! Désole. Votre inscription a échoué ","error");
            </script>';
    }
}
?>





</body>

</html>