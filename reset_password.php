<?php include ("connexion_bd.php");  include ("layouts/app.php");?>
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


    <!-- Contact Start -->
   
        <div class="container">
            <div class="row">
                <div class="col-3 wow fadeIn" data-wow-delay=".5s"></div>
                <div class="col-6">
                	<div class="card">
                        
                        	<div class="card-header"> <h3 class="text-white">Modication du mot de passe</h3> </div>
                            <div class="card-body">
                    
                                    <form method="post"> 
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nouveau mot de passe</label>
                                                <input type="password" name="pwd" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirmation du mot de passe</label>
                                                <input type="password" name="cpwd" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="text-center">
                                            <button type="submit" class="btn btn-primary" name="reset">Réinitialiser le mot de passe</button>
                                            </div>
                                        </form>
                    
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
    if (isset($_POST["reset"]))
    {
        $email=htmlspecialchars($_POST["email"]);
        $pwd=htmlspecialchars($_POST["pwd"]);
        $cpwd=htmlspecialchars($_POST["cpwd"]);

        if($pwd<>$cpwd)
        {
        echo '<script>
                swal("","Les mots de pass ne concordent pas ","error");
            </script>';
            exit();
        }

        $req=$cnx->prepare("select email from utilisateurs where email=:em");
        $req->execute(array("em"=>$email)) or die(print_r($req->errorInfo()));
        $result= $req->fetch();
        if($result)
        {
            $req=$cnx->prepare("update utilisateurs set mdp=:mp where email=:em");
            $req->execute(array("mp"=>$pwd, "em"=>$result[0])) or die(print_r($req->errorInfo()));
            $res=$cnx->errorCode();
            if($res)
            {
                echo '<script>
                swal("","Votre mot de passe a été réinitialise avec succès ","success");
                </script>';
            }
            else
            {
                echo '<script>
                swal("","La réinitialisation de votre mot de passe a échoué ","error");
                </script>';
                exit();
            }

        }
        else
        {
            echo '<script>
                swal("","Cette adresse emaail n\'est pas valide ","error");
            </script>';
        }

    }

?>

</body>

</html>