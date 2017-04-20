<?php
    header('Content-Type: text/plain');
    session_start();
    if (isset($_REQUEST['page'])) {
        $_SESSION['template']['page'] = $_REQUEST['page'];
        //header('Location: '.$_SESSION["adresse"]);
        print 'fini '. $_SESSION['template']['page'];
    }
    else
        print 'erreur';
?>
