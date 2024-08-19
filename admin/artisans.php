<?php include('entete.php'); ?>
         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
            <?php include('topbar.php'); ?>
            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2></h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="row">

                     <!-- table section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Tous les artisans</h2>
                              </div>
                           </div>

                           <div class="table_section padding_infor_info">
                              <div class="table-responsive-sm">
                                 <table class="table table-hover">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Nom</th>
                                          <th>Prenom</th>
                                          <th>Email</th>
                                          <th>Photo</th>
                                          <th>Ville</th>
                                          <th>Supprimer</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       include('../connexion_bd.php');
                                       $requete=$cnx->query("select count(id) from utilisateurs where type='C'");
                                       $count=$requete->fetch();
                                       $nbre_elt_par_page=5;
                                       $nbre_pages=ceil($count[0]/$nbre_elt_par_page);

                                       @$page=$_GET["page"];
                                       if(empty($page) or $page>$nbre_pages) $page=1;
                                       $debut=($page-1)*$nbre_elt_par_page;
                                      
                                       $req=$cnx->query("select * from utilisateurs where type='P'" );
                                       while($result=$req->fetch())
                                       {
                                          echo'
                                       <tr>
                                          <td>'.$result[0].'</td>
                                          <td>'.$result[1].'</td>
                                          <td>'.$result[2].'</td>
                                          <td>'.$result[3].'</td>
                                          <td><img height="50" width="50"class="img-responsive rounded-circle" src="../photoPro/'.$result[9].'" style="border:2px solid;"></td>
                                          <td>'.$result[6].'</td>
                                          <td>
                                          <td align="center"> <a href="delete_member.php?id='.$result[0].'&type='.$result[12].'" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                          </td>
                                       </tr>';}
                                       ?>
                                    </tbody>
                                 </table>
                                 <?php
                                    for($i=1;$i<=$nbre_pages;$i++)
                                    {
                                       if($page !=$i)
                                       echo '<a class="btn btn-outline-primary btn-sm m-2 p-2" href="?page='.$i.'">'.$i.'</a>';
                                       else
                                       echo '<a class="btn btn-primary btn-sm m-2 p-2 text-white">'.$i.'</a>';
                                    }

                                 ?>
                               
                              </div>
                              <div class="text-right">
                              <?php
                                 include('../connexion_bd.php');
                                 $req=$cnx->query("select count(*) from utilisateurs where type='P'");
                                 $nbre=$req->fetch();
                                 ?>
                                 <h1 class="total_no">Total: <?php echo $nbre[0]; ?></h1>
                              
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
            <!-- footer -->
            <div class="container-fluid">
               <div class="footer">
                  <p>Copyright © 2024. All rights reserved.<br><br>
                  </p>
               </div>
            </div>
         </div>
         <!-- end dashboard inner -->
      </div>
   </div>
   </div>
   <!-- jQuery -->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <!-- wow animation -->
   <script src="js/animate.js"></script>
   <!-- select country -->
   <script src="js/bootstrap-select.js"></script>
   <!-- owl carousel -->
   <script src="js/owl.carousel.js"></script>
   <!-- chart js -->
   <script src="js/Chart.min.js"></script>
   <script src="js/Chart.bundle.min.js"></script>
   <script src="js/utils.js"></script>
   <script src="js/analyser.js"></script>
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="js/chart_custom_style1.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>