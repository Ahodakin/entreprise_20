<?php 
session_start();
include("connexion_bd.php"); include("layouts/app.php");
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>Connexion</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Latest Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Meta tag Keywords -->

	<!-- css files -->
	<link rel="stylesheet" href="css/style_inscription_connexion.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->

	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	 rel="stylesheet">
	<!-- //web-fonts -->
</head>

<body>
<?php
include('PHPMailer.php');
echo'<style> #msg_error_connexion{display:nsone}</style>';
$email='';
if(isset($_GET['email'])){
    $email=$_GET['email'];
}else{
    header('location: login.php');
}

//confimer le nouveau mot de passe
if(isset($_POST['modifier'])){
    $nv_mdp=$_POST['nv_mdp'];
    $code_confirm_mdp = mt_rand(1000, 9999);

    //verifer dabord si le user est deja enregistre dans la table de reinitialisation de mot de passe
    $req=$cnx->prepare('SELECT email FROM modifier_mdp where email=:em');
    $req->execute(array("em"=>$email));
    $res=$req->fetch();
    if($res){
        //Recipients
        $mail->setFrom('wadjabnc@gmail.com', 'Admin');
        $mail->addAddress($email, '');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'REINITIALISER MOT DE PASSE.';
        $mail->Body    = '
                        <div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
                            <h2>Bonjour cher utilisateur,</h2>
                            <p style="font-size:20px" >Veullez utiliser le code utiliser pour confirmer la reinitialisationde votre mot de passe:</p>
                            <div style="background-color: #f3f3f3; color: #333; padding: 10px; border-radius: 5px; text-align: center; font-size:25px; font-weight:900">'.$code_confirm_mdp.'</div>
                        </div>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        $req=$cnx->prepare('UPDATE modifier_mdp SET code=:c, mdp=:m WHERE email=:em');
        $req->execute(array("c"=>$code_confirm_mdp,'m'=>$nv_mdp,"em"=>$email));

        
        echo '<script>';
            echo "alert('Mot de passe reinitialise avec succes. Un code de finalisation a ete envoye sur votre adresse email. Veuillez l\'utiliser pour confirmer la reinitialisation du mot de passe');";
            echo "window.location.href='confirm_reinit_mdp.php?email=".$email."';"; // Redirige après 3 secondes
        echo '</script>';
    }else{
        //Recipients
        $mail->setFrom('wadjabnc@gmail.com', 'Admin');
        $mail->addAddress($email, '');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'REINITIALISER MOT DE PASSE.';
        $mail->Body    = '
                        <div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
                            <h2>Bonjour cher utilisateur,</h2>
                            <p style="font-size:20px" >Veullez utiliser le code utiliser pour confirmer la reinitialisationde votre mot de passe:</p>
                            <div style="background-color: #f3f3f3; color: #333; padding: 10px; border-radius: 5px; text-align: center; font-size:25px; font-weight:900">'.$code_confirm_mdp.'</div>
                        </div>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        $req=$cnx->prepare('INSERT INTO modifier_mdp(email, code, mdp) VALUES(:em, :c,:m)');
        $req->execute(['em'=>$email, 'c'=>$code_confirm_mdp, 'm'=>$nv_mdp]);


        echo '<script>';
            echo "alert('Mot de passe reinitialise avec succes. Un code de finalisation a ete envoye sur votre adresse email. Veuillez l\'utiliser pour confirmer la reinitialisation du mot de passe');";
            echo "window.location.href='confirm_reinit_mdp.php?email=".$email."';"; // Redirige après 3 secondes
        echo '</script>';
    }

}

?>
	<div class="container-fluid py-5 mb-5">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-5  wow fadeIn" data-wow-delay=".5s">
                	<div class="card broder-primary">
                        
                        	<div class="card-header bg-primary text-center text-white"> <h3 class="text-white">Reinitialisation mot de passe</h3> </div>
                            <div class="card-body">
                            <form method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nouveau mot de passe</label>
                                <input type="password" name="nv_mdp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                            </div>
                            <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-sm" name="modifier">VAlider</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
		<!-- //content -->
		<!-- copyright -->
		<div class="copyright">
			
		</div>
		<!-- //copyright -->
	</div>

    <script>
        let nv_mdp=document.getElementById('nv_mdp')
        let btn_confirm_nv_mdp=document.getElementById('btn_confirm_nv_mdp')
        tab_chiffre=['0','1','2','3','4','5','6','7','8','9']
        tab_maj=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z']
        nv_mdp.addEventListener('input', function(){
            document.getElementById('exist_chiffre').style.color='gray'
            document.getElementById('exist_maj').style.color='gray'
            document.getElementById('long_mdp').style.color='gray'
            let verif_maj=false
            let verif_chiffre=false

            //verif existence chiffre
            for(let i=0; i<tab_chiffre.length; i++){
                if(this.value.includes(tab_chiffre[i])){
                    document.getElementById('exist_chiffre').style.color='green'
                    verif_chiffre=true
                }
            }

            //verif existence maj
            for(let i=0; i<tab_maj.length; i++){
                if(this.value.includes(tab_maj[i])){
                    document.getElementById('exist_maj').style.color='green'
                    verif_maj=true
                }
            }

            //verif longueur
            if(this.value.length>=6){
                document.getElementById('long_mdp').style.color='green'
            }
            
            if(verif_maj && verif_chiffre && this.value.length>=6){
                btn_confirm_nv_mdp.style.display='block'
            }else{
                btn_confirm_nv_mdp.style.display='none'
            }

        })

        //afficher/masquer le mot de passe
        let view_mdp=document.getElementById('view_mdp')
        view_mdp.addEventListener('click', function(){
            if(this.checked){
                nv_mdp.type='text'
            }else{
                nv_mdp.type='password'
            }
        })

    </script>
</body>

</html>