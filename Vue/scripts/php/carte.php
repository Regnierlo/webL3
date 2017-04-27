<!--script php qui gère la sélection d’un élément, il sert simplement à changer la variable de session qui stocke l’élément sélectionné-->

<?php
    header('Content-Type: text/plain');
    if (isset($_REQUEST['action']))
    {
        session_start();
        include '../../config/config.php';
        include "../../$adresse_controleur";
        $controleur = new Controller();
        switch($_REQUEST['action'])
        {
            case 'select':
                if (isset($_REQUEST['id']))
                {
                    $_SESSION['carte']['elt'] = $_REQUEST['id'];
                    echo $_SESSION['carte']['elt'];
                }
                else
                    echo 'erreur';
                break;
            case 'renommer_elt' :
                if (isset($_REQUEST['nom']))
                {
                    echo $_REQUEST['action'];
                }
                else
                    echo 'erreur';
                break;
            case 'creer_fils' :
                echo $_REQUEST['action'];
                break;
            case 'creer_frere' :
                echo $_REQUEST['action'];
                break;
            case 'supprimer_elt' :
                echo $_REQUEST['action'];
                break;
            case 'ajouter_edition' :
                if (isset($_REQUEST['pseudo']))
                {
                    echo $_REQUEST['action'];
                }
                else
                    echo 'erreur';
                break;
            case 'supprimer_edition' :
                if (isset($_REQUEST['pseudo']))
                {
                    echo $_REQUEST['action'];
                }
                else
                    echo 'erreur';
                break;
            case 'partager' :
                if (isset($_REQUEST['pseudo']))
                {
                    echo $_REQUEST['action'];
                }
                else
                    echo 'erreur';
                break;
            case 'arreter_partage' :
                if (isset($_REQUEST['pseudo']))
                {
                    echo $_REQUEST['action'];
                }
                else
                    echo 'erreur';
                break;
            case 'renommer_carte' :
                if (isset($_REQUEST['nom']))
                {
                    echo $_REQUEST['action'];
                }
                else
                    echo 'erreur';
                break;
            case 'supprimer_carte' :
                echo $_REQUEST['action'];
                break;
        }
    }
    else
        echo 'erreur';


?>
