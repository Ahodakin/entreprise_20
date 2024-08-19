<?php
session_start();
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
        <div class="col-4 wow fadeIn" data-wow-delay=".5s">
            <h5>Ajouter des produits a votre boutique</h5>
                <ol>
                    <li>Ces produits concernent vos réalisations. Il peut s'agir </li>
                    <li>de vos inventions personnelles.</li>
                    <li>des travaux réalisés pour des clients.</li>
                    	
                </ol>	 
                   

        </div>
        <div class="col-4 wow fadeIn" data-wow-delay=".5s">
            <div class="card  rounded contact-form">
                <div class="card-header bg-primary text-center"> 
                    <h2 class="text-white">Ajout de produit</h2>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nom du produit </label>
                            <input type="text" name="nom" class="form-control" id="exampleInputPassword1" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Prix</label>
                            <input type="text" name="prix" class="form-control" id="exampleInputPassword1" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <textarea name="desc" class="form-control" id="exampleInputPassword1" ></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button>
                        </div>

                    </div>
                </div>
</div>
                <div class="col-3 text-center wow fadeIn" data-wow-delay=".5s">
                        <label for="exampleInputPassword1" class="form-label">Photo du produit</label><br>
                        <img src="img/blog-1.jpg" alt="" id="image" style="max-width: 500px; margin-top: 15px; border:2px solid; width:150px;height:150px; padding:1%;" ><br/>
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

                        <p>
                            <input type="file" id="hiddenfile" style="display:none;" accept="image/*" onChange="previewPicture(this)" name="picture"/>
                            <input type="hidden" id="selectedfile" value=""/><br>
                            <input type="button" value="Selectionner un produit" class="btn btn-outline-primary btn-sm" onClick="getfile();"/>
                        </p>
                                    
                    </div>   
                </div>
                </form>         

            </div>
            
    </div>
    <!-- Contact End -->

 


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Javascript -->
    <script src="js/main.js"></script>



    <?php
     $nom="";
     $prix="";
     $e="";;
     $photo="";
if(isset($_POST["ajouter"]))
{

    $nom=verif($_POST["nom"]);
    $prix=verif($_POST["prix"]);
    $desc=verif($_POST["desc"]);
    $photo="";

   
    // gestion chargement photo
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
    $extensions = ['jpg', 'png', 'jpeg', 'gif','jfif'];
    if(in_array($extension, $extensions))
    {
        if($size<=$maxSize && $error == 0)
        {
            $photo='Art'.$_SESSION["id"].$photo;
            move_uploaded_file($tmpName, 'boutique/'.$photo);
        }
        else
        {
            echo " Une erreur est survenue";
            exit();
        }
       
    }
    else
    {
        echo"La photo du produit n'est pas correcte";
        exit();
       
    }

    $tmpName = $_FILES['picture']['tmp_name'];
    $photo = $_FILES['picture']['name'];
    $size = $_FILES['picture']['size'];
    $error = $_FILES['picture']['error'];
    $photo='Art'.$_SESSION["id"].$photo;
    move_uploaded_file($tmpName, 'boutique/'.$photo);
    
    include('connexion_bd.php');

    // recherche de la boutique ou inserer le produit
    $reqt=$cnx->prepare("select id_btk from boutique where id_artisan=:id");
    $reqt->execute(array("id"=>$_SESSION['id'])) or die(print_r($reqt->errorCode()));
    $resu=$reqt->fetch();
    
    $id_prod='Pr_'.$resu[0].'_'.mt_rand(10,99).mt_rand(10,99).mt_rand(10,99).mt_rand(10,99);


    $req=$cnx->prepare("insert into boutique_pro(id_prod, nom_prod, prix, id_btk ,image,description) values(:id,:no,:pr,:bq,:im,:de)");
    $req->execute(array("id"=>$id_prod,"no"=>$nom, "pr"=>$prix,"bq"=>$resu[0], "im"=>$photo,"de"=>$desc)) or die (print_r($req->errorInfo()));
    $res=$cnx->errorCode();
    if($res)
    {
            echo '<script> swal("","Produit bien ajouté à la boutique","success"); </script>';   
    }
    else
    {
        echo '<script>
                swal("","Ouups! Echec de l\'ajout du produit ","error");
            </script>';
    }
	}
}
?>





</body>
