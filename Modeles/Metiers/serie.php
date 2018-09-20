<?php
include_once 'support.php';
Class serie extends support
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $resumeSerie; 
		
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unId‪Serie, $unTitreSupport, $unRealisateurSupport, $uneImageSupport, $leGenreDeLaSerie, $unResumeSerie)
		{
		parent::__construct($unId‪Serie,$unTitreSupport,$unRealisateurSupport,$uneImageSupport, $leGenreDeLaSerie);
		$this->resumeSerie = $unResumeSerie;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getResumeSerie()
		{
		return $this->resumeSerie;
		}
	public function getIdSerie()
	{
		return parent::getIdSupport();
	}
	public function getTitreSerie()
	{
		return parent::getTitreSupport();
	}
	public function getRealisateurSerie()
	{
		return parent::getRealisateurSupport();
	}
	public function getUneImageDeLaSerie()
	{
		return parent::getImageSupport();
	}	
		
	public function getLeGenreDeLaSerie()
	{
		return parent::getLeGenreDeSupport()->getLibelleGenre();
	}				
	//SETTEUR------------------------------------------------------------
	
	public function setResumeSerie($unResumeSerie)
	{
		$this->resumeSerie = $unResumeSerie;
	}
	
	
	}
	
?>