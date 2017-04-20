<?php

    /**
     * Génération de la requête de sélection (SELECT) AVEC une condition (WHERE)
     *
     * @param $selection Tableau contenant la liste de la sélection. Pas de '*' !!!
     * @param $fromTable Nom de la table sélectionnée
     * @param $whereCondition String contenant la condition. Pas de 'WHERE'. Uniquement ce qu'il y a après.
     * @return Retourne une string qui est le résultat de la requête.
     *
     * @exemple $arraySelec=array("NomGroupe","Droit");<br/>creerRequeteAvecWhere($arraySelec,'DROIT_GROUPE',"NomGroupe='Administrateur'");
     */
    function creerRequeteAvecWhere($selection, $fromTable, $whereCondition)
    {
        if($selection == '*')//Vérifie si la sélection n'est pas une étoile
        {
            die('Erreur : lister les colonnes de sélection. Pas de "*".');
        }
        else {
            try {
                //connexion
                $bd = new PDO('mysql:host=172.31.21.41;dbname=lr206974;charset=utf8', 'lr206974', 'lr206974');

                //Préparation de la requete

                $selectTotal = ""; //initialisation de la chaine de selection
                $size=count($selection); //Calcul du nombre de champ à récupérer

                //Récupération des champs
                for($i=0;$i<$size;$i++)
                {
                    $selectTotal.=$selection[$i];//Ajout des champs dans la chaine de sélection
                    if($i+1 < $size)
                        $selectTotal.=', '; //S'il reste encore des champs à récupérer on ajoute une virgule
                    else
                        $selectTotal.=' ';//Sinon un espace
                }

                //Création de la requete
                $requete = 'SELECT ' . $selectTotal . ' FROM ' . $fromTable . ' WHERE '.$whereCondition.';';

                //Lancement de la reqête
                $reponse = $bd->query($requete);

                //Initialisation de la chaine résultante (celle retournée)
                $res='';

                //Tant qu'il reste des réponses
                while ($donees = $reponse->fetch()) {
                    //Pour tous les champs sélectionnés
                    for($i=0;$i<$size;$i++)
                        $res.=$donees[$selection[$i]].'|';//On ajoute le résultat du champs à la chaine résultante
                    $res.='<br/>';//On va a la ligne pour une nouvelle entrée (nouvelle ligne de la requete)
                }

                $reponse->closeCursor();//Fermeture du curseur de la requete
                return $res;//Retourne la chaine résultante
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }

    /**
     * Génération de la requête de sélection (SELECT) SANS condition (WHERE)
     *
     * @param $selection Tableau contenant la liste de la sélection. Pas de '*' !!!
     * @param $fromTable Nom de la table sélectionnée
     * @return Retourne une string qui est le résultat de la requête.
     *
     * @exemple $arraySelec=array("NomGroupe","Droit");<br/>creerRequete($arraySelec,'DROIT_GROUPE');
     */
    function creerRequete($selection, $fromTable)
    {
        if($selection == '*')
        {
            die('Erreur : lister les colonnes de sélection. Pas de "*".');
        }
        else {
            try {
                //connexion
                $bd = new PDO('mysql:host=172.31.21.41;dbname=lr206974;charset=utf8', 'lr206974', 'lr206974');

                //Préparation de la requete

                $selectTotal = ""; //initialisation de la chaine de selection
                $size=count($selection); //Calcul du nombre de champ à récupérer

                //Récupération des champs
                for($i=0;$i<$size;$i++)
                {
                    $selectTotal.=$selection[$i];//Ajout des champs dans la chaine de sélection
                    if($i+1 < $size)
                        $selectTotal.=', '; //S'il reste encore des champs à récupérer on ajoute une virgule
                    else
                        $selectTotal.=' ';//Sinon un espace
                }

                //Création de la requete
                $requete = 'SELECT ' . $selectTotal . ' FROM ' . $fromTable . ' ;';

                //Lancement de la reqête
                $reponse = $bd->query($requete);

                //Initialisation de la chaine résultante (celle retournée)
                $res='';

                //Tant qu'il reste des réponses
                while ($donees = $reponse->fetch()) {
                    //Pour tous les champs sélectionnés
                    for($i=0;$i<$size;$i++)
                        $res.=$donees[$selection[$i]].'|';//On ajoute le résultat du champs à la chaine résultante
                    $res.='<br/>';//On va a la ligne pour une nouvelle entrée (nouvelle ligne de la requete)
                }

                $reponse->closeCursor();//Fermeture du curseur de la requete
                return $res;//Retourne la chaine résultante
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }
?>