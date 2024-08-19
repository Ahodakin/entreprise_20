<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        $title='Profession approxmite';
        include('layouts/app.php');
        include('connexion_bd.php');
    ?>
    <link rel="stylesheet" href="css/profession_approx_posit.css">
</head>
<body>
    <?php
        $profession='';
        if(isset($_GET['profession'])){
            $profession=$_GET['profession'];
        }
    ?>
    <div style="position: fixed; height: 100vh; width: 100%;;">
        <img style="height: 100%; width: 100%;;" src="./images/bg2.jpg" alt="">
    </div>
    <div style="position: relative; width: 100%;" id="container_principal">
        <!-- placer le header ici -->
       
        
        <main>
            <!--presenter quelques profession-->
            <div style="background-color: white; text-align: center;  font-weight: 900; color: gray; padding: 20px; padding-bottom: 90px; ">
                <h3>PROFESSION <span style="color: #b88a4d;">PROCHE DE VOUS</span></h3>
            </div>
            <div style="position: relative; width: 100%; padding-bottom: 70px; background-color: #000000ba;">
                <div id="container_qlq_pro_text">
                    <div style="margin-left: 15px;">
                        <h2>Quelques professions en approximite</h2>
                        <p style="color:#552d16;">Nous avons trouve quelques professions proche de vous. vous pourrez consulter leur profil pour en savoir plus. Si vous souhaitez egalement vous inscrire en tant que professionel qualifie, veuillez cliquez sur le bouton "Je m'inscrire maintenant</p>
                    </div>
                    <div class="vr"></div>
                    <div>
                        <div style="text-align: end;">
                            <a style="text-decoration: none;" href="">
                                <button style="display: flex; align-items: center; font-weight: 900; font-size: 20px;" class="btn btn-outline-light shadow-none">
                                    <span style="font-size: 28px" class="material-symbols-outlined me-2">support_agent</span>
                                    +2250102030405
                                </button>
                            </a>
                        </div>
                        <h2>Ouvrez votre compte</h2>
                        <a href="inscription.php" style="font-weight: 900; color:#552d16; font-size: 20px;" class="btn btn-light shadow-none rounded-1">Je m'inscris maintenant</a>
                    </div>
                </div><br><br><br><br><br><br><br><br>
                
                <div id="container_btn_scroll_down">
                    <div class="w-100 d-flex justify-content-center">
                        <span style="display: flex; align-items: center; font-weight: 900; text-decoration: none; gap: 2px; color: #b88a4d;" class="">Afficher les resultats</span>
                    </div>
                    <div id="scr_down" style="text-align: center; margin-top: 10px;">
                        <a style="color:#b88a4d; border: 2px solid #b88a4d;" href="#scr_down" class="btn shadow-none"><span class="bi bi-arrow-down"></span></a>
                    </div>
                </div>
            </div>
            
            <!--liste des profi par professions-->
            <div style="background-color: white; display:flex; padding-top: 10px; padding-bottom: 10px;">
                <div id="container_raccourci" style="border:#b88a4d 1px solid; position:sticky; background-color:#000000ba; top:70px; border-radius:6px">
                    <div style="text-align: center;">
                        <h5 style="color: gray; font-weight:900;">RACCOURCI</h5>
                    </div>
                    <div>
                        <div>
                            <h6 style="font-weight: 900; color:gray;"> > Trier par profession</h6>
                        </div>
                        <div>
                            <?php
                                $liste_profession_saved=$cnx->prepare('SELECT DISTINCT profession FROM utilisateurs WHERE type=?');
                                $liste_profession_saved->execute(['P']);
                                while($read_liste_profession_saved=$liste_profession_saved->fetch()){
                                    echo '<a style="font-weight:500;" class="dropdown-item" href="profession.php?profession='.$read_liste_profession_saved['profession'].'"> > '.$read_liste_profession_saved['profession'].'</a>' ;
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div style="background-color:#f8f9fa; border-radius:20px; width:100%;">
                    <?php    
                        // // Fonction pour calculer la distance entre deux points géographiques
                        // function calculerDistance($lat1, $lon1, $lat2, $lon2) {
                        //     $rayonTerre = 6371; // Rayon de la terre en kilomètres
                        //     $deltaLat = deg2rad($lat2 - $lat1);
                        //     $deltaLon = deg2rad($lon2 - $lon1);
                        //     $a = sin($deltaLat/2) * sin($deltaLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($deltaLon/2) * sin($deltaLon/2);
                        //     $c = 2 * atan2(sqrt($a), sqrt(1-$a));
                        //     $distance = $rayonTerre * $c;
                        //     return $distance;
                        // }
                        // // Récupérer les coordonnées actuelles de l'utilisateur (remplacer par les valeurs réelles)
                        // $latA = $_GET['latitude'];
                        // $lonA = $_GET['longitude'];
                        // //5.329571870470332, -3.8756791848558017
                        // $value_lat=0;
                        // $value_long=0;
                        // // Pagination
                        // $limit = 24; // Nombre de profils par page
                        // $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        // $start = ($page - 1) * $limit;
                        // $type_user='P';
                        // // Récupérer la profession sélectionnée
                        // $profession = isset($_GET['profession']) ? $_GET['profession'] : '';
                        // // obtenir les profils des utilisateurs avec la moyenne des notes
                        // $req = $cnx->prepare(
                        //     'SELECT utilisateurs.*, AVG(appreciation_profil.note) AS moyenne
                        //     FROM utilisateurs 
                        //     LEFT JOIN appreciation_profil ON appreciation_profil.mat_user_pro = utilisateurs.mat_user 
                        //     WHERE utilisateurs.profession_user = ? 
                        //     AND type_user = ? 
                        //     AND latitude_atel_user <>?
                        //     AND longitude_atel_user <>?
                        //     GROUP BY utilisateurs.mat_user 
                        //     LIMIT ?, ?'
                        // );
                        // $req->bindParam(1, $profession, PDO::PARAM_STR);
                        // $req->bindParam(2, $type_user, PDO::PARAM_STR);
                        // $req->bindParam(3, $value_lat, PDO::PARAM_INT);
                        // $req->bindParam(4, $value_long, PDO::PARAM_INT);
                        // $req->bindParam(5, $start, PDO::PARAM_INT);
                        // $req->bindParam(6, $limit, PDO::PARAM_INT);
                        // $req->execute();
                        // $profilesOnCurrentPage = $req->rowCount();
                    

                        // echo '<div>';
                        //     echo '<div id="container_affich_profil_par_profe" class="container_affich_profil_par_profe">';
                        //         while ($profil = $req->fetch(PDO::FETCH_ASSOC)) {
                        //             // Coordonnées du point B (le profil en cours)
                        //             $latB = $profil['latitude_atel_user']; // Remplacez 'latitude' par le nom réel de la colonne
                        //             $lonB = $profil['longitude_atel_user']; // Remplacez 'longitude' par le nom réel de la colonne
                        //             // Calcul de la distance
                        //             $distance = calculerDistance($latA, $lonA, $latB, $lonB);
                        //             if ($distance < 1) {
                        //                 // Convertit la distance en mètres et arrondit à deux chiffres après la virgule
                        //                 $distance ='Environ '.number_format($distance * 1000, 0).' m de vous';
                        //             }else {
                        //                 // Arrondit la distance à deux chiffres après la virgule pour l'affichage en kilomètres
                        //                 $distance ='Environ '.number_format($distance, 0).' km de vous';
                        //             }
                        //             echo '<div style="border-radius: 6px; box-sizing: border-box; border:none; background-color: white; text-align: center; overflow: hidden;" class="item_container_profil_par_profe">';
                        //                 echo '<div style="width: 100%; height: 60%;">';
                        //                     echo '<img style="width: 100%; height: 100%;" src="'.$profil['photo_user'].'" alt="">';
                        //                 echo '</div>';
                        //                 echo '<div style="width: 100%; height: 40%; color: gray;">';
                        //                     echo '<span style="font-weight: 900; width: 100%; text-transform:uppercase;" class="text-truncate d-inline-block">'.htmlspecialchars($profil['nom_user']).' '.htmlspecialchars($profil['pren_user']).'</span>';
                        //                     echo '<code style="font-weight: 200; display: flex; align-items: center; gap: 5px; justify-content: center; width:100%" class="text-truncate d-inline-block"><span class="bi bi-geo-alt"></span>'.$profil['ville_user'].','.$profil['quart_user'].'</code>';
                        //                     echo '<code style="font-weight: 200; display: flex; align-items: center; gap: 5px; justify-content: center;">'.$distance.'</code>';
                        //                     echo '<div style="display: flex; align-items: center; justify-content: center; gap: 8px;">';
                        //                         echo '<span style="font-weight: 700; font-size: 15px; width: 100%;" class="text-truncate d-inline-block">' . htmlspecialchars($profil['precis_profession_user']) . '</span><br>';
                        //                     echo '</div>';
                        //                     echo '<div style="display: flex; justify-content: center; gap: 2px;">';
                        //                         // Génération dynamique des étoiles en fonction de la moyenne des notes
                        //                         for ($i = 0; $i < round($profil['moyenne']); $i++) {
                        //                             echo '<span style="color: #b88a4d;" class="bi bi-star-fill"></span>';
                        //                         }
                        //                         for ($i = round($profil['moyenne']); $i < 5; $i++) {
                        //                             echo '<span class="bi bi-star-fill"></span>';
                        //                         }
                        //                     echo '</div>';
                        //                     echo '<div style="display:flex; justify-content:center; align-items:center; gap:4px ">';
                        //                         // Boutons d'action (à personnaliser selon les besoins)
                        //                         echo '<a href="profil_pro.php?profil='.$profil['mat_user'].'&nom='.$profil['nom_user'].'&pren='.$profil['pren_user'].'&profession='.$profil['precis_profession_user'].'" style="color: white; background-color: #b88a4d; font-weight: 900;" class="btn shadow-none">Infos</a>';
                        //                         echo '<a href="tel:'.$profil['tel_user'].'" style="color: #b88a4d; border: 1px solid #b88a4d; font-weight: 900;" class="btn shadow-none bi bi-telephone"></a>';
                        //                         echo '<a href="mailto:'.$profil['email_user'].'" style="color: #b88a4d; border: 1px solid #b88a4d; font-weight: 900;" class="btn shadow-none bi bi-envelope"></a>';
                        //                     echo '</div>';
                        //                 echo '</div>';
                        //             echo '</div>';
                        //         }
                        //     echo '</div>';
                        // echo '</div>';

                        // Fonction pour calculer la distance entre deux points géographiques
                        function calculerDistance($lat1, $lon1, $lat2, $lon2) {
                            $rayonTerre = 6371; // Rayon de la terre en kilomètres
                            $deltaLat = deg2rad($lat2 - $lat1);
                            $deltaLon = deg2rad($lon2 - $lon1);
                            $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($deltaLon / 2) * sin($deltaLon / 2);
                            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                            $distance = $rayonTerre * $c;
                            return $distance;
                        }

                        // Récupérer les coordonnées actuelles de l'utilisateur (remplacer par les valeurs réelles)
                       





                        $latA = $latitude;
                        $lonA = $longitude;

                        // Pagination
                        $limit = 24; // Nombre de profils par page
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $start = ($page - 1) * $limit;
                        $type_user = 'P';
                        $statut_compte=1;
                        $value_lat=0;
                        $value_long=0;
                        // Récupérer la profession sélectionnée
                        $profession = isset($_GET['profession']) ? $_GET['profession'] : '';

                        // obtenir les profils des utilisateurs avec la moyenne des notes
                        $req = $cnx->prepare(
                            'SELECT utilisateurs.*, AVG(appreciation_profil.note) AS moyenne
                            FROM utilisateurs 
                            LEFT JOIN appreciation_profil ON appreciation_profil.mat_user_pro = utilisateurs.mat_user 
                            WHERE utilisateurs.profession_user = ? 
                            AND type_user = ? 
                            AND statut_compte_user=?
                            AND latitude_atel_user <>?
                            AND longitude_atel_user <>?
                            GROUP BY utilisateurs.mat_user 
                            LIMIT ?, ?'
                        );
                        $req->bindParam(1, $profession, PDO::PARAM_STR);
                        $req->bindParam(2, $type_user, PDO::PARAM_STR);
                        $req->bindParam(3, $statut_compte, PDO::PARAM_INT);
                        $req->bindParam(4, $value_lat, PDO::PARAM_INT);
                        $req->bindParam(5, $value_long, PDO::PARAM_INT);
                        $req->bindParam(6, $start, PDO::PARAM_INT);
                        $req->bindParam(7, $limit, PDO::PARAM_INT);
                        $req->execute();

                        $profilesOnCurrentPage = $req->rowCount();

                        // Stocker tous les profils avec leur distance dans un tableau
                        $profiles = [];
                        while ($profil = $req->fetch(PDO::FETCH_ASSOC)) {
                            $latB = $profil['latitude_atel_user'];
                            $lonB = $profil['longitude_atel_user'];
                            $distance = calculerDistance($latA, $lonA, $latB, $lonB);
                            $profil['distance'] = $distance;
                            $profiles[] = $profil;
                        }

                        // Trier les profils par distance
                        usort($profiles, function($a, $b) {
                            return $a['distance'] - $b['distance'];
                        });


                        echo '<div>';
                            echo '<div id="container_affich_profil_par_profe" class="container_affich_profil_par_profe">';
                                foreach ($profiles as $profil) {
                                    $distance = $profil['distance'];
                                    if ($distance < 1) {
                                        $distance = 'Environ ' . number_format($distance * 1000, 0) . ' m de vous';
                                    } else {
                                        $distance = 'Environ ' . number_format($distance, 0) . ' km de vous';
                                    }
                                    echo '<div style="border-radius: 6px; box-sizing: border-box; border:none; background-color: white; text-align: center; overflow: hidden;" class="item_container_profil_par_profe">';
                                        echo '<div style="width: 100%; height: 60%;">';
                                            echo '<img style="width: 100%; height: 100%;" src="' . $profil['photo_user'] . '" alt="">';
                                        echo '</div>';
                                        echo '<div style="width: 100%; height: 40%; color: gray;">';
                                            echo '<span style="font-weight: 900; width: 100%; text-transform:uppercase;" class="text-truncate d-inline-block">' . htmlspecialchars($profil['nom_user']) . ' ' . htmlspecialchars($profil['pren_user']) . '</span>';
                                            echo '<code style="font-weight: 200; display: flex; align-items: center; gap: 5px; justify-content: center; width:100%" class="text-truncate d-inline-block"><span class="bi bi-geo-alt"></span>' . $profil['ville_user'] . ',' . $profil['quart_user'] . '</code>';
                                            echo '<code style="font-weight: 200; display: flex; align-items: center; gap: 5px; justify-content: center;">' . $distance . '</code>';
                                            echo '<div style="display: flex; align-items: center; justify-content: center; gap: 8px;">';
                                                echo '<span style="font-weight: 700; font-size: 15px; width: 100%;" class="text-truncate d-inline-block">' . htmlspecialchars($profil['precis_profession_user']) . '</span><br>';
                                            echo '</div>';
                                            echo '<div style="display: flex; justify-content: center; gap: 2px;">';
                                                for ($i = 0; $i < round($profil['moyenne']); $i++) {
                                                    echo '<span style="color: #b88a4d;" class="bi bi-star-fill"></span>';
                                                }
                                                for ($i = round($profil['moyenne']); $i < 5; $i++) {
                                                    echo '<span class="bi bi-star-fill"></span>';
                                                }
                                            echo '</div>';
                                            echo '<div style="display:flex; justify-content:center; align-items:center; gap:4px ">';
                                                echo '<a href="profil_pro.php?profil=' . $profil['mat_user'] . '&nom=' . $profil['nom_user'] . '&pren=' . $profil['pren_user'] . '&profession=' . $profil['precis_profession_user'] . '&lat_user_pro='.$profil['latitude_atel_user'].'&long_user_pro='.$profil['longitude_atel_user'].'" style="color: white; background-color: #b88a4d; font-weight: 900;" class="btn shadow-none">Infos</a>';
                                                echo '<a href="tel:' . $profil['tel_user'] . '" style="color: #b88a4d; border: 1px solid #b88a4d; font-weight: 900;" class="btn shadow-none bi bi-telephone"></a>';
                                                echo '<a href="mailto:' . $profil['email_user'] . '" style="color: #b88a4d; border: 1px solid #b88a4d; font-weight: 900;" class="btn shadow-none bi bi-envelope"></a>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                            echo '</div>';
                        echo '</div>';

                        // Boutons de pagination
                        echo '<div class="container_aff_plus_moins text-center gap-9">';
                            if ($page > 1) {
                                echo '<a style="color: #552d16; font-weight: 900; border:1px solid #b88a4d" href="profession_approx.php?page=' . ($page - 1) . '&latitude='.$_GET['latitude'].'&longitude='.$_GET['longitude'].'" class="btn shadow-none">Voir moins</a>';
                            }
                            // Calculer le nombre total de pages pour les profils de type de prof
                            $sqlTotal = $cnx->prepare('SELECT COUNT(*) as total FROM utilisateurs WHERE type_user = ? AND latitude_atel_user <>? AND longitude_atel_user <>?');
                            $sqlTotal->execute(['P', $value_lat, $value_long]);
                            $totalRows = $sqlTotal->fetch(PDO::FETCH_ASSOC);
                            $totalPages = ceil($totalRows['total'] / $limit);
                            // Afficher le bouton "Voir plus" seulement s'il y a encore des profils à afficher
                            if ($page < $totalPages) {
                                echo '<a style="color: #552d16; font-weight: 900; border:1px solid #b88a4d; margin-left:5px;" href="profession_approx.php?page=' . ($page + 1) . '&latitude='.$_GET['latitude'].'&longitude='.$_GET['longitude'].'" class="btn shadow-none">Voir plus</a>';
                            }

                        echo '</div>'; // Fin du conteneur des boutons de pagination
                    ?>
                    <!-------------------------------------------------------------------------->
                    <br>
                </div>
            </div>

            <!--fin liste des profi par professions-->
        </main>

        <!-- afficher ici le footer -->
         <?php include('footer.php'); ?>
    </div>
    
</body>
</html>