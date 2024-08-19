<?php include('entete.php'); ?>
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
                           <h2>Dashboard</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row column1">
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-user yellow_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <?php
                                 include('../connexion_bd.php');
                                 $req=$cnx->query("select count(*) from utilisateurs where type='P'");
                                 $nbre=$req->fetch();
                                 ?>
                                 <p class="total_no"><?php echo $nbre[0]; ?></p>
                                 <p class="head_couter">Artisans</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-clock-o blue1_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                              <?php
                                 include('../connexion_bd.php');
                                 $req=$cnx->query("select count(*) from utilisateurs where type='C'");
                                 $nbre=$req->fetch();
                                 ?>
                                 <p class="total_no"><?php echo $nbre[0]; ?></p>
                                 <p class="head_couter">Utilisateurs</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-cloud-download green_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                           <?php
                                 include('../connexion_bd.php');
                                 $req=$cnx->query("select count(*) from utilisateurs where type='P' or type='C' ");
                                 $nbre=$req->fetch();
                                 ?>
                                 <p class="total_no"><?php echo $nbre[0]; ?></p>
                                 <p class="head_couter">Membres</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-comments-o red_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                           <?php
                                 include('../connexion_bd.php');
                                 $req=$cnx->query("select count(*) from utilisateurs where type='P'");
                                 $nbre=$req->fetch();
                                 ?>
                                 <p class="total_no"></p>
                                 <p class="head_couter">Messages des Clients</p>
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