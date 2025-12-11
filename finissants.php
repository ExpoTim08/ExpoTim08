<?php
/*
Template Name: Finissants
*/
require("global.php");
get_header();
?>
<?php 
$titre1 = get_theme_mod('expoTim_finissants_title_1') ;
$titre2 = get_theme_mod('expoTim_finissants_title_2');
$titre3 = get_theme_mod('expoTim_finissants_title_3');
$titre4 = get_theme_mod('expoTim_finissants_title_4');
?>


<body> 
<div class="pattern-background">

<main class="page-finissant">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- ===================== Présentation Finissant ===================== -->
  <section class="presentation-finissant">
  <h1 class="titre-finissant" aria-label="finissant">
    <span class="titre-finissant-layer titre-finissant--base"><?php echo esc_html(get_theme_mod('expoTim_finissants_title')); ?></span>
    <span class="titre-finissant-layer titre-finissant-layer--1"><?php echo esc_html(get_theme_mod('expoTim_finissants_title')); ?></span>
    <span class="titre-finissant-layer titre-finissant-layer--2"><?php echo esc_html(get_theme_mod('expoTim_finissants_title')); ?></span>
    <span class="titre-finissant-layer titre-finissant-layer--3"><?php echo esc_html(get_theme_mod('expoTim_finissants_title')); ?> </span>
  </h1>

    <svg class="logo-finissant" width="181" height="177" viewBox="0 0 181 177" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M46.5964 85.63L62.7584 60.4906C63.1226 59.9241 63.9314 59.8723 64.3649 60.3879L92.0953 93.3678C92.2211 93.5174 92.388 93.6269 92.5753 93.6827L136.603 106.793C137.242 106.983 137.519 107.732 137.159 108.292L120.982 133.455C120.754 133.81 120.336 133.985 119.926 133.89C110.38 131.675 87.4595 125.733 74.3417 122.094C74.1321 122.036 73.9513 121.91 73.8191 121.737C62.7023 107.203 54.7246 97.2567 46.6457 86.7811C46.3876 86.4465 46.3679 85.9854 46.5964 85.63Z" fill="#D09308" stroke="#D7C9B6"/>
      <path d="M96.626 85.6456L47.4627 26.3521C46.2169 24.8497 47.6405 22.6353 49.5245 23.1449L123.794 43.2366C124.601 43.4547 125.318 43.9199 125.847 44.5668L175.496 105.33C176.592 106.671 176.7 108.566 175.763 110.024L148.898 151.812C148.773 152.006 148.721 152.243 148.742 152.473C149.934 165.213 136.501 170.061 128.703 171.052C128.149 171.122 127.662 170.691 127.627 170.133C126.336 149.338 134.173 145.442 138.907 146.127C139.334 146.188 139.77 146.023 140.003 145.66L164.073 108.221C164.431 107.663 164.157 106.917 163.523 106.724L98.5391 86.9187C97.7906 86.6905 97.1255 86.2479 96.626 85.6456Z" fill="#D09308" stroke="#D7C9B6"/>
    </svg>
    
    <div class="conteneur-description-finissant">
    <p class="description-titre">Description</p>
    <p class="description-texte">
      <?php echo wp_kses_post(get_theme_mod('expoTim_finissants_description')); ?> 
    </p>
  </div>
</section>
  <!-- ===================== Barre de filtres ===================== -->
  <div class="filtres-container">
    <?php
    $parent_cat = get_category_by_slug('projet-des-finissants'); 
    if ($parent_cat):
        $child_categories = get_categories([
            'parent'     => $parent_cat->term_id,
            'hide_empty' => false
        ]);
    ?>
    <select id="filtre-categorie-select" name="cat" aria-label="Filtrer par catégorie">
        <option value="all">Filtrer (Tous)</option>
        <?php foreach ($child_categories as $cat): ?>
            <option value="<?php echo esc_attr($cat->term_id); ?>" <?php selected(isset($_GET['cat']) && $_GET['cat'] == $cat->term_id); ?>>
                <?php echo esc_html($cat->name); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?php endif; ?>

    <div class="tri-bar">
      <select id="tri-select" name="tri-select" aria-label="Trier projets">
        <option value="random" <?php selected(isset($_GET['tri']) ? sanitize_text_field($_GET['tri']) : 'random', 'random'); ?>>Tri (Aléatoire)</option>
        <option value="asc" <?php selected(isset($_GET['tri']) ? sanitize_text_field($_GET['tri']) : '', 'asc'); ?>>A à Z</option>
        <option value="desc" <?php selected(isset($_GET['tri']) ? sanitize_text_field($_GET['tri']) : '', 'desc'); ?>>Z à A</option>
      </select>
    </div>
  </div>

  <!-- ===================== Liste des projets ===================== -->
  <section class="liste-projet-finissant" id="liste-projet-finissant">
    <?php
    $args = [
        'post_type'      => 'projet-finissant',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    ];

    $projets_finissants = new WP_Query($args);

    if ($projets_finissants->have_posts()) :
        while ($projets_finissants->have_posts()) : $projets_finissants->the_post();
            $titre = get_field('nom_du_projet');
            $description = get_field('description');
            $image = get_field('image');
            $liens = get_field('liens');

            // ✅ IDs catégories pour le filtrage JS
            $cats = wp_get_post_categories(get_the_ID());
            $data_filtre = implode(",", $cats);

            $short_desc = wp_trim_words(wp_strip_all_tags($description), 40, '...');
    ?>

    <!-- ===== Carte Projet Desktop ===== -->
    <article class="carte-projet-finissant carte-projet-finissant--desktop" 
    onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-finissant')))); ?>'" data-filtre="<?php echo esc_attr($data_filtre); ?>">
        <?php if (!empty($image) && !empty($image['url'])): ?>
            <img class="image-projet-finissant" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: $titre); ?>">
        <?php endif; ?>

        <div class="conteneur-carte-bas">
            <h2 class="titre-projet-finissant"><?php echo esc_html($titre); ?></h2>
            <p class="carte-finissant-titre-description">Description</p>
            <p class="description-projet"><?php echo esc_html($short_desc); ?></p>
            
            <?php
            /*
            if ($liens): ?>
              <p class="liens-projet">
                <a href="<?php echo esc_url($liens); ?>" target="_blank">Liens</a>
              </p>
            <?php endif;
            */
            ?>

            <button class="button-projet-finissant"
            onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-finissant')))); ?>'">
            ➜
            </button>
        </div>
    </article>

    <!-- ===== Carte Projet Mobile ===== -->
    <article class="carte-projet-finissant carte-projet-finissant--mobile" data-filtre="<?php echo esc_attr($data_filtre); ?>">
        <div class="bloc-titre">
            <h2 class="titre-projet-finissant"><?php echo esc_html($titre); ?></h2>
            <button class="button-projet-finissant"
                onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-finissant')))); ?>'">
                ➜
            </button>
        </div>

        <?php if ($image): ?>
            <img class="image-projet-finissant" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($titre); ?>">
        <?php endif; ?>

        <span class="conteneur-button-dropdown-finissant">
            <p class="carte-finissant-titre-description">Description</p>
            <button class="button-dropdown-finissant" aria-expanded="false" aria-controls="<?php echo 'dropdown-'.get_the_ID(); ?>">+</button>
        </span>

        <div id="<?php echo 'dropdown-'.get_the_ID(); ?>" class="dropdown-carte-finissant" aria-hidden="true">
            <p class="description-projet"><?php echo esc_html($short_desc); ?></p>
        </div>
    </article>

    <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>Aucun projet de finissants pour le moment.</p>';
    endif;
    ?>
  </section>

</main>
</div>
</body>

<?php get_footer(); ?>
