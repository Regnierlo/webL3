<!--utilise l’identifiant de la carte pour la récupérer et la transformer à l’aide du script carte.xsl-->

<?php
    $placement = 'Vue';
    if (file_exists('config/config.php'))
    {
        include 'config/config.php';
        include "$adresse_controleur";
    }
    else
    {
        $placement = 'php';
        include '../../config/config.php';
        include "../../$adresse_controleur";
    }

    //Récupération du doc xsl
    $xslDoc = new DOMDocument();
    if ($placement == 'Vue')
        $xslDoc->load('scripts/xsl/carte.xsl');
    else
        $xslDoc->load('../xsl/carte.xsl');

    //Récupération du doc xml
    $xmlDoc = simplexml_load_string(recup_carte($_SESSION['carte']['id']));
    //$xmlDoc = new DOMDocument();
    //$xmlDoc->load('test/test.xml');

    //Application du doc xsl
    $proc = new XSLTProcessor();
    $proc->importStylesheet($xslDoc);

    //Transformation et affichage
    echo $proc->transformToXML($xmlDoc);
?>