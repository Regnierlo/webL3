<?php
	class Carte
	{
		//Compteur d'element
		private $nom;
		private $dateCreation;
		private $dateModification;
		private $publique;
		private $xml_doc;
		private $racine;
		private $cmpE;

		public function __construct()
		{
			$this->nom = 'Nouvelle carte';
			$this->dateCreation = date("d-m-Y");
			$this->dateModification = date("d-m-Y");
			$this->publique = 'false';
			$this->cmpE = 0;
			$this->xml_doc = new DOMDocument('1.0', 'utf-8');
			$this->racine = new Element('elt0','Racine',null,null);
			//On ajoute la racine
			$this->xml_doc->appendChild($this->xml_doc->createElement($this->racine->getId(),$this->racine->getValeur()));
			
		}
		
		public function getNom()
		{
			return $this->nom;
		}
		
		public function getDateCreation()
		{
			return $this->dateCreation;
		}
		
		public function getDateModification()
		{
			return $this->dateModification;
		}
		
		public function getPublique()
		{
			return $this->publique;
		}
		public function getCmpE()
		{
			return $this->cmpE;
		}
		
		public function getXml_doc()
		{
			return $this->xml_doc;
		}

		public function getRacine()
		{
			return $this->racine;
		}
		
		public function setNom($n)
		{
			$this->nom = $n;
		}
		
		public function setDateModification()
		{
			$this->dateModification = date("d-m-Y");
		}
		
		public function setPublique($p)
		{
			$this->publique = $p;
		}
		
		public function incCptE()
		{
			$this->cptE++;
		}
	}
?>
