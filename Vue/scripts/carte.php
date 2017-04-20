<!--script php qui gère la sélection d’un élément, il sert simplement à changer la variable de session qui stocke l’élément sélectionné-->

<?php
header('Content-Type: text/plain');
session_start();
if (isset($_REQUEST['id'])) {
    $_SESSION['carte']['elt'] = $_REQUEST['id'];
    print 'fini '. $_SESSION['carte']['elt'];
}
else
    print 'erreur';
?>
