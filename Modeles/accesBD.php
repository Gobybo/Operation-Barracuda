<?php

class accesBD
	{
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------ATTRIBUTS PRIVES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private $hote;
	private $login;
	private $passwd;
	private $base;
	private $conn;
	private $port;
	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------CONSTRUCTEUR------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function __construct()
		{
		// ORDI PROFSIO
		$this->hote="172.16.0.50";
		$this->port="";
		$this->login="ALT18MOREAU";
		$this->passwd="Benj1008";
		$this->base="videoppe3moreau";
		
		// ORDI DEV2
		/*$this->hote = "localhost";
		$this->port = "";
		$this->login = "Panda";
		$this->passwd = "UgbNu74!";
		$this->base = "videoppe3";*/
		$this->connexion();
		
		}
	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-----------------------------CONNECTION A LA BASE---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function connexion()
	{
		try
        {
			//echo "sqlsrv:server=$this->hote$this->port;Database=$this->base"." | ".$this->login." | ".$this->passwd;
			// Pour SQL Server
			$this->conn = new PDO("sqlsrv:server=$this->hote$this->port;Database=$this->base", $this->login, $this->passwd);
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
            
            // Pour Mysql/MariaDB
            /*$this->conn = new PDO("mysql:dbname=$this->base;host=$this->hote",$this->login, $this->passwd);*/
            $this->boolConnexion = true;
        }
        catch(PDOException $e)
        {
            die("Connection à la base de données échouée".$e->getMessage());
        }
	}
	
	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------CHARGEMENT DES INFORMATIONS DE LA BASE--------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function chargement($uneTable)
		{
		$lesInfos=null;
		$nbTuples=0;
		$stringQuery="SELECT * FROM ";

		//définition de la requête SQL
		//On prépare la
		$stringQuery = $this->specialCase($stringQuery,$uneTable);
		$query = $this->conn->prepare($stringQuery);
		//POUR chaque tuple retourné par la requête SQL
		if($query->execute())
		{
			while($row = $query->fetch(PDO::FETCH_NUM))
			{
				$lesInfos[$nbTuples] = $row;
				$nbTuples++;
				
			}
		}
		else
		{
			die('Problème dans chargement : '.$query->errorCode());
		}

		//retour du tableau à deux dimension
		return $lesInfos;
	}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CREATION DE LA REQUETE D'INSERTION Client-------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function insertClient($unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement,$unLoginClient,$unPwdClient)
		{
		//génération automatique de l'identifiant
		$sonId = $this->donneProchainIdentifiant("client","idClient");
		
		$requete = $this->conn->prepare("INSERT INTO CLIENT (nomClient,prenomClient, emailClient, dateAbonnementClient,loginClient, pwdClient) VALUES (?,?,?,?,?,?)");
		//définition de la requête SQL
		$requete->bindValue(1,$unNomClient);
		$requete->bindValue(2,$unPrenomClient);
		$requete->bindValue(3,$unEmailClient);
		$requete->bindValue(4,$uneDateAbonnement);
		$requete->bindValue(5,$unLoginClient);
		$requete->bindValue(6,$unPwdClient);
		//exécution de la requête SQL
		if(!$requete->execute())
		{
			die("Erreur dans insertClient : ".$requete->errorCode());
		}

		//retour de l'identifiant du nouveau tuple
		return $sonId;
		}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CREATION DE LA REQUETE D'INSERTION DES GENRES------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function insertGenre($unLibelleGenre)
		{
		//génération automatique de l'identifiant
		$sonId = $this->donneProchainIdentifiant("genre","idGenre");
		
		//définition de la requête SQL
		$requete = $this->conn->prepare("INSERT INTO genre (libelleGenre) VALUES (?)");
		$requete->bindValue(1,$unLibelleGenre);

		//exécution de la requête SQL
		if(!$requete->execute())
		{
			die("Erreur dans insertGenre : ".$requete->errorCode());
		}

		//retour de l'identifiant du nouveau tuple
		return $sonId;
		}	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CREATION DE LA REQUETE D'INSERTION des FILMS-------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function insertFilm($unTitreFilm, $unRealisateurFilm, $unIdGenre,$uneDureeFilm)
		{
		//génération automatique de l'identifiant
		$sonId = $this->donneProchainIdentifiant("support","idSupport");
		//définition de la requête SQL pour le support
		$requete = $this->conn->prepare("INSERT INTO support (titreSupport, realisateurSupport, idGenre) VALUES (?,?,?);");
		$requete->bindValue(1,$unTitreFilm);
		$requete->bindValue(2,$unRealisateurFilm);
		$requete->bindValue(3,$unIdGenre);
		//exécution de la requête SQL
		if(!$requete->execute())
		{
			die("Erreur dans insertSupport : ".$requete->errorCode());
		}
		//définition de la requête SQL pour le film
		$requete = $this->conn->prepare("INSERT INTO film (idFilm, dureeFilm) VALUES (?,?);");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$uneDureeFilm);
		//exécution de la requête SQL
		if(!$requete->execute())
		{
			die("Erreur dans insertFilm : ".$requete->errorCode());
		}
		//retour de l'identifiant du nouveau tuple
		return $sonId;
		}	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CREATION DE LA REQUETE D'INSERTION des SERIES-------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function insertSerie($unTitreFilm, $unRealisateurFilm, $unIdGenre,$unResumeSerie)
		{
		//génération automatique de l'identifiant
		$sonId = $this->donneProchainIdentifiant("support","idSupport");
		//définition de la requête SQL pour le support
		$requete = $this->conn->prepare("INSERT INTO support (titreSupport, realisateurSupport, idGenre) VALUES (?,?,?);");
		$requete->bindValue(1,$unTitreFilm);
		$requete->bindValue(2,$unRealisateurFilm);
		$requete->bindValue(3,$unIdGenre);
		//exécution de la requête SQL
		if(!$requete->execute())
		{
			die("Erreur dans insertSupport : ".$requete->errorCode());
		}
		//définition de la requête SQL pour le film
		$requete = $this->conn->prepare("INSERT INTO serie (idSerie, resumeSerie) VALUES (?,?);");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unResumeSerie);
		//exécution de la requête SQL
		if(!$requete->execute())
		{
			die("Erreur dans insertSerie : ".$requete->errorCode());
		}
		//retour de l'identifiant du nouveau tuple
		return $sonId;
		}	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CREATION DE LA REQUETE D'INSERTION d'une Saison ------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function insertSaison($unIdSerie,$uneAnneeSaison, $unNbrEpisodesPrevus)
		{
		//génération automatique de l'identifiant de la Saison
		$sonId = $this->donneProchainIdentifiantSaison("saison","idSerie");
		//définition de la requête SQL
		$requete = $this->conn->prepare("INSERT INTO saison (idSerie,idSaison,anneeSaison, nbrEpisodesPrevus) VALUES (?,?,?,?);");
		$requete->bindValue(1,$unIdSerie);
		$requete->bindValue(2,$sonId);
		$requete->bindValue(3,$uneAnneSaison);
		$requete->bindValue(4,$unNbrEpisodesPrevus);

		//exécution de la requête SQL
		if(!$requete->execute())
		{
			die("Erreur dans insertSaison : ".$requete->errorCode());
		}

		//retour de l'identifiant du nouveau tuple
		return $sonId;
		}	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CREATION DE LA REQUETE D'INSERTION d'un épisode ------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function insertEpisode($unIdSerie, $unNumSaison, $unTitreEpisode, $uneDuree)
		{
		//génération automatique de l'identifiant de episode
		$sonId = $this->donneProchainIdentifiantEpisode("episode","idSerie","idSaison");
		//définition de la requête SQL
		$requete = $this->conn->prepare("INSERT INTO saison (idSerie,idSaison,idEpisode, titreEpisode, duree) VALUES (?,?,?,?,?);");
		$requete->bindValue(1,$unIdSerie);
		$requete->bindValue(2,$unNumSaison);
		$requete->bindValue(3,$sonId);
		$requete->bindValue(4,$unTitreEpisode);
		$requete->bindValue(5,$uneDuree);

		//exécution de la requête SQL
		if(!$requete->execute())
		{
			die("Erreur dans insertEpisode : ".$requete->errorCode());
		}

		//retour de l'identifiant du nouveau tuple
		return $sonId;
		}	
			
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CREATION DE LA REQUETE D'INSERTION d'emprunt ------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function insertEmprunt($uneDateEmprunt, $unIdClient, $unIdSupport)
		{
	    //génération automatique de l'identifiant de l'emprunt
		$sonId = $this->donneProchainIdentifiantSaison("emprunt","idEmprunt");
		//définition de la requête SQL
		$requete = $this->conn->prepare("INSERT INTO Emprunt (dateEmprunt, idClient, idSupport) VALUES (?,?,?)");
		$requete->bindValue(1,$uneDateEmprunt);
		$requete->bindValue(2,$unIdClient);
		$requete->bindValue(3,$unIdSupport);
		
		//exécution de la requête SQL
		if(!$requete->execute())
		{
			die("Erreur dans insertEmprunt : ".$requete->errorCode());
		}

		//retour de l'identifiant du nouveau tuple
		return $sonId;
		}
		
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-----------------------------EXECUTION D'UNE REQUETE---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		private function specialCase($stringQuery,$uneTable)
		{
			$uneTable = strtoupper($uneTable);
			switch ($uneTable) {
			case 'CLIENT':
				$stringQuery.='CLIENT';
				break;
			case 'GENRE':
				$stringQuery.='GENRE';
				break;
			case 'SUPPORT':
				$stringQuery.='SUPPORT';
				break;
			case 'FILM':
				$stringQuery.='FILM';
				break;
			case 'SERIE':
				$stringQuery.='SERIE';
				break;
			case 'SAISON':	
				$stringQuery.='SAISON';
				break;
			case 'EPISODE':	
				$stringQuery.='EPISODE';
				break;
			case 'EMPRUNT':	
				$stringQuery.='EMPRUNT';
				break;
			default:
				die('Pas une table valide');
				break;
			}

			return $stringQuery.";";
		}
	
	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-----------------------------DONNE LE PROCHAIN INDENTIFIANT---------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function donneProchainIdentifiant($uneTable,$unIdentifiant)
		{
		//$prochainId[0]=0;
		//définition de la requête SQL
		$stringQuery = $this->specialCase("SELECT * FROM ",$uneTable);
		echo $stringQuery;
		$requete = $this->conn->prepare($stringQuery);
		$requete->bindValue(1,$unIdentifiant);

		//exécution de la requête SQL
		if($requete->execute())
		{
			$nb=0;
			//Retourne le prochain identifiant
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{

				$nb = $row[0];
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur donneProchainIdentifiant : '+$requete->errorCode());
		}
		}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-----------------------------DONNE LE PROCHAIN INDENTIFIANT D'UNE SAISON---------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function donneProchainIdentifiantSaison($uneTable,$unIdentifiantSerie)
		{
		//$prochainId[0]=0;
		//définition de la requête SQL
		$stringQuery = $this->specialCase("SELECT MAX(NUMSAISON) FROM ",$uneTable,"WHERE idSerie = ",$unIdentifiantSerie,";");
		echo $stringQuery;
		$requete = $this->conn->prepare($stringQuery);
		$requete->bindValue(1,$unIdentifiantSerie);

		//exécution de la requête SQL
		if($requete->execute())
		{
			$nbSaison=0;
			//Retourne le prochain identifiant
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{

				$nbSaison = $row[0];
			}
			return $nbSaison+1;
		}
		else
		{
			die('Erreur sur donneProchainIdentifiantSaison : '+$requete->errorCode());
		}
		}	
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-----------------------------DONNE LE PROCHAIN INDENTIFIANT D'UNE SAISON---------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function donneProchainIdentifiantEpisode($uneTable,$unIdentifiantSerie, $unIdentifiantSaison)
		{
		//$prochainId[0]=0;
		//définition de la requête SQL
		$stringQuery = $this->specialCase("SELECT MAX(NUMEPISODE) FROM ",$uneTable,"WHERE IDSERIE = ",$unIdentifiantSerie," AND IDSAISON =",$unIdSaison,";");
		echo $stringQuery;
		$requete = $this->conn->prepare($stringQuery);
		$requete->bindValue(1,$unIdentifiantSerie);

		//exécution de la requête SQL
		if($requete->execute())
		{
			$nbEpisode=0;
			//Retourne le prochain identifiant
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{

				$nbEpisode = $row[0];
			}
			return $nbEpisode+1;
		}
		else
		{
			die('Erreur sur donneProchainIdentifiantEpisode : '+$requete->errorCode());
		}
		}	
	}

?>
