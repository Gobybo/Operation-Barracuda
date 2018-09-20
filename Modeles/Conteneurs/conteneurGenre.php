<?php
include_once('Modeles/Metiers/genre.php');

Class conteneurGenre
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesGenres;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct()
		{
		$this->lesGenres = new arrayObject();
		}
	
	//METHODE AJOUTANT UN genre------------------------------------------------------------------------------
	public function ajouteUnGenre($unId‪Genre, $unLibelleGenre, $unCheminImageGenre)
		{
		$unGenre = new genre($unId‪Genre, $unLibelleGenre, $unCheminImageGenre);
		$this->lesGenres->append($unGenre);
			
		}
		
	//METHODE RETOURNANT LE NOMBRE de genres-------------------------------------------------------------------------------
	public function nbGenres()
		{
		return $this->lesGenres->count();
		}	
		
	//METHODE RETOURNANT LA LISTE DES Genres-----------------------------------------------------------------------------------------
	public function listeDesGenres()
		{
		$liste = "<div class='container'>
					<section class='row'>";

		foreach ($this->lesGenres as $unGenre)
			{	
				$liste = $liste.'<div class="col-xs-4 col-sm-4 col-md-4">
				<a href="index.php?login='.$_GET['login'].'&vue=Videotheque&action=choixGenre&idGenre='.$unGenre->getIdGenre().'">
				<img src="'.$unGenre->getCheminImageGenre().'" class="rounded mx-auto d-block" style="width : 200px; length : 200px;"></a>
				<figcaption class="figure-caption text-center">
				<a href="index.php?login='.$_GET['login'].'&vue=Videotheque&action=choixGenre&idGenre='.$unGenre->getIdGenre().'">
				'.$unGenre->getLibelleGenre().'</a></figcaption></div>';

				//$liste = $liste.'<tr><td class="col-xs-4 col-sm-3 col-md-2"><img src="'.$unGenre->getCheminImageGenre().'" style="width : 75px; length : 75px;></td><td class="text-white td-table">'.$unGenre->getLibelleGenre().'</td></tr>';
			}
			$liste=$liste."</section></div>";
		return $liste;
		}
		
		//METHODE RETOURNANT LA LISTE DES genres DANS UNE BALISE <SELECT>------------------------------------------------------------------
	public function lesGenresAuFormatHTML()
		{
		$liste = "<SELECT name = 'idGenre'>";
		foreach ($this->lesGenres as $unGenre)
			{
			$liste = $liste."<OPTION value='".$unGenre->getIdGenre()."'>".$unGenre->getLibelleGenre()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}		

//METHODE RETOURNANT UN genre A PARTIR DE SON NUMERO--------------------------------------------	
	public function donneObjetGenreDepuisNumero($unIdGenre)
		{
		//initialisation d'un booléen (on part de l'hypothèse que le genre n'existe pas)
		$trouve=false;
		$leBonGenre=null;
		//création d'un itérateur sur la collection lesGenres
		$iGenre = $this->lesGenres->getIterator();
		//TQ on a pas trouvé le genre et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iGenre->valid()))
			{
			//SI le numéro du genre courant correspond au numéro passé en paramètre
			if ($iGenre->current()->getIdGenre() == $unIdGenre)
				{
				//maj du booléen
				$trouve=true;
				//sauvegarde du genre courant
				$leBonGenre = $iGenre->current();
				
				}
			//SINON on passe au genre suivant
			else
				$iGenre->next();
			}
		return $leBonGenre;
		}		
	
	}
	
?> 
