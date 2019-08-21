<?php
ob_start();
?>
<div class="webSitePresentation container-fluid">
    <div class="row ">
        <h1 class="col col-lg-12 mt-5 mx-auto booktitle">BILLET SIMPLE POUR L'ALASKA</h1>
    </div>
    <div class="row mt-4">
        <p class=" webSiteDescription offset-3 col-6 "><span class="font-weight-bold">Venez rejoindre l'aventure!!</span>
        <br>Au sein de ce blog, vous trouverez l'avancé de mon nouveau livre intitulé: <strong>Billet simple pour l'Alaska</strong>
        Un nouveau roman d'aventure et de voyages au coeur de l'Alaska, de ses lacs azurs, de ses forets et ses montagnes enneigées.<br>
        A intervales réguliers, je publierai les chapitres sur ce site afin de procédé sous forme de sorti épisodique. Je publierai aussi de temps en temps de articles à propos de mon ressenti sur l'écriture du roman et je vous expliquerai le cheminement de mes idées. 
        Enfin, je compte aussi demander l'avis de mes lecteurs ( eh oui je vais vous faire travailler! ) sur certains points de développement de l'histoire. Ainsi ce roman sera un peu le votre.<br>
        </p>
    </div>
</div>
<section class="postsContainer container-fluid">
    <div class="offset-1 col-10 border border-dark mt-3">

    </div>
</section>
<?=
$content = ob_get_contents();
ob_end_clean();
