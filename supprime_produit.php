<?php
include('connexion_bd.php');
include('layouts/app.php');
$idprod=$_GET['p'];

$req=$cnx->prepare("delete  from boutique_pro where id_prod=:id");
$req->execute(array("id"=>$idprod));
$res=$cnx->errorCode();
if($res)
{
    echo '<script> swal({
        title: "",
        text: "Produit supprimé avec succès",
        type: "success"
        }, function(){
            window.location= "boutique_view_pro.php";
        });
</script>';
}
else
{
    echo '<script> swal({
        title: "",
        text: "Impossible de supprimer ce produit",
        type: "error"
        }, function(){
            window.location= "boutique_view_pro.php";
        });
</script>';

}
?>