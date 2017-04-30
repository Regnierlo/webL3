<!--page de connexion, on change la variable et on appelle le template-->

<?php
    include_once 'config/config.php';
    $_SESSION['template']['page'] = $pages['Connexion'];
    include_once 'pages/template.php';
?>