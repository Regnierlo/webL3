<!-- contrôleur inclu -->
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

    function creationCarte()
    {
        return true;
    }

    function recuperationCartesPrivees()
    {
        $cartes = array();
        $cartes[0] = array("Nom" => "toto", "Id" => 8);
        return $cartes;
    }

    function recuperationCartesPartagees($role)
    {
        $cartes = array();
        //on passe le role recherché en paramètre, je ferai plusieurs appels…
            /*if ($role == $roles['Admin'])
            {
                $cartes[0] = array("Nom" => "toto", "Id" => 0);
                $cartes[1] = array("Nom" => "toto", "Id" => 15);
            }
            else if ($role == $roles['Editeur'])
            {
                $cartes[0] = array("Nom" => "toto", "Id" => 1);
                $cartes[1] = array("Nom" => "toto", "Id" => 2);
                $cartes[2] = array("Nom" => "toto", "Id" => 3);
            }
            else if ($role == $roles['Consultant'])
            {
                $cartes[0] = array("Nom" => "toto", "Id" => 4);
                $cartes[1] = array("Nom" => "toto", "Id" => 5);
                $cartes[2] = array("Nom" => "toto", "Id" => 6);
                $cartes[3] = array("Nom" => "toto", "Id" => 7);
            }*/
        //ou on les retourne toutes et je gère avec
        //d’ailleurs ce serait bien que le tableau soit indicé par id
            $cartes['elt4'] = array("Nom" => "toto", /*"Id" => 4,*/ "Role" => /*$roles['Admin']*/ 0);
            $cartes['elt5'] = array("Nom" => "tata", /*"Id" => 5,*/ "Role" => /*$roles['Editeur']*/ 1);
            $cartes['elt6'] = array("Nom" => "titi", /*"Id" => 6,*/ "Role" => /*$roles['Consultant']*/ 2);

        return $cartes;
    }

    function recuperationCartesPubliques()
    {
        $cartes = array();
        $cartes[0] = array("Nom" => "titi1", "Id" => 7);
        $cartes[1] = array("Nom" => "tata2", "Id" => 8);
        $cartes[2] = array("Nom" => "toto3", "Id" => 15);
        $cartes[3] = array("Nom" => "titi4", "Id" => 7);
        $cartes[4] = array("Nom" => "tata5", "Id" => 8);
        $cartes[5] = array("Nom" => "toto6", "Id" => 15);
        $cartes[6] = array("Nom" => "titi7", "Id" => 7);
        $cartes[7] = array("Nom" => "tata8", "Id" => 8);
        $cartes[8] = array("Nom" => "toto9", "Id" => 15);
        $cartes[9] = array("Nom" => "tata10", "Id" => 8);
        $cartes[10] = array("Nom" => "toto11", "Id" => 15);
        $cartes[11] = array("Nom" => "titi12", "Id" => 7);
        $cartes[12] = array("Nom" => "tata13", "Id" => 8);
        $cartes[13] = array("Nom" => "toto14", "Id" => 15);
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
                        <elt id="elt7" valeur="sujet7"/>
                    </elt>
                </elt>';
    }
?>
