<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Suppression</title>
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
		<section class="supp">
		<h1>Résultat de la suppression du film: </h1>
			<table>
				<thead>
					<tr>
						<th>Numéro</th>
						<th>Titre du Film</th>
						<th>Année de sortie </th>
						<th>Réalisateur</th>
					</tr>
				</thead>
				<tbody>
			<?php
				try{
					$bd = new PDO( 'mysql:host=localhost;dbname=vod', 'adminvod' , 'azerty' ) ;
				} catch ( PDOException $e ){
					die( 'Erreur : ' . $e->getMessage() );
					}
				$supp = ucwords( strtolower($_GET['suppTitre']));
				try{
				//Requête de recherche
					$sql = $bd->prepare('SELECT * FROM Film WHERE titre = "'.$supp.'"');
					$sql->execute(array('%'.$supp.'%'));
					$nbr = $sql->rowCount();
					//Requête de suppression
					if($nbr>0){
						$dsql = 'DELETE FROM Film WHERE titre = "'.$supp.'"';
						$resultat = $bd->exec($dsql);

					//Numérotation automatique
						$maj = $bd->prepare('ALTER TABLE Film DROP COLUMN numFILM');
							$maj ->execute(array());
							$maj2 = $bd->prepare('ALTER TABLE Film ADD numFilm INT NOT NULL AUTO_INCREMENT PRIMARY KEY');
							$maj2 ->execute(array());
						
						echo "<p>"."Le film a bien été supprimé!"."</p>";
					}
					else{
						echo "<p>"."Suppression IMPOSSIBLE!"."<br/>"." Film non recencé!"."</p>" ;
					}
					
				}catch ( PDOExection $e ) {
				die( 'Suppression IMPOSSIBLE: ' .$e->getMessage() );
				}
				//Affichage du tableau complet
				$sql = 'SELECT * FROM Film' ;
				$bilan = $bd->query( $sql );
				$lines = $bilan->fetchAll( PDO::FETCH_ASSOC ) ;
					foreach( $lines as $line ){
						echo "<tr>";
						echo "<td>" . $line ['numFilm'] . "</td>";
						echo "<td>" . $line ['titre'] . "</td>";
						echo "<td>" . $line ['annee'] . "</td>";
						echo "<td>" . $line ['realisateur'] . "</td>";
						echo "</tr>";
					}
				unset( $bd ) ;
				$bd = NULL;
				
			?>
			</tbody>
		</table>
		<a class="retour" href="saisieTitreSuppression.html"> RETOUR </a>  
		<a class="retour" href="consulterFilms.php"> ACCUEIL</a>
		</section>
	</body>
</html>	
