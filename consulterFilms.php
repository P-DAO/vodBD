<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Consulter</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style/vod.css">
    </head>
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
	<section class="consult">
	<h1>Liste des films en VOD</h1>
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
						//connection
						$bd = new PDO( 'mysql:host=localhost;dbname=vod', 'adminvod' , 'azerty' ) ;
					} catch ( PDOException $e ){
						die( 'Erreur : ' . $e->getMessage() );
					}
					//Requête pour consulter 
						$sql = 'SELECT * FROM Film' ;
						$resultat = $bd->query( $sql );
						$lines = $resultat->fetchAll( PDO::FETCH_ASSOC ) ;
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
	</section>
	</body>
</html>
