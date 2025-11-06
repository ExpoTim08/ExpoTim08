<?php
/*
Template Name: Arcade
*/
require("global.php");
get_header();
?>

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
            <p class="filtre">Filtrer</p>
        </div>
    
        <section class="liste-projet-arcade">
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
