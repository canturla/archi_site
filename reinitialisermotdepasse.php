<?php
require_once('template/header.php');
require_once('template/menu.php');
?>

<section class="hero is-fullheight ">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-vcentered"> <!-- alligne objet-->

          <div class="column is-4 is-offset-4">
            <div class="iamgelogo">
              <figure class="image is-128x128">
                <img src="template/images/logocanturla.png">

              </figure>
            </div>

            <div class="box boxreinitialiser">
              <h1 class="title">Un e-mail vient de vous être envoyé</h1>

              <p>  Vous recevrez dans quelques instants, par email, un lien vous permettant de réinitialiser facilement votre mot de passe.</p></br>
            

                <!-- bouton connexion -->
              <p class="control">
                <div class="has-text-centered">
                <a class="button is-primary breinitialiser" href="connection.php">Connection</a>
                  </div>

              </p>
            </div>

            <p class="has-text-centered"> <!-- centrer objet-->


              <div class="has-text-centered">
                <!-- lien-->
              <a href="motdepasse.php">Mot de passe oublié</a>
              |
              <a href="#">Besoin d'aide?</a>

            </div>
            </p>
          </div>
        </div>
      </div>
    </div>


<?php
require_once ('template/footer.php');
?>
