<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:login.php");
    exit();
}

include('layouts/app.php');
include('connexion_bd.php');

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
               
               </div>
               <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                     <li class="nav-item active">
                     <a href="#" class="nav-link">
                        <i class="fas fa-inbox"></i> Boite de réception
                        <?php
                        $req=$cnx->prepare("select * from messages where recepteur=:re");
                        $req->execute(array("re"=>$_SESSION["id"])) or die(print_r($req->errorInfo()));
                        $result=$req->rowCount();
                        
                        ?>
                        <span class="badge bg-primary float-right"><?php echo $result;?></span>
                     </a>
                     </li>
                     <li class="nav-item">
                     <a href="#" class="nav-link">
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

      <div class="col-9  wow fadeIn" data-wow-delay=".5s">
         <?php 
               // selection de tous les messages recues par l'artisan connecte
            $req=$cnx->prepare("select * from messages where recepteur=:ds");
            $req->execute(array("ds"=>$_SESSION["id"]));
            $total=$req->rowCount();
         ?>
         <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Read Mail</h3>

              <div class="card-tools">
                <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>Message Subject Is Placed Here</h5>
                <h6>From: support@adminlte.io
                  <span class="mailbox-read-time float-right">15 Feb. 2015 11:03 PM</span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
                    <i class="fas fa-share"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" title="Print">
                  <i class="fas fa-print"></i>
                </button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            
            <!-- /.card-footer -->
            <div class="card-footer">
              
              <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
              <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
<!-- Blog End -->


<?php
if(isset($_POST["envoyer"]))
{
    $num=$_GET["num"];
    $emet=$_SESSION["id"];
    $objet=$_POST["objet"];
    $contenu=$_POST["contenu"];
    $date=date('d/m/Y');
    $heure=date('H:i:s');
    $recpt=$_POST["destinataire"];
    $statEmetteir=1;
    $statRecepteur=1;
    $req=$cnx->prepare("insert into messages(emetteur, objet,contenu, dateEnvoi, heureEnvoi, recepteur, statMesEmett,statMesRecept) values(:em,:ob,:co,:de,:he, :re,:se,:sr)");
    $req->execute(array("em"=>$emet,"ob"=>$objet,"co"=>$contenu,"de"=>$date,"he"=>$heure,"re"=>$num,"se"=>$statEmetteir,"sr"=>$statRecepteur)) or die(print_r($req->errorInfo()));
    $res=$cnx->errorCode();
    if($res)
    {
        echo'<script>swal(" ","Votre message a bien été envoyé","success");</script>';
    }
    else{
        echo'<script>swal("","Impossible d\'envoyer le message","error");</script>';
    }
   
}
?>





<?php
include('footer.php');
?>
