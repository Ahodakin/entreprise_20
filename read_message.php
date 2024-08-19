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
      <?php
         $req=$cnx->prepare("select * from messages where recepteur=:re and statMesRecept='1' and id=:id");
         $req->execute(array("re"=>$_SESSION["id"],"id"=>$idm)) or die(print_r($req->errorInfo()));
         $result=$req->fetch();
      ?>
      <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Lecture du message</h3>
             <!-- <div class="card-tools">
                <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
              </div> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>Sujet: <?php echo $result[2]; ?></h5>
                <h6>De: <?php echo recherche($emett); ?>
                  <span class="mailbox-read-time float-right"><?php echo $result[4].'   ' .$result[5]; ?></span></h6>
                  <hr>
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
              <div class="mailbox-read-message p-3">
              <?php echo $result[3]; ?>
              <br><br>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">    
            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
              <div class="float-right">
                <a href="message.php?id=<?php echo $result[0];?>&type=<?php echo $result[6];?>" class="btn btn-default"><i class="fas fa-reply"></i> Repondre</a>
                <a href="delete_message.php?id=<?php echo $result[0];?>&type=<?php echo $result[6];?>" class="btn btn-default"><i class="far fa-trash-alt"></i> Supprimer</a>
                <a type="button" class="btn btn-default"><i class="fas fa-print"></i> Imprimer</a>
              </div>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      </div>
   </div></div></div>
<!-- Blog End -->


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reponse à un message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="">
      <div class="modal-body">
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Emetteur :</label>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo $_SESSION["nom"].' '.$_SESSION["prenom"]; ?>" readonly name="emetteur">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Destinataire :</label>
            <input type="text" class="form-control" id="recipient-name" value="<?php echo $_SESSION['dest'];?>" name="destinataire">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary" name="envoyer">Envoyer</button>
      </div>
      </form>
    </div>
  </div>
</div>

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
        echo'<script>swal("","Votre message abien été envoyé","success");</script>';
    }
    else{
        echo'<script>swal("","Impossible d\'envoyer le message","error");</script>';
    }
   
}
?>





<?php
include('footer.php');
?>
