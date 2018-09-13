<?php
include_once('Modeles/Metiers/episode.php');

Class conteneurEpisode
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesEpisodes;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct()
		{
		$this->lesEpisodes = new arrayObject();
		}
	
	//METHODE AJOUTANT UN episode------------------------------------------------------------------------------
	public function ajouteUnEpisode($unIdEpisode,$unTitreEpisode,$uneDureeEpisode, $laSaison)
		{
		$unEpisode = new episode($unIdEpisode,$unTitreEpisode,$uneDureeEpisode, $laSaison);
		$this->lesEpisodes->append($unEpisode);
			
		}
		
	//METHODE RETOURNANT LE NOMBRE d'épisodes-------------------------------------------------------------------------------
	public function nbEpisodes()
		{
		return $this->lesEpisodes->count();
		}	
		
	//METHODE RETOURNANT LA LISTE DES Episodes-----------------------------------------------------------------------------------------
	public function listeDesEpisodes()
		{
		$liste = '';
		foreach ($this->lesEpisodes as $unEpisode)
			{	$liste = $liste.'Serie : "'.$unEpisode->getLaSaisonEpisode()->getLaSerie()->getTitreSerie().' -> Saison N° : '.$unEpisode->getLaSaisonEpisode()->getIdSaison().' ->Episode : '.$unEpisode->getTitreEpisode().'><br>';
			}
		return $liste;
		}
		
		//METHODE RETOURNANT LA LISTE DES Episodes DANS UNE BALISE <SELECT>------------------------------------------------------------------
	public function lesEpisodesAuFormatHTML()
		{
		$liste = "<SELECT name = 'idEpisode'>";
		foreach ($this->lesEpisodes as $unEpisode)
			{
			$liste = $liste."<OPTION value='".$unEpisode->getIdEpisode()."'>".$unEpisode->getTitreEpisode()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}		
	
	}
	
?> 