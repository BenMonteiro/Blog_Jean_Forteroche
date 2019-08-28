<?php

/* Accueil.html.twig */
class __TwigTemplate_596f4952d0e2588be13e3d1fd025cf1c029da6d5e3409de66c4b9109f8cb91ae extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
<div class=\"webSitePresentation container-fluid\">
    <div class=\"row \">
        <h1 class=\"col col-lg-12 my-4 mx-auto booktitle\">BILLET SIMPLE POUR L'ALASKA</h1>
    </div>
    <div class=\"webSiteDescription row \">
        <p class=\"offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 offset-1 col-10 py-4\"><span class=\"subtitle font-weight-bold\">Venez rejoindre l'aventure!!</span>
        <br>Au sein de ce blog, vous trouverez l'avancé de mon nouveau livre intitulé: <strong>Billet simple pour l'Alaska</strong>
        Un nouveau roman d'aventure et de voyages au coeur de l'Alaska, de ses lacs azurs, de ses forets et ses montagnes enneigées.<br>
        A intervales réguliers, je publierai les chapitres sur ce site afin de procéder sous forme épisodique. Je publierai aussi de temps en temps des articles à propos de mon ressenti sur l'écriture du roman et je vous expliquerai le cheminement de mes idées. 
        Enfin, je compte aussi demander l'avis de mes lecteurs ( eh oui je vais vous faire travailler! ) sur certains points de développement de l'histoire. Ainsi ce roman sera un peu le votre.<br>
        </p>
    </div>
</div>

";
        // line 16
        echo twig_escape_filter($this->env, ($context["article"] ?? null), "html", null, true);
        echo "

<section class=\"postsContainer container-fluid\">
    <div class=\"offset-2 col-8 border border-dark mt-3 py-5\">
    </div>
</section>

";
    }

    public function getTemplateName()
    {
        return "Accueil.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 16,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Accueil.html.twig", "C:\\wamp64\\www\\Blog_P4\\src\\templates\\Accueil.html.twig");
    }
}
