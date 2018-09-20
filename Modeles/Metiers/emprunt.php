<?php
Class emprunt
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idEmprunt; 
	private $dateEmprunt; 
	private $leClient;
	private $leSupport;
	
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdEmprunt, $uneDateEmprunt,$unClient,$unSupport)
		{
		$this->idEmprunt = $unIdEmprunt;
		$this->dateEmprunt = $uneDateEmprunt;
		$this->leClient = $unClient;
		$this->leSupport = $unSupport;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdEmprunt()
		{
		return $this->idEmprunt;
		}
	public function getDateEmprunt()
		{
		return $this->dateEmprunt;
		}
	public function getLeClient()
		{
		return $this->leClient;
		}
	public function getLeSupport()
	{
		return $this->leSupport;
	}
	
	//SETTEUR------------------------------------------------------------
	
	public function setIdEmprunt($unIdEmprunt)
		{
		$this->idEmprunt = $unIdEmprunt;
		}
	public function setDateEmprunt($uneDateEmprunt)
		{
		$this->dateEmprunt = $uneDateEmprunt;
		}
		
		
	}
	
?>