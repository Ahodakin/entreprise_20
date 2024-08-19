<?php
include('layouts/app.php');
?>
<br><br>
<style>
    body {
        background-color: #1842b6;
    }

    .section {
        text-align: center;
        padding: 20px;
        background-color: #ffffff;
        margin-right: 30px;
        margin-bottom: 40px;
        border-radius: 8px;
        box-shadow: 0 13px 19px -7px rgba(0, 0, 0, 0.09);
        height: 310px;
        width: 270px;
        transition: all 0.3s ease;
    }

    .section:hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .btn-container {
        display: flex;
        justify-content: center;
    }

    .grid-x {
        webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        -webkit-flex-flow: row wrap;
        -ms-flex-flow: row wrap;
        flex-flow: row wrap;

    }
</style>

<div class="container">
    <h2 class="text-center mb-3" style="color: #fff;">Sélectionner votre statut</h2><br>
    <div class="btn-container grid-container grid-x">
        <div class="">
            <a href="register_client.php" class="btn-contain">
                <div class="section">
                    <img loading="lazy" src="img/client.jpeg" alt="images" style="width: 200px; padding-top: 25px;">
                    <p class="btn  btn-block btn-section">Je suis un client</p>
                </div>
            </a>
        </div>

        <div class="">
            <a href="register_artisan.php" class="btn-contain">
                <div class="section">
                    <img loading="lazy" src="img/artisan.png" alt="images" style="width: 200px;padding-top: 25px;">
                    <p class="btn  btn-block btn-section btn-button">Je suis un artisan</p>
                </div>
            </a>
        </div>
    </div>
</div>
<svg viewBox="0 0 1595 258" preserveAspectRatio="none">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <path d="M444.340642,154 C694.722027,154 1052.66439,33 1277.90476,14.9967149 C1428.06501,2.99452485 1533.61546,-1.31308158 1594.55611,2.07389562 L1594.55611,257.183313 L0,257.183313 L0,42.6646632 C129.306171,116.888221 277.419718,154 444.340642,154 Z" fill="#ffffff"></path>
    </g>
</svg>

<?php
include('footer.php');
?>