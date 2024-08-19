<?php
session_start();
if(!$_SESSION["id"])
{
    header("location:login.php");
}
include('layouts/app.php');
require_once('fonctions_panier.php');
include('connexion_bd.php');
?>

<body>
<body>
	<br><br>
<div class="container">
	<div class="row" id="c1">
		<div class="col-sm-4">
 		</div>

		<div class="col-sm-4">
			
            	<div class="card-header  bg-primary text-center" > <h5 class="text-white"> Règlement de commande </h5></div>
			 		<div class="card bordered border-primary" >
			 			<div class="card-body">
							<form method="post">
   								<div class="form-group">
   								 <label>Numero de compte</label>
   							 	<input type="text" class="form-control  form-control-sm" name="code">
								</div>
								<br>
								<div class="form-group">
									<div id="paypal-button-container"></div>
									<p id="result-message"></p>
</div>
                             </form>
                         </div>
                      </div>
        
							
</div>
					 
					</form>
				</div>
							
		</div>
    </div>

</div>

    <div id="paypal-button-container"></div>
    <p id="result-message"></p>
    <!-- Replace the "test" client-id value with your client-id -->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    <script src="js/app.js"></script>
  </body>
</body>
</html>