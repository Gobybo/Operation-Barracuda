<?php
include_once('Modeles/Metiers/saison.php');

Class conteneurSaison
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesSaisons;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct()
		{
		$this->lesSaisons = new arrayObject();
		}
	
	//METHODE AJOUTANT UNE SAISON------------------------------------------------------------------------------
	public function ajouteUneSaison($unIdSaison,$uneAnneeSaison, $unNbrEpisodeSaison, $laSerie)
		{
		$uneSaison = new saison($unIdSaison,$uneAnneeSaison, $unNbrEpisodeSaison, $laSerie);
		$this->lesSaisons->append($uneSaison);
			
		}
		
	//METHODE RETOURNANT LE NOMBRE DE SAISON-------------------------------------------------------------------------------
	public function nbSaisons()
		{
		return $this->lesSaisons->count();
		}	
		
	//METHODE RETOURNANT LA LISTE DES SAISONS-----------------------------------------------------------------------------------------
	public function listeDesSaisons()
		{
		$liste = '';
		foreach ($this->lesSaisons as $uneSaison)
			{	
				$laSerie=$uneSaison->getLaSerie();
				$liste = $liste.'Serie :'.$laSerie->getTitreSerie().'  -> Saison N° : '.$uneSaison->getIdSaison().'><br>';
			}
		return $liste;
		}
		
	//METHODE RETOURNANT LA LISTE DES saisons DANS UNE BALISE <SELECT>------------------------------------------------------------------
	public function lesSaisonsAuFormatHTML()
		{
		$liste = "<SELECT name = 'idSaison'>";
		foreach ($this->lesSaisons as $uneSaison)
			{
				$liste = $liste."<OPTION value='".$uneSaison->getIdSaison()."'>".$uneSaison->getAnneeSaison()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}		

//METHODE RETOURNANT UN genre A PARTIR DE SON NUMERO--------------------------------------------	
	public function donneObjetSaisonDepuisNumero($unIdSerie,$unIdSaison)
		{
		//initialisation d'un booléen (on part de l'hypothèse que la saison n'existe pas)
		$trouve=false;
		$laBonneSaison=null;
		//création d'un itérateur sur la collection lesSaisons
		$iSaison = $this->lesSaisons->getIterator();
		//TQ on a pas trouvé la Saison et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iSaison->valid()))
			{
			//SI le numéro de la saison courante correspond au numéro passé en paramètre
			$laSerie=$iSaison->current()->getLaSerie();
			if (($laSerie->getIdSerie()== $unIdSerie) && ($iSaison->current()->getIdSaison()==$unIdSaison))
				{
				//maj du booléen
				$trouve=true;
				//sauvegarde de la saison courant
				$laBonneSaison = $iSaison->current();
				
				}
			//SINON on passe à la saison suivante
			else
				$iSaison->next();
			}
		return $laBonneSaison;
		}		
	
	}
	
?> 