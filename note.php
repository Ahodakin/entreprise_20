<?php include("connexion_bd.php"); include("layouts/app.php");
$req =$cnx->prepare('SELECT /*DISTINCT*/  COUNT(profession) AS nbr_profession FROM utilisateurs  GROUP BY utilisateurs.profession ORDER BY nbr_profession DESC LIMIT ?, ?');
                        // Lier les paramètres comme des entiers
                       
             
                        // $professionGroupsOnCurrentPage = $req->rowCount();

                        while ($read_profession = $req->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div id="'.$read_profession['profession_'].'">';
                                echo '<div style="text-align: center;">';
                                   // echo '<span style="color: gray; font-weight: 900; text-transform:uppercase">'.$read_profession['profession_user'].'</span>';
                                    echo '<a href="#'.$read_profession['profession_user'].'" style="color: #b88a4d; font-weight: 900;">'.$read_profession['profession'].'</a>';
                                echo '</div>';
                                $req2 =$cnx->prepare('SELECT utilisateurs.*, AVG(avis_notation.note) AS moyenne FROM utilisateurs LEFT JOIN appreciation_profil ON avis_notation.id_user = utilisateurs.id WHERE utilisateurs.profession=? AND type=?  GROUP BY utilisateurs.id LIMIT 12');
                                $req2->execute([$read_profession['profession'], 'P', 1]);

                                echo '<div id="container_affich_profil_par_profe" class="container_affich_profil_par_profe">';
                                    while ($profil = $req2->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<div style="border-radius: 6px; box-sizing: border-box; /*min-height: 300px;*/ border:none; background-color: white; text-align: center; overflow: hidden;" class="item_container_profil_par_profe">';
                                            echo '<div style="width: 100%; height: 60%;">';
                                                echo '<img style="width: 100%; height: 100%;" src="'.$profil['photo'].'" alt="">';
                                            echo '</div>';
                                            echo '<div style="width: 100%; height: 40%; color: gray;">';
                                                echo '<span style="font-weight: 900; width: 100%; text-transform:uppercase;" class="text-truncate d-inline-block">'.htmlspecialchars($profil['nom_user']).' '.htmlspecialchars($profil['pren_user']).'</span>';
                                                echo '<code style="font-weight: 200; display: flex; align-items: center; gap: 5px; justify-content: center; width:100%" class="text-truncate d-inline-block"><span class="bi bi-geo-alt"></span>'.$profil['ville_user'].','.$profil['quart_user'].'</code>';
                                                echo '<div style="display: flex; align-items: center; justify-content: center; gap: 8px;">';
                                                    echo '<span style="font-weight: 700; font-size: 15px; width: 100%;" class="text-truncate d-inline-block">' . htmlspecialchars($profil['precis_profession_user']) . '</span><br>';
                                                echo '</div>';
                                                echo '<div style="display: flex; justify-content: center; gap: 2px;">';
                                                    // Génération dynamique des étoiles en fonction de la moyenne des notes
                                                    for ($i = 0; $i < round($profil['moyenne']); $i++) {
                                                        echo '<span style="color: #b88a4d;" class="bi bi-star-fill"></span>';
                                                    }
                                                    for ($i = round($profil['moyenne']); $i < 5; $i++) {
                                                        echo '<span class="bi bi-star-fill"></span>';
                                                    }
                                                echo '</div>';
                                                echo '<div style="display:flex; justify-content:center; align-items:center; gap:4px ">';
                                                    // Boutons d'action (à personnaliser selon les besoins)
                                                    echo '<a href="profil_pro.php?profil='.$profil['mat_user'].'&nom='.$profil['nom'].'&pren='.$profil['pren_user'].'&profession='.$profil['precis_profession_user'].'&lat_user_pro='.$profil['latitude_atel_user'].'&long_user_pro='.$profil['longitude_atel_user'].'" style="color: white; background-color: #b88a4d; font-weight: 900;" class="btn shadow-none">Info</a>';
                                                    echo '<a href="tel:'.$profil['tel'].'" style="color: #b88a4d; border: 1px solid #b88a4d; font-weight: 900;" class="btn shadow-none bi bi-telephone"></a>';
                                                    echo '<a href="mailto:'.$profil['email'].'" style="color: #b88a4d; border: 1px solid #b88a4d; font-weight: 900;" class="btn shadow-none bi bi-envelope"></a>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                echo '</div><br>';
                            echo '</div><br>';
                                }
                            ?>


<div style="text-align: center;">
                <button id="btn_affi_modal_commente_profil_pro" style="background-color: #b88a4d; font-weight: 900; color: white;" class="btn shadow-none" >Que pensez-vous de ce profil?</button>
            </div><br>

<form action="" method="post">
        <div class="modal fade" id="modal_avis_pro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Avis sur ce profil</h1>
                  <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <div class="modal-body">
                      <div style="text-align: center;">
                          <h5>Que pensez-vous de ce profil?</h5>
                          <input style="display: none;" type="text" name="mat_pro_commente" id="mat_pro_commente"  value="<?php echo $_GET['profil']; ?>">
                          <input style="display: none;" type="text" name="mat_user_commente" id="mat_user_pro_note" value="<?php echo $matricule_type_user_connecte; ?>">
                          <input style="display: none;" type="text" name="valueofstar" id="valueofstar" value="1">
                          <div style="display: flex; align-items: center;">
                            <span>Qualite</span>
                            <div style="display: flex; align-items: center; margin-left: 8px;" class="btn border-0">
                                <input style="display: none;" type="checkbox" name="" checked id="noteEtoile1">
                                <input style="display: none;" type="checkbox" name="" id="noteEtoile2">
                                <input style="display: none;" type="checkbox" name="" id="noteEtoile3">
                                <input style="display: none;" type="checkbox" name="" id="noteEtoile4">
                                <input style="display: none;" type="checkbox" name="" id="noteEtoile5">

                                <label style="color: #ffc107;" for="noteEtoile1" id="labelnoteEtoile1" class="bi bi-star-fill"></i>
                                <label style="margin-left: 5px; color: gray;" id="labelnoteEtoile2" for="noteEtoile2" class="bi bi-star-fill"></label>
                                <label style="margin-left: 5px; color: gray;" id="labelnoteEtoile3" for="noteEtoile3" class="bi bi-star-fill"></label>
                                <label style="margin-left: 5px; color: gray;" id="labelnoteEtoile4" for="noteEtoile4" class="bi bi-star-fill"></label>
                                <label style="margin-left: 5px; color: gray;" id="labelnoteEtoile5" for="noteEtoile5" class="bi bi-star-fill"></label>
                            </div>
                        </div>
                          <div style="display: flex; align-items: center;">
                           
                          <div style="width: 100%; position:relative" >
                              <textarea placeholder="Votre commentaire..." required style="width: 100%; height: 100px; resize: none; outline: none;" name="commentaire_appreciation_pro" id="text_for_avis_pro"></textarea>
                              <span style="position: absolute; right: 2px; bottom: 5px; font-weight: 900; font-size: 12px; color:#dc3545; " id="nombre_caracter_avis_pro">204</span>
                          </div>
                      </div>
               </div>
                <div style=" text-align:end" >
                  <button style="background-color: #dc3545; color: #ffffffff; font-weight:900; font-family: Verdana, Geneva, Tahoma, sans-serif;" type="button" class="btn shadow-none" data-bs-dismiss="modal">Fermer</button>
                  <button id="btn_valider_avis_sur_profil_pro" name="btn_valider_avis_sur_profil_pro" style="background-color: #1dc370; color: #ffffffff; font-weight:900; font-family: Verdana, Geneva, Tahoma, sans-serif;" type="submit" class="btn shadow-none">Valider</button>
                </div>
              </div>
           </div>
          </div>
        </div>
        </form>