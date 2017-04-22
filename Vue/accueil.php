<!--page d’accueil, on change la variable et on appelle le template-->

<?php
    include 'config/config.php';
    $_SESSION['template']['page'] = $pages['Accueil'];
    //paramètre d’affichage des cartes
    $cartes = $type_affichage_cartes['Publiques'];
    include 'pages/template.php';
?>
