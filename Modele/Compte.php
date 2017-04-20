<?php
	class Compte
	{
		private $login;
		private $nom;
		private $prenom;
		private $mdp;
		private $email;
		private $dateCreation;
		
		
		
		public function __construct($l,$n,$p,$password,$e,$date)
		{
			$this->login = $l;
			$this->nom = $n;
			$this->prenom = $p;
			$this->mdp = $password;
			$this->email = $e;
			$this->dateCreation = $date;
		}
		
		public function getLogin()
		{
			return $this->login;
		}
		
		public function getNom()
		{
			return $this->nom;
			
		}
		
		public function getPrenom()
		{
			return $this->prenom;
		}
		
		public function getMdp()
		{
			return $this->mdp;
		}
		
		public function getEMail()
		{
			return $this->email;
		}
		
		public function getDateCreation()
		{
			return $this->dateCreation;
		}
		
		
		
		public function setLogin($l)
		{
			$this->login = $l;
		}
		
		public function setNom($n)
		{
			$this->nom = $n;
			
		}
		
		public function setPrenom($p)
		{
			$this->prenom = $p;
		}
		
		public function setMdp($m)
		{
			$this->mdp = $m;
		}
		
		public function setEMail($e)
		{
			$this->email = $e;
		}
		
		public function setDateCreation($d)
		{
			$this->dateCreation = $d;
		}
		
		
		
	}
	
	
	?>
