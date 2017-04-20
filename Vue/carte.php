<!--page d’une carte, on change la variable et on appelle le template-->

<?php
include 'config/config.php';
$_SESSION['template']['page'] = $pages['Carte'];
include 'pages/template.php';
?>