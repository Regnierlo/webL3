<!--page de compte, on change la variable et on appelle le template-->

<?php
    include_once 'config/config.php';
    $_SESSION['template']['page'] = $pages['Compte'];
    //paramètre d’afficha des cartes
    $cartes = $type_affichage_cartes['Compte'];
    include_once 'pages/template.php';
?>