<!--page d’accueil, on change la variable et on appelle le template-->

<?php
    include 'config/config.php';
    $_SESSION['template']['page'] = $pages['Accueil'];
    include 'pages/template.php';
?>
