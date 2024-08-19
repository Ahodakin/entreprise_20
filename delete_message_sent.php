<?php
include('connexion_bd.php');
$mesRecpt=$_GET['type'];
$id=$_GET['id'];

$req=$cnx->prepare("select statMesRecept from messages where id=:id");
$req->execute(array("id"=>$id));
$res=$req->fetch();
if($res[0]==1)
{
    $req2=$cnx->prepare("update messages set statMesEmett='0' where id=:id");
    $req2->execute(array("id"=>$id));
    $res2=$req->fetch();
    header("location:message_envoi.php");
}
else
{
    $req2=$cnx->prepare("delete from messages  where id=:id");
    $req2->execute(array("id"=>$id));
    $res2=$req->fetch();
    header("location:message_envoi.php");

}
?>