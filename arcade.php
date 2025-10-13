<?php
/*
Template Arcade
*/
//get_header(); //appelle le header

?>

<!-- CONTENU DE TA PAGE ARCADE -->
<main class="page-arcade">
    <section>
        <h1 class="TitreArcade">Arcade</h1>
        <p class="DescriptionTitre">Description</p>
        <p class="DescriptionArcade">
            Bienvenue sur notre page arcade. Découvrez nos projets !
        </p>
    </section>

    <p class="Filtre">Filtrer</p>

    <?php if(!empty($projets)): ?>
        <?php foreach($projets as $projet): ?>
            <section>
                <h2 class="TitreProjetArcade"><?php echo htmlspecialchars($projet['titre']); ?></h2>
                <img class="ImageProjetArcade" src="<?php echo htmlspecialchars($projet['image']); ?>" alt="<?php echo htmlspecialchars($projet['titre']); ?>">
                <p class="DescriptionProjet"><?php echo nl2br(htmlspecialchars($projet['description'])); ?></p>
            </section>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun projet disponible pour le moment.</p>
    <?php endif; ?>
</main>

<?php
//get_footer(); //appelle le footer
?>

