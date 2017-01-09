<?php
require_once('template/header.php');
require_once('template/menu.php');
?>



<!---****** PANIER---------------------------------------------------->

<div class="panier">



  <div class="content has-text-centered">
    <div class="column is-half is-offset-one-quarter">
      <p class="title is-3">Votre panier contient 2 produits</p> <!--titre-->
      <p class="subtitle is-5">Récapitulatifs de votre commandes</p>  <!--sous-titre-->


    </div>
  </div>


  <div class="content has-text-centered"> <!--centrer-->
    <div class="column is-two-thirds">
      <h1 class="title"> Article</h1>
    </div>
  </div>


  <div class="container">
    <div class="box">  <!-- box article 1 -->
      <div class="columns">
        <div class="column is-two-thirds">
          <div class="content has-text-centered">

            <article class="media">
              <div class="media-left">
                <div class="image imagearticle12">
                  <figure class="image is-96x96">
                    <img src="http://lilot-the.com/wp-content/uploads/2013/11/the-vert-citron.jpg" alt="Image"> <!-- image article -->
                  </figure>
                </div>
              </div>
              <div class="media-content">
                <div class="content"> <!-- presentation de l'article -->
                  <div class="titrepanier">
                  <h3><strong>Thé vert</strong></h3>
                  </div>
                  <div class="texte">
                    <p> Le thé vert est une plante vertueuse pour la santé,
                      efficace contre plus de 60 maladies.
                      Les types de thé vert et leur préparation.</p>
                    </div>
                  </div>
                  <!-- fin presentation de l'article -->

                  <!-- bouton supprimer -->

                  <div class="boutonsupprimer">
                    <a class="button is-small button is-danger is-outlined ">
                      <span class="icon">
                        <i class="fa fa-times"></i>
                      </span>
                      <span>Supprimer</span>
                    </a>
                  </div>
                  <!--fin  bouton supprimer -->
                </div>
              </article>

            </div>
          </div>

          <!---PRIX----------------------------------------------->

          <div class="column">
            <div class="has-text-centered">
              <h1 class="title">Prix</h1>
              <div class="prix">
                <h3 class="title is-3">10.<sup>99€</sup></h3>
              </div>
            </div>
          </div>

          <!---Quantité-------------------------------------------------->

          <div class="column">
            <div class="has-text-centered"> <!--div center l'objet-->
              <h1 class="title">Quantité</h1>
              <label class="label">Quantité:</label>
              <p class="control"> <!--bouton liste grammes-->
                <div class="has-text-centered"> <!--div center l'objet-->
                  <span class="select">
                    <select>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                    </select>
                  </span>
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>  <!-- fin box article 1 -->
    </div>

    <!---********fin panier partie 1 ------------------------------------->

    <!---****** PANIER partie 2**---------------------------------->
    <div class="panier2">
      <div class="container">
        <div class="box">
          <div class="columns">

            <div class="column is-two-thirds">
              <div class="content has-text-centered">
                <article class="media">
                  <div class="media-left">
                    <div class="image imagearticle12">
                      <figure class="image is-96x96">
                        <img src="http://www.chocolat-voisin.com/?action=getImg&type=b1&f=07_italien.png" alt="Café">
                      </figure>
                    </div>
                  </div>
                  <div class="media-content">
                    <div class="content">
                      <div class="titrepanier">
                      <h3><strong>Café Italien </strong></h3>
                    </div>
                      <div class="texte">
                        <p> Torréfaction poussée pour cet assemblage de grands crus
                          d'Amérique latine et d'Afrique de l'est, idéal « Ristretto »..</p>
                        </div>
                      </div>
                      <!-- bouton supprimer -->
                      <div class="boutonsupprimer">
                        <a class="button is-small button is-danger is-outlined">
                          <span class="icon">
                            <i class="fa fa-times"></i>
                          </span>
                          <span>Supprimer</span>
                        </a>
                      </div>
                      <!-- fin bouton supprimer -->
                    </div>
                  </article>
                </div>
              </div>

              <!---****************PRIX----------------------------------------------->

              <div class="column">
                <div class="has-text-centered">  <!--div center l'objet-->
                  <h1 class="title">Prix</h1>
                  <div class="prix">
                    <h3 class="title is-3">5.<sup>50€</sup></h3>
                  </div>
                </div>
              </div>

              <!--************************-Quantité--------------------------------->

              <div class="column">
                <div class="has-text-centered"> <!--div center l'objet-->
                  <h1 class="title">Quantité</h1>
                  <label class="label">Quantité:</label>
                  <p class="control"> <!--bouton liste grammes-->
                    <div class="has-text-centered">  <!--div center l'objet-->
                      <span class="select">
                        <select>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                        </select>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!--fin panier partie 1 ------------------------------------------>

    <!---****** PANIER partie 3**------------------------------------------>

    <div class="panier3">
      <div class="container">
        <div class="columns">
          <div class="column is-two-thirds">
            <div class="content has-text-centered">
            </div>
          </div>

          <!---PRIX TOTAL----------------------------------------------->

          <div class="column">
            <div class="has-text-centered">
              <div class="total">
                <h1 class="title ">Total:</h1><script src="/template/js/modernizr.custom.63321.js"></script> <!-- js slider -->
                <div class="price">

                    <h2 class="title is-2 prixtotal">16.<sup>49€</sup></h2><script src="/template/js/modernizr.custom.63321.js"></script> <!-- js slider -->
                  </div>
                </div>

                <!---Passer la commande---------------->

                <div class="column">
                  <div class="has-text-centered">
                    <div class="commande">
                      <a class="button is-success">Passer la commande</a>
                    </div>
                  </div>
                </div>
                <!---fin de Passer la commande---------------->
              </div>
            </div>
          </div>
        </div>


        <!--SLIDER------------------------------------------------->
        <div class="container slider01">
          <div class="has-text-centered">
            <header class="clearfix">

              <h1 class="title proposition22">Nous vous proposons également : </br> 100% bio</h1>
            </header>
          </div>
          <div class="main">
            <div id="mi-slider" class="mi-slider">     <!-- thés-->
              <ul>
                <li><a href="#"><img src="https://media.cdnws.com/_i/49902/274/2206/76/sencha-delices-delysse-zoom.png" alt="img01"><h4>thé vert</h4> <a class=" button is-smal button is-success">Ajouter</a></li>
                <li><a href="#"><img src="http://www.teatower.com/themes/axome/img/reassurance/echantillons-offerts.png" alt="img02"><h4>thé menthe</h4><a class=" button is-smal button is-success">Ajouter</a></li>
                <li><a href="#"><img src="http://ileauxepices.com/367-large/the-noir-keemun.jpg" alt="img03"><h4>thé noir</h4><a class=" button is-smal button is-success">Ajouter</a></li>
                <li><a href="#"><img src="https://content.davidstea.com/media/catalog/product/cache/2/image/500x/0dc2d03fe217f8c83829496872af24a0/1/0/10432dt01var0019353-bi-1.46.png" alt="img04"><h4>thé orange épicée</h4><a class=" button is-smal button is-success">Ajouter</a></li>
              </ul>
              <ul>             <!-- cafés-->
                <li><a href="#"><img src="http://www.destination-bio.com/5464-thickbox_default/cafe-bio-selection-pur-arabicas-grain-250g.jpg" alt="img05"><h4>Arabicas N°1</h4><a class=" button is-smal button is-success">Ajouter</a></li>
                <li><a href="#"><img src="http://www.destination-bio.com/5625-thickbox_default/cafe-bio-mexique-chiapas-grain-250g.jpg" alt="img06"><h4>Mexico Chiapas N°19</h4><a class=" button is-smal button is-success">Ajouter</a></li>
                <li><a href="#"><img src="http://www.destination-bio.com/5476-thickbox_default/stretto-italiano-n11-grain-250g.jpg" alt="img07"><h4>Stretto Italiano N°11</h4><a class=" button is-smal button is-success">Ajouter</a></li>
                <li><a href="#"><img src="http://www.destination-bio.com/6643-thickbox_default/indonesia-sumatra-n37-100-arabica-grain-200g-paquet-boite-metal.jpg" alt="img08"><h4>Indonesia Sumatra N°37</h4><a class=" button is-smal button is-success">Ajouter</a></li>
              </ul>
              <ul> <!-- Pates-->
                <li><a href="#"><img src="http://produits.bienmanger.com/23117-0w300h300_Spahettis_Bio_Bas_Montignac.jpg" alt="img09"><h4>Montignac</h4><a class=" button is-smal button is-success">Ajouter</a></li>
                <li><a href="#"><img src="http://produits.bienmanger.com/5403-0w300h300_Pates_Bio_Sardaigne_Gigli_Forme_Girolles.jpg" alt="img10"><h4> Sardaigne</h4><a class=" button is-smal button is-success">Ajouter</a></li>
                <li><a href="#"><img src="http://produits.bienmanger.com/21749-0w300h300_Torsades_Mais_Riz_Pates_Bio_Sans_Gluten.jpg" alt="img11"><h4>Torsades maïs et riz</h4><a class=" button is-smal button is-success">Ajouter</a></li>
              </ul>
              <nav>
                <a href="#">THÉS</a>
                <a href="#">CAFÉS</a>
                <a href="#">PATES</a>
              </nav>
            </div>
          </div>
        </div>
      </div>



      <!--fin slider-->


      <!--fin PANIER -->

      <?php
      require_once ('template/footer.php');
      ?>
