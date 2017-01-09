<?php
require_once("backend/functions.php");
dbconn(true);
require_once('template/header.php');
require_once('template/menu.php');


$action = $_POST["action"];
if($action =="connection"){
  $email = htmlspecialchars($_POST['email']);
  if(!$email){
      $erreur .= 'votre adresse email est incorect';
  }
  $password = sha1($_POST['password']);
  if(!$password) {
      $erreur .= 'votre mot de passe est incorrect';
  }
 
}
?>

<section class="hero is-fullheight ">
   <div class="has-text-centered">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-vcentered"> <!-- alligne objet-->

          <div class="column is-4 is-offset-4">
            <div class="has-text-centered"> <!-- centrer texte" connexion"-->
            <h1 class="title">
            Connection
            </h1>
            </div>

            <form method="post" action="connection.php" class="box connection">
               <!-- email et pseudo-->
              <label class="label">Email</label>
              <p class="control has-icon">
                <input class="input" type="email" name="email" placeholder="Email">
                <i class="fa fa-envelope logoenvelope"></i>
              </p>
               <!-- fin email et pseudo-->

               <!-- mot de passe-->

              <label class="label">Mot de passe</label>
              <p class="control has-icon">
                <input class="input" type="password" name="password" placeholder="Mot de passe">
                <i class="fa fa-lock"></i>
              </p>
              <!-- fin mot de passe-->

                <!-- bouton connexion -->
              <p class="control">



                <div class="has-text-centered">
                  <button type="submit" class="button is-success33">Connection</button>
                  </div>

              </p>
            </form>

            <p class="has-text-centered"> <!-- centrer objet-->
              <div class="has-text-centered">
                <a class="button is-info1" href="inscription.php">Créer un compte</a>
        </div>

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
  </div>





        <?php
        require_once ('template/footer.php');
        ?>
