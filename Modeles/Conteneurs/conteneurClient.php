<?php
include_once('Modeles/Metiers/client.php');

Class conteneurClient
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesClients;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct()
		{
		$this->lesClients = new arrayObject();
		}
	
	//METHODE AJOUTANT UN Client------------------------------------------------------------------------------
	public function ajouteUnClient($unIdClient, $unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement, $unLoginClient, $unPwdClient)
		{
		$unClient = new client($unIdClient, $unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement,$unLoginClient, $unPwdClient);
		$this->lesClients->append($unClient);
			
		}
		
	//METHODE RETOURNANT LE NOMBRE De clients-------------------------------------------------------------------------------
	public function nbClient()
		{
		return $this->lesClients->count();
		}	
		
	//METHODE RETOURNANT LA LISTE DES Clients-----------------------------------------------------------------------------------------
	public function listeDesClients()
		{
		$liste = '';
		foreach ($this->lesClients as $unClient)
			{	$liste = $liste.'client : "'.$unClient->getNomClient().' - '.$unClient->getPrenomClient().' - '.$unClient->getEmailClient().' - '.$unClient->getDateAbonnementClient().'><br>';
			}
		return $liste;
		}
		
		//METHODE RETOURNANT LA LISTE DES CLIENTS DANS UNE BALISE <SELECT>------------------------------------------------------------------
	public function lesClientsAuFormatHTML()
		{
		$liste = "<SELECT name = 'idClient'>";
		foreach ($this->lesClients as $unClient)
			{
			$liste = $liste."<OPTION value='".$unClient->getIdClient()."'>".$unClient->getNomClient()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}		

//METHODE RETOURNANT UN CLIENT A PARTIR DE SON NUMERO--------------------------------------------	
	public function donneObjetClientDepuisNumero($unIdClient)
		{
		//initialisation d'un booléen (on part de l'hypothèse que le client n'existe pas)
		$trouve=false;
		$leBonClient=null;
		//création d'un itérateur sur la collection lesClients
		$iClient = $this->lesClients->getIterator();
		//TQ on a pas trouvé le client et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iClient->valid()))
			{
			//SI le numéro du client courant correspond au numéro passé en paramètre
			if ($iClient->current()->getIdClient()==$unIdClient)
				{
				//maj du booléen
				$trouve=true;
				//sauvegarde du client courant
				$leBonClient = $iClient->current();
				
				}
			//SINON on passe au client suivant
			else
				$iClient->next();
			}
		return $leBonClient;
		}		
	public function verificationExistanceClient($unLogin, $unPassword)
	{
		//echo $unLogin."<br/>";
		//echo $unPassword."<br/>";
		//initialisation d'un booléen (on part de l'hypothèse que le client n'existe pas)
		$trouve=0;
		//création d'un itérateur sur la collection lesClients
		$iClient = $this->lesClients->getIterator();
		//TQ on a pas trouvé le client et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iClient->valid()))
			{
			//SI le login du client courant correspond au login passé en paramètre
			// On supprime les caractères invisibles que le SGBD ajoute pour compenser puisqu'on utilise des char(n)
			$testLogin = trim($iClient->current()->getLoginClient());
			$testPassword = trim($iClient->current()->getPwdClient());
			//$test = $testLogin===$unLogin;
			//$test2 = $testPassword===$unPassword;
			//echo "Login : ".strcmp($unLogin,$testLogin)."<br/>".$test;
			//echo "Password : ".strcmp($unPassword,$testPassword)."<br/>".$test2;
			//On test avec la fonction strcmp
			if (strcmp($unPassword,$testPassword)===0 && strcmp($unPassword,$testPassword)===0)
				{
				//maj du booléen
				$trouve=1;
				}
			//SINON on passe au client suivant
			else
				{
					$iClient->next();
				}
			}
		return $trouve;
	}
	}
	
?> 