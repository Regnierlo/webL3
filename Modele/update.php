<?php
    function creerUpdate($table, $champsAMettreAJour, $nouvellesValeurs,$clauseWhere)
    {

        echo "champsAMettreAJour : ".$champsAMettreAJour[0]."<br/>";
        echo "nouvellesValeurs : ".$nouvellesValeurs[0]."<br/>";

        $sizeChamps = count($champsAMettreAJour);
        $sizeNVal = count($nouvellesValeurs);

        if($sizeChamps==$sizeNVal && $sizeNVal>0)
        {
            try {
                //connexion
                $bd = new PDO('mysql:host=172.31.21.41;dbname=lr206974;charset=utf8', 'lr206974', 'lr206974');

                $requete = "UPDATE " . $table . " SET ";

                for($i=0;$i<$sizeChamps;$i++)
                {
                    $requete.=$champsAMettreAJour[$i]."='".$nouvellesValeurs[$i]."'";
                    if($i+1<$sizeChamps)
                        $requete.=',';
                    else
                        $requete.=' ';
                }

                $requete.=" WHERE ".$clauseWhere.";";
                echo $requete;
                $bd->query($requete);

            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        else
        {
            die('Erreur : taille des tableaux des champs et des nouvelles valeurs différentes');
        }
    }

    function creerUpdateSansWhere($table, $champsAMettreAJour, $nouvellesValeurs)
    {

        echo "champsAMettreAJour : ".$champsAMettreAJour[0]."<br/>";
        echo "nouvellesValeurs : ".$nouvellesValeurs[0]."<br/>";

        $sizeChamps = count($champsAMettreAJour);
        $sizeNVal = count($nouvellesValeurs);

        if($sizeChamps==$sizeNVal && $sizeNVal>0)
        {
            try {
                //connexion
                $bd = new PDO('mysql:host=172.31.21.41;dbname=lr206974;charset=utf8', 'lr206974', 'lr206974');

                $requete = "UPDATE " . $table . " SET ";

                for($i=0;$i<$sizeChamps;$i++)
                {
                    $requete.=$champsAMettreAJour[$i]."='".$nouvellesValeurs[$i]."'";
                    if($i+1<$sizeChamps)
                        $requete.=',';
                    else
                        $requete.=' ';
                }

                echo $requete;
                $bd->query($requete);

            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        else
        {
            die('Erreur : taille des tableaux des champs et des nouvelles valeurs différentes');
        }
    }

    $arrayupdate = array("nom","prenom");
    $arrayNewVal = array("testNomSW","testPrenomSW");

    creerUpdateSansWhere("COMPTE",$arrayupdate,$arrayNewVal);
?>