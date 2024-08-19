<?php
include('layouts/app.php');
?>

<div class="container-fluid py-5 mb-5" id="contact">
    <div class="container">
        <div class="row justify-content-center"> <!-- Centering the form horizontally -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                <div class="p-5 rounded contact-form">
                <div class="text-center card-body bg-primary" style="width:108%; margin-left:-4%;margin-top:-4%; top:0; left:0;">
                        <h3 class="text-white">Modication du mot de passe</h3>
                    </div>
                    <form method="post">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ancien mot de passe</label>
                            <input type="password" name="oldpwd" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputtel" class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="newpwd" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputtel" class="form-label">Confirmation du nouveau mot de passe</label>
                            <input type="password" name="newpwd2" class="form-control" required />
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm" name="modifier">Modifier</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST["modifier"]))
{
    include("connexion_bd.php");
    $ancien=$_POST["oldpwd"];
    $nouvo=htmlspecialchars($_POST["newpwd"]);
    $nouvo2=htmlspecialchars($_POST["newpwd2"]);

    if($ancien<>"" and $nouvo<>"" and $nouvo2<>"")
    {
        $ancien=sha1($ancien);

        $req=$cnx->prepare("select mdp, email from utilisateurs where mdp=:mdp");
        $req->execute(array("mdp"=>$ancien)) or die(print_r($req->errorInfo()));
        $res=$req->fetch();
        if($res)
        {
            if($nouvo==$nouvo2)
            {
                $nouvo=sha1($nouvo);
                $req=$cnx->prepare("update utilisateurs set mdp=:mdp where mdp=:pwd and email=:em ");
                $req->execute(array("mdp"=>$nouvo,"pwd"=>$ancien,"em"=>$res[1]))  or die(print_r($req->errorInfo()));
                $result=$cnx->errorCode();
                if($result)
                {
                    echo '<script>swal("", "Votre mot de passe a été modifié avec succès","success");	</script>';
                }
                else
                {
                    echo '<script>swal("", "Une  erreur est survenue durant la modification du mt de passe","error");	</script>';
                    exit();
                }
            }
            else
            {
                echo '<script>swal("", "Les nouveaux mots de passe ne concordent pas","warning");	</script>';
                exit();
            }
        }
        else
        {
            echo '<script>swal("", "Désole. Le mot de passe que vous tentez de modifier n`\est pas valide","warning");	</script>';
        }
    }
    else
    {
        echo '<script>swal("", "veuillez remplir tous les champs SVP!","warning");	</script>';
    }

}
?>
<?php
include('footer.php');
?>