<footer class="site-footer">
  <div class="footer-top">
    <div class="footer-logo">
      <img src="<?php echo get_template_directory_uri(); ?>/Images/logo.png" alt="Logo de l'expo TIM">
    </div>
    <div class="footer-icones">
      <a href="https://www.youtube.com" target="_blank" aria-label="YouTube">
        <img src="<?php echo get_template_directory_uri(); ?>/Images/youtube.svg" alt="YouTube">
      </a>
      <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
        <img src="<?php echo get_template_directory_uri(); ?>/Images/instagram.svg" alt="Instagram">
      </a>
      <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
        <img src="<?php echo get_template_directory_uri(); ?>/Images/facebook.svg" alt="Facebook">
      </a>
    </div>
  </div>

  <div class="footer-contact">
    <p>3800 Sherbrooke St E, Montréal, Québec H1X 2A2</p>
    <p>+1 (514) 254 7131</p>
  </div>

  <div class="footer-bottom">
    <div class="footer-left">
      <h3>Navigation</h3>
      <?php
        wp_nav_menu(array(
          'theme_location' => 'main-menu',
          'menu_class' => 'footer-menu',
          'container' => false
        ));
      ?>
    </div>

    <div class="footer-right">
      <h3>Liens</h3>
      <ul>
        <li><a href="#">Politique de confidentialité</a></li>
        <li><a href="#">Conditions d’utilisation</a></li>
        <li><a href="#">Accessibilité</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-menu-bas">
    <p>© <?php echo date('Y'); ?> TimVision — Tous droits réservés.</p>
  </div>

  <?php wp_footer(); ?>
</footer>
