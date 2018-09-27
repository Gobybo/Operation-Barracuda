<?php
include_once('Modeles/Metiers/support.php');

Class conteneurSupport
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesSupports;
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct()
		{
		$this->lesSupports = new arrayObject();
		}
	
	//METHODE AJOUTANT UN Support------------------------------------------------------------------------------
	public function ajouteUnSupport($unIdSupport, $unTitreSupport, $unRealisateurSupport, $uneImageSupport, $leGenreSupport, $unLienTelechargementSupport)
		{
		$unSupport = new support($unIdSupport, $unTitreSupport, $unRealisateurSupport, $uneImageSupport, $leGenreSupport, $unLienTelechargementSupport);
		$this->lesSupports->append($unSupport);
			
		}
		
	//METHODE RETOURNANT LE NOMBRE de Support-------------------------------------------------------------------------------
	public function nbSupports()
		{
		return $this->lesSupports->count();
		}	
	//METHODE RETOURNANT LA LISTE DES  films-----------------------------------------------------------------------------------------
	public function listeDesSupports()
		{
		$liste = '';
		foreach ($this->lesSupports as $unSupport)
			{	$liste = $liste.'Support N° : "'.$unSupport->getIdSupport().' -> Titre : '.$unSupport->getTitreSupport().' - '.$unSupport->getLeGenreDeSupport()->getLibelleGenre().'><br>';
			}
		return $liste;
		}
				//METHODE RETOURNANT LA LISTE DES supports DANS UNE BALISE <SELECT>------------------------------------------------------------------
	public function lesSupportsAuFormatHTML()
		{
		$liste = "<SELECT name = 'idSupport'>";
		foreach ($this->lesSupports as $unSupport)
			{
			$liste = $liste."<OPTION value='".$unSupport->getIdSupport()."'>".$unSupport->getTitreSupport()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}		
	
//METHODE RETOURNANT UN Support A PARTIR DE SON NUMERO--------------------------------------------	
	public function donneObjetSupportDepuisNumero($unIdSupport)
		{
		//initialisation d'un booléen (on part de l'hypothèse que le Support n'existe pas)
		$trouve=false;
		$leBonSupport=null;
		//création d'un itérateur sur la collection lesEmpruntsFilms
		$iSupport = $this->lesSupports->getIterator();
		//TQ on a pas trouvé le support et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iSupport->valid()))
			{
			//SI le numéro du support courant correspond au numéro passé en paramètre
			if ($iSupport->current()->getIdSupport()==$unIdSupport)
				{
				//maj du booléen
				$trouve=true;
				//sauvegarde le Support courant
				$leBonSupport = $iSupport->current();
				
				}
			//SINON on passe au Support suivant
			else
				$iSupport->next();
			}
			return $leBonSupport;
		}
		
	public function donneListeSUpportDepuisIdGenre($idGenre)
		{
		$liste = "<div class='container'>
					<section class='row'>";
		
		foreach($this->lesSupports as $unSupport)
		{
			if($unSupport->getLeGenreDeSupport()->getIdGenre() == $idGenre)
			{
				$liste = $liste.'
				<div class="col-xs-4 col-sm-4 col-md-4"><img src="Images/'.$unSupport->getImageSupport().'" class="rounded mx-auto d-block" style="width : 200px; length : 200px;">
				<figcaption class="figure-caption text-center">'.$unSupport->getTitreSupport().'</a>
				<br/>
				<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalLong'.$unSupport->getIdSupport().'">Commander</button>
				</figcaption>
				<div class="modal fade" id="exampleModalLong'.$unSupport->getIdSupport().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Votre commande</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<img src="Images/'.$unSupport->getImageSupport().'" style="width : 200px; length : 200px; float : left;" />
							<a style="text-decoration : underline;">'.$unSupport->getTitreSupport().'</a><br/><a style="font-size : smaller;">'.$unSupport->getRealisateurSupport().'</a>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
								<button type="button" class="btn btn-primary"><a style="color : white;" href="Supports/Support1.zip">Valider la commande</a></button>
							</div>
						</div>
					</div>
				</div><br/></div>';
			}
		}
		$liste=$liste."</section></div>";
		return $liste;
		}
	
	}
	
	
	
	
?> 