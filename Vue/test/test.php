<?php

    function connecter($pseudo, $mdp)
    {
        return false;
    }

    function creer_compte($pseudo, $mdp, $prenom, $nom, $email)
    {
        return true;
    }

    function recup_donnees($pseudo)
    {
        return array('pseudo' => 'toto', 'prenom' => 'tata', 'nom' => 'titi', 'email' => 'toto@mail.com');
    }

    function recup_cartes_privees($pseudo)
    {
        $cartes = array();
        $cartes[0] = array("Nom" => "toto", "Id" => 8);
        return $cartes;
    }

    function recup_cartes_partagees($pseudo, $role)
    {
        $cartes = array();
        if ($role == $roles['Admin'])
        {
            $cartes[0] = array("Nom" => "toto", "Id" => 0);
            $cartes[1] = array("Nom" => "toto", "Id" => 15);;
        }
        else if ($role == $roles['Editeur'])
        {
            $cartes[0] = array("Nom" => "toto", "Id" => 1);;
            $cartes[1] = array("Nom" => "toto", "Id" => 2);;
            $cartes[2] = array("Nom" => "toto", "Id" => 3);;
        }
        else if ($role == $roles['Consultant'])
        {
            $cartes[0] = array("Nom" => "toto", "Id" => 4);;
            $cartes[1] = array("Nom" => "toto", "Id" => 5);;
            $cartes[2] = array("Nom" => "toto", "Id" => 6);;
            $cartes[3] = array("Nom" => "toto", "Id" => 7);;
        }
        return $cartes;
    }

    function recup_cartes_publiques()
    {
        $cartes = array();
        $cartes[0] = array("Nom" => "toto", "Id" => 7);;
        $cartes[1] = array("Nom" => "toto", "Id" => 8);;
        $cartes[2] = array("Nom" => "toto", "Id" => 15);;
        return $cartes;
    }

    function recup_données_carte($id)
    {
        $admin = 'pseudo';
        $editeurs = array('pseudo1', 'pseudo2', 'pseudo3');
        $consultants = array('pseudo4', 'pseudo5', 'pseudo6');
        return array($admin, $editeurs, $consultants);
    }

    function recup_carte($id)
    {
        return '<?xml version="1.0"?>
                <elt id="elt1" valeur="sujet1">
                    <elt id="elt2" valeur="sujet2"/>
                    <elt id="elt3" valeur="sujet3">
                        <elt id="elt4" valeur="sujet4"/>
                        <elt id="elt5" valeur="sujet5"/>
                        <elt id="elt6" valeur="sujet6"/>
                    </elt>
                </elt>';
    }
?>
