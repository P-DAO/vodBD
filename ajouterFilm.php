<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Ajout</title>
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
		<section class="ajout">
			<h1>Résultat du film ajouter:</h1>
			<table>
				<thead>
					<tr>
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
						try{
						//Requête d'ajout
							$bd->beginTransaction();
							$sql = 'INSERT INTO Film (`titre`, `annee`, `realisateur`) VALUES("'. ucwords( strtolower($_POST['adTitre'])).'","'.$_POST['adAnnee'].'","'.ucwords( strtolower($_POST['adReal'])).'")';
							$resultat = $bd->exec($sql);
							
						//Numérotation automatique	
							$maj = $bd->prepare('ALTER TABLE Film DROP COLUMN numFILM');
							$maj ->execute(array());
							$maj2 = $bd->prepare('ALTER TABLE Film ADD numFilm INT NOT NULL AUTO_INCREMENT PRIMARY KEY');
							$maj2 ->execute(array());
							
							$bd->commit();
							
						}catch ( PDOException $e ) {
							$bd->rollback();
							die('Erreur :' .$e->getMessage() );
						}
						//Affichage des élèments entrés
					echo "<tr>";
					echo "<td>" . ucwords( strtolower($_POST['adTitre'])) . "</td>" ;
					echo "<td>" . $_POST["adAnnee"] . "</td>" ;
					echo "<td>" . ucwords( strtolower($_POST['adReal'])) . "</td>" ;
					echo "</tr>";
							if($resultat)
								echo "<p> Le film a été ajouté</p>";
							else 
								echo "<p> Erreur </p>"
					?>
				</tbody>
			</table>
		<section>
		<a class="retour" href="saisieFilm.html"> RETOUR </a> 
		<a class="retour" href="consulterFilms.php"> ACCUEIL</a>
	</body>
</html>
