<?php
Class saison
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idSaison; 
	private $anneeSaison; 
	private $nbrEpisodeSaison;
	private $laSerie;
		
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdSaison,$uneAnneeSaison, $unNbrEpisodeSaison, $laSerie)
		{
		$this->idSaison = $unIdSaison;
		$this->anneeSaison = $uneAnneeSaison;
		$this->nbrEpisodeSaison = $unNbrEpisodeSaison;
		$this->laSerie = $laSerie;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdSaison()
		{
		return $this->idSaison;
		}
	public function getAnneeSaison()
		{
		return $this->anneeSaison;
		}
	public function getNbrEpisodeSaison()
		{
		return $this->nbrEpisodeSaison;
		}
	public function getLaSerie()
		{
		return $this->laSerie;
		}
		
	//SETTEUR------------------------------------------------------------
	
	public function setIdSaison($unIdSaison)
		{
		$this->idSaison = $unIdSaison;
		}
	public function setAnneeSaison($uneAnneeSaison)
		{
		$this->anneeSaison = $uneAnneeSaison;
		}
	public function setNbrEpisodeSaison($unNbrEpisodeSaison)
		{
		$this->nbrEpisodeSaison = $unNbrEpisodeSaison;
		}
		
	public function setLaSerie($laSerie)
		{
		$this->laSerie = $laSerie;
		}
	
	}
	
?>