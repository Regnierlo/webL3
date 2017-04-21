<?php
    include "$adresse_controleur";

    //récupération des cartes
    $cartes = recuperationCartesPubliques();

    foreach ($cartes as $carte)
    {
        print '<form method="'.$type_requete.'" action="carte.php">';
        print   '<input type="hidden" name="nom_carte" value="'.$carte["Nom"].'"/>';
        print   '<input type="hidden" name="carte" value="'.$carte["Id"].'"/>';
        print   '<input class="champ carte-listee gauche arrondi fond-violet" type="submit" value="'.$carte["Nom"].'"/>';
        print '</form>';
    }
?>

