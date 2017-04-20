<!--page de connexion, on change la variable et on appelle le template-->

<?php
include 'config/config.php';
$_SESSION['template']['page'] = $pages['Connexion'];
include 'pages/template.php';
?>