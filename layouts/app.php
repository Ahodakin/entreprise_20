<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Entreprise 20</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="text/html; charset=utf-8" name="keywords">
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

    <?php include('topbar.php');?>

    <!-- Navbar Start -->
    <div class="container-fluid bg-primary">
        <div class="container">
            <nav class="navbar navbar-dark navbar-expand-lg py-0" >
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-white fw-bold d-block">Entreprise<span class="text-secondary">20</span> </h1>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                    <div class="navbar-nav ms-auto mx-xl-auto p-0">
                        <a href="index.php" class="nav-item nav-link active text-secondary">Accueil</a>
                        <a href="index.php#about" class="nav-item nav-link">À Propos</a>
                        <a href="index.php#service" class="nav-item nav-link">Services</a>
                        <a href="index.php#faq" class="nav-item nav-link">FAQ</a>
                        <?php
                        if(isset($_SESSION["acces"]) and $_SESSION["acces"]=="oui"){

                        
                        ?>
                        <a href="artisan.php" class="nav-item nav-link" id="artisan">Artisan</a>
                        <?php
                       }
                       ?>
                        <a href="index.php#contact" class="nav-item nav-link">Contact</a>


                        <!-- Admin Section -->
                        <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Administration</a>
                                <div class="dropdown-menu rounded">
                                    <a href="" class="dropdown-item">Tableau de Bord</a>
                                </div>
                            </div> -->

                    </div>



                    <!-- Signup and Login Buttons -->

                    <div class="d-flex align-items-center">
                    <?php
                        if(isset($_SESSION["acces"]) and $_SESSION["acces"]=="oui"){

                        
                        ?>
                        <a href="choix.php" class="btn btn-secondary mx-2" style="display:none;">Inscription</a>
                        <a href="login.php" class="btn btn-light"style="display:none;">Connexion</a>
                        
                        <?php
                       } else{
                            ?>
                            <a href="choix.php" class="btn btn-secondary mx-2" style="display:block;">Inscription</a>
                            <a href="login.php" class="btn btn-light"style="display:block;">Connexion</a>
                           
                        <?php 
                        }
                        ?>
                    </div>
                    <?php
                    if(isset($_SESSION["id"]) && $_SESSION["id"])
                    {
                        ?>
                        <div class="nav-item dropdown">
                    
                        
                            <a href="#" class="nav-link dropdown-toggle btn btn-secondary mx-1" style="color: #fff; padding:5px;padding-right:10px;padding-left:10px;" data-bs-toggle="dropdown">Profil</a>                       
                            
                           
                            <div class="dropdown-menu rounded">
                                <?php 
                                if(isset($_SESSION["id"]) && $_SESSION["type"]=="C")
                                {
                                ?>
                                    <a href="profil_user.php?id='<?php echo  $_SESSION["id"]; ?>'" class="dropdown-item">Mon Profil</a>
                                <?php 
                                } 

                                if(isset($_SESSION["id"]) && (($_SESSION["type"]=="P") || ($_SESSION["type"]=="A")))
                                {
                                ?>
                                    <a href="profil.php?id='<?php echo  $_SESSION["id"]; ?>'" class="dropdown-item">Mon Profil</a>
                                <?php
                                } ?>
                                
                            <a href="password.php" class="dropdown-item">Changer le mot de passe</a>
                            <a href="pack_publicitaire.php" class="dropdown-item">Pack publicitaire</a>
                            <?php 
                                if(isset($_SESSION["id"]) && $_SESSION["type"]=="P")
                                {
                                ?>
                                    <a href="espace_artisan.php?id='<?php echo  $_SESSION["id"]; ?>'" class="dropdown-item">Mon Espace</a>
                                <?php 
                                } 

                                ?>
                            <a href="avis.php" class="dropdown-item">Vote avis</a>
                            <a href="deconnexion.php" class="dropdown-item">Deconnexion</a>
                            </div>
                            
                        </div>
                        <?php
                    
                    }
                        ?>

                    <div class="d-flex align-items-center">
                    <?php
                       if(isset($_SESSION["id"]) )
                       {
                            if($_SESSION["type"]=="P")
                            {
                    ?>
                                <div class="nav-item dropdown">
                                <a href="" class="btn btn-secondary mx-2" style="display:block;">Boutique</a>
                                <div class="dropdown-menu rounded">
                                    <a href="boutique.php" class="dropdown-item">Creer une boutique</a>
                                    <a href="ajout_prod.php" class="dropdown-item">Ajouter un produit</a>
                                    <a href="boutique_view_pro.php?id=<?php echo  $_SESSION['id'];?>" class="dropdown-item">Voir les produits</a>

                                </div>
                                </div>
                            
                                <a href="message.php" class="btn btn-light"style="display:block;">Message</a>
                    <?php
                    
                            } else
                            {
                            ?>
                            <a href="" class="btn btn-secondary mx-2" style="display:none;">Boutique</a>
                            <a href="message.php" class="btn btn-light"style="display:block;">Message</a>
                            <?php 
                        }
                    }
                        ?>
                            
                        
                    </div>
                    <!-- <div class="d-flex align-items-center">
                            <a href="login.php" class="btn btn-danger mx-2" >Logout</a>
                        </div> -->
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top"><i class="fa fa-arrow-up text-white"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Javascript -->
    <script src="js/main.js"></script>

     
</html>