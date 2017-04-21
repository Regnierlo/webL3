<?php
    function creerInsert($table, $champsOuAjouter, $valeursAAjouter)
    {
        //Récuèpere la taille des tableaux des champs et des valeurs
        $sizeChamps = count($champsOuAjouter);
        $sizeVal = count($valeursAAjouter);

        //Vérifie que les tailles sont identiques et supérieurs à 0
        if ($sizeChamps == $sizeVal && $sizeVal > 0) {
            try {
                //connexion
                $bd = new PDO('mysql:host=172.31.21.41;dbname=lr206974;charset=utf8', 'lr206974', 'lr206974');

                //Début de l'écriture de la requete
                $requete = "INSERT INTO " . $table . " (";

                //Pour tous les champs du tableau, on les ajoute à la requete les champs qui auront un ajout
                for ($i = 0; $i < $sizeChamps; $i++) {
                    $requete .= $champsOuAjouter[$i];

                    //Ajoute une "," si il reste des champs à ajouter ou un ') ' si c'est fini
                    if ($i + 1 < $sizeChamps)
                        $requete .= ",";
                    else
                        $requete .= ') ';
                }

                //On continue de préparer la requête avec les valeurs
                $requete.="VALUES ('";

                for($i=0;$i<$sizeVal;$i++)
                {
                    //On ajoute les valeurs de chaque champs
                    $requete.=$valeursAAjouter[$i]."'";

                    if($i+1<$sizeVal)
                        $requete.=",'";
                    else
                        $requete.=');';

                }
                echo $requete;
                //Execution de la requete
                $bd->query($requete);

            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        } else {
            die('Erreur : taille des tableaux des champs et des nouvelles valeurs différentes');
        }
    }
?>