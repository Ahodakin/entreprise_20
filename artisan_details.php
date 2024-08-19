<?php
session_start();
if(!$_SESSION["id"])
{
    header("location:login.php");
}
include('layouts/app.php');
?>
<style>
    .details-artisans {
        padding: 50px;
        display: flex;
        flex-direction: row;
        gap: 15px;

    }

    img {
        width: 300px;
        border: 2px solid;
    }

    a {
        color: #fff;

    }

    a:hover {
        color: #fff;

    }

    .tel {

        background-color: #1842b6;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .tel:hover {
        background-color: #1842b6;
    }

    .what {

        background-color: #3cd898;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .what:hover {
        background-color: #3cd898;

    }

    .link {
        display: flex;
        flex-direction: row;
        gap: 15px;
    }

    #map {
            height: 350px;
            width: 100%;
        }
</style>
<?php
$_SESSION['num']=$_GET["num"];
include("connexion_bd.php");
$req=$cnx->prepare("select * from utilisateurs where id= :id");
$req->execute(array("id"=>$_SESSION['num']));
$result=$req->fetch();
?>

<?php

   include('connexion_bd.php');
   $reqt=$cnx->prepare("select id_btk from boutique where id_artisan=:id");
   $reqt->execute(array("id"=>$_SESSION["num"])) or die(print_r($reqt->errorCode()));
   $resu=$reqt->fetch();

   function recherche($n)
   {
      include('connexion_bd.php');
      $reqt=$cnx->prepare("select nom, prenom from utilisateurs where id=:id");
      $reqt->execute(array("id"=>$n)) or die(print_r($reqt->errorCode()));
      $resu=$reqt->fetch();
      $pers= $resu[0][0].'  '.$resu[1][0];
      return $pers;
   }

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-9">
            <section class="details-artisans">
                <div>
                    <img src="photoPro/<?php echo $result[9]; ?>" alt="">
                </div>
                <div>
                    <h1><?php echo $result[1].'   '.$result[2]; ?></h1>
                    <h2><?php echo $result[10]; ?></h2>
                    <p><?php echo $result[3]; ?></p>
                    <p><?php echo $result[4]; ?></p>
                    <p><?php echo $result[6]; ?></p>
                    <p>Niveau d'etude : <?php echo $result[5]; ?></p>


                    <div class="">
                        <a href="" title="appel téléphonique" class="btn btn-primary btn-sm"><i class="fa fa-phone"></i></a>
                        <a href="" title="appel whatsapp" class="what"><i class="fa fa-phone"></i></a>
                        <a href=""  class="tel" data-bs-toggle= "modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Envoyer un message</a>
                        <?php if($resu){
                        ?>
                        <a href="boutique_view.php?num=<?php echo $_SESSION["num"];?>" class="tel">voir la boutique</i></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-3 wow fadeIn" data-wow-delay=".5s">
            <div class="card broder-primary">
                        
                        <div class="card-header bg-primary text-center text-white"> <h6 class="text-white">Votre avis sur cet artisan</h6> </div>
                        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="exampleInputtel" class="form-label">Votre impression</label>
                    <textarea  name="impression" class="form-control form-control-sm" required ></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputtel" class="form-label">Note sur 5</label>
                    <input type="number" name="note" min="0" max="5" class="form-control form-control-sm" required />
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm" name="send">Envoyer</button>
                </div>
            </form>
        </div>
        </div>
        <?php
        if(isset($_POST["send"]))
        {
            $id_pro=$_SESSION["num"];
            $id_user=$_SESSION["id"];
            $impr=$_POST["impression"];
            $note=$_POST["note"];
            $date=date('d/m/Y');
            $req=$cnx->prepare("insert into avis_notation(note, avis,id_user, id_pro, dateenvoi) values(:no,:av,:us,:pr,:da)");
            $req->execute(array("no"=>$note,"av"=>$impr,"us"=>$id_user,"pr"=>$id_pro,"da"=>$date)) or die(print_r($req->errorInfo()));
            $res=$cnx->errorCode();
            if($res)
            {
                echo'<script>swal("","Votre avis a bien été envoyé","success");</script>';
            }
            else{
                echo'<script>swal("","Impossible d\'envoyer cet avis","error");</script>';
            }
           
        }
        ?>
    </div>
 </div>
    
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">Les avis sur l'artisan</div>
            <div class="card-body">
                <?php
                $req=$cnx->prepare("select * from avis_notation where id_pro=:ar");
                $req->execute(array("ar"=>$_SESSION["num"]));
                $res=$req->rowCount();
                if($res>0)
                { echo'<table class="table">
                    <tr>
                    <td>Client</td>
                    <td>Avis donné</td>
                    <td>Note /5 </td>
                    </tr>';
                    
                    while($resu=$req->fetch())
                    {
                        echo'<tr>
                        <td>'.recherche($resu[3]).'</td>
                        <td>'.$resu[2].'</td>
                        <td>'.$resu[1].'</td>
                        </tr>';
                    }
                    echo'</table>';
                }
                else
                {
                    echo'<table class="table table hover table-bordered">
                    <tr>
                    <td colspan="4">Aucun avis et notation concernant cet artisan</td>
                    </tr></table>';
                }
                ?>
                 
            </div>
        </div>
    </div>
</div>




<input style="display: none;" type="text" name="" id="input_lat_maps" value="<?php echo $result[8]; ?>">
<input style="display: none;" type="text" name="" id="input_long_maps" value="<?php echo $result[7]; ?>">

<div id="map"></div>
<script>
        
        
        function initMap() {
        let latitude = parseFloat(document.getElementById('input_lat_maps').value)
        let longitude = parseFloat(document.getElementById('input_long_maps').value)
        console.log(latitude+' '+longitude)

            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: latitude, lng: longitude },
                zoom: 15
            });

            const marker = new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: 'Emplacement atelier'
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8FOFa7RdFQUtYjIZjO-M0gkuBDeEv0zU&callback=initMap"></script>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau message</h5>
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
            <input type="text" class="form-control" id="recipient-name" value="<?php echo $result[1].' ' .$result[2];?>" name="destinataire">
          </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Objet:</label>
            <input type="text" class="form-control" id="message-text" name="objet">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Exprimer votre besoin:</label>
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
    $num=$_GET["num"];
    $emet=$_SESSION["id"];
    $objet=$_POST["objet"];
    $contenu=$_POST["besoin"];
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
        echo'<script>swal("","Votre message abien été envoyé","success");</script>';
    }
    else{
        echo'<script>swal("","Impossible d\'envoyer le message","error");</script>';
    }
   
}
?>




<br><br>
<?php
include('footer.php');
?>