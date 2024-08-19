<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:login.php");
    exit();
}

include('layouts/app.php');
include('connexion_bd.php');

function recherche($n)
{
   include('connexion_bd.php');
   $reqt=$cnx->prepare("select nom, prenom from utilisateurs where id=:id");
   $reqt->execute(array("id"=>$n)) or die(print_r($reqt->errorCode()));
   $resu=$reqt->fetch();
   $pers= $resu[0].'  '.$resu[1];
   return $pers;
}

?>
<!-- Blog Start -->
<div class="container-fluid py-5 mb-5">
   <div class="row">
      <div class="col-3"> 
         <section class="content">
         <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
               <a href="message.php" class="btn btn-primary btn-block mb-1">Retour à la Boite de reception</a>

               <div class="card">
               <div class="card-header">
               </div>
               <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                     <li class="nav-item active">
                     <a href="message.php" class="nav-link">
                        <i class="fas fa-inbox"></i> Boite de réception
                        <?php
                        $req=$cnx->prepare("select * from messages where recepteur=:re and statMesRecept='1'");
                        $req->execute(array("re"=>$_SESSION["id"])) or die(print_r($req->errorInfo()));
                        $result=$req->rowCount();
                        
                        ?>
                        <span class="badge bg-primary float-right"><?php echo $result;?></span>
                     </a>
                     </li>
                     <li class="nav-item">
                     <a href="message_envoi.php" class="nav-link">
                        <i class="far fa-envelope"></i> Envoyés
                     </a>
                     </li>
                     
                  </ul>
               </div>
               <!-- /.card-body -->
               </div>
               <!-- /.card -->
               
               <br><br>
            
         </section>
      </div>

      <div class="col-9  wow fadeIn" data-wow-delay=".5s">
         <?php 
               // selection de tous les messages recues par l'artisan connecte
            $req=$cnx->prepare("select * from messages where recepteur=:ds and statMesRecept='1'");
            $req->execute(array("ds"=>$_SESSION["id"]));
            $total=$req->rowCount();
         ?>
         <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>Tous les messages reçus</h2>
                  </div>
               </div>
               <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
                  <table class="table table-hover table-bordered">
                     <thead>
                        <tr>
                           <th>Emetteur</th>
                           <th>Objet</th>
                           <th>Contenu</th>
                            <th>Date </th>
                           <th>Heure</th>
                           <th colspan="3" align="center">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                         <?php
                         if($total!=0)
                         {
                           while($result=$req->fetch())
                           {
                            
                              $_SESSION['dest']=recherche($result[1]);
                              $_SESSION['num']=$result[1];

                               echo'
                                 <tr>
                                    <td>'.recherche($result[1]).'</td>
                                    <td>'.$result[2].'</td>
                                    <td>'.substr($result[3],0,30).'...'.'</td>
                                    <td>'.$result[4].'</td>
                                    <td>'.$result[5].'</td>
                                    <td> <a href="reponse_message.php?id='.$result[0].'&emetteur='.$result[1].'" class="btn btn-info text-white btn-sm" title="repondre"><i class="bi bi-reply"></i></a></td>
                                    <td> <a href="read_message.php?id='.$result[0].'&emetteur='.$result[1].'" class="btn btn-secondary text-white btn-sm" title="lire"><i class="bi bi-book" aria-hidden="true"></i</a></td>
                                    <td> <a href="delete_message.php?id='.$result[0].'&type='.$result[6].'" class="btn btn-danger text-white btn-sm" title="supprimer"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                 </tr>';
                           }
                        }
                        else
                        {
                           echo '<tr>
                                    <td colspan="6">
                                    <h5 class="text-danger text-center">Désole! <br>
                                       Vous n\'avez pas de messages.
                                    </h5><br>
                                    </td>
                                 </tr>';
                        
                        }
                        ?>
                     </tbody>
                  </table>
               </div><!--fin conte-->
            </div>
         </div>
      </div>
   </div></div></div>
<!-- Blog End -->



      




<?php
include('footer.php');
?>
