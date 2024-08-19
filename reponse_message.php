<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:login.php");
    exit();
}

include('layouts/app.php');
include('connexion_bd.php');

$idm=$_GET['id'];
$emett=$_GET['emetteur'];

function recherche($n)
{
   include('connexion_bd.php');
   $reqt=$cnx->prepare("select nom, prenom from utilisateurs where id=:id");
   $reqt->execute(array("id"=>$n)) or die(print_r($reqt->errorCode()));
   $resu=$reqt->fetch();
   $pers= $resu[0].'  '.$resu[1];
   return $pers;
}

?>
<head>
<link href="sweetalert/dist/sweetalert.css" rel="stylesheet">
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script></head>
<!-- Blog Start -->
<div class="container-fluid py-5 mb-5">
   <div class="row">
      <div class="col-3"> 
         <section class="content">
         <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
               <a href="message.php" class="btn btn-primary btn-block mb-1">Retour à la Boite de reception</a>

               <div class="card">
               <div class="card-header">
               </div>
               <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                     <li class="nav-item active">
                     <a href="message.php" class="nav-link">
                        <i class="fas fa-inbox"></i> Boite de réception
                        <?php
                        $req=$cnx->prepare("select * from messages where recepteur=:re and statMesRecept='1'");
                        $req->execute(array("re"=>$_SESSION["id"])) or die(print_r($req->errorInfo()));
                        $result=$req->rowCount();
                        
                        ?>
                        <span class="badge bg-primary float-right"><?php echo $result;?></span>
                     </a>
                     </li>
                     <li class="nav-item">
                     <a href="message_envoi.php" class="nav-link">
                        <i class="far fa-envelope"></i> Envoyés
                     </a>
                     </li>
                     
                  </ul>
               </div>
               <!-- /.card-body -->
               </div>
               <!-- /.card -->
               
               <br><br>
            
         </section>
      </div>
      <div class="col-6">

<!-- Blog End -->

                	<div class="card broder-primary">
                        
                        	<div class="card-header bg-primary text-center text-white"> <h3 class="text-white">Reponse au message</h3> </div>
                            <div class="card-body">


      <form method="post" action="">
      <div class="card-body">
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Emetteur :</label>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo $_SESSION["nom"].' '.$_SESSION["prenom"]; ?>" readonly name="emetteur">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Destinataire :</label>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo recherche($emett);?>" name="destinataire">
          </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Objet:</label>
            <input type="text" class="form-control" id="message-text" name="objet">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Reponse:</label>
            <textarea class="form-control" id="message-text" name="besoin"></textarea>
          </div>
       
      </div>
      <div class="text-center">
        
        <button type="submit" class="btn btn-primary" name="envoyer">Envoyer</button>
      </div>
      </form>
                    
<?php
if(isset($_POST["envoyer"]))
{
    //$num=$_GET["num"];
    $emet=$_SESSION["id"];
    $objet=$_POST["objet"];
    $contenu=$_POST["besoin"];
    $date=date('d/m/Y');
    $heure=date('H:i:s');
    $recpt=$_SESSION["num"];
    $statEmetteir=1;
    $statRecepteur=1;
    $req=$cnx->prepare("insert into messages(emetteur, objet,contenu, dateEnvoi, heureEnvoi, recepteur, statMesEmett,statMesRecept) values(:em,:ob,:co,:de,:he, :re,:se,:sr)");
    $req->execute(array("em"=>$emet,"ob"=>$objet,"co"=>$contenu,"de"=>$date,"he"=>$heure,"re"=>$recpt,"se"=>$statEmetteir,"sr"=>$statRecepteur)) or die(print_r($req->errorInfo()));
    $res=$cnx->errorCode();
    if($res)
    {
        echo '<script> swal({
            title: "",
            text: "Envoyé  avec succès",
            type: "success"
            }, function(){
                window.location= "message.php";
            });
            </script>';
    }
    else{
        echo'<script>swal("","Impossible d\'envoyer le message","error");</script>';
    }
   
}
?>

</div>
                </div>
            </div>
        </div>
    </div



<?php
include('footer.php');
?>
