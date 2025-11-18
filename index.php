<?php
// Si un fichier accueil.php existe, on le charge en priorité
if ( file_exists( get_template_directory() . '/accueil.php' ) ) {
    include get_template_directory() . '/accueil.php';
    return;
}

http_response_code(404);
include("404.php");
exit();

?>