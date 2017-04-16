<?php

    /**
     * Connexion à la BDD
     */
    function connexion()
    {
        try{
            $bdd = new PDO('mysql:host=172.31.21.41;dbname=lr206974;charset=utf8', 'lr206974', 'lr206974');
            return $bdd;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
?>