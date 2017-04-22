<!--page de compte, on change la variable et on appelle le template-->

<?php
    include 'config/config.php';
    $_SESSION['template']['page'] = $pages['Compte'];
    //paramètre d’afficha des cartes
    $cartes = $type_affichage_cartes['Compte'];
    include 'pages/template.php';
?>