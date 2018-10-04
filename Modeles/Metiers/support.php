<?php
Class support
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $idSupport; 
	private $titreSupport; 
	private $realisateurSupport; 
	private $imageSupport;
	private $leGenreDeSupport; 
		
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unIdSupport, $unTitreSupport, $unRealisateurSupport, $uneImageSupport, $leGenreSupport)
		{
		$this->idSupport = $unIdSupport;
		$this->titreSupport = $unTitreSupport;
		$this->realisateurSupport = $unRealisateurSupport;
		$this->imageSupport = $uneImageSupport;
		$this->leGenreDeSupport = $leGenreSupport;
		
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdSupport()
		{
		return $this->idSupport;
		}
		
	public function getTitreSupport()
		{
		return $this->titreSupport;
		}
	public function getRealisateurSupport()
		{
		return $this->realisateurSupport;
		}
	public function getImageSupport()
		{
		return $this->imageSupport;
		}
	public function getLeGenreDeSupport()
		{
		return $this->leGenreDeSupport;
		}
	
	
	//SETTEUR------------------------------------------------------------
	
	public function setIdSupport($unIdSupport)
		{
		$this->idSupport = $unIdSupport;
		}
	public function setTitreSupport($unTitreSupport)
		{
		$this->titreSupport = $unTitreSupport;
		}
	public function setRealisateurSupport($unRealisateurSupport)
		{
		$this->realisateurSupport = $unRealisateurSupport;
		}
	public function setImageSupport($uneImageSupport)
		{
		$this->imageSupport = $uneImageSupport;
		}
	public function setLeGenreDeSupport($unGenreDeSupport)
		{
		$this->leGenreDeSupport = $unGenreDeSupport;
		}

	}
	
?>