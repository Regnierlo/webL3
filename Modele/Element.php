<?php
	class Element
	{
		private $id;
		private $valeur;
		private $pere;
		private $fils;
		
		
		
		public function __construct($i,$v,$p,$f)
		{
			$this->id = $i;
			$this->valeur = $v;
			$this->pere = $p;
			$this->fils = $f;
		}
		
		public function getId()
		{
			return $this->id;
		}
		
		public function getValeur()
		{
			return $this->valeur;
		}
		
		public function getPere()
		{
			return $this->pere;
		}
		
		public function getFils()
		{
			return $this->fils;
		}
		
		
		public function setId($i)
		{
			$this->id = $i;
		}
		
		public function setValeur($v)
		{
			$this->valeur = $v;
		}
		
		public function setPere($p)
		{
			$this->pere = $p;
		}
		
		public function setFils($f)
		{
			$this->fils = $f;
		}
		
	}
?>