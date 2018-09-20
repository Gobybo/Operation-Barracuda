<?php
Class genre
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $id‪Genre; 
	private $libelleGenre; 
	private $cheminImageGenre;
	
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unId‪Genre, $unLibelleGenre, $unCheminImageGenre)
		{
		$this->id‪Genre = $unId‪Genre;
		$this->libelleGenre = $unLibelleGenre;
		$this->cheminImageGenre = $unCheminImageGenre;
		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function getIdGenre()
		{
		return $this->id‪Genre;
		}
		
	public function getLibelleGenre()
		{
		return $this->libelleGenre;
		}

	public function getCheminImageGenre()
	{
		return $this->cheminImageGenre;
	}
	
	//SETTEUR------------------------------------------------------------
	
	public function setIdGenre($unId‪Genre)
		{
		$this->id‪Genre = $unId‪Genre;
		}
	public function setLibelleGenre($unLibelleGenre)
		{
		$this->libelleGenre = $unLibelleGenre;
		}
	public function setCheminImageGenre($unCheminImageGenre)
	{
		$this->cheminImageGenre = $unCheminImageGenre;
	}
	
	}
	
?>