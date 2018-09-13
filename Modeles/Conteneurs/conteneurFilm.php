<?php
include_once('Modeles/Metiers/film.php');

Class conteneurFilm
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesFilms;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct()
		{
		$this->lesFilms = new arrayObject();
		}
	
	//METHODE AJOUTANT UN Film------------------------------------------------------------------------------
	public function ajouteUnFilm($unIdFilm, $unTitreSupport, $unRealisateurSupport, $uneImageSupport, $leGenreSupport,$laDureeFilm)
		{
		$unFilm = new film($unIdFilm, $unTitreSupport, $unRealisateurSupport, $uneImageSupport, $leGenreSupport,$laDureeFilm);
		$this->lesFilms->append($unFilm);
			
		}
		
	//METHODE RETOURNANT LE NOMBRE de films-------------------------------------------------------------------------------
	public function nbFilms()
		{
		return $this->lesFilms->count();
		}	
		
	//METHODE RETOURNANT LA LISTE DES  films-----------------------------------------------------------------------------------------
	public function listeDesFilms()
		{
		$liste = '';
		foreach ($this->lesFilms as $unFilm)
			{	$leGenre=$unFilm->getLeGenreDuFilm();
			    $liste = $liste.'Film N° : "'.$unFilm->getIdFilm().' -> Film : '.$unFilm->getTitreFilm().' - '.$leGenre.' - '.$unFilm->getDureeFilm().'><br>';
			}
		return $liste;
		}
		
		//METHODE RETOURNANT LA LISTE DES films DANS UNE BALISE <SELECT>------------------------------------------------------------------
	public function lesFilmsAuFormatHTML()
		{
		$liste = "<SELECT name = 'idFilm'>";
		foreach ($this->lesFilms as $unFilm)
			{
			$liste = $liste."<OPTION value='".$unFilm->getIdFilm()."'>".$unFilm->getTitreFilm()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}		

//METHODE RETOURNANT UN film A PARTIR DE SON NUMERO--------------------------------------------	
	public function donneObjetFilmDepuisNumero($unIdFilm)
		{
		//initialisation d'un booléen (on part de l'hypothèse que le film n'existe pas)
		$trouve=false;
		$leBonFilm=null;
		//création d'un itérateur sur la collection lesEmpruntsFilms
		$iFilm = $this->lesFilms->getIterator();
		//TQ on a pas trouvé le film et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iFilm->valid()))
			{
			//SI le numéro du film courant correspond au numéro passé en paramètre
			if ($iFilm->current()->getIdFilm()==$unIdFilm)
				{
				//maj du booléen
				$trouve=true;
				//sauvegarde le film courant
				$leBonFilm = $iFilm->current();
				
				}
			//SINON on passe au film suivant
			else
				$iFilm->next();
			}
			$leBonSupport= new support($leBonFilm->getIdFilm(), $leBonFilm->getTitreFilm(), $leBonFilm->getRealisateurFilm(), $leBonFilm->getImageFilm(), $leGenreSupport);
		return $leBonFilm;
		}
//METHODE RETOURNANT UN film A PARTIR DE SON NUMERO--------------------------------------------	
	public function donneObjetSupportDepuisNumeroFilm($unIdFilm)
		{
			
		//initialisation d'un booléen (on part de l'hypothèse que le film n'existe pas)
		$trouve=false;
		$leBonFilm=null;
		$leBonSupport=null;
		//création d'un itérateur sur la collection lesEmpruntsFilms
		$iFilm = $this->lesFilms->getIterator();
		//TQ on a pas trouvé le film et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iFilm->valid()))
			{
			//SI le numéro du film courant correspond au numéro passé en paramètre
			if ($iFilm->current()->getIdFilm()==$unIdFilm)
				{
				//maj du booléen
				$trouve=true;
				//sauvegarde le film courant
				$leBonFilm = $iFilm->current();
				$leBonSupport= new support($leBonFilm->getIdFilm(), $leBonFilm->getTitreFilm(), $leBonFilm->getRealisateurFilm(), $leBonFilm->getImageFilm(), $leGenreSupport);
		
				}
			//SINON on passe au film suivant
			else
				$iFilm->next();
			}
		return $leBonSupport;
		}		
	
	}
	
?> 