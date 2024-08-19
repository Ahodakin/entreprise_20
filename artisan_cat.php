<?php
session_start();
include('layouts/app.php');
include('connexion_bd.php');
?>


<!-- Page Header Start -->
<div class="container-fluid page-header">
    <div class="container text-center">
        <h4 class="display-1 text-white mb-2 animated slideInDown">Nos Artisans  de <?php echo $_GET["prof"]; ?></h4>
    </div>
</div>
<!-- Page Header End -->



<!-- Blog Start -->
<div class="container-fluid blog my-5">
    <div class="container py-2">

        <?php
      
           
                $text=ucfirst($_GET["prof"]);
                $req=$cnx->prepare("select * from utilisateurs where  type=:ty  and profession =:pf");
                $req->execute(array("ty"=>"P", "pf"=>$text)) or die (print_r($req->errorInfo() ));
        ?>

        <div class="row g-5 justify-content-center">
            
        <?php 
        $t=0;
        while($result=$req->fetch())
        {
            $t+=2;
            echo'
            <div class="col-lg-6 col-xl-3 wow fadeIn" data-wow-delay=".'.$t.'s">
                <div class="blog-item position-relative bg-light rounded">
                    <img src="img/blog-1.jpg" class="img-fluid w-50 rounded-top" alt="" height="20" width="20">
                    <span class="position-absolute px-2 py-2 bg-primary text-white rounded" style="top: -28px; right: 20px;">'.$result[10].'</span>
            
                    <div class="blog-content text-center position-relative px-3" style="margin-top: -25px;">
                        <img src="photoPro/'.$result[9].'" class="rounded-circle border border-1 border-primary mb-1" alt="" width="100" height="100">
                        <h5 class="">'.$result[1].'  '. $result[2].'</h5>
                        <span class="text-secondary">'.$result[6].'</span>
                
                    </div>
                    <div class="blog-coment d-flex justify-content-between px-2 py-2 border bg-primary rounded-bottom">
                        <div class="blog-icon btn btn-secondary btn-sm px-0 ">
                        <a href="artisan_details.php?num='.$result[0].'" class="btn btn-sm text-white">Voir plus</a>
                     </div>
                    <div class="blog-icon btn btn-secondary btn-sm px-1">
                        <a href="artisan_details.php?num='.$result[0].'" class="btn btn-sm text-white">  Info   </a>
                    </div>
                    <!-- <a href="" class="text-white"><small><i class="fas fa-share me-2 text-secondary"></i>5324 Share</small></a>
                        <a href="" class="text-white"><small><i class="fa fa-comments me-2 text-secondary"></i>5 Comments</small></a> -->
                </div>
             </div>
            </div>';
                
                }
               
                ?>
            
        </div><!--fin conte-->
    </div>
</div>
<!-- Blog End -->

<?php
include('footer.php');
?>