<?php
	require ('Carte.php');
	require ('Compte.php');
	require ('Element.php');
	
	class Controller
	{
	
		private $compte;
		private $carte;
	
	
		public function __construct($co,$ca)
		{
			$this->compte = $co;
			$this->carte = $ca;
		}

		//Fonctions sur les cartes
		public function ajouterCarte($nomC)
		{
			$this->carte = new Carte();
			$this->modifierNomCarte($nomC);	
			//update BD
		}
	
		public function modifierNomCarte($n)
		{
			$this->carte->setNom($n);
			//update BD
		}
	
		public function modifierPubliqueCarte($n)
		{
			$this->carte->setPublique($n);
			//update BD
		}
	
		public function modifierDateModificationCarte()
		{
			$this->carte->setDateModification();
			//update BD
		}
	
		public function listeCartes()
		{
			//requete BD
		}
		
		public function afficheCarteXML()
		{
			$xml_string = $this->carte->getXml_doc()->saveXML();
			echo $xml_string;
		}
	
		//Fonctions sur compte
		public function ajouterCompte($nom,$prenom,$mdp,$email)
		{
			$this->compte = new Compte($nom,$prenom,$mdp,$email);
			//update BD
		}
	
		public function modifierNomCompte($n)
		{
			$this->compte->setNom($n);
			//update BD
		}
	
		public function modifierPrenomCompte($n)
		{
			$this->compte->setPrenom($n);
			//update BD
		}
	
		public function modifierMdpCompte($n)
		{
			$this->compte->setMdp($n);
			//update BD
		}
		
		//Fonctions sur Element
		public function ajouterElement($valeur,$pere)
		{
			/*
				Ajouter le nouvel element dans la liste des fils du pere
			*/
			$element = new Element('elt'.$this->carte->getId(),$valeur,$pere,null);
			$elementsXML = $this->carte->getXml_doc()->getElementsByTagName($pere);
			foreach ($elementsXML as $node) 
			{
				$node->appendChild($element);
			}
		}
		
		
		public function modifierValeurElement($idElt,$newValeur)
		{
			/*
				Chercher element et modifier sa valeur
			*/
			$elementsXML = $this->carte->getXml_doc()->getElementsByTagName($idElt);
			foreach ($elementsXML as $node) 
			{
				$node->nodeValue = $newValeur;
			}
		}
		// ATTENTION IL FAUT DEPLACER LES FILS EGALEMENT; UTILISER FONCTION SUPPRIMER ELEMENT! 
		public function modifierPlaceElement($idElt,$idNewPere)
		{
			/*
				Retirer l'element de la liste des fils de l'ancien père et l'ajouter à la liste des fils du nouveau pere
			*/
			$elementsXML = $this->carte->getXml_doc()->getElementsByTagName($idElt);
			foreach ($elementsXML as $node) 
			{
				//Suppression du noeud déjà existant 
				$node->parentNode->removeChild($node);
				//Creation du nouveau noeud
				$idNewPere->appendChild($node);
			}
		}
		
		public function supprimerElement($idElt)
		{
			/*
				Retirer l'element et l'ensemble de ses fils (recursif)
			*/
			$elementsXML = $this->carte->getXml_doc()->getElementsByTagName($idElt);
			foreach ($elementsXML as $node) 
			{
				while ($node->firstChild)
				{
				    	while ($node->firstChild->firstChild) 
				    	{
					      remove_children($node->firstChild);
			    		}
			    		$node->removeChild($node->firstChild);
			  	}
			}
		}
	}
	
	//Test
	$compte=new Compte('P','C','CP','123');
	$carte=new Carte();
	
	$cont = new Controller($compte,$carte);
	$cont->modifierValeurElement('elt0','Reussite');
	
	$cont->afficheCarteXML();
	//$test = new Controller();
	//$test->ajouteCarte('MaCarte');
?>
