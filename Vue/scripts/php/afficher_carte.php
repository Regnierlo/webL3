<!--utilise l’identifiant de la carte pour la récupérer et la transformer à l’aide du script carte.xsl-->

<?php
    include "$adresse_controleur";

    $xslDoc = new DOMDocument();
    $xslDoc->load("scripts/xsl/carte.xsl");

    $xmlDoc = simplexml_load_string(recup_carte($_SESSION['carte']['id']));
    //$xmlDoc = new DOMDocument();
    //$xmlDoc->load('test/test.xml');

    $proc = new XSLTProcessor();
    $proc->importStylesheet($xslDoc);

    echo $proc->transformToXML($xmlDoc);
?>