<?php
	require ('../Modele/Carte.php');
	require ('../Modele/Compte.php');
	require ('../Modele/Element.php');
	require ('../Modele/GenerationRequetes/select.php');
	require ('../Modele/GenerationRequetes/delete.php');
	require ('../Modele/GenerationRequetes/insert.php');
	require ('../Modele/GenerationRequetes/update.php');
	
	class Controller
	{
		private $compte;
		private $carte;
		private $listeCartesPriv;
		private $ListeCartesPart;
		private $listeCartePub;
		
		public function __construct()
		{
			$this->compte=null;
			$this->carte=  new Carte(null,null,null,null,null,null,null,null,"Didier",null,null);//null;
			$this->listeCartesPriv=null;
			$this->ListeCartesPart=null;
			$this->listeCartePub=null;			
		}
		
		public function inscription($pseudo, $mdp, $prenom, $nom, $email)
		{
			//On verifie que le pseudo n'existe pas déjà dans la table Compte
			//Retourne vrai, si c'est bon
			$COA = array ('Login','Mdp','Mail','Nom','Prenom');
			$VAA = array ($pseudo, $mdp, $email, $nom, $prenom);
			if(creerRequeteAvecWhere(array("login"), "COMPTE" , "login = '".$pseudo."'")=='')
			{
				creerInsert("COMPTE",$COA,$VAA);
				$this->compte = new Compte($pseudo, $prenom, $nom, $email, $date);
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
                //a compléter avec créateur et tout

                $req = creerRequeteAvecWhere(array("idElement","nomElement","valeurElement","idElementPere","racine"),"ELEMENT","idCarteElement = ".$idCarte);
                if ($req <> "")
				{

					$tableau = $this->requeteDansTableau($req);
					
					$xml = new DOMDocument("1.0","utf-8");
					$racine=0;
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
					$fichier_xml = $xml->saveXML();	
					$req3 = creerRequeteAvecWhere(array("login","nomGroupe"),"v_LISTE_CARTE","idCarteListe = ".$idCarte);
					if($req3 <>"")
					{	
						$listeLogin = $this->requeteDansTableau($req3);
						$listeE = array();
						$listeC = array();
						for ($i=0;$i<count($listeLogin);$i++) //Affectation des logins aux différentes listes
							if ($listeLogin[$i][1] == "Editeur")
								array_push($listeE,$listeLogin[$i][0]);
							else if($listeLogin[$i][1] == "Consultant")
								array_push($listeC,$listeLogin[$i][0]);
	                    $this->carte = new Carte($idCarte, $tab[0][0], $tab[0][1], $tab[0][2], $tab[0][3],count($tableau), $fichier_xml,  $racine, $listeE, $listeC);
						return true;
					}
					else
					{
						return false;
					}
					
			
					

					return true; //ou retourner la carte

				}
				else
				{
                	return false;
				}
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
			$res = creerRequeteAvecWhere(array("idCarte"),"v_CARTE","login ='".$pseudo."' AND accessibilite = 'Prive'");
			//On vérifie si le pseudo possede des cartes privées
			//Si c'est bon, on stocke les id et les noms des cartes
			if($res != '')
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
				return $res;
			}
			//On retoune faux, si le pseudo n'a aucune carte privée ou si le pseudo est mauvais
			else
			{
				return false;
			}
		
		}
		
		public function recuperationCartesPartagees($pseudo)
		{
			$res = creerRequeteAvecWhere(array("idCarte"),"v_CARTE","login ='".$pseudo."' AND accessibilite = 'Partage'");
			//On vérifie si le pseudo possede des cartes partagées
			//Si c'est bon, on stocke les id et les noms des cartes
			if($res != '')
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
				return $res;
			}
			//On retoune faux, si le pseudo n'a aucune carte partagée ou si le pseudo est mauvais
			else
			{
				return false;
			}
		
		}
		
		public function recuperationCartesPubliques()
		{
			$res = creerRequeteAvecWhere(array("idCarte"),"v_CARTE","accessibilite = 'Public'");
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
				return $res;
			}	
			//Retourne faux, si il y a un probleme
			else
			{
				return false;
			}
		}
		
		public function creationCarte($nom)
		{
			$COA = array ("nomCarte","dateCreation","derniereModification","accessibilite");
			$VAA = array ($nom, date('d-m-Y'), date('d-m-Y'),"Public");		
			echo "pseudo :".$this->compte->getLogin();	
			creerInsert("CARTE",$COA,$VAA);
			$idC=creerRequeteAvecWhere("idCarteListe","v_LISTE_CARTE", "login='".$this->compte->getLogin()."' ORDER BY idCarteListe DESC LIMIT 1");
			echo "testing2";
			$this->carte=recuperationCarte($idC);	
			return true;
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
			if($this->carte->getAdmin()==$this->compte->getPseudo() && creerRequeteAvecWhere("idCarte", "CARTE" , "idCarte=".$idCarte)!='')
			{
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
			$dom = new DOMDocument();
			$dom->loadXML($this->carte->getXml_doc());
			
			echo $dom;
			
			$listeElt = $this->carte->getXml_doc()->getElementsByTagName('element');
			echo 'dzdza';
			$tabDonnees = array();
			$tmp = array();
			
			foreach($listeElt as $e)
			{
				echo $e->getAttribute("id");
				array_push($tmp,$e->getAttribute("id")); 
				array_push($tmp,$e->getAttribute("nom"));
				array_push($tmp,$e->getAttribute("valeur"));
				array_push($tmp,$e->getAttribute("idPere"));
				array_push($tabDonnees,$tmp);
				$tmp = array();
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
	}
	
	$testing = new Controller();
	//echo $testing->inscription('Didier', 'Jean', 'D', 'J', 'J@D');
	echo $testing->connexion("Didier","Jean");
	//echo $testing->recuperationCartesPrivees("tes04t");
	//echo $testing->recuperationCartesPartagees("test");
	//echo $testing->recuperationCartesPubliques();
	//--------------------------------------echo $testing->creationCarte("Carte2");
	echo $testing->renommerCarte(34, "LaCarte");
	echo 'coucou';
?>
