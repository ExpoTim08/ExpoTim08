<?php 
/*
Template Name: Page 404
*/ 
require("global.php");
?>
<?php get_header(); ?>

<body>
    <div class="pattern-background"> <main>
            <div class="border gauche"></div>
            <div class="border droite"></div>
            <section class="section-erreur">
                 <h1 class="titre-erreur" aria-label="erreur">
                    <span class="titre-erreur-layer titre-erreur-base">ERREUR 404</span>
                    <span class="titre-erreur-layer titre-erreur-layer--1">ERREUR 404</span>
                    <span class="titre-erreur-layer titre-erreur-layer--2">ERREUR 404</span>
                    <span class="titre-erreur-layer titre-erreur-layer--3">ERREUR 404</span>
                 </h1>
                  <p class="message">La page que vous cherchez n'existe pas</p>
            </section>
            <section>
                <h2>Projet 1</h2>
                <h2>Projet 2</h2>
                <h2>Projet 3</h2>
            </section>
        </main>
    </div>
</body>

<?php get_footer(); ?>