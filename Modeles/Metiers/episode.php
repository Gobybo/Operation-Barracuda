<?php
Class episode
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idEpisode; 
	private $titreEpisode; 
	private $dureeEpisode;
	private $laSaison;
		
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdEpisode,$unTitreEpisode,$uneDureeEpisode, $laSaison)
		{
		$this->idEpisode = $unIdEpisode;
		$this->titreEpisode = $unTitreEpisode;
		$this->dureeEpisode = $uneDureeEpisode;
		$this->laSaison = $laSaison;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdEpisode()
		{
		return $this->idEpisode;
		}
	public function getTitreEpisode()
		{
		return $this->titreEpisode;
		}
	public function getDureeEpisode()
		{
		return $this->dureeEpisode;
		}
	public function getLaSaisonEpisode()
		{
		return $this->laSaison;
		}		
	//SETTEUR------------------------------------------------------------
	
	public function setIdEpisode($unIdEpisode)
		{
		$this->idEpisode = $unIdEpisode;
		}
	public function setTitreEpisode($unTitreEpisode)
		{
		$this->titreEpisode = $unTitreEpisode;
		}
	public function setDureeEpisode($uneDureeEpisode)
		{
		$this->dureeEpisode = $uneDureeEpisode;
		}
	public function setLaSaisonDeLEpisode($uneSaisonDeLEpisode)
		{
		$this->laSaison = $uneSaisonDeLEpisode;
		}
	
	}
	
?>