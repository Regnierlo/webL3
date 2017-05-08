<!--utilise l’identifiant de la carte pour la récupérer et la transformer à l’aide du script carte.xsl-->

<?php
    $placement = 'Vue';

    if (file_exists('config/config.php'))
    {
        include_once 'config/config.php';
        //include_once_once $adresse_controleur;
    }
    else
    {
        $placement = 'php';
        include_once '../../config/config.php';
        //include_once_once "../../$adresse_controleur";
    }
    $controleur = $_SESSION['controleur'];

    //Récupération du doc xsl
    $xslDoc = new DOMDocument();
    if ($placement == 'Vue')
        $xslDoc->load('scripts/xsl/carte.xsl');
    else
        $xslDoc->load('../xsl/carte.xsl');

    //Récupération du doc xml
    $res = $controleur->recuperationCarte($controleur->getCarte()->getId());
    //si la carte est correctement générée
    if ($res)
    {
        $xmlDoc = new DOMDocument();
        $xmlDoc = simplexml_load_string($controleur->getCarte()->getXml_doc());
        //$xmlDoc = simplexml_load_string($controleur->recup_carte($_SESSION['carte']['id']));
        //$xmlDoc = new DOMDocument();
        //$xmlDoc->load('test/test.xml');

        //Application du doc xsl
        $proc = new XSLTProcessor();
        $proc->importStylesheet($xslDoc);

        //Transformation et affichage
        echo $proc->transformToXml($xmlDoc);
    }
    else
        echo 'erreur';
?>