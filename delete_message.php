<?php
include('connexion_bd.php');
$mesRecpt=$_GET['type'];
$id=$_GET['id'];

$req=$cnx->prepare("select statMesEmett from messages where id=:id");
$req->execute(array("id"=>$id));
$res=$req->fetch();
if($res[0]==1)
{
    $req2=$cnx->prepare("update messages set statMesRecept='0' where id=:id");
    $req2->execute(array("id"=>$id));
    $res2=$req->fetch();
    header("location:message.php");
}
else
{
    $req2=$cnx->prepare("delete from messages  where id=:id");
    $req2->execute(array("id"=>$id));
    $res2=$req->fetch();
    header("location:message.php");

}
?>