<?php
session_start();
if(!$_SESSION["id"])
{
    header("location:login.php");
    exit();
}
include('layouts/app.php');
include('connexion_bd.php');

$id=$_SESSION["id"];
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-2">
    <div class="container text-center py-2">
        <h1 class="display-2 text-white mb-2 animated slideInDown">Pack publicitaire</h1>
    </div>
</div>
<!-- Page Header End -->


<!-- Project Start -->





<div class="container-fluid project py-2 my-3">
    <div class="container py-2">
        <div class="text-center mx-auto pb-2 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Les differents packs</h5>
        </div>
        <div class="row g-5">
            <?php
                $req=$cnx->query("select * from advertising_packages");
                while($result=$req->fetch())
                {

            ?>
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                <div class="project-item">
                <?php echo $result[1]; ?>
                    <div class="project-img">
                        <img src="img/project-2.jpg" class="img-fluid w-100 rounded" alt="">
                        <div class="project-content">
                            <a href="" class="text-center"data-bs-toggle= "modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                <h4 class="text-secondary"><?php echo $result[1]; ?></h4>
                                <p class="m-0 text-white"><?php  echo $result[2]; ?>FCFA</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>


<div class="modal fade text-center" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog text-center">
    <div class="modal-content">
        <form method="post" action="" class="text-center">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Code de paiement:</label>
                    <input type="text" class="form-control" id="recipient-name" name="emetteur">
                </div>
            </div>
            <div class="modal-footer text-ceneter">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                 <button type="submit" class="btn btn-primary" name="Valider">Valider le choix du pack</button>
            </div>
        </form>   
    </div>
  </div>
</div>

<?php
if(isset($_POST["Valider"]))
{

    $id=$_SESSION["id"];
    $req=$cnx->prepare("update utilisateurs set pack=:pk where id=:id");
    $req->execute(array("pk"=>$result[2],"id"=>$id)) or die(print_r($req->errorInfo()));
    $res=$cnx->errorCode();
    if($res)
    {
        echo'<script>swal("","Opération validée");</script>';
    }
    else{
        echo'<script>swal("","Echec de la validation du choix du pack","error");</script>';
    }
   
}
?>




<!-- Project End -->
<?php
include('footer.php');
?>