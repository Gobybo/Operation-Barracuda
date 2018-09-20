<?php
include 'Conteneurs/conteneurClient.php';
include 'Conteneurs/conteneurEmprunt.php';
include 'Conteneurs/conteneurEpisode.php';
include 'Conteneurs/conteneurFilm.php';
include 'Conteneurs/conteneurGenre.php';
include 'Conteneurs/conteneurSaison.php';
include 'Conteneurs/conteneurSerie.php';
include 'Conteneurs/conteneurSupport.php';
include 'accesBD.php';

Class gestionVideo
	{
	//ATTRIBUTS PRIVES---------------------------------------------------------------------------------------------------------------------------
	private $tousLesClients;
	private $tousLesSupports;
	private $tousLesEmprunts;
	private $tousLesEpisodes;
	private $tousLesFilms;
	private $tousLesGenres;
	private $toutesLesSaisons;
	private $toutesLesSeries;
	private $maBD;
	
	//CONSTRUCTEUR--------------------------------------------------------------------------------------------------------------------------------
	public function __construct()
		{
		$this->tousLesClients = new conteneurClient();
		$this->tousLesGenres = new conteneurGenre();
		$this->tousLesSupports = new conteneurSupport();
		$this->tousLesFilms = new conteneurFilm();
		$this->toutesLesSeries = new conteneurSerie();
		$this->toutesLesSaisons = new conteneurSaison();
		$this->tousLesEpisodes = new conteneurEpisode();
		$this->tousLesEmprunts = new conteneurEmprunt();
		
		$this->maBD = new accesBD();
		
		$this->chargeLesClients();	
		$this->chargeLesGenres();
		$this->chargeLesSupports();
		$this->chargeLesFilms();
		$this->chargeLesSeries();
		$this->chargeLesSaisons();
		$this->chargeLesEpisodes();
		$this->chargeLesEmprunts();
	
		}
	
		
	//METHODE CHARGEANT TOUTES LES Clients--------------------------------------------------------------------------------------
	private function chargeLesClients()
	{
		$resultat=$this->maBD->chargement('client');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
			//instanciation du client et ajout de celui-ci dans la collection
			$this->tousLesClients->ajouteUnClient($resultat[$nb][0],$resultat[$nb][1],$resultat[$nb][2],$resultat[$nb][3],$resultat[$nb][4],$resultat[$nb][5],$resultat[$nb][6]);
			$nb++;
			
			}
			echo '<br>--> Liste de tous les clients : <br>';
			echo $this->tousLesClients->listeDesClients();
	}
	//METHODE CHARGEANT TOUS LES GENRES-----------------------------------------------------------------------------------
	private function chargeLesGenres()
		{
		$resultat=$this->maBD->chargement('genre');
		$nb=0;
	
		while ($nb<sizeof($resultat))
			{
				$this->tousLesGenres->ajouteUnGenre($resultat[$nb][0],$resultat[$nb][1]);
				
			$nb++;
			}
		echo '<br>--> Liste de tous les genres : <br>';
			echo $this->tousLesGenres->listeDesGenres();	
		}
	//METHODE CHARGEANT TOUS LES Supports-----------------------------------------------------------------------------------
	private function chargeLesSupports()
		{
		$resultat=$this->maBD->chargement('support');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
				$leGenre = $this->tousLesGenres->donneObjetGenreDepuisNumero($resultat[$nb][4]);
				$this->tousLesSupports->ajouteUnSupport($resultat[$nb][0],$resultat[$nb][1],$resultat[$nb][2],$resultat[$nb][3],$leGenre);
				
			$nb++;
			}
			echo '<br>--> Liste de tous les supports : <br>';
			echo $this->tousLesSupports->listeDesSupports();
		}
		//METHODE CHARGEANT TOUS LES FILMS-----------------------------------------------------------------------------------
	private function chargeLesFilms()
		{
		$resultat=$this->maBD->chargement('film');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
				$leSupport = $this->tousLesSupports->donneObjetSupportDepuisNumero($resultat[$nb][0]);
				$leGenre = $leSupport->getLeGenreDeSupport();
				$leGenre = $this->tousLesGenres->donneObjetGenreDepuisNumero($leGenre->getIdGenre());
				$this->tousLesFilms->ajouteUnFilm($resultat[$nb][0],$leSupport->getTitreSupport(),$leSupport->getRealisateurSupport(),$leSupport->getImageSupport(),$leGenre,$resultat[$nb][1]);
			$nb++;
			}
		echo '<br>--> Liste de tous les films : <br>';
			echo $this->tousLesFilms->listeDesFilms();
		}
	
//METHODE CHARGEANT TOUTES LES SERIES-----------------------------------------------------------------------------------
	private function chargeLesSeries()
		{
		$resultat=$this->maBD->chargement('serie');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
				$leSupport = $this->tousLesSupports->donneObjetSupportDepuisNumero($resultat[$nb][0]);
				$leGenre = $this->tousLesGenres->donneObjetGenreDepuisNumero($leSupport->getLeGenreDeSupport()->getIdGenre());
				$this->toutesLesSeries->ajouteUneSerie($resultat[$nb][0],$leSupport->getTitreSupport(),$leSupport->getRealisateurSupport(),$leSupport->getImageSupport(),$leGenre,$resultat[$nb][1]);
			$nb++;
			}
			echo '<br> --> toutes les Series : <br>';
			echo $this->toutesLesSeries->listeDesSeries();
		}	
//METHODE CHARGEANT TOUTES LES SAISONS-----------------------------------------------------------------------------------
	private function chargeLesSaisons()
		{
		$resultat=$this->maBD->chargement('Saison');
		$nb=0;
	
		while ($nb<sizeof($resultat))
			{   $laSerie = $this->toutesLesSeries->donneObjetSerieDepuisNumeroSerie($resultat[$nb][0]);
				$this->toutesLesSaisons->ajouteUneSaison($resultat[$nb][1],$resultat[$nb][2],$resultat[$nb][3],$laSerie);
			$nb++;
			}
			echo '<br> --> toutes les Saisons : <br>';
			echo $this->toutesLesSaisons->listeDesSaisons();
		}
		//METHODE CHARGEANT TOUTES LES EPISODES-----------------------------------------------------------------------------------
	private function chargeLesEpisodes()
		{
		$resultat=$this->maBD->chargement('episode');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
			$laSaison = $this->toutesLesSaisons->donneObjetSaisonDepuisNumero($resultat[$nb][0],$resultat[$nb][1]);
			$this->tousLesEpisodes->ajouteUnEpisode($resultat[$nb][2],$resultat[$nb][3],$resultat[$nb][4],$laSaison);
			$nb++;
			}
			echo '<br> --> tous les Episodes : <br>';
			echo $this->tousLesEpisodes->listeDesEpisodes();
		}
	//METHODE CHARGEANT TOUS LES EMPRUNTS -----------------------------------------------------------------------------------
	private function chargeLesEmprunts()
		{
		$resultat=$this->maBD->chargement('emprunt');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
				// récupérer le client et le support à partir de l'emprunt
				$leSupport = $this->tousLesSupports->donneObjetSupportDepuisNumero($resultat[$nb][3]);
				$unClient = $this->tousLesClients->donneObjetClientDepuisNumero($resultat[$nb][2]);
				$this->tousLesEmprunts->mettreUnEmpruntEnPlus($resultat[$nb][0], $resultat[$nb][1],$unClient,$leSupport);
			    $nb++;
			}
			echo '<br> --> tous les Emprunts : <br>';
			echo $this->tousLesEmprunts->listeDesEmprunts();
		}
			
		




//METHODE INSERANT UN CLIENT----------------------------------------------------------------------------------------------------------
	public function ajouteUnClient($unIdClient, $unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement)
		{
		//insertion du client dans la base de données
		$sonNumero = $this->maBD->insertClient($unIdClient, $unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement);
		//instanciation du client et ajout de celui-ci dans la collection
		$this->tousLesClients->ajouteUnClient($unIdClient, $unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement);
		}
	//METHODE INSERANT UN FILM----------------------------------------------------------------------------------------------------------
	public function ajouteUnFilm($unIdFilm,$unTitreFilm, $unRealisateurFilm, $unIdGenre,$uneDureeFilm)
		{
		//insertion du film dans la base de données
		$sonNumero = $this->maBD->insertFilm($unTitreFilm, $unRealisateurFilm, $unIdGenre,$uneDureeFilm);
		//instanciation du film et ajout de celui-ci dans la collection
		$leGenre= null;
		$leGenre=$leGenre->donneObjetGenreDepuisNumero($unIdGenre);
		$this->tousLesFilms->ajouteUnFilm($unIdFilm,$unTitreFilm, $unRealisateurFilm, $leGenre,$uneDureeFilm);
		}
	//METHODE INSERANT UNE SERIE----------------------------------------------------------------------------------------------------------
	public function ajouteUneSerie($unIdSerie,$unTitreSerie, $unRealisateurSerie, $unIdGenre,$unResumeSerie)
		{
		//insertion de la serie dans la base de données
		$sonNumero = $this->maBD->insertSerie($unTitreSerie, $unRealisateurSerie, $unIdGenre,$unResumeSerie);
		//instanciation de la serie et ajout de celui-ci dans la collection
		$leGenre= null;
		$leGenre=$leGenre->donneObjetGenreDepuisNumero($unIdGenre);
		$this->toutesLesSeries->ajouteUneSerie($unIdSerie,$unTitreSerie, $unRealisateurSerie, $leGenre,$unResumeSerie);
		}
		//METHODE INSERANT UN GENRE----------------------------------------------------------------------------------------------------------
	public function ajouteUnGenre($unLibelleGenre)
		{
		//insertion du genre dans la base de données
		$sonNumero = $this->maBD->insertGenre($unLibelleGenre);
		//instanciation du genre et ajout de celui-ci dans la collection
		$this->tousLesGenres->ajouteUnGenre($sonNumero,$unLibelleGenre);
		}
	//METHODE INSERANT UNE SAISON--------------------------------------------------------------------------------------------------------
	public function ajouteUneSaison($unIdSerie,$uneAnneeSaison, $unNbrEpisodesPrevus)
		{
		//insertion de la saison  dans la base de données
		$sonCode=$this->maBD->insertSaison($unIdSerie,$uneAnneeSaison, $unNbrEpisodesPrevus);
		$leGenre = null;
		$laSerie = null;
		$laSerie = $laSerie->donneObjetSerieDepuisNumero($unIdSerie);
		//instanciation de la saison et ajout de celle-ci dans la collection
		$this->toutesLesSaisons->ajouteUneSaison($unIdSaison,$uneAnneeSaison, $unNbrEpisodeSaison, $laSerie);
		}	
		
    //METHODE INSERANT UN EMPRUNT--------------------------------------------------------------------------------------------------------
	public function ajouteUnEmprunt($uneDateEmprunt, $unIdClient, $unIdSupport)
		{
		//insertion de l'emprunt  dans la base de données
		$sonCode=$this->maBD->insertEmprunt($uneDateEmprunt, $unIdClient, $unIdSupport);
		
		//instanciation de l'emprunt et ajout de celui-ci dans la collection
		$leClient = null;
		$leClient = $leClient->donneObjetClientDepuisNumero($unIdClient);
		$leGenre = null;
		$leSupport = null;
		$leSupport = $leSupport->donneObjetSupportDepuisNumero($unIdSupport);
		$this->tousLesEmprunts->ajouteUnEmprunt($sonCode, $uneDateEmprunt,$leClient,$leSupport);
		}	
	//METHODE INSERANT UN EPISODE --------------------------------------------------------------------------------------------------------
	public function ajouteUnEpisode($unIdSerie, $unNumSaison, $unTitreEpisode, $uneDuree)
		{
		//insertion d'un episode  dans la base de données
		$sonCode=$this->maBD->insertEpisode($unIdSerie, $unNumSaison, $unTitreEpisode, $uneDuree);
		
		//instanciation de l'épisode et ajout de celui-ci dans la collection
		$leGenre = null;
		$laSerie = null;
		$laSaison = null;
		$laSaison = $laSaison->donneObjetSaisonDepuisNumero($unIdSerie,$unNumSaison);
		$this->tousLesEpisodes->ajouteUnEpisode($sonCode,$unTitreEpisode,$uneDureeEpisode, $laSaison);
		}	
	//METHODE RETOURNANT LE NOMBRE DE CLIENT------------------------------------------------------------------------------------------------
	public function donneNbClients()
		{
		return $this->tousLesClients->nbClients();
		}

	//METHODE RETOURNANT LE NOMBRE DE FIlMS----------------------------------------------------------------------------------------------
	public function donneNbFilms()
		{
		return $this->tousLesFilms->nbFilms();
		}
	public function donneNbSeries()
		{
		return $this->toutesLesSeries->nbSeries();
		}		
	public function donneNbGenres()
		{
		return $this->tousLesGenres->nbGenres();
		}
	public function donneNbSaisons()
		{
		return $this->toutesLesSaisons->nbSaisons();
		}		
	public function donneNbEmprunts()
		{
		return $this->tousLesEmprunts->nbEmprunts();
		}
	public function donneNbEpisodes()
		{
		return $this->tousLesEpisodes->nbEpisodes();
		}
	//METHODE RETOURNANT LA LISTE DES differents elements-------------------------------------------------------------------------------------------------------
	public function listeLesClients()
		{
		return $this->tousLesClients->listeDesClients();
		}
	public function listeLesFilms()
		{
		return $this->tousLesFilms->listeDesFilms();
		}
	public function listeLesSeries()
		{
		return $this->toutesLesSeries->listeDesSeries();
		}
	public function listeLesGenres()
		{
		return $this->tousLesGenres->listeDesGenres();
		}
	public function listeLesSaisons()
		{
		return $this->toutesLesSaisons->listeLesSaisons();
		}
	public function listeLesEmprunts()
		{
		return $this->tousLesEmprunts->listeDesEmprunts();
		}
	public function listeLesEpisodes()
		{
		return $this->tousLesEpisodes->listeDesEpisodes();
		}		
			
	//METHODE RETOURNANT LA LISTE DES DIFFERENTS ELEMENTS DANS DES BALISES <SELECT>-----------------------------------------------------------------
	public function lesClientsAuFormatHTML()
		{
		return $this->tousLesClients->lesClientsAuFormatHTML();
		}
	public function lesFilmsAuFormatHTML()
		{
		return $this->tousLesFilms->lesFilmsAuFormatHTML();
		}	
	public function lesSeriesAuFormatHTML()
		{
		return $this->toutesLesSeries->lesSeriesAuFormatHTML();
		}	
	public function lesGenresAuFormatHTML()
		{
		return $this->tousLesGenres->lesGenresAuFormatHTML();
		}	
	public function lesSaisonsAuFormatHTML()
		{
		return $this->toutesLesSaisons->lesSaisonsAuFormatHTML();
		}	
	public function lesEmpruntsAuFormatHTML()
		{
		return $this->tousLesEmprunts->lesEmpruntsAuFormatHTML();
		}	
	public function lesEpisodesAuFormatHTML()
		{
		return $this->tousLesEpisodes->lesEpisodesAuFormatHTML();
		}		

		
	}
	
?>