<?php
include ('support.php');
Class film extends support
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $dureeFilm; 
			
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdFilm, $unTitreSupport, $unRealisateurSupport, $uneImageSupport, $leGenreSupport,$laDureeFilm)
		{
		parent::__construct($unIdFilm,$unTitreSupport,$unRealisateurSupport,$uneImageSupport, $leGenreSupport);
		$this->dureeFilm = $laDureeFilm;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getDureeFilm()
		{
		return $this->dureeFilm;
		}
	public function getIdFilm()
	{
		return parent::getIdSupport();
	}
	public function getTitreFilm()
	{
		return parent::getTitreSupport();
	}
	public function getRealisateurFilm()
	{
		return parent::getRealisateurSupport();
	}
	public function getUneImageDuFilm()
	{
		return parent::getImageSupport;
	}	
		
	public function getLeGenreDuFilm()
	{
		return parent::getLeGenreDeSupport()->getLibelleGenre();
	}
	public function getLeIdGenreDuFilm()
	{
		return parent::getLeGenreDeSupport()->getIdGenre();
	}		
	//SETTEUR------------------------------------------------------------
	
	public function setDureeFilm($uneDureeFilm)
		{
		$this->dureeFilm = $uneDureeFilm;
		}
		
	}
	
?>