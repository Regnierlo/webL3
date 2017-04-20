<?php
    session_start();
    include '../config/config.php';

    //procédure de déconnexion
    $_SESSION['pseudo'] = null;
    $_SESSION['template']['connecte'] = false;
    $_SESSION['template']['page'] = $pages['Accueil'];
    header('Location: ../pages/template.php');
?>