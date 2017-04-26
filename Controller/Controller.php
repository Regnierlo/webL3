<?php
	require ('../Modele/Carte.php');
	require ('../Modele/Compte.php');
	require ('../Modele/Element.php');
	require ('../Modele/GenerationRequetes/connexion.php');
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
			$this->carte=null;
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
			if(creerRequeteAvecWhere('Login', 'COMPTE' , 'Login='.$pseudo)!='')
			{
				creerInsert('COMPTE',$COA,$VAA);
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
			$res = creerRequeteAvecWhere("Login,Mail,Nom,Prenom,DateCreation", "COMPTE", "Login =".$pseudo." AND Mdp=".$mdp);
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
				$compte= new Compte($tab[0], $tab[2], $tab[3], $mdp, $tab[1], $tab[4]);
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function recuperationCarte($idCarte)
		{
			$res = creerRequeteAvecWhere("nomCarte, dateCreation, derniereModification, accessibilite", "CARTE", "idCarte =".$idCarte)!=''
			//On verifie si la carte existe dans la table Carte
			//On retourne le fichier XML, Si la carte existe, on retourne le fichier XML, l'administrateur, le nom, les editeurs, les consultants, publique...
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
				// IL MANQUE LES DERNIERS PARAMETRES DANS LE CONSTRUCTEUR
				$this->carte = new Carte($tab[0], $tab[1], $tab[2], $tab[3], null, null, null, null, null, null, null)
				return true;
			}
			//On retoune faux, si la carte n'existe pas
			else
			{
				return false;
			}
		}
		
		public function recuperationCartesPrivees($pseudo)
		{
			//On vérifie si le pseudo possede des cartes privées
			//Si c'est bon, on stocke les id et les noms des cartes
			if()
			{
				return true;
			}
			//On retoune faux, si le pseudo n'a aucune carte privée ou si le pseudo est mauvais
			else
			{
				return false;
			}
		
		}
		
		public function recuperationCartesPartagees($pseudo)
		{
			//On vérifie si le pseudo possede des cartes partagées
			//Si c'est bon, on stocke les id et les noms des cartes
			if()
			{
				return true;
			}
			//On retoune faux, si le pseudo n'a aucune carte partagée ou si le pseudo est mauvais
			else
			{
				return false;
			}
		
		}
		
		public function recuperationCartesPubliques()
		{
			if()
			{
				return true;
			}	
			//Retourne faux, si il y a un probleme
			else
			{
				return false;
			}
		}
		
		public function creationCarte($nom)
		{
			$COA = array ('NomCarte','DateCreation','DerniereModification');
			$VAA = array ($nom, date(format:"d-m-Y"), date(format:"d-m-Y"));			
			creetInsert('CARTE',$COA,$VAA);
			$idC=creerRequeteAvecWhere('idCarteListe','v_LISTE_CARTE', 'login='.$this->compte->pseudo.'ORDER BY idCarteListe DESC LIMIT 1');
			$this->carte=recuperationCarte($idC);	
			return true;
		}
		
		public function renommerCarte($idCarte, $nNom)
		{
			//Si le pseudo est celui de l'admin
			if($this->carte->getAdmin()==$this->compte->getPseudo() && creerRequeteAvecWhere('idCarte', 'CARTE' , 'idCarte='.$idCarte)!='')
			{
				creerUpdate('Carte', 'NomCarte', $nNom, 'idCarte='.$idCarte);
				$this->carte->setNom($nNom);
				return true;
			}
			//Si le pseudo n'est pas celui de l'admin
			else
			{
				return false;
			}
		}
				
		public function supprimerCarte($idCarte)
		{
			//On verifie que la carte existe dans la table Carte et que c'est bien l'Administrateur qui la supprime
			//Si c'est bon, on supprime la carte de la table Carte et on vide $carte
			if($this->carte->getAdmin()==$this->compte->getPseudo() && creerRequeteAvecWhere('idCarte', 'CARTE' , 'idCarte='.$idCarte)!='')
			{
				creerDelete('Carte', 'idCarte='.$idCarte);
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
			//Role : Consultant (ajout à la liste des consultants), Editeur (ajout à la liste des editeurs), Aucun (retire le pseudo de la liste des Editeurs et des Consultants)
			//On verifie que la carte et le pseudo existent et que c'est l'Administrateur qui modifie les droits
			//Si c'est bon, on ajoute le pseudo à la liste correspondante : Consultant, Editeur 
			if($this->compte->getPseudo()=='REQUETE')
			{
				else if($role=='Consultant')
				{
					$this->carte->addListeConsultants($pseudo);
					$this->carte->remListeEditeurs($pseudo);
				}
				else if($role=='Editeur')
				{
					$this->carte->addListeConsultants($pseudo);
					$this->carte->addListeEditeurs($pseudo);
				}
				else if($role=='Aucun')
				{
					$this->carte->remListeConsultants($pseudo);
					$this->carte->remListeEditeurs($pseudo);
				}
				return true;
			}
			//Si la carte, le pseudo ou le role est incorrecte
			else
			{
				return false;
			}
		}
		
		public function modifierPublique($idCarte,$publique)
		{
			//On verifie si la carte existe dans la table Carte
			//Si c'est bon on affecte la nouvelle valeur
			if($this->carte->getAdmin()==$this->compte->getPseudo() && creerRequeteAvecWhere('idCarte', 'CARTE' , 'idCarte='.$idCarte)!='' && ($publique='Public' || $publique='Prive' || $publique='Partage')
			{
				creerUpdate('Carte', 'accessibilite', $publique, 'idCarte='.$idCarte);
				$this->carte->setPublique($publique);
			}
			//Sinon on retourne faux
			else
			{
				return false
			}
		}
	}
?>
