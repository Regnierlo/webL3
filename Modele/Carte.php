<?php
	class Carte
	{
		//Compteur d'element
        private $id;
		private $nom;
		private $dateCreation;
		private $dateModification;
		private $publique;
		private $xml_doc;
		private $racine;
		private $cmpE;
		private $admin;
		private $lConsultant;
        private $lEditeur;


		public function __construct($i,$n,$dC,$dM,$p,$nbE,$xmlDoc,$r,$a,$lC,$lE)
		{
		    $this->id = $i;
			$this->nom = $n;
			$this->dateCreation = $dC;
			$this->dateModification = $dM;
			$this->publique = $p;
			$this->cmpE = $nbE;
			$this->xml_doc = $xmlDoc;
			$this->racine = $r;
			$this->admin = $a;
			$this->lConsultant = $lC;
			$this->lEditeur = $lE;

		}


		//Getter
        public function getId()
        {
            return $this->id;
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

		public function getAdmin()
        {
            return $this->admin;
        }

		public function getListeConsultant()
        {
            return $this->lConsultant;
        }

        public function getListeEditeur()
        {
            return $this->lEditeur;
        }


        //Setter
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
			$this->cptE ++;
		}

        public function remListeEditeur($editeur)
        {
            $indice =-1;
            $indentation = 0;
            foreach ($this->lEditeur as &$valeur)
            {
                if (strcmp($valeur,$editeur))
                {
                    $indice = $indentation;
                }
                $indentation ++;
            }
            if ($indice == -1)
            {
                return false;
            }
            else
            {
                unset($this->lEditeur[$indice]);
                array_values($this->lEditeur); //réindexer le tableau
                return true;
            }
        }

        public function remListeConsultant($consultant)
        {
            $indice =-1;
            $indentation = 0;
            foreach ($this->lConsultant as &$valeur)
            {
                if (strcmp($valeur,$consultant))
                {
                    $indice = $indentation;
                }
                $indentation ++;
            }
            if ($indice == -1)
            {
                return false;
            }
            else
            {
                unset($this->lConsultant[$indice]);
                array_values($this->lConsultant); //réindexer le tableau
                return true;
            }
        }



        public function addListeEditeur($editeur)
        {
            array_push($this->lEditeur, $editeur);
        }

        public function addListeConsultant($consultant)
        {
            array_push($this->lConsultant,$consultant);
        }

	}
?>
