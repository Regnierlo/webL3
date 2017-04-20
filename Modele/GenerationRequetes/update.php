<?php
    /**
     * Génère une requête de mis à jour (UPDATE) avec les paramètres passé en paramètres AVEC une clause WHERE
     *
     * @param $table Nom de la table à mettre à jour
     * @param $champsAMettreAJour Liste des champs à mettre à jour
     * @param $nouvellesValeurs Nouvelles valeurs des champs. Respecter l'ordre des champs !
     * @param $clauseWhere Clause WHERE mais sans le mot clé 'WHERE'
     *
     */
    function creerUpdate($table, $champsAMettreAJour, $nouvellesValeurs,$clauseWhere)
    {
        //Récuèpere la taille des tableaux des champs et des nouvelles valeurs
        $sizeChamps = count($champsAMettreAJour);
        $sizeNVal = count($nouvellesValeurs);

        //Vérifie que les tailles sont identiques et supérieurs à 0
        if($sizeChamps==$sizeNVal && $sizeNVal>0)
        {
            try {
                //connexion
                $bd = new PDO('mysql:host=172.31.21.41;dbname=lr206974;charset=utf8', 'lr206974', 'lr206974');

                //Début de l'écriture de la requete
                $requete = "UPDATE " . $table . " SET ";

                //Pour tous les champs du tableau, on les ajoute à la requete avec leurs nouvelles valeurs
                for($i=0;$i<$sizeChamps;$i++)
                {
                    $requete.=$champsAMettreAJour[$i]."='".$nouvellesValeurs[$i]."'";

                    //Ajoute une ',' si il reste des champs à mettre à jour ou un ' ' si c'est fini
                    if($i+1<$sizeChamps)
                        $requete.=',';
                    else
                        $requete.=' ';
                }

                //Rajout de la clause WHERE à la requete
                $requete.=" WHERE ".$clauseWhere.";";

                //Execution de la requete
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

    /**
     * Génère une requête de mis à jour (UPDATE) avec les paramètres passé en paramètres SANS la clause WHERE
     *
     * @param $table Nom de la table à mettre à jour
     * @param $champsAMettreAJour Liste des champs à mettre à jour
     * @param $nouvellesValeurs Nouvelles valeurs des champs. Respecter l'ordre des champs !
     *
     */
    function creerUpdateSansWhere($table, $champsAMettreAJour, $nouvellesValeurs)
    {
        //Récuèpere la taille des tableaux des champs et des nouvelles valeurs
        $sizeChamps = count($champsAMettreAJour);
        $sizeNVal = count($nouvellesValeurs);

        //Vérifie que les tailles sont identiques et supérieurs à 0
        if($sizeChamps==$sizeNVal && $sizeNVal>0)
        {
            try {
                //connexion
                $bd = new PDO('mysql:host=172.31.21.41;dbname=lr206974;charset=utf8', 'lr206974', 'lr206974');

                //Début de l'écriture de la requete
                $requete = "UPDATE " . $table . " SET ";

                //Pour tous les champs du tableau, on les ajoute à la requete avec leurs nouvelles valeurs
                for($i=0;$i<$sizeChamps;$i++)
                {
                    $requete.=$champsAMettreAJour[$i]."='".$nouvellesValeurs[$i]."'";

                    //Ajoute une ',' si il reste des champs à mettre à jour ou un ' ' si c'est fini
                    if($i+1<$sizeChamps)
                        $requete.=',';
                    else
                        $requete.=' ';
                }

                //Execution de la requete
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
?>