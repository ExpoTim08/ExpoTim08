<?php
/*
Template Name: Arcade
*/
require("global.php"); 
?>

<body <?php body_class(); ?>>
<div class="pattern-background">
<?php get_header(); ?>


<main class="page-arcade">
  <div class="border gauche"></div>
  <div class="border droite"></div>


    <!-- Présentation Arcade -->
    <section class="presentation-arcade">
        <h1 class="titre-arcade" aria-label="arcade">
            <span class="titre-arcade-layer titre-arcade--base">ARCADE</span>
            <span class="titre-arcade-layer titre-arcade-layer--1">ARCADE</span>
            <span class="titre-arcade-layer titre-arcade-layer--2">ARCADE</span>
            <span class="titre-arcade-layer titre-arcade-layer--3">ARCADE</span>
        </h1>

        <div class="conteneur-description-arcade">
            <p class="description-titre">Description</p>
            <p class="description-texte">
                L’Arcade de l’expoTIM présente les prototypes de jeux vidéo créés par les étudiants de deuxième année en Technique d’intégration multimédia. 
                Réalisés dans le cadre du cours Création de jeu en équipe, ces projets sont le fruit d’un processus de production complet : de la conception et la planification à la création des médias, de la programmation aux tests de qualité jusqu’au produit fini.
            </p>
        </div>
    </section>
    

    <!-- Liste des projets -->
    <div class="conteneur-section-arcade-bas">

        <div class="conteneur-arcade-filtre">
            <svg fill="#f1e2cc" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-179.59 -179.59 831.80 831.80" xml:space="preserve" stroke="#f1e2cc" stroke-width="0.00472615" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="1.8904600000000003"></g><g id="SVGRepo_iconCarrier"> <g> <g> <polygon points="472.615,12.908 0,12.908 180.081,202.629 180.066,459.708 292.55,401.525 292.534,202.629 "></polygon> </g> </g> </g></svg>
            <p class="filtre">Filtrer</p>
        </div>

        <section class="liste-projet-arcade">

        <!-- Carte projet arcade — version desktop/tablette (n'apparait pas en mobile) -->
        <div class="carte-projet-arcade--desktop">
            <img class="image-projet-arcade" src="<?php echo get_template_directory_uri(); ?>/Images/AfficheHachiman.jpg" alt="">

            <div class="conteneur-carte-bas">
                <h2 class="titre-projet-arcade">Nom du projet</h2>
                <p class="carte-arcade-titre-description">Description</p>
                <p class="description-projet">Hachiman est un jeu d’aventure et de combat narratif inspiré de la culture japonaise et de grands classiques du genre fantastique, tels qu’Elden Ring et Sekiro. Dans ce jeu, magie et batailles s’entrelacent pour offrir une expérience immersive et dynamique. Réalisé dans le cadre d'un projet de jeu vidéo en équipe, Hachiman est l’aboutissement de 15 semaines de travail intensif.
Le joueur y incarne Hachiman et son but est de combattre des ennemis redoutables et de récupérer des artefacts essentiels à la progression...</p>
                <button class="button-projet-arcade">>></button>
            </div>
        </div>

        <!-- Carte projet arcade — version mobile (n'apparaît pas en desktop/tablette) -->
        <div class="carte-projet-arcade">
            <div class="conteneur-carte-haut">
                <img class="image-projet-arcade" src="<?php echo get_template_directory_uri(); ?>/Images/AfficheHachiman.jpg" alt="">
                <button class="button-projet-arcade">>></button>
            </div>

          <div class="conteneur-carte-bas">
            <span class="conteneur-button-dropdown-arcade">
              <p class="carte-arcade-titre-description">Description</p>
              <button class="button-dropdown-arcade">+</button>
            </span>
            <div class="dropdown-carte-arcade">
              <p class="description-projet">Hachiman est un jeu d’aventure et de combat narratif inspiré de la culture japonaise et de grands classiques du genre fantastique, tels qu’Elden Ring et Sekiro...</p>
            </div>
          </div>
        </div>

            <?php
            global $wpdb;
            $projets = $wpdb->get_results("SELECT * FROM projets_arcade ORDER BY projet_id ASC");

            foreach ($projets as $projet) :

                $etudiants = $wpdb->get_results("
                    SELECT e.prenom, e.nom 
                    FROM etudiants e
                    INNER JOIN etudiants_projets_arcade ep ON e.id = ep.etudiant_id
                    WHERE ep.projet_arcade_id = {$projet->projet_id}
                ");

                $noms_etudiants = array_map(fn($e) => $e->prenom.' '.$e->nom, $etudiants);
                $liste_etudiants = implode(', ', $noms_etudiants);
            ?>
                <div class="carte-projet-arcade">
                    <div class="conteneur-carte-haut">
                        <h2 class="titre-projet-arcade"><?php echo esc_html($projet->titre); ?></h2>
                        <button class="button-projet-arcade">>></button>
                    </div>

                    <img class="image-projet-arcade" src="<?php echo !empty($projet->image_url) ? esc_url($projet->image_url) : get_template_directory_uri().'/Images/Arcade.jpg'; ?>" alt="<?php echo esc_attr($projet->titre); ?>">

                    <div class="conteneur-carte-bas">
                        <div class="conteneur-button-dropdown-arcade">
                            <p class="carte-arcade-titre-description">Description</p>
                            <button class="button-dropdown-arcade">+</button>
                        </div>
                        <div class="dropdown-carte-arcade">
                            <p class="description-projet"><?php echo esc_html($projet->description); ?></p>
                            <?php if(!empty($liste_etudiants)) : ?>
                                <p class="etudiants-projet">Étudiants : <?php echo esc_html($liste_etudiants); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</main>

<?php get_footer(); ?>
</div>
</body>