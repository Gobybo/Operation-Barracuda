<?php
//include du fichier GESTION pour les objets (Modeles)
include 'Modeles/gestionVideo.php';
?>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap-grid.min.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap-reboot.min.css" type="text/css"/>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
//classe CONTROLEUR qui redirige vers les bonnes vues les bonnes informations
class Controleur
	{
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------ATTRIBUTS PRIVES-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private $maVideotheque;
	private $maBD;


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CONSTRUCTEUR------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function __construct()
		{
		$this->maVideotheque = new gestionVideo();
		$this->maBD = new accesBD();
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------METHODE D'AFFICHAGE DE L'ENTETE-----------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function afficheEntete()
		{
		//appel de la vue de l'entête
		require 'Vues/entete.php';
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------METHODE D'AFFICHAGE DU PIED DE PAGE------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function affichePiedPage()
		{
		//appel de la vue du pied de page
		require 'Vues/piedPage.php';
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------METHODE D'AFFICHAGE DU MENU-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function afficheMenu()
		{
		//appel de la vue du menu
		require 'Vues/menu.php';
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------METHODE D'AFFICHAGE DES VUES----------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function affichePage($action,$vue)
		{
		//SELON la vue demandée
		switch ($vue)
			{
			case 'compte':
				$this->vueCompte($action);
				break;
			case 'film':
				$this->vueFilm($action);
				break;
			case 'serie':
				$this->vueSerie($action);
				break;
			case 'Videotheque':
				$this->vueRessource($action);
				break;
			case "accueil":
				session_destroy();
				break;
			}
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------Mon Compte--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueCompte($action)
		{

		//SELON l'action demandée
		switch ($action)
			{

			//CAS visualisation de mes informations-------------------------------------------------------------------------------------------------
			case 'visualiser' :
				//ici il faut pouvoir avoir accès au information de l'internaute connecté
				require 'Vues/construction.php';
				break;

			//CAS enregistrement d'une modification sur le compte------------------------------------------------------------------------------
			case 'modifier' :
				// ici il faut pouvoir modifier le mot de passe de l'utilisateur
				$this->afficheMenu();
				echo "
				<div class='container h-100'>
						<div class='row h-100 justify-content-center align-items-center'>

							<div class='form-group'>
							<h3 class='head-table-connexion text-white'>Modification du mot de passe</h3>
							<form action='index.php?vue=compte&action=resetPwd&login=".$_GET['login']."&password=".$_GET['password']."' method=GET>
								<input class='form-control' type='password' name='oldPwd' placeholder='Mot de passe actuel'/><br>
								<input class='form-control' type='password' name='newPwd' placeholder='Nouveau mot de passe'/><br>
								<input class='form-control' type='password' name='confirmPwd' placeholder='Confirmez votre nouveau mot de passe'/><br>
								<input class='btn btn-outline-danger mx-auto' type='submit' value='Modifier mon mot de passe'/>
							</form>
							</div>
						</div>
				</div>";


				break;

				case 'resetPwd' :
					$oldPwd = $_GET['oldPwd'];
					$newPwd = $_GET['newPwd'];
					$confirmPwd = $_GET['confirmPwd'];

					if ($oldPwd == $_GET['password']) {
						if($newPwd == $confirmPwd) {
							// Modif BDD et retour accueil
							$this->maVideotheque->modifPwd($_GET['login'], $newPwd);
						}
						else {
							// erreur mots de passes différents et retour form
							echo "non";
						}
					} else {
						// MDP incorrect, retour form
						echo "
						</nav>
						<div class='container h-50'>
							<div class='row h-10 justify-content-center align-items-center'>
								<p class='head-table-connexion text-white'> Mot de passe incorrect </p>
							</div>
							<div class='row h-10 justify-content-center align-items-center'>
								<form>
									<input class='btn btn-outline-danger mx-auto' type='button' value='Retour' onclick='history.back()'>
								</form>
							</div>
						</div>
							";
					}
				break;
			//CAS ajouter un utilisateur ------------------------------------------------------------------------------
			case 'nouveauLogin' :
				// ici il faut pouvoir recuperer un nouveau utilisateur
				$unNomClient=$_GET['nomClient'];
				$unPrenomClient=$_GET['prenomClient'];
				$unEmailClient=$_GET['emailClient'];
				$uneDateAbonnement=$_GET['dateAbonnementClient'];
				$unLoginClient=$_GET['login'];
				$unPwdClient=$_GET['password'];

				$query=$this->maVideotheque->ajouteUnClient($unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement,$unLoginClient,$unPwdClient);
				break;
			//CAS verifier un utilisateur ------------------------------------------------------------------------------
			case 'verifLogin' :
				// ici il faut pouvoir vérifier un login un nouveau utilisateur
				//Je récupère les login et password saisi et je verifie leur existancerequire
				//pour cela je verifie dans le conteneurClient via la gestion.
				$unLogin=$_GET['login'];
				$unPassword=$_GET['password'];
				$resultat=$this->maVideotheque->verifLogin($unLogin, $unPassword);
				$actif=$this->maBD->verifActif($unLogin);
				print_r($resultat);
				echo "slt";
						//si le client existe alors j'affiche le menu et la page visuGenre.php
						if($resultat==1 && $actif ==1)
						{
							require 'Vues/menu.php';
							echo $this->maVideotheque->listeLesGenres();
						}
						elseif($resultat ==0)
						{
							// destroy la session et je repars sur l'acceuil en affichant un texte pour prévenir la personne
							//des mauvais identifiants;
							session_destroy();
							echo "</nav>
									<div class='container h-100'>
										<div class='row h-100 justify-content-center align-items-center'>
											<span class='text-white'>Identifiants incorrects</span>
										</div>
									</div>
									<meta http-equiv='refresh' content='1;index.php'>";
						}
						elseif($resultat == 1 && $actif == 0) {
							echo "
							</nav>
							<div class='container h-50'>
				                    <div class='row h-10 justify-content-center align-items-center'>
										<p class='head-table-connexion text-white'> Votre compte n'est pas actif. </p>
									</div>
									<div class='row h-10 justify-content-center align-items-center'>
										<form>
											<input class='btn btn-outline-danger mx-auto' type='button' value='Retour' onclick='history.back()'>
										</form>
									</div>
							</div>
								";
						}
				break;
			}
		}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------Film--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueFilm($action)
		{
		//SELON l'action demandée
		switch ($action)
			{

			//CAS visualisation de tous les films-------------------------------------------------------------------------------------------------
			case "visualiser" :
				//ici il faut pouvoir visualiser l'ensemble des films
				require 'Vues/construction.php';
				break;

			}
		}

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------Serie--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueSerie($action)
		{
		//SELON l'action demandée
		switch ($action)
			{

			//CAS visualisation de toutes les Series-------------------------------------------------------------------------------------------------
			case "visualiser" :
				//ici il faut pouvoir visualiser l'ensemble des Séries
				require 'Vues/construction.php';
				break;

			}
		}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------Vidéotheque-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueVideotheque($action)
		{
		//SELON l'action demandée
		switch ($action)
			{

			//CAS Choix d'un genre------------------------------------------------------------------------------------------------
			case "choixGenre" :
				if ($this->maVideotheque->donneNbGenres()==0)
					{
					$message = "il n existe pas de genre";
					$lien = 'index.php?vue=ressource&action=ajouter';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/erreur.php';
					}
				else
					{
					$_SESSION['lesRessources'] = $this->maMairie->listeLesRessources();
					require 'Vues/voirRessource.php';
					}
				break;

			//CAS enregistrement d'une ressource dans la base------------------------------------------------------------------------------
			case "enregistrer" :
				$nom = $_GET['nomRessource'];
				if (empty($nom))
					{
					$message = "Veuillez saisir les informations";
					$lien = 'index.php?vue=ressource&action=ajouter';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/erreur.php';
					}
				else
					{
					$this->maMairie->ajouteUneressource($nom);
					require 'Vues/enregistrer.php';
					//$_SESSION['Controleur'] = serialize($this);
					}
				break;
			}
		}

	}
?>
