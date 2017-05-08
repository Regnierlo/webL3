<!--script php qui gère toutes les opérations qui peuvent se faire sur la page carte-->

<?php
    header('Content-Type: text/plain');
    if (isset($_REQUEST['action']))
    {
        //inclusion du contrôleur
        include_once '../../config/config.php';
        //include_once "../../$adresse_controleur";
        $controleur = $_SESSION['controleur'];
        $id_carte = $controleur->getCarte()->getId();

        switch($_REQUEST['action'])
        {
            case 'select':
                if (isset($_REQUEST['id']))
                {
                    //$_SESSION['carte']['elt'] = $_REQUEST['id'];
                    //echo $_SESSION['carte']['elt'];
                    $_SESSION['elt_select'] = $_REQUEST['id'];
                    echo $_SESSION['elt_select'];
                }
                else
                    echo 'erreur';
                break;
            case 'renommer_elt' :
                if (isset($_SESSION['elt_select']) && isset($_REQUEST['nom']))
                {
                    if ($controleur->modifierValeurElement($_SESSION['elt_select'], $_REQUEST['nom']))
                        echo $_REQUEST['action'];
                    else
                        echo 'erreur';
                }
                else
                    echo 'erreur';
                break;
            case 'creer_fils' :
                if (isset($_REQUEST['id_pere']))
                {
                    var_dump($_REQUEST['id_pere']);
                    $pere = $_REQUEST['id_pere'];
                    if ($pere == 'undefined' && $controleur->getCarte()->getCmpE() == 0)
                        $pere = 'Administrateur';
                    if ($controleur->ajouterElement($pere))
                        echo $_REQUEST['action'];
                    else
                        echo 'erreur';
                }
                else
                    echo 'erreur';
                break;
            case 'supprimer_elt' :
                if (isset($_SESSION['elt_select']))
                {
                    if ($controleur->supprimerElement($_SESSION['elt_select']))
                        echo $_REQUEST['action'];
                    else
                        echo 'erreur';
                }
                else
                    echo 'erreur';

                break;
            case 'ajouter_edition' :
                if (isset($_REQUEST['pseudo']))
                {
                    if ($controleur->modifierRole($id_carte, $_REQUEST['pseudo'], 'Editeur'))
                        echo $_REQUEST['action'];
                    else
                        echo 'erreur';
                }
                else
                    echo 'erreur';
                break;
            case 'supprimer_edition' :
                if (isset($_REQUEST['pseudo']))
                {
                    if ($controleur->modifierRole($id_carte, $_REQUEST['pseudo'], 'Consultant'))
                        echo $_REQUEST['action'];
                    else
                        echo 'erreur';
                }
                else
                    echo 'erreur';
                break;
            case 'partager' :
                if (isset($_REQUEST['pseudo']))
                {
                    if ($controleur->modifierRole($id_carte, $_REQUEST['pseudo'], 'Consultant'))
                        echo $_REQUEST['action'];
                    else
                        echo 'erreur';
                }
                else
                    echo 'erreur';
                break;
            case 'arreter_partage' :
                if (isset($_REQUEST['pseudo']))
                {
                    if ($controleur->modifierRole($id_carte, $_REQUEST['pseudo'], 'Aucun'))
                        echo $_REQUEST['action'];
                    else
                        echo 'erreur';
                }
                else
                    echo 'erreur';
                break;
            case 'renommer_carte' :
                if (isset($_REQUEST['nom']))
                {
                    if ($controleur->renommerCarte($id_carte, $_REQUEST['nom']))
                        echo $_REQUEST['action'];
                    else
                        echo 'erreur';
                }
                else
                    echo 'erreur';
                break;
            case 'supprimer_carte' :
                if ($controleur->supprimerCarte($id_carte))
                    echo $_REQUEST['action'];
                else
                    echo 'erreur';
                break;
        }
    }
    else
        echo 'erreur';
?>
