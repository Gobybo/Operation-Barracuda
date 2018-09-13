<?php

Class client
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idClient;
	private $nomClient;
	private $prenomClient;
	private $emailClient;
	private $dateAbonnementClient;
	private $loginClient;
	private $pwdClient;
		
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdClient, $unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement, $unLoginClient, $unPwdClient)
		{
		$this->idClient = $unIdClient;
		$this->nomClient = $unNomClient;
		$this->prenomClient = $unPrenomClient;
		$this->emailClient = $unEmailClient;
		$this->dateAbonnementClient = $uneDateAbonnement;
		$this->loginClient = $unLoginClient;
		$this->pwdClient = $unPwdClient;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdClient()
		{
		return $this->idClient;
		}
		
	public function getNomClient()
		{
		return $this->nomClient;
		}
	public function getPrenomClient()
		{
		return $this->prenomClient;
		}
	public function getEmailClient()
	{
		return $this->emailClient;
	}	
	public function getDateAbonnementClient()
	{
		return $this->dateAbonnementClient;
	}
	public function getLoginClient()
	{
		return $this->loginClient;
	}
	public function getPwdClient()
	{
		return $this->pwdClient;
	}
	
	}
	
?>