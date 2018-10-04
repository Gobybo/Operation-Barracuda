<?php
session_start();
include 'Controleur.php';

function chargerPage()
{
	$monControleur = new Controleur();
	$monControleur->afficheEntete();
		if(isset($_GET['login']))
		{
				if ((isset($_GET['vue'])) && (isset($_GET['action'])))
				{
					echo $_GET['vue'].",".$_GET['action'];
						$monControleur->affichePage($_GET['action'],$_GET['vue']);

				}
				else
				{
					$monControleur->affichePiedPage();
				}
		}
		else
		{
					premier_affichage();
		}
	$monControleur->affichePiedPage();
}
	function premier_affichage()
	{
		echo "</nav>
                <div class='container h-100'>
                    <div class='row h-100 justify-content-center align-items-center'>
                        <table class='table w-50'>
                            <thead>
                                <td class='head-table-connexion text-white'>Je suis déjà client</td>
                                <td class='head-table-connexion text-white'>Je crée mon compte</td>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class='td-table justify-content-center'>
                                        <form action=index.php method=GET>
																					<div class='form-group'>
                                            <input class='form-control' type='text' placeholder='Login' name='login'/><br>
                                            <input class='form-control' type='password' placeholder='Mot de passe' name='password'/><br>
                                            <input type='hidden' name='vue' value='compte'>
                                            <input type='hidden' name='action' value='verifLogin'/>
                                            <input class='btn btn-outline-danger mx-auto' type='submit' value='Se connecter'/>
																					</div>
                                        </form>
                                    </td>
                                    <td class='justify-content-center td-table'>
                                        <form action='index.php?vue=compte&action=nouveauLogin' method=GET>
											<div class='form-group'>
												<input class='form-control' type='text' name='nomClient' placeholder='Saisir votre nom'/><br>
												<input class='form-control' type='text' name='prenomClient' placeholder='Saisir votre prenom'/><br>
												<input class='form-control' type='text' name='emailClient' placeholder='Saisir votre email'/><br>
												<input class='form-control' type='date' name='dateAbonnementClient' placeholder='Date souhaitée d abonnement'/><br>
												<input class='form-control' type='text' name='login' placeholder='Saisir votre login'/><br>
												<input class='form-control' type='password' name='password' placeholder='Choisir un mot de passe'/><br>
												<input type='hidden' name='vue' value='compte'>
												<input type='hidden' name='action' value='nouveauLogin'/>
												<input class='btn btn-outline-danger' type='submit' value='S&acute;inscrire'/>
											</div>
                                        </form>
                                    </td>
                            </tbody>
                        </table>
                    </div>
                </div>";
	}

	chargerPage();


?>
