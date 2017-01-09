<?php
$today = date("Y-m-d");
$action = $_POST["action"];

if($action == "ajouter") {

        $erreur = "";
        $name = $_POST["name"];
        if (!$name) {
            $erreur .= "il manque le nom";
        }
        $email = $_POST["email"];
        if (!$email) {
            $erreur .= " manque l'adresse email";
        }
        $message = $_POST["message"];
        if (!$message) {
            $erreur .= " il manque votre message ";
        }
        $dates = $today;
        $lu = "non-lu";
        if ($erreur == "") {
            SQL_Query_exec("INSERT INTO message(`name`,`email`,`message`,`dates`,`lu`) VALUES ('$name','$email','$message','$dates','$lu')");
            echo "vous avez bien envoyer votre message";
        } else {
            echo $erreur;
        }
}
?>
<!--formulaire-->
<footer class="footer">
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="content has-text-centered">
                    <form method="POST" role="form" action="index.php">
                        <input type="hidden" name="action" value="ajouter">
                        <p class="control">
                            <input class="input" type="text" name="name" placeholder="Nom / Prenom">
                        </p>
                        <p class="control has-icon has-icon-right">
                            <input class="input " type="email" name="email" placeholder="Email " >
                        </p>
                        <p class="control">
                            <textarea class="textarea" type="text" name="message" placeholder="Message"></textarea>
                        </p>
                        <p class="control">
                          <a type="reset" class="button is-link bfooter1">Annuler</a>
                          <a type="submit" class="button is-primary bfooter2">Envoyer</a>
                        </p>
                    </form>
          </div>
        </div>
        <div class="column">
          <div class="content has-text-centered">
            <div class="canturlacontact">
              <p><i class="fa fa-home" aria-hidden="true"></i> <a class="accueil" href="index.php">Accueil</a></p>
              <p><i class="fa fa-facebook-square" aria-hidden="true"></i> <a class="svn" href="https://www.facebook.com/canturla/">Suivez-nous</a></p>
              <p><i class="fa fa-map-marker" aria-hidden="true"></i> <a href="https://www.google.fr/maps/place/49+Avenue+Gaston+Ribot,+30100+Al%C3%A8s/@44.1335763,4.0906704,17z/data=!3m1!4b1!4m5!3m4!1s0x12b4425ef4072d39:0x9eef73a6f0c28b9d!8m2!3d44.1335763!4d4.0928591">49 av. Gaston Ribot, 30100 Alès<a></p>
              <p><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:+33434139183">04 34 13 91 83</a></p>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="content has-text-centered">
            <h1 class="title">Canturla</h1>
            <p class="about subheader">Canturla c'est une épicerie de produits locaux et en vrac, un salon de thé et un lieu d'exposition/vente de création à base de matériaux de récupération.</p>
            <p class="about subheader"><img src="./template/images/logocanturla.png" width="125px"></p>
          </div>
        </div>
      </div>
      <div class="content has-text-centered">
         <p>Copyright ©<span style="font-weight: bold;">CODA</span> (K4rtM4n, Meg4R0M, M3rL1n, H4cK1M) - 2016</p>
         <p><a class="icon" href="https://github.com/jgthms/bulma"><i class="fa fa-github"></i></a></p>
      </div>
    </div>
  </footer>

  <!--fin du formulaire-->
    <script src="http://bulma.io/javascript/bulma.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/template/js/menu.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="template/js/modernizr.custom.63321.js"></script>
    <script src="template/js/jquery.catslider.js"></script><!-- js slider -->
    <script src="template/js/jquery.modal.js"></script>
  


    <?php
    if (basename($_SERVER['PHP_SELF']) == 'panier.php') {
        ?>

          <script>

            $(function() {

              $( '#mi-slider' ).catslider();

            });
            </script>
            <?php
    }
          ?>

  </body>
</html>
