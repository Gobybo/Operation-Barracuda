<?php
Class genre
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $id‪Genre; 
	private $libelleGenre; 
	
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct($unId‪Genre, $unLibelleGenre)
		{
		$this->id‪Genre = $unId‪Genre;
		$this->libelleGenre = $unLibelleGenre;
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
	
	//SETTEUR------------------------------------------------------------
	
	public function setIdGenre($unId‪Genre)
		{
		$this->id‪Genre = $unId‪Genre;
		}
	public function setLibelleGenre($unLibelleGenre)
		{
		$this->libelleGenre = $unLibelleGenre;
		}
	
	}
	
?>