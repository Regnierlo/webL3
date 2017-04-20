<!--page d’inscription, on change la variable et on appelle le template-->

<?php
include 'config/config.php';
$_SESSION['template']['page'] = $pages['Inscription'];
include 'pages/template.php';
?>