<?php
session_start();
include('layouts/app.php');
?>

<!-- Carousel Start -->
<div class="container-fluid px-0">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="img/2.jpg" class="img-fluid" alt="First slide">
                <div class="carousel-caption">
                    <div class="container carousel-content">
                        <h6 class="text-secondary h4 animated fadeInUp">Promotion des Artisans</h6>
                        <h1 class="text-white display-1 mb-4 animated fadeInRight">Valorisons les Compétences Artisanales en Côte d'Ivoire</h1>
                        <p class="mb-4 text-white fs-5 animated fadeInDown">Découvrez notre plateforme dédiée à mettre en avant les talents des artisans ivoiriens. Nous facilitons la mise en relation entre clients et artisans pour des services de qualité.</p>
                        <!-- <a href="#" class="me-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">En savoir plus</button></a> -->
                        <a href="#contact" class="ms-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInRight">Contactez-nous</button></a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/1.jpg" class="img-fluid" alt="Second slide">
                <div class="carousel-caption">
                    <div class="container carousel-content">
                        <h6 class="text-secondary h4 animated fadeInUp">Solutions Numériques pour les Artisans</h6>
                        <h1 class="text-white display-1 mb-4 animated fadeInLeft">Des Services Numériques Adaptés aux Besoins des Artisans</h1>
                        <p class="mb-4 text-white fs-5 animated fadeInDown">Découvrez nos solutions numériques conçues pour booster la visibilité et les opportunités commerciales des artisans en Côte d'Ivoire.</p>
                        <!-- <a href="#" class="me-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">En savoir plus</button></a> -->
                        <a href="#contact" class="ms-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInRight">Contactez-nous</button></a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev" style="width:3%;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next" style="width:3%;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

<!-- Statistiques Début -->
<div class="container-fluid bg-secondary py-5">
    <div class="container">
        <div class="row">
            <?php
                    include('connexion_bd.php');
                    $req=$cnx->query("select count(*) from utilisateurs where type='P'");
                    $nbre=$req->fetch();
                    ?>
            <div class="col-lg-3 wow fadeIn" data-wow-delay=".3s">
                <div class="d-flex counter">
                    <h1 class="me-3 text-primary counter-value" style="display:none;"></h1>
                    <h5 class="text-white mt-1"></h5>
                </div>
            </div>

            <?php
                    include('connexion_bd.php');
                    $req=$cnx->query("select count(*) from utilisateurs where type='P'");
                    $nbre=$req->fetch();
                    ?>
            <div class="col-lg-4 wow fadeIn" data-wow-delay=".3s">
                <div class="d-flex counter">
                    <h1 class="me-3 text-primary counter-value"><?php echo $nbre[0]; ?></h1>
                    <h5 class="text-white mt-1">Artisans enregistrés sur notre plateforme</h5>
                </div>
            </div>

            <?php
                    include('connexion_bd.php');
                    $req=$cnx->query("select count(*) from utilisateurs where type='C'");
                    $nbre=$req->fetch();
                    ?>
            <div class="col-lg-4 wow fadeIn" data-wow-delay=".3s">
                <div class="d-flex counter">
                    <h1 class="me-3 text-primary counter-value"><?php echo $nbre[0]; ?></h1>
                    <h5 class="text-white mt-1">Utilisateurs enregistrés sur notre plateforme</h5>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Statistiques Fin -->

<!-- À propos Début -->
<div class="container-fluid py-5 my-5" id="about">
    <div class="container pt-5">
        <div class="row g-5">
            <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                <div class="h-100 position-relative">
                    <img src="img/abou-1.jpg" class="img-fluid w-75 rounded" alt="À propos de notre agence" style="margin-bottom: 25%;">
                    <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                        <img src="img/abou-2.jpg" class="img-fluid w-100 rounded" alt="Équipe de notre agence">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                <h5 class="text-primary">À propos de Nous</h5>
                <h1 class="mb-4">Notre Agence et Notre Engagement envers les Artisans en Côte d'Ivoire</h1>
                <p>Nous sommes une agence dédiée à la promotion des artisans en Côte d'Ivoire, offrant des solutions numériques innovantes pour soutenir leur croissance et leur visibilité. Notre mission est d'aider les artisans à se connecter avec des clients locaux et internationaux grâce à notre plateforme moderne et efficace.</p>
                <p class="mb-4">Nous facilitons l'inscription des artisans, la gestion de leurs services, et nous offrons des outils pour améliorer leur présence en ligne et leur efficacité opérationnelle. Chez Nous, nous croyons au potentiel des artisans ivoiriens et nous travaillons chaque jour pour les aider à prospérer dans un environnement numérique en constante évolution.</p>
                <!-- <a href="#" class="btn btn-secondary rounded-pill px-5 py-3 text-white">Détails Supplémentaires</a> -->
            </div>
        </div>
    </div>
</div>
<!-- À propos Fin -->

<!-- Services Début -->
<div class="container-fluid services py-5 mb-5" id="service">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Nos Services</h5>
            <h1>Services Dédiés aux Artisans</h1>
        </div>
        <div class="row g-5 services-inner">
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                <div class="services-item bg-light">
                    <div class="p-4 text-center services-content">
                        <div class="services-content-icon">
                            <i class="fa fa-users fa-7x mb-4 text-primary"></i>
                            <h4 class="mb-3">Mise en Réseau</h4>
                            <p class="mb-4">Facilitons la connexion des artisans avec d'autres artisans locaux et internationaux.</p>
                            <!-- <a href="#" class="btn btn-secondary text-white px-5 py-3 rounded-pill">En Savoir Plus</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                <div class="services-item bg-light">
                    <div class="p-4 text-center services-content">
                        <div class="services-content-icon">
                            <i class="fa fa-store fa-7x mb-4 text-primary"></i>
                            <h4 class="mb-3">Promotion Commerciale</h4>
                            <p class="mb-4">Aidons à promouvoir les produits artisanaux à travers des campagnes de marketing digital.</p>
                            <!-- <a href="#" class="btn btn-secondary text-white px-5 py-3 rounded-pill">En Savoir Plus</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                <div class="services-item bg-light">
                    <div class="p-4 text-center services-content">
                        <div class="services-content-icon">
                            <i class="fa fa-globe fa-7x mb-4 text-primary"></i>
                            <h4 class="mb-3">Plateforme Numérique</h4>
                            <p class="mb-4">Développons une plateforme numérique pour la vente en ligne des produits artisanaux.</p>
                            <!-- <a href="#" class="btn btn-secondary text-white px-5 py-3 rounded-pill">En Savoir Plus</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services Fin -->



<!-- Témoignages Start -->
<div class="container-fluid testimonial py-5 my-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Témoignages</h5>
            <h1>Ce que disent nos clients !</h1>
        </div>
        <div class="owl-carousel testimonial-carousel" data-wow-delay=".5s">
            <?php
            include('connexion_bd.php');
                $req=$cnx->query("select * from avis");
                $tot= $req->rowCount();
                if($tot>0)
                {
                    while($res=$req->fetch())
                    {
                        $req2=$cnx->prepare("select nom, prenom from utilisateurs where id=:id"); // on recherche le nom de l'utilistaur qui a poste un avis
                        $req2->execute(array("id"=>$res[2])) or die(print_r($req2->errorInfo()));
                        $result=$req2->fetch();
                        if($result)
                        {
                            $nom=$result[0];
                            $pnom=$result[1];
                        }
                        else{
                            $nom=''; $pnom='';
                        }
                        
                        echo '
                        <div class="testimonial-item border p-4">
                            <div class="d-flex align-items-center">
                                <!-- <div class="">
                                    <img src="img/testimonial-1.jpg" alt="">
                                </div> -->
                                <div class="ms-4">
                                    <h4 class="text-secondary">'. $nom .'  '.$pnom.'</h4>
                                </div>
                            </div>
                            <div class="border-top mt-4 pt-3">
                                <p class="mb-0">
                                '. $res[1].'
                                </p>
                            </div>
                        </div>';
                    }
                }
                else
                {
                    echo 'Pas de commentaire ';
                }
                
            ?>
        </div>
            </div>
    </div>
</div>
<!-- Témoignages End -->


<!-- FAQ Start -->

<div class="container-fluid py-5 mb-5" id="faq">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s">
            <h5 class="text-primary">FAQ</h5>
            <h1 class="mb-3">Questions Fréquemment Posées</h1>
        </div>
        <div class="faq-content">
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="color: #1842b6;">
                            Comment puis-je m'inscrire en tant qu'artisan ?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Pour vous inscrire en tant qu'artisan, cliquez sur le bouton "Inscription" en haut de la page, remplissez le formulaire avec vos informations personnelles et professionnelles, puis soumettez votre demande. Un administrateur validera votre inscription sous peu.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Quels sont les avantages de s'inscrire sur votre plateforme ?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            En vous inscrivant sur notre plateforme, vous bénéficiez d'une visibilité accrue auprès de clients potentiels, d'opportunités de mise en réseau avec d'autres artisans, et de la possibilité de recevoir des demandes de services directement via notre site. De plus, nous offrons des outils pour vous aider à gérer votre activité et à promouvoir vos services.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Comment puis-je modifier mes informations personnelles ?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Une fois connecté, allez dans votre profil en cliquant sur votre nom en haut de la page. Vous pourrez alors mettre à jour vos informations personnelles et professionnelles, ainsi que télécharger des documents nécessaires pour valider votre profil.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Quelles sont les méthodes de paiement acceptées sur la plateforme ?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Nous acceptons diverses méthodes de paiement, y compris Wave, Orange Money, MTN Mobile Money, Moov Money, et PayPal. Vous pouvez choisir la méthode de paiement qui vous convient le mieux lors du règlement de vos services ou abonnements.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Comment contacter le support client ?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Si vous avez besoin d'aide, vous pouvez nous contacter via notre formulaire de contact, par email à info@example.com, ou par téléphone au +225 01 23 45 67 89. Notre équipe de support est disponible pour répondre à vos questions et vous assister dans l'utilisation de notre plateforme.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAQ End -->

<!-- Contact Start -->
<div class="container-fluid py-5 mb-5" id="contact">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Contactez-nous</h5>
            <h1 class="mb-3">Pour toute question ou demande</h1>
        </div>
        <div class="contact-detail position-relative p-5">
            <div class="row g-5 mb-5 justify-content-center">
                <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".3s">
                    <div class="d-flex bg-light p-3 rounded">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="text-primary">Adresse</h4>
                            <a href="#" target="_blank" class="h5"> Abidjan, Côte d'Ivoire</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".5s">
                    <div class="d-flex bg-light p-3 rounded">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                            <i class="fa fa-phone text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="text-primary">Appelez-nous</h4>
                            <a class="h5" href="tel:+2250700000000" target="_blank">+2250700000000</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".7s">
                    <div class="d-flex bg-light p-3 rounded">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                            <i class="fa fa-envelope text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="text-primary">Email</h4>
                            <a class="h5" href="mailto:entreprise20gmail.com" target="_blank">entreprise20gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                    <div class="p-5 h-100 rounded contact-map">
                        <iframe class="rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4050954.505608909!2d-8.189689608650081!3d7.464115452254894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xf961387b049a067%3A0x1f91e627cb9ee40!2sC%C3%B4te%20d&#39;Ivoire!5e0!3m2!1sfr!2sci!4v1721296761279!5m2!1sfr!2sci" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                    <div class="p-5 rounded contact-form">
                        <form action="" method="post">
                            <div class="mb-4">
                                <input type="text" name="nom" class="form-control border-0 py-3" placeholder="Votre nom" value="<?php if(isset($_SESSION["nom"])) echo $_SESSION["nom"]; ?>">
                            </div>
                            <div class="mb-4">
                                <input type="email" name="email" class="form-control border-0 py-3" placeholder="Votre email" value="<?php if(isset($_SESSION["email"])) echo $_SESSION["email"]; ?>">
                            </div>
                            <div class="mb-4">
                                <select class="form-select" name="question" aria-label="Default select example" required>
                                    <option value="Question">Question</option>
                                    <option value="Préoccupation">Préoccupation</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <textarea class="w-100 form-control border-0 py-3" rows="6" cols="10" placeholder="Message" name="message"></textarea>
                            </div>
                            <div class="text-start text-center">
                                <button class="btn bg-primary text-white py-3 px-5" type="submit" name="envoyer">Envoyer le message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<?php
if(isset($_POST["envoyer"]))
{
    if(isset($_SESSION["email"]))
    {
        include('connexion_bd.php');
        include('PHPMailer.php');
        $nom=htmlspecialchars($_POST["nom"]);
        $email=htmlspecialchars($_POST["email"]);
        $question=htmlspecialchars($_POST["question"]);
        $message=htmlspecialchars($_POST["message"]);

        if($message=="")
        {
            echo'<script>swal("","Veuillez indiquer votre message SVP!","error");</script>';
            exit();
        }
        //Recipients
      

        $mail->setFrom($email, 'Entreprise20');
        $mail->addAddress('wadjabnc@gmail.com', '');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = ' '.$question.' de  '.$nom.' ';
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        echo'<script>swal("","Message envoyé avec succes","success");</script>';

    }
    else
    {
        echo'<script>swal("","Impossible d\envoyer ce message. Veuillez vous connecter d\'abord","error");</script>';
    }
}
?>
<?php
include('footer.php');
?>

<script src="js/main.js"></script>