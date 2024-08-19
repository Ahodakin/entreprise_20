<?php
session_start();
include('layouts/app.php');
?>

<div class="container-fluid py-5 mb-5">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4  wow fadeIn" data-wow-delay=".5s">
                	<div class="card  rounded contact-form">
                        
                        	<div class="card-header bg-primary text-center text-white"> <h3 class="text-white">Modication du mot de passe</h3> </div>
                            <div class="card-body">
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
                        <button type="submit" class="btn btn-primary btn-lg" name="modifier">Modifier</button>
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
        $req=$cnx->prepare("select mdp, email from utilisateurs where email=:em");
        $req->execute(array("em"=>$_SESSION["email"])) or die(print_r($req->errorInfo()));
        $res=$req->fetch();
        if($res && password_verify($ancien, $res[0]))
        {
            if($nouvo==$nouvo2)
            {
                $nouvo=password_hash($nouvo,PASSWORD_DEFAULT);
                $req=$cnx->prepare("update utilisateurs set mdp=:mdp where email=:em ");
                $req->execute(array("mdp"=>$nouvo,"em"=>$_SESSION["email"]))  or die(print_r($req->errorInfo()));
                $result=$cnx->errorCode();
                if($result)
                {
                    echo '<script> swal({
                             title: "",
                             text: "Votre mot de passe a été modifié avec succès",
                             type: "success"
                             }, function(){
                             window.location= "login.php";
                             });
                            </script>';
           
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

<br><br><br><br><br>


<?php
include('footer.php');
?>