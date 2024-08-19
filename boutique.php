<?php
session_start();
if(!$_SESSION["id"])
{
    header("location:login.php");
}
include('layouts/app.php');

function verif($value)
{
    $value=htmlspecialchars($value);
    $value=addslashes($value);
    $value=trim($value);
    return $value;
}
?>

<div class="container-fluid py-5 mb-5">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4  wow fadeIn" data-wow-delay=".5s">
                	<div class="card broder-primary">
                        
                        	<div class="card-header bg-primary text-center text-white"> <h3 class="text-white">Nom de la boutique</h3> </div>
                            <div class="card-body">
                    <form method="post">
                    <div class="mb-3">
                            <label for="exampleInputtel" class="form-label">Nom de la boutique</label>
                            <input type="text" name="nom" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputtel" class="form-label">Description</label>
                            <textarea  name="description" class="form-control" required ></textarea>
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm" name="creer">Creer la boutique</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST["creer"]))
{
    include("connexion_bd.php");
    $nom=verif($_POST["nom"]);
    $desc=verif($_POST["description"]);
   

    if($nom<>"" and $desc<>"" )
    {
        
        $idb='btk_'.$_SESSION["id"]. '_'.date('dmy').mt_rand(10,99);
        $req=$cnx->prepare("insert into boutique (id_btk, nom, description, id_artisan, datecreat) values (:idb,:no, :de,:id, :dc)");
        $req->execute(array("idb"=>$idb,"no"=>$nom, "de"=>$desc, "id"=>$_SESSION["id"], "dc"=>date('d/m/Y'))) or die(print_r($req->errorInfo()));
        $res=$cnx->errorCode();
        if($res)
        {
           echo '<script>swal("", "Votre boutique a été créée avec succès","success");	</script>';
        }
        else
        {
            echo '<script>swal("", "Désole. La boutique n\'a pu être créée","error");	</script>';
        }
    }

}
?>

<br><br><br><br><br>


<?php
include('footer.php');
?>