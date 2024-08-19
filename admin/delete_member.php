<?php
$id=$_GET["id"];
$type=$_GET["type"];
include("../connexion_bd.php");
$req=$cnx->prepare("delete from utilisateurs where id=:id");
$req->execute(array("id"=>$id));
if($type=="P")
   header("location:artisans.php");
if($type=="C")
   header("location:users.php");
?>

   













            