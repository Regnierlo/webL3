<!--script php qui gère la navigation entre pages, il sert simplement à changer la variable de session qui stocke la page-->

<?php
    header('Content-Type: text/plain');
    session_start();
    if (isset($_REQUEST['page'])) {
        $_SESSION['template']['page'] = $_REQUEST['page'];
        echo 'fini '. $_SESSION['template']['page'];
    }
    else
        echo 'erreur';
?>
