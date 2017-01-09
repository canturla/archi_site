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

            <div class="box passe">
              <h1 class="title">Aide avec le mot de passe</h1>

              <p>  Saisissez l'adresse e-mail ou le numéro de téléphone
                portable associé à votre compte Canturla.</p></br>
               <!-- email et pseudo-->
              <label class="label">Adresse e-mail ou numéro de téléphone portable</label>
              <p class="control has-icon">
                <input class="input" type="email" placeholder="">

              </p>
               <!-- fin email et pseudo-->

                <!-- bouton connexion -->
              <p class="control">



                <div class="has-text-centered">
                  <a class="button is-primary bmotdepasse" href="reinitialisermotdepasse.php">Continuer</a>
                  </div>

              </p>
            </div>

            <p class="has-text-centered"> <!-- centrer objet-->
              <div class="has-text-centered">
                <h5 class="title is-5">Avez-vous changé d'adresse e-mail ou de numéro de téléphone portable ?</h5>
              <h6 class="subtitle is-6">Si vous n'utilisez plus l'adresse e-mail associée à votre compte Canturla,
                vous pouvez contacterle Service clients pour vous aider à restaurer l'accès à votre compte.</h6>

        </div>

              <div class="has-text-centered">
                <!-- lien-->
              <a href="connection.php">Connection</a>
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
