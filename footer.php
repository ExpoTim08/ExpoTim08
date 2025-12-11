<!---------------- Section footer ----------------->

<div class="footer-border"></div>

<footer class="site-footer">
  
  <!-- Section haute du footer (logo + icones) -->
  <div class="footer-top">
    <div class="footer-logo">
      <img class="footer-logo-img" src="<?php echo esc_url(get_theme_mod('expoTim_footer_logo')); ?>" alt="Logo de l'expo TIM">
    </div>


    
    <div class="footer-icones">
      <a href="<?php echo esc_url(get_theme_mod('expoTim_footer_social_1')); ?>" target="_blank" aria-label="YouTube">
        <img src="<?php echo get_template_directory_uri(); ?>/Images/youtube.svg" alt="YouTube">
      </a>
      <a href="<?php echo esc_url(get_theme_mod('expoTim_footer_social_2')); ?>" target="_blank" aria-label="Instagram">
        <img src="<?php echo get_template_directory_uri(); ?>/Images/instagram.svg" alt="Instagram">
      </a>
      <a href="<?php echo esc_url(get_theme_mod('expoTim_footer_social_3')); ?>" target="_blank" aria-label="Facebook">
        <img src="<?php echo get_template_directory_uri(); ?>/Images/facebook.svg" alt="Facebook">
      </a>
    </div>
  </div>

  <!-- Section contact (adresse + cell du college) -->
  <div class="footer-contact">
    <div class="footer-adresse">
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MapLogo.svg" alt="Adresse">
      <p><?php echo esc_html(get_theme_mod('expoTim_footer_address')); ?></p>
    </div>

    <div class="footer-telephone">
        <img src="<?php echo get_template_directory_uri(); ?>/Images/CellLogo.svg" alt="Téléphone">
      <p><?php echo esc_html(get_theme_mod('expoTim_footer_phone')); ?></p>
    </div>
  </div>

  <!-- Image logo TIM (seuleument en tablet et desktop)-->
  <div class="footer-tim">
    <?php 
    $logo2 = get_theme_mod('expoTim_footer_logo_2');
    if ( $logo2 ) : ?>
        <img class="logo-tim" src="<?php echo esc_url($logo2); ?>" alt="Logo TIM">
    <?php endif; ?>
  </div>

  <!-- Section bas du footer (menu + liens) -->
  <div class="footer-bottom">
    <div class="footer-left">
      <h3>Navigation</h3>
      <div class="div-logo-tim"><?php
        wp_nav_menu(array(
          'theme_location' => 'menu2-location',
          'menu_class' => 'footer-menu',
          'container' => false
        ));
      ?>
      <?php 
    $logo2 = get_theme_mod('expoTim_footer_logo_2');
    if ( $logo2 ) : ?>
        <img class="logo-tim-mob" src="<?php echo esc_url($logo2); ?>" alt="Logo TIM">
    <?php endif; ?>
      </div>
    </div>

    <div class="footer-right">
      <h3>Liens</h3>
      <ul>
        <li><a href="https://www.cmaisonneuve.qc.ca/">Collège Maisonneuve</a></li>
        <li><a href="https://www.cmaisonneuve.qc.ca/programme/integration-multimedia/">À propos du programme</a></li>
        <li><a href="https://gftnth00.mywhc.ca/audiovisuel/site/application/site/index.php">Audiovisuel du TIM</a></li>
        <li><a href="https://www.behance.net/departement_tim">Behance du TIM</a></li>
      </ul>
    </div>
  </div>

  <!-- Section très bas du footer (copyright) -->
  <div class="footer-menu-bas">
    <p>© <?php echo date('Y'); ?> TimVision — Tous droits réservés.</p>
  </div>

  <?php wp_footer(); ?>
</footer>