<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:login.php");
    exit();
}

include('layouts/app.php');
include('connexion_bd.php');
?>


<!-- Page Header Start -->
<div class="container-fluid page-header">
    <div class="container text-center">
        <h1 class="display-0 text-white animated slideInDown">Bienvenue dans votre espace  <?php echo $_SESSION["nom"].'  '.$_SESSION["prenom"]; ?> </h1>
      
    </div>
</div>
<!-- Page Header End -->
  


<!-- Blog Start -->
<div class="container-fluid blog my-5">    
        <div class="row g-5 justify-content-center">

            
           <img src="img/blog-1.jpg"/>
            
        </div><!--fin conte-->
    </div>
</div>
<!-- Blog End -->

<?php
include('footer.php');
?>