<?php
	class Utilisateur
	{
		private $ip;
		
		public function __construct()
		{
			$this->ip = $_SERVER['REMOTE_ADDR'];
		}
		
		public function getIp()
		{
			return $this->ip;
		}
	}
?>