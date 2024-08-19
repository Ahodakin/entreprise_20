<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Admin</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="images/fevicon.png" type="image/png" />
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="css/responsive.css" />
   <!-- color css -->
   <link rel="stylesheet" href="css/colors.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
   <link rel="stylesheet" href="css/custom.css" />
   <link href="css/style.css" rel="stylesheet">
   <link href="../sweetalert/dist/sweetalert.css" rel="stylesheet">
   <script src="../sweetalert/dist/sweetalert.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body class="dashboard dashboard_1">
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         <nav id="sidebar">
            <div class="sidebar_blog_1">
               <div class="sidebar-header">
                  <div class="logo_section">
                     <a href="../index.php"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>
                  </div>
               </div>
               <div class="sidebar_user_info">
                  <div class="icon_setting"></div>
                  <div class="user_profle_side">
                     <div class="card-header text-center border-white bg-white" style="border-radius:50%; border:solid 1px; padding:1%;"><h1 class="text-primary"><?php echo substr($_SESSION['nom'],0,1).'  '. substr($_SESSION['prenom'],0,1); ?> </h1></div>
                     <div class="user_info">
                        <h6><?php echo $_SESSION['nom'].'  '.$_SESSION['prenom']; ?></h6>
                        <p><span class="online_animation"></span> en ligne</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="sidebar_blog_2">
               <h4>General</h4>
               <ul class="list-unstyled components">
                  <li><a href="app.php"><i class="fa fa-cog yellow_color"></i> <span>Dashboard</span></a></li>
                  <li><a href="artisans.php"><i class="fa fa-bar-chart-o green_color"></i> <span>Tous les artisans</span></a></li>
                  <li><a href="users.php"><i class="fa fa-cog yellow_color"></i> <span>Tous les utilisateurs</span></a></li>
                  <li><a href=""  data-bs-toggle= "modal" data-bs-target="#exampleModal" data-bs-whatever="@fat"><i class="fa-solid fa-city"></i><span>Ajouter une spécialité</span></a></li>
                 
               </ul>
            </div>
         </nav>
    
<!--ajout de profession-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Nouvelle Spécialité</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="">
      <div class="modal-body">

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nom de la spécialité</label>
            <input type="text" class="form-control" id="recipient-name" value="" name="spec" required>
          </div>
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button>
      </div>
      </form>
      <?php
      if(isset($_POST["ajouter"]))
      {
         
         $ville=$_POST['spec'];
         $req=$cnx->prepare("insert into specialities(name) values(:s)");
         $req->execute(array("s"=>$spec)) or die(print_r($req->errorInfo()));
         $res=$cnx->errorCode();
         if($res)
         {
            echo '<script>swal("","Nouvelle ville ajoutée","success");</script>';
         }
         else
         {
            echo '<script> swal("","L\enregistrement de la ville  a échoué ","error"); </script>';
         }
      }
      ?>
         <!-- end sidebar -->
</div>
</div>
   </div>
</body>







