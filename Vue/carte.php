<!--page d’une carte, on change la variable et on appelle le template-->

<?php
    include 'config/config.php';
    $_SESSION['template']['page'] = $pages['Carte'];

    if (isset($_REQUEST['carte']))
    {
        $_SESSION['carte']['id'] = $_REQUEST['carte'];
        $_SESSION['carte']['nom'] = $_REQUEST['nom_carte'];
        $_SESSION['carte']['elt'] = $_REQUEST['elt'];
    }
    else
    {
        unset($_SESSION['carte']);
    }
    include 'pages/template.php';
?>