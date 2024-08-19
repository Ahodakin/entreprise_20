<?php 
session_start();
include("connexion_bd.php"); include("layouts/app.php");?>
<!DOCTYPE HTML>
<html lang="fr">

<head>
	<title>Connexion</title>
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
	<link rel="stylesheet" href="css/style_inscription_connexion.css" type="text/css" media="all" />
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }
    </style>
</head>

<body>
<?php
include('connexion_bd.php');
echo'<style> #msg_error_code_confirm_mdp{display:none}</style>';
$email='';
if($_GET['email']){
   $email=$_GET['email'];
}
if(isset($_POST["confirmer"]))
{
    $value_confirm_mdp= $_POST['value_confirm_mdp'];
    $req = $cnx->prepare('SELECT mdp FROM modifier_mdp WHERE code =:c AND email=:e');
    $req->execute(array("c"=>$value_confirm_mdp, "e"=>$email));
    $res= $req->fetch();

    if($res) {
        $nv_mdp=password_hash($res[0],PASSWORD_DEFAULT);
        $req=$cnx->prepare('UPDATE utilisateurs SET mdp=:m WHERE email=:e');
        $req->execute(array("m"=>$nv_mdp, "e"=>$email));

        $req2=$cnx->prepare('DELETE FROM modifier_mdp WHERE email=:e');
        $req2->execute(array("e"=>$email));

        echo '<script> swal({
            title: "",
            text: "Votre compte a été réinitialisé avec succès",
            type: "success"
            }, function(){
                window.location= "login.php";
            });
            </script>';
    } else {
        echo'<script>swal("","Echec de la reinitialisation du mot de passe");</script>';
    }
}
?>

<div class="container-fluid py-5 mb-5">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-5  wow fadeIn" data-wow-delay=".5s">
                	<div class="card broder-primary">
                        
                        <div class="card-header bg-primary text-center text-white"> <h3 class="text-white">Confirmation</h3> </div>
                        <div class="card-body">
                            <form action="" method="post">
					            <p style="color: gray;" class="legend">Entrer le code </p>
					            <div style="display: flex; justify-content:center; gap:5px" class="">
						        <input id="code1" style="width: 40px; height:40px; border-radius:5px; border:2px solid blue; outline-color:#552d16; text-align:center; color:#b88a4d; font-weight:900; font-size:25px; text-transform:uppercase" type="number"  name="email" required value="" class="code" />
						        <input id="code2" style="width: 40px; height:40px; border-radius:5px; border:2px solid blue; outline-color:#552d16; text-align:center; color:#b88a4d; font-weight:900; font-size:25px; text-transform:uppercase" type="number"  name="email" required value="" class="code" />
						        <input id="code3" style="width: 40px; height:40px; border-radius:5px; border:2px solid blue; outline-color:#552d16; text-align:center; color:#b88a4d; font-weight:900; font-size:25px; text-transform:uppercase" type="number"  name="email" required value="" class="code" />
						        <input id="code4" style="width: 40px; height:40px; border-radius:5px; border:2px solid blue; outline-color:#552d16; text-align:center; color:#b88a4d; font-weight:900; font-size:25px; text-transform:uppercase" type="number"  name="email" required value="" class="code" />
                                <input style="display: block;" type="text" name="value_confirm_mdp" required id="value_confirm_mdp">
					            </div>
                                <span style="color: brown; font-weight:900" id="msg_error_code_confirm_mdp">Code incorrect</span>
                                
                                <div class="text-center pt-3">
					            <button type="submit" class="btn btn-primary btn-sm" name="confirmer">Confirmer</button>
                                </div>
				</form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let value_confirm_mdp=document.getElementById('value_confirm_mdp')
        function verif_long_champ(){
            if(this.value.length>1){
                this.value=this.value.substring(0, this.value.length-1)
            }
            value_confirm_mdp.value=code1.value+code2.value+code3.value+code4.value
        }
        let code1=document.getElementById('code1')
        let code2=document.getElementById('code2')
        let code3=document.getElementById('code3')
        let code4=document.getElementById('code4')
        
        code1.addEventListener('input', verif_long_champ)
        code2.addEventListener('input', verif_long_champ)
        code3.addEventListener('input', verif_long_champ)
        code4.addEventListener('input', verif_long_champ)
    </script>
</body>

</html>