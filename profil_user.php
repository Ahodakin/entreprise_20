<?php
session_start();
include('layouts/app.php');
include('connexion_bd.php');

$id=$_SESSION["id"];
include("connexion_bd.php");
$req=$cnx->prepare("select * from utilisateurs where id= :id");
$req->execute(array("id"=>$id));
$result=$req->fetch();
?>
<div class="container-fluid py-5 mb-5" id="contact">
    <div class="container">
        <div class="row justify-content-center"> <!-- Centering the form horizontally -->
                
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                <div class="text-center card-body bg-primary">
               

                        <h3 class="text-white">Modification de votre profil</h3>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row mt-3">
                            <div class="col">
                                <label for="exampleInputname" class="form-label">Nom</label>
                                <input type="text" name="nom" class="form-control" required value="<?php echo $result[1]?> " />
                            </div>
                            <div class="col">
                                <label for="exampleInputprenom" class="form-label">Prénom</label>
                                <input type="text" name="prenom" class="form-control" required value="<?php echo $result[2]?> "/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?php echo $result[3]; ?> "/>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputtel" class="form-label">Téléphone</label>
                            <input type="text" name="tel" class="form-control" required value="<?php echo $result[4]?> "/>
                        </div>

                   <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="modifier">Valider les modifications</button>
						</div>
                        </div>
                        
                        
                        
                        <div class="col-lg-2 text-center wow fadeIn" data-wow-delay=".5s">
                	<label for="exampleInputPassword1" class="form-label">Photo de profil</label>
                    <img src="photoPro/<?php echo $result[9];?>" alt="image introuvable" id="image" style="max-width: 500px; margin-top: 20px; border:2px solid; width:200px;height:200px; padding:1%;" ><br/>
                    <script type="text/javascript" >
                // L'image img#image
                var image = document.getElementById("image");
                 
                // La fonction previewPicture
                var previewPicture  = function (e) {
            
                    // e.files contient un objet FileList
                    const [picture] = e.files
            
                    // "picture" est un objet File
                    if (picture) {
                        // On change l'URL de l'image
                        image.src = URL.createObjectURL(picture)
                    }
                } 
            </script>
            <script>
                function getfile(){
        		document.getElementById('hiddenfile').click();
    			}
   				function getvalue(){
        		document.getElementById('selectedfile').value=document.getElementById('hiddenfile').value;
   				}
            </script>

            <p><input type="file" id="hiddenfile" style="display:none;" accept="image/*" onChange="previewPicture(this)" name="picture"/>
                <input type="hidden" id="selectedfile" value=""/><br>
            <input type="button" value="Selectionner une photo" class="btn btn-outline-info btn-sm" onClick="getfile();"/>
                    </p>
                                
                   </div>   
            </div>
                      </form> 
                        
                        
                        
                        
                        
                        
                        
                        
                        
                            </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST["modifier"]))
{
    
	$nom=htmlspecialchars($_POST["nom"]);
    $prenom=htmlspecialchars($_POST["prenom"]);
    $email=htmlspecialchars($_POST["email"]);
    $tel=htmlspecialchars($_POST["tel"]);
    $type="C";
    $photo="";

    if(isset($_FILES['picture'])){
    $maxSize = 400000;
    $tmpName = $_FILES['picture']['tmp_name'];
    $photo = $_FILES['picture']['name'];
    $size = $_FILES['picture']['size'];
    $error = $_FILES['picture']['error'];
    //corriger les erreurs
    $tabExtension = explode('.', $photo);
    $extension = strtolower(end($tabExtension));
    //verification de l'extension
    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    if(in_array($extension, $extensions))
    {
        if($size<=$maxSize && $error == 0)
        {
            move_uploaded_file($tmpName, 'photoPro/'.$photo);
        }
        else
        {
            echo " Une erreur est survenue";
            exit();
        }
       
    }
    else
    {
        echo "Mauvaise extension";
        exit();
    }

    $tmpName = $_FILES['picture']['tmp_name'];
    $photo = $_FILES['picture']['name'];
    $size = $_FILES['picture']['size'];
    $error = $_FILES['picture']['error'];
    move_uploaded_file($tmpName, 'photoPro/'.$photo);
	}
	
	
	$req=$cnx->prepare("update utilisateurs set nom=:no, prenom=:pr, email=:em, telp=:te,  photo=:ph, type=:ty where id=:id");
	$req->execute(array("no"=>$nom,"pr"=>$prenom, "em"=>$email, "te"=>$tel, "ph"=>$photo, "ty"=>$type, "id"=>$_SESSION['id'])) or die (print_r($req->errorInfo()));
	$res=$cnx->errorCode();
	if($res)
	{
		    echo '<script> swal({
            title: "",
            text: "Les modifications ont été effectuées  avec succès",
            type: "success"
            }, function(){
                window.location= "espace_artisan.php";
            });
     </script>';
   
   
	}
	else
	{
		 echo '<script>
                swal("","Oups. Vos donnees n\'ont pas etre modifiées ","success");
				document.location.replace("login.php");
            </script>';
	}
}
?>

<?php
include('footer.php');
?>