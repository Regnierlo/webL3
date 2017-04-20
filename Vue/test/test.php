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
        $cartes[0] = 8;
        return $cartes;
    }

    function recup_cartes_partagees($pseudo, $role)
    {
        $cartes = array();
        if ($role == $roles['Admin'])
        {
            $cartes[0] = 0;
            $cartes[1] = 15;
        }
        else if ($role == $roles['Editeur'])
        {
            $cartes[0] = 1;
            $cartes[1] = 2;
            $cartes[2] = 3;
        }
        else if ($role == $roles['Consultant'])
        {
            $cartes[0] = 4;
            $cartes[1] = 5;
            $cartes[2] = 6;
            $cartes[3] = 7;
        }
        return $cartes;
    }

    function recup_cartes_publiques()
    {
        $cartes = array();
        $cartes[0] = 7;
        $cartes[1] = 8;
        $cartes[2] = 15;
        return $cartes;
    }

    function recup_carte($id)
    {
        $contenu = array('elt1' => array('elt2', 'elt3' => array('elt4', 'elt5'), 'elt6'));
        $admin = 'pseudo';
        $editeurs = array('pseudo1', 'pseudo2', 'pseudo3');
        $consultants = array('pseudo4', 'pseudo5', 'pseudo6');
        return array($contenu, $admin, $editeurs, $consultants);
    }
