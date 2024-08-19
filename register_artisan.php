<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<?php
 function verif($value)
{
    $value=htmlspecialchars($value);
    $value=addslashes($value);
    $value=trim($value);
    return $value;
}
?>
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

<body >
    <!-- Cchoix de la photo -->
    <?php
     $nom="";
     $prenom="";
     $email="";
     $tel="";
     $niveau="";
     $ville="";
     $longitude="";
     $latitude="";
     $photo="";
     $profession="";
if(isset($_POST["creer"]))
{
    $nom=strtoupper(verif($_POST["nom"]));
    $prenom=ucwords(verif($_POST["prenom"]));
    $email=verif($_POST["email"]);
    $tel=verif($_POST["tel"]);
    $niveau=$_POST["niveau"];
    $ville=verif($_POST["ville"]);
    $longitude=verif($_POST["longitude"]);
    $latitude=verif($_POST["latitude"]);
    $photo="";
    $profession=verif($_POST["profession"]);
    $pwd=$_POST["pwd"];
    $cpwd=$_POST["cpwd"];
    $type="P";

    if($pwd<>$cpwd)
    {
        echo '<script> swal({
            title: "",
            text: "Les mots de passe ne concordent pas",
            type: "error"
            }, function(){
                window.location= "register_artisan.php";
            });
    </script>';
        exit();
    }
   
    // gestion chargement photo
    if(isset($_FILES['picture'])){
    $maxSize = 400000;
    $tmpName = $_FILES['picture']['tmp_name'];
    $photo = $_FILES['picture']['name'];
    $size = $_FILES['picture']['size'];
    $error = $_FILES['picture']['error'];
    //corriger les erreurs
    $tabExtension = explode('.', $photo);
    $extension = strtolower(end($tabExtension));
    //verification de l'extension
    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    if(in_array($extension, $extensions))
    {
        if($size<=$maxSize && $error == 0)
        {
            move_uploaded_file($tmpName, 'photoPro/'.$photo);
        }
        else
        {
            echo " Une erreur est survenue";
            exit();
        }
       
    }
    else
    {
        $photo="img/pres.png";
        move_uploaded_file('', 'photoPro/'.$photo);
       
    }

    $tmpName = $_FILES['picture']['tmp_name'];
    $photo = $_FILES['picture']['name'];
    $size = $_FILES['picture']['size'];
    $error = $_FILES['picture']['error'];
    move_uploaded_file($tmpName, 'photoPro/'.$photo);
    
    include('connexion_bd.php');



    $pwd=password_hash($pwd, PASSWORD_DEFAULT);
    $req=$cnx->prepare("insert into utilisateurs(nom, prenom, email, telp, niveau, ville,  longitude, latitude, photo, profession, mdp, type) values(:no, :pr, :em, :te, :ni, :vi, :lo, :la, :ph, :pf, :pw, :ty)");
    $req->execute(array("no"=>$nom, "pr"=>$prenom,"em"=>$email, "te"=>$tel, "vi"=>$ville, "ni"=>$niveau, "lo"=>$longitude,"la"=>$latitude,"ph"=>$photo,"pf"=>$profession,"pw"=>$pwd, "ty"=>$type)) or die (print_r($req->errorInfo()));
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
   
   
    }
    else
    {
        echo '<script>
                swal("","Ouups! Désole. Votre inscription a échoué ","error");
            </script>';
    }
	}
}
?>
<?php include ("connexion_bd.php"); ?>
<!-- Topbar Start -->
<div class="container-fluid bg-dark py-2 d-none d-md-flex">
        <div class="container">
            <div class="d-flex justify-content-between topbar">
                <div class="top-info">
                    <small class="me-3 text-white-50"><a href="#"><i class="fas fa-map-marker-alt me-2 text-secondary"></i></a> Côte d'ivoire</small>
                    <small class="me-3 text-white-50"><a href="#"><i class="fas fa-envelope me-2 text-secondary"></i></a>entreprise20gmail.com</small>
                </div>
                <div id="note" class="text-secondary d-none d-xl-flex"><small>Note : Nous aidons à promouvoir les artisans en Côte d'Ivoire</small></div>
                <div class="top-link">
                    <a href="https://www.facebook.com/share/p/YTshHnXuPpLDpL75/?mibextid=qi2Omg" class="bg-light nav-fill btn btn-sm-square rounded-circle"><i class="fab fa-facebook-f text-primary"></i></a>
                    <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle me-0"><i class="fab fa-linkedin-in text-primary"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
    <!-- Contact Start -->
    <div class="container-fluid  mb-2 bg-primary" id="contact">
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
                <div class="col-3 wow fadeIn" data-wow-delay=".5s">
                    <h3>Obtenir les coordonnées d'un lieu</h3>
                    <ol>
                        <li>Ouvrez <a href="https://www.google.com/maps" rel="noopener" target="_blank">Google&nbsp;Maps</a> sur votre ordinateur. </li>
                    	<li>Effectuez un clic droit sur le lieu ou la zone qui vous intéresse sur la carte.</li>
                    	<li>Vous trouverez vos coordonnées (latitude et longitude) au format décimal en haut de la fenêtre pop-up qui s'affiche.</li>
                    	<li>Pour copier automatiquement les coordonnées, effectuez un clic gauche sur la latitude et la longitude.</li>
                    </ol>	 
                   <h4> Conseils </h4>:
                   <ul>
                       <li> La latitude doit être indiquée avant la longitude.</li>
                       <li>Assurez-vous que le premier nombre indiqué en tant que latitude se situe entre -90 et 90.</li>
                       <li>Vérifiez que le premier nombre indiqué en tant que longitude se situe entre -180 et 180.</li>
                    </ul>

                </div>
                <div class="col-6 wow fadeIn" data-wow-delay=".5s">
                	<div class="card  rounded contact-form">
                        <div class="card-header bg-primary text-center"> 
                            <h2 class="text-white">Inscription Artisan</h2>
                        </div>
                         <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="exampleInputname" class="form-label" >Nom</label>
                                        <input type="text" name="nom" class="form-control" required autocomplete="off" value="<?php if(isset($_POST["nom"])) echo $nom;?>"/>
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputprenom" class="form-label">Prénom</label>
                                        <input type="text" name="prenom" class="form-control" required autocomplete="off"  value="<?php echo $prenom;?>"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required autocomplete="off"  value="<?php echo $email;?>"/>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputtel" class="form-label">Téléphone</label>
                                    <input type="text" name="tel" class="form-control" required autocomplete="off"  value="<?php echo $tel;?>"/>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="exampleInputtel" class="form-label">Niveau d'étude</label>
                                        <select class="form-select" name="niveau" aria-label="Default select example" required autocomplete="off">
                                            <option value="cepe">CEPE</option>
                                            <option value="bepc">BEPC</option>
                                            <option value="bac">BAC</option>
                                            <option value="bts">BTS</option>
                                            <option value="licence">LICENCE</option>
                                            <option value="master">MASTER</option>
                                            <option value="doctorat">DOCTORAT</option>
                                            <option value="aucun">AUCUN</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputtel" class="form-label">Villes/communes</label>
                                        <select class="form-select" name="ville" aria-label="Default select example" required autocomplete="off">
                                        <option value="">---Choix de votre ville/commune---</option>
                                        <?php
                                        $req=$cnx->query("select name from villes");
                                        while($spec=$req->fetch())
                                        {
                                            echo '<option value='.$spec[0].'>'.$spec[0].'</option>';
                                        }

                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="exampleInputname" class="form-label">Latitude</label>
                                        <input type="text" name="latitude" class="form-control" required autocomplete="off"  value="<?php echo $latitude;?>"/>
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputprenom" class="form-label">Longitude</label>
                                        <input type="text" name="longitude" class="form-control" required autocomplete="off"  value="<?php echo $longitude;?>"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputtel" class="form-label">Profession</label>
                                    <select class="form-select" name="profession" aria-label="Default select example" required>
                                        <option value="">---Choix de votre profession---</option>
                                        <?php
                                        $req=$cnx->query("select name from specialties");
                                        while($vil=$req->fetch())
                                        {
                                            echo '<option value='.$vil[0].'>'.$vil[0].'</option>';
                                        }

                                         ?>
                                    </select>
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
                    
                         </div></div>
                    <div class="col-3 text-center wow fadeIn" data-wow-delay=".5s">
                        <label for="exampleInputPassword1" class="form-label">Photo de profil</label>
                        <img src="img/pres.png" alt="" id="image" style="max-width: 500px; margin-top: 15px; border:2px solid; width:200px;height:200px; padding:1%;" ><br/>
                        <script type="text/javascript" >
                            // L'image img#image
                            var image = document.getElementById("image");
                            
                            // La fonction previewPicture
                            var previewPicture  = function (e) {
                        
                                // e.files contient un objet FileList
                                const [picture] = e.files
                        
                                // "picture" est un objet File
                                if (picture) {
                                    // On change l'URL de l'image
                                    image.src = URL.createObjectURL(picture)
                                }
                            } 
                         </script>
                        
                        <script>
                            function getfile(){
                            document.getElementById('hiddenfile').click();
                            }
                            function getvalue(){
                            document.getElementById('selectedfile').value=document.getElementById('hiddenfile').value;
                            }
                        </script>

                        <p>
                            <input type="file" id="hiddenfile" style="display:none;" accept="image/*" onChange="previewPicture(this)" name="picture"/>
                            <input type="hidden" id="selectedfile" value=""/><br>
                            <input type="button" value="Selectionner une photo" class="btn btn-outline-primary btn-sm" onClick="getfile();"/>
                        </p>
                                    
                    </div>   
                </div>
                </form>         

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
</body>






</html>