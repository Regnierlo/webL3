<?php
	$pre = '';
	while (!file_exists($pre.'../Modele/Carte.php'))
		$pre = $pre.'../';

	require ($pre.'../Modele/Carte.php');
	require ($pre.'../Modele/Compte.php');
	require ($pre.'../Modele/Element.php');
	require ($pre.'../Modele/GenerationRequetes/select.php');
	require ($pre.'../Modele/GenerationRequetes/delete.php');
	require ($pre.'../Modele/GenerationRequetes/insert.php');
	require ($pre.'../Modele/GenerationRequetes/update.php');
	
	class Controller
	{
		private $compte;
		private $carte;
		private $listeCartesPriv;
		private $listeCartesPart;
		private $listeCartePub;
		
		public function __construct()
		{
			$this->compte=null;
			$this->carte=  new Carte(null,null,null,null,null,null,null,null,null,null,null);
			$this->listeCartesPriv=null;
			$this->listeCartesPart=null;
			$this->listeCartePub=null;			
		}
		//Getter
		public function getCompte()
		{
		    return $this->compte;
		}
		
		public function getCarte()
		{
		    return $this->carte;
		}
		
		public function getListeCartesPriv()
		{
		    return $this->listeCartesPriv;
		}
	
		public function getListeCartesPart()
		{
		    return $this->listeCartesPart;
		}
		
		public function getListeCartesPub()
		{
		    return $this->listeCartesPub;
		}
		
		public function inscription($pseudo, $mdp, $prenom, $nom, $email)
		{
			//On verifie que le pseudo n'existe pas déjà dans la table Compte
			//Retourne vrai, si c'est bon
			if(creerRequeteAvecWhere(array("login"), "COMPTE" , "login = '".$pseudo."'")=='')
			{
				$date=date("Y-m-d H:i:s");
				$COA = array ('login','mdp','mail','nom','prenom','dateCreation');
				$VAA = array ($pseudo, $mdp, $email, $nom, $prenom, $date);
				creerInsert("COMPTE",$COA,$VAA);
				$this->compte = new Compte($pseudo, $nom, $prenom, $email, $date);
				return true;
			}	
			//Retourne faux, si il y a un probleme
			else
			{
				return false;
			}
		}
		
		public function connexion($pseudo, $mdp)
		{
			$res = creerRequeteAvecWhere(array("login","mail","nom","prenom","dateCreation"), "COMPTE", "login ='".$pseudo."' AND mdp='".$mdp."'");
			//Retourne vrai, si le compte existe et le mot de passe correspond
			if($res!='')
			{
				$tab = array();
				$val ="";
				for ($i=0;$i<strlen($res);$i++)
				{
					if ($res[$i] == "|")
					{
						array_push($tab,$val);
						$val ="";
					}
					else
					{
						$val = $val."".$res[$i];
					}
				}
				//$prenom,$nom, $email et $date de création seront récuperer depuis la table Compte
				$this->compte= new Compte($tab[0], $tab[2], $tab[3], $mdp, $tab[1], $tab[4]);
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function recuperationCarte($idCarte)
		{
			//On verifie si la carte existe dans la table Carte
			$res = creerRequeteAvecWhere(array('nomCarte','dateCreation','derniereModification','Accessibilite'), "CARTE", "idCarte=".$idCarte);
			//On retourne le fichier XML, Si la carte existe, on retourne le fichier XML, l'administrateur, le nom, les editeurs, les consultants, publique.
			if($res <> "")
			{
				$tab = $this->requeteDansTableau($res);
				$req = creerRequeteAvecWhere(array("idElement","nomElement","valeurElement","idElementPere","racine"),"ELEMENT","idCarteElement = ".$idCarte);
               			$xml = new DOMDocument("1.0","utf-8");
				$racine=0;
				//Si la carte contient des elements
               			if ($req <> "")
				{
					$tableau = $this->requeteDansTableau($req);
					for ($i=0;$i<count($tableau);$i++)
					{
						if ($tableau[$i][4]=="Administrateur")
						{
							$racine = $tableau[$i][0];
							$tmp = $xml->createElement("element");
							$attr = $xml->createAttribute('id');
							$attr->value = $tableau[$i][0];
							$attr3 = $xml->createAttribute('nom');
							$attr3->value = $tableau[$i][1];
							$attr2 = $xml->createAttribute('valeur');
							$attr2->value = $tableau[$i][2];
							$tmp -> appendChild($attr);
							$tmp -> appendChild($attr3);							
							$tmp -> appendChild($attr2);							
							$xml->appendChild($tmp);
							$this->recursXml($tableau[$i][0],$tmp,$xml,$tableau);
						}
					}
				}
				$fichier_xml = $xml->saveXML();	
				$req3 = creerRequeteAvecWhere(array("login","nomGroupe"),"v_LISTE_CARTE","idCarteListe = ".$idCarte);
				$listeE = array();
				$listeC = array();
				//Si le login existe
				if($req3 <>"")
				{	
					$listeLogin = $this->requeteDansTableau($req3);
					for ($i=0;$i<count($listeLogin);$i++) //Affectation des logins aux différentes listes
						if ($listeLogin[$i][1] == "Editeur")
							array_push($listeE,$listeLogin[$i][0]);
						else if($listeLogin[$i][1] == "Consultant")
							array_push($listeC,$listeLogin[$i][0]);
					$admin = $this->requeteDansTableau(creerRequeteAvecWhere(array("login"),"v_LISTE_CARTE", "idCarteListe =".$idCarte." AND nomGroupe = \"Administrateur\""));
				}
				$this->carte = new Carte($idCarte, $tab[0][0], $tab[0][1], $tab[0][2], $tab[0][3],count($tableau), $fichier_xml,  $racine, $admin[0][0], $listeE, $listeC);
				return true;
			}
			//On retoune faux, si la carte n'existe pas
			else
			{
				return false;
			}

		}
		
		
		public function recursXml($pere,$perebis,$xml,$tableau)
		{
			for ($i=0;$i<count($tableau);$i++)
			{
				if ($tableau[$i][3]==$pere)
				{
					$tmp = $xml->createElement("element");
					$attr = $xml->createAttribute('id');
					$attr->value = $tableau[$i][0];
					$attr3 = $xml->createAttribute('nom');
					$attr3->value = $tableau[$i][1];
					$attr2 = $xml->createAttribute('valeur');
					$attr2->value = $tableau[$i][2];
					$attr4 = $xml->createAttribute('idPere');
					$attr4->value = $tableau[$i][3];
					$tmp -> appendChild($attr);
					$tmp -> appendChild($attr4);					
					$tmp -> appendChild($attr3);							
					$tmp -> appendChild($attr2);
					$perebis->appendChild($tmp);
					$this->recursXml($tableau[$i][0],$tmp,$xml,$tableau);
					
				}
			}
		}
		
		public function recuperationCartesPrivees($pseudo)
		{
			$res = creerRequeteAvecWhere(array("idCarte","nomCarte"),"v_CARTE","login ='".$pseudo."' AND accessibilite = 'Prive'");
			$resTab=explode("|",$res);
			//On vérifie si le pseudo possede des cartes privées
			//Si c'est bon, on stocke les id et les noms des cartes
			if($res!= "")
			{
				$tab = array();
				for ($i=0;$i<count($resTab)-1;$i=$i+2)
				{
					$tab[] = array('Id' => $resTab[$i], 'Nom' => $resTab[$i+1]);
				}
				$this->listeCartesPriv;
				return $tab;
			}
			//On retoune faux, si le pseudo n'a aucune carte privée ou si le pseudo est mauvais
			else
			{
				return false;
			}
		}
		
		public function recuperationCartesPartagees($pseudo)
		{
			$res = creerRequeteAvecWhere(array("idCarte","nomCarte"),"v_CARTE","login ='".$pseudo."' AND accessibilite = 'Partage'");
			var_dump($res);
			$resTab=explode("|",$res);
			//On vérifie si le pseudo possede des cartes partagées
			//Si c'est bon, on stocke les id et les noms des cartes
			
			if($res!= "")
			{
				$tab = array();
				for ($i=0;$i<count($resTab)-1;$i=$i+2)
				{
					$tab[] = array('Id' => $resTab[$i], 'Nom' => $resTab[$i+1]);
				}
				$this->listeCartesPart;
				return $tab;
			}
			//On retoune faux, si le pseudo n'a aucune carte partagée ou si le pseudo est mauvais
			else
			{
				return false;
			}
		
		}
		
		public function recuperationCartesPubliques()
		{
			$res = creerRequeteAvecWhere(array("idCarte","nomCarte"),"v_CARTE","accessibilite = 'Public'");
			$resTab=explode("|",$res);
			//On vérifie si il y a des cartes publiques
			//Si c'est bon, on stocke les id et les noms des cartes
			
			if($res!= "")
			{
				$tab = array();
				for ($i=0;$i<count($resTab)-1;$i=$i+2)
				{
					$tab[] = array('Id' => $resTab[$i], 'Nom' => $resTab[$i+1]);
				}
				$this->listeCartePub;
				return $tab;
			}
			//On retoune faux, si le pseudo n'a aucune carte partagée ou si le pseudo est mauvais
			else
			{
				return false;
			}
		}
		
		public function creationCarte($nom,$accessibilite)
		{
			if($this->compte != null)
			{
				insertNewCarte($nom,$accessibilite,$this->compte->getLogin());
				$idC=explode("|",(creerRequeteAvecWhere(array("idCarteListe"),"v_LISTE_CARTE", "login='".$this->compte->getLogin()."' ORDER BY idCarteListe DESC LIMIT 1")));
				$this->recuperationCarte($idC[0]);
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function renommerCarte($idCarte, $nNom)
		{
			
			//Si le pseudo est celui de l'admin
			if($this->carte->getAdmin()==$this->compte->getLogin() && creerRequeteAvecWhere(array("idCarte"), "CARTE" , "idCarte=".$idCarte)!="")
			{
				creerUpdate("CARTE", "nomCarte", $nNom, "idCarte=".$idCarte);
				$this->carte->setNom($nNom);
				return true;
			}
			//Si le pseudo n'est pas celui de l'admin ou si la carte n'existe pas
			else
			{
				return false;
			}
		}
			
		public function supprimerCarte($idCarte)
		{
			//On verifie que la carte existe dans la table Carte et que c'est bien l'Administrateur qui la supprime
			//Si c'est bon, on supprime la carte de la table Carte et on vide $carte
			//On supprime aussi tous les elements liés à ce compte.
			if($this->carte->getAdmin()==$this->compte->getPseudo() && creerRequeteAvecWhere("idCarte", "CARTE" , "idCarte=".$idCarte)!='')
			{
				supprimerElement($this->carte->getRacine);
				creerDelete("LISTE_CARTE", "idCarte=".$idCarte);
				creerDelete("CARTE", "idCarte=".$idCarte);
				$this->carte=null;
				return true;
			}
			//Sinon retourne faux
			else
			{
				return false;
			}
		}
		
		public function modifierRole($idCarte, $pseudo, $role)
		{
			$res = creerRequeteAvecWhere("idCompte", "COMPTE", "login ='".$pseudo."'");
			//Role : Consultant (ajout à la liste des consultants), Editeur (ajout à la liste des editeurs), Aucun (retire le pseudo de la liste des Editeurs et des Consultants)
			//On verifie que la carte et le pseudo existent et que c'est l'Administrateur qui modifie les droits
			//Si c'est bon, on ajoute le pseudo à la liste correspondante : Consultant, Editeur 
			if($this->compte->getPseudo()==$this->carte->getAdmin() && $this->carte->getAdmin()!=$pseudo && $res!='')
			{
				if($role=='Consultant')
				{
					$COA = array ("idCarteListe","idCompteListe","nomGroupe");
					$VAA = array ($idCarte, $res, $role);
					creerDelete("LISTE_CARTE","idCompteListe =".$res);
					creerInsert("LISTE_CARTE", $COA, $VAA);
					$this->carte->addListeConsultants($pseudo);
					$this->carte->remListeEditeurs($pseudo);
					return true;
				}
				else if($role=='Editeur')
				{
					$COA = array ("idCarteListe","idCompteListe","nomGroupe");
					$VAA = array ($idCarte, $res, $role);
					creerDelete("LISTE_CARTE","idCompteListe =".$res);
					creerInsert("LISTE_CARTE", $COA, $VAA);
					$this->carte->addListeEditeurs($pseudo);
					$this->carte->remListeConsultants($pseudo);
					return true;
				}
				else if($role=='Aucun')
				{
					creerDelete("LISTE_CARTE","idCompteListe =".$res);
					$this->carte->remListeConsultants($pseudo);
					$this->carte->remListeEditeurs($pseudo);
					return true;
				}
				else
				{
					return false;
				}
			}
			//Si la carte, le pseudo, le role est incorrecte ou si on n'est pas administrateur de la carte
			else
			{
				return false;
			}
		}
		
		public function modifierPublique($idCarte,$publique)
		{
			//On verifie si la carte existe dans la table Carte
			//Si c'est bon on affecte la nouvelle valeur
			if($this->carte->getAdmin()==$this->compte->getPseudo() && creerRequeteAvecWhere("idCarte", "CARTE" , "idCarte=".$idCarte)!='' && ($publique=="Public" || $publique=="Prive" || $publique=="Partage"))
			{
				creerUpdate("CARTE", "accessibilite", $publique, "idCarte=".$idCarte);
				$this->carte->setPublique($publique);
			}
			//Sinon on retourne faux
			else
			{
				return false;
			}
		}
		
		public function sauvegarderCarte()
		{

			$req = creerRequeteAvecWhere(array("idCarte"),"CARTE","idCarte =".$this->carte->getId());
            if($req == "")
            {
				creerInsert("CARTE", array ("nomCarte","accessibilite"),array($this->carte->getNom(),$this->carte->getPublique()));
            }
            else
			{
                creerUpdate("CARTE", array("nomCarte","accessibilite"), array($this->carte->getNom(),$this->carte->getPublique()), "idCarte=" . $this->carte->getId()); 
            }

			$dom = new DOMDocument( "1.0", "ISO-8859-15" );
			$dom->loadXML($this->carte->getXml_doc()); 

			$listeElt = $dom->getElementsByTagName("element");
			$tabDonnees = array();
			$tmp = array();
			

			foreach ($listeElt as $e) {
				array_push($tmp, $e->getAttribute("id"));
				array_push($tmp, $e->getAttribute("nom"));
				array_push($tmp, $e->getAttribute("valeur"));
				array_push($tmp, $e->getAttribute("idPere"));
				array_push($tabDonnees, $tmp);
				$tmp = array();
			}


			for ($i = 0; $i < count($tabDonnees); $i++) 
			{
				if (creerRequeteAvecWhere(array("idElement"), "ELEMENT", "idElement=" . $tabDonnees[$i][0]) == "")
				{
					if ($i == 0)
						creerInsert("ELEMENT", array("idCarteElement", "nomElement", "valeurElement", "idElementPere",  "racine"), array($this->carte->getId(), $tabDonnees[$i][1], $tabDonnees[$i][2], $tabDonnees[$i][3], " ", "Administrateur"));
					else
						creerInsert("ELEMENT", array("idCarteElement", "nomElement", "valeurElement", "idElementPere", "valeurEntreBalise", "racine"), array($this->carte->getId(), $tabDonnees[$i][1], $tabDonnees[$i][2], $tabDonnees[$i][3], NULL));
				}
				else
				{
					if ($i == 0)	
						$racine = "Administrateur";
					else
						$racine = NULL;
					creerUpdate("ELEMENT",array("nomElement", "valeurElement", "idElementPere",  "racine"),array($tabDonnees[$i][1], $tabDonnees[$i][2], $tabDonnees[$i][3],  $racine),"idElement =".$tabDonnees[$i][0]);
				}
			}
			
			$lC = $this->carte->getListeConsultant();
			$lE = $this->carte->getListeEditeur();
			
			for ($i = 0; $i < count($lC);$i++)
			{
				if (creerRequeteAvecWhere(array("nomGroupe"), "v_LISTE_CARTE", "login = \"" .$lC[$i]."\" AND idCarteListe = ".$this->carte->getId()) == "")
					creerInsert("LISTE_CARTE", array("idCarteListe", "idCompteListe", "nomGroupe"), array($this->carte->getId(),$lC[$i],"Consultant"));
				else 
				{
					$idCompte = $this->requeteDansTableau(creerRequeteAvecWhere(array("idCompte"), "COMPTE", "login = \"".$lC[$i]."\""));
					creerUpdate("LISTE_CARTE",array("nomGroupe"),array("Consultant")," idCarteListe=".$this->carte->getId()."AND idCompteListe = ".$idCompte[0][0]);
				}
			}
			
			
			
			for ($i = 0; $i < count($lE);$i++)
			{
				if (creerRequeteAvecWhere(array("nomGroupe"), "v_LISTE_CARTE", "login = \"" .$lE[$i]."\" AND idCarteListe = ".$this->carte->getId()) == "")
					creerInsert("LISTE_CARTE", array("idCarteListe", "idCompteListe", "nomGroupe"), array($this->carte->getId(),$lE[$i],"Consultant"));
				else 
				{
					$idCompte = $this->requeteDansTableau(creerRequeteAvecWhere(array("idCompte"), "COMPTE", "login = \"".$lE[$i]."\""));
					creerUpdate("LISTE_CARTE",array("nomGroupe"),array("Consultant")," idCarteListe=".$this->carte->getId()."AND idCompteListe = ".$idCompte[0][0]);
				}
			}



		}


		public function requeteDansTableau($chaine)
		{
			$tab = array();
			$n = array();
		    $val ="";

		    for ($i=0;$i<strlen($chaine);$i++)
		    {

				if($chaine[$i] == "<")
				{
					array_push($tab,$val);
					array_push($n,$tab);
					$tab = array();
					$val = "";
					$i = $i + 4;
				}
		        else if ($chaine[$i] == "|")
		        {
		        	if ($val == "")
		        		array_push($tab,"null");
		        	else
		            	array_push($tab,$val);
		            $val ="";
		        }
		        else
		        {
		            $val = $val.$chaine[$i];

		        }
		    }
		    if ($val == "")
        		array_push($tab,"null");
		else
            	array_push($tab,$val);
		    array_push($n,$tab);
		    return $n;
		}

		/*public function ajouterElement($nom, $valeur,$idPere)
		{
			//Si le pere existe
			if(creerRequeteAvecWhere(array("idElement"), "ELEMENT" , "idElement = ".$idPere)!='')
			{
				$COA = array ("idCarteElement","nomElement","valeurElement","idElementPere");
				$VAA = array ($this->carte->getId(), $nom, $valeur, $idPere);
				creerInsert("ELEMENT",$COA,$VAA);
				$idC=substr(creerRequeteAvecWhere(array("idElement"),"ELEMENT", "idCarteElement=".$this->carte->getId()." ORDER BY idElement DESC LIMIT 1"),0,-1);
				$tmp = $xml->createElement("element");
			
				$attr = $xml->createAttribute('id');
				$attr->value = $idC;
				$attr2 = $xml->createAttribute('nom');
				$attr2->value = $nom;
				$attr3 = $xml->createAttribute('valeur');
				$attr3->value = $valeur;
			
				$tmp -> appendChild($attr);							
				$tmp -> appendChild($attr2);
				$tmp -> appendChild($attr3);	
			
				$element = $this->carte->getXml_doc()->getElementById($idPere);
				$element->appendChild($tmp);	
				return true;
			}
			//Si le pere n'existe pas
			else
			{
				return false;
			}
					
		}*/
		
		public function modifierValeurElement($idElt,$newValeur)
		{
			//Si l'element existe
			if(creerRequeteAvecWhere(array("idElement"), "ELEMENT" , "idElement = ".$idElt)!='')
			{
				creerUpdate("ELEMENT", "valeurElement", $newValeur, "idElement=".$idElt);
				$element = $this->carte->getXml_doc()->getElementById($idElt);
				$element->setAttribute("valeur", $newValeur); 
				return true;
			}
			//Si l'element n'existe pas
			else
			{
				return false;
			}
		}
		
		public function modifierPlaceElement($idElt,$idNewPere)
		{
			//Si l'element existe
			if(creerRequeteAvecWhere(array("idElement"), "ELEMENT" , "idElement = ".$idElt)!='')
			{
				$element = $this->carte->getXml_doc()->getElementById($idElt);
				$element->parentNode->removeChild($element);
				$this->carte->getXml_doc()->getElementById($idNewPere)->appendChild($element);
				return true;
			}
			//Si l'element n'existe pas
			else
			{
				return false;
			}
		}
		
		public function supprimerElement($idElt)
		{
			//Si l'element existe
			if(creerRequeteAvecWhere(array("idElement"), "ELEMENT" , "idElement = ".$idElt)!='')
			{			
				$element = $this->carte->getXml_doc()->getElementById($idElt);
				while($element->firstChild!=null)
				{
					$firstC=$element->item(0);
					creerDelete("ELEMENT", "idElement=".$firstC->getAttribute('id'));
					supprimerElement($firstC->getAttribute('id'));
				    	$element->removeChild($firstC);
				}
				return true;
			}
			//Si l'element n'existe pas
			else
			{
				return false;
			}
		}
		
		
		
		
	}


	
	//$t = new Controller();
	//$t->connexion("Didier", "Jean");
	//$t->creationCarte("Macarte","Prive");
	//echo $t->getCarte()->getId();
	//$t->sauvegarderCarte();
	//$t->recuperationCartesPrivees("Didier");
	//echo "fin";
	

//	$testing->test();
	//echo $testing->inscription('Didier', 'Jean', 'D', 'J', 'J@D');
	//echo $testing->connexion("Didier","Jean");
	//echo $testing->recuperationCartesPrivees("tes04t");
	//echo $testing->recuperationCartesPartagees("test");
	//echo $testing->recuperationCartesPubliques();
	//--------------------------------------echo $testing->creationCarte("Carte2");
	//echo $testing->renommerCarte(34, "LaCarte");
	//echo 'coucou';
?>
