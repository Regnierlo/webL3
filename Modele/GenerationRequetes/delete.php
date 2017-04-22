<?php
    /**
     * Créer une requete de suppression
     *
     * @param $table Table qui va subir la suppression
     * @param $condition Condition de suppression
     */
    function creerDelete($table, $condition)
    {
        try {
            //connexion
            $bd = new PDO('mysql:host=172.31.21.41;dbname=lr206974;charset=utf8', 'lr206974', 'lr206974');

            //Ecriture de la requete
            $requete = "DELETE FROM " . $table . " WHERE " . $condition.";";


            //Execution de la requete
            $bd->query($requete);

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
?>