<!--page d’inscription, on change la variable et on appelle le template-->

<?php
    include_once 'config/config.php';
    $_SESSION['template']['page'] = $pages['Inscription'];
    include_once 'pages/template.php';
?>