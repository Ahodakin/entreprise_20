<?php
session_start();
if(!$_SESSION['id'])
{
    header('location:login.php');
    exit();
}


include('layouts/app.php');
include('connexion_bd.php');



function calculerDistance($lat1, $lon1, $lat2, $lon2) {
    $rayonTerre = 6371; // Rayon de la terre en kilomètres
    $deltaLat = deg2rad($lat2 - $lat1);
    $deltaLon = deg2rad($lon2 - $lon1);
    $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($deltaLon / 2) * sin($deltaLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $rayonTerre * $c;
    return $distance;
}

?>
<script>
function doSomethingWithGeolocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                console.log('current position', position.coords.latitude, position.coords.longitude);

                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                document.cookie = "lat = " +latitude;
                document.cookie = "lon = " +longitude;

               
            });
        }
    }
 
    
</script>
<!-- Page Header Start -->
<div class="container-fluid page-header">
    <div class="container text-center">
        <h4 class="display-2 text-white mb-4 animated slideInDown">Nos Artisans</h4>
    </div>
</div>
<!-- Page Header End -->



<!-- Blog Start -->
<div class="container-fluid blog my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-2">
            <form action="" method="post" class="input-group">
                <input type="text" name="prof" value="" placeholder="Rechercher un artisan" class="form-control py-2">
                <button type="submit" class="btn btn-secondary mx-2 btn-sm" name="search">Rechercher</button>
                
            </form>
        </div>
    </div>
    <div class="container py-2">
        <div class="text-center mx-auto pb-4 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <!-- <h5 class="text-primary">Nos Artisans</h5> -->
            <h1>Tous les <span id="titre">Artisans</span></h1>
        </div>

        <?php 
            if(isset($_POST["search"]))
            { 
            $text=ucfirst($_POST["prof"]);
            echo'<script>document.location.replace("artisan_cat.php?prof='.$text.'");</script>';
           
            }
            
?>

        <div class="row g-5 justify-content-center">
        <?php

            // pagination
					 $requet=$cnx->query("select count(*) from utilisateurs where type='P'");
					 $count=$requet->fetch();
					 $nbre_elt_par_page=12;
					 $nbre_pages=ceil($count[0]/$nbre_elt_par_page);

					 @$page=$_GET["page"];
					 if(empty($page) or $page>$nbre_pages) $page=1;
					 $debut=($page-1)*$nbre_elt_par_page;

            $requete=$cnx->prepare("select * from utilisateurs where type=:ty limit $debut, $nbre_elt_par_page");
            $requete->execute(array("ty"=>"P")) or die (print_r($req->errorInfo()));
            $total=$requete->rowCount();
            if($total!=0)
            {
                $t=0;
                while($result=$requete->fetch())
                {
                    $lat=$_COOKIE['lat'];
                    $lon=$_COOKIE['lon'];
                    $latA=$result[8];
                    $lonB=$result[7];
                    $distance=calculerDistance($lat,$lon,$latA ,$lonB );
                    if ($distance < 1) {
                        $distance = 'Environ ' . number_format($distance * 1000, 0) . ' m de vous';
                    } else {
                        $distance = 'Environ ' . number_format($distance, 0) . ' km de vous';
                    }
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
                                <h6 style="color:red;"><i class="bi bi-geo-alt-fill"></i>'.$distance.'</h6>
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
              
            }
            else
            {
                echo '<script>swal("","Aucun arisan inscrit sur la plateforme","error");</script>';
            }
        
              
                ?>
                
            
        </div><!--fin conte--> <br><br>
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
        </div>
       
   

<!-- Blog End -->

<?php
include('footer.php');
?>
