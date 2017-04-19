<?php
	class Invite
	{
		private $pseudoSession;
		
		
		public function __construct($p)
		{
			$this->pseudoSession = $p;
		}
		
		public function getPseudoSession()
		{
			return $this-> $pseudoSession;
		}
		
		public function setPseudoSession($p)
		{
			$this-> $pseudoSession = $p;
		}
	}
?>