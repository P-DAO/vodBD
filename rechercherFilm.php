<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Recherche</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style/vod.css">
    </head>
	<body>
	<header>
		<div class="menu">
		<nav>
			<a class="active" href="vod.html" title="Accueil">Films VOD </a>
			<a href="consulterFilms.php">Consulter</a>
			<a href="saisieTitreRecherche.html">Rechercher</a>
			<a href="saisieFilm.html">Ajouter</a>
			<a href="saisieTitreSuppression.html">Supprimer</a>
		</nav>
		</div>
	</header>
	<body>
		<section class="rech">
		<h1>Résultat de la recherche: </h1> <br/>
			<p>		
			<?php
			//Ouvre une connexion
				try{
					$bd = new PDO( 'mysql:host=localhost;dbname=vod', 'adminvod' , 'azerty' ) ;
				} catch ( PDOException $e ){
					die( 'Erreur : ' . $e->getMessage() );
				}
			//if ($_POST['search'] != '') { //vérification que le champ n'est pas vide	
				//Récupère la recherche
				$rech = ucwords( strtolower($_GET['rechTitre']));	
				try{
				//Requête de recherche
				$sql = $bd->prepare("SELECT * FROM Film WHERE titre LIKE ?");
				$sql ->execute(array('%'.$rech.'%'));
				//Nombre de résultats
				$nbr = $sql ->rowCount ();
				//Traitement du résultats
					if($nbr > 0){
						while($resultat = $sql->fetch( PDO::FETCH_OBJ )){
							echo "Titre du Film: " . $resultat->titre ."<br/>";
							echo "Année de sortie: " . $resultat->annee ."<br/>";
							echo "Le Réalisateur du film: ".$resultat->realisateur ."<br/>";
						}	
					}
					else{
						echo "Aucun résultat trouvé pour '$rech'";
					}
				}catch (Exception $e){
					echo "ERREUR!" .$e->getMessage() ;
				}
				unset($bd);
				$bd = NULL;
			/*}
			else{
				echo "Le champ de recherche est vide";
			}*/
			?>
			</p>
		<br/>	
		
		<a class="retour" href="saisieTitreRecherche.html"> RETOUR </a>
		<a class="retour" href="consulterFilms.php"> ACCUEIL</a>		
		</section>
	</body>
</html>
