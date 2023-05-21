<?php
    $identifiant = $_GET['identifiant'];
    $mdp = $_GET['mdp'];
    
    include_once('../../fonc_utiles.php');
    $connexion = connexion();
    $admin = connexionAdmin($connexion, $identifiant, $mdp);

	if($admin === true)
	{
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/ajoutdepokemon.css">
	<link rel="icon" type="image/x-icon" href="../IMG/Pokeball.ico">
	<title>Création de Pokemon</title>
</head>

<body>
	<form action="create_pokemon.php" method="post">
		<label for="nom">Nom :</label>
		<input type="text" name="nom" required><br>

		<label for="numero">Numéro :</label>
		<input type="number" name="numero" required><br>

		<label for="taille">Taille :</label>
		<input type="number" step="any" name="taille" required><br>

		<label for="poids">Poids :</label>
		<input type="number" step="any" name="poids" required><br>

		<label for="genre">Genre :</label>
		<select name="genre" required>
			<option value="Male">Mâle</option>
			<option value="Femelle">Femelle</option>
			<option value="Les deux">Les deux</option>
			<option value="Non-genre">Non-genré</option>
		</select><br>

		<label for="points_vie">Points de vie :</label>
		<input type="number" name="points_vie" required><br>

		<label for="attaque">Attaque :</label>
		<input type="number" name="attaque" required><br>

		<label for="defense">Défense :</label>
		<input type="number" name="defense" required><br>

		<label for="attaque_speciale">Attaque spéciale :</label>
		<input type="number" name="attaque_speciale" required><br>

		<label for="defense_speciale">Défense spéciale :</label>
		<input type="number" name="defense_speciale" required><br>

		<label for="vitesse">Vitesse :</label>
		<input type="number" name="vitesse" required><br>

		<label for="categorie">Catégorie :</label>
		<input type="text" name="categorie" required><br>

		<label for="region">Région :</label>
		<input type="text" name="region" required><br>

		<label for="photo">Photo (URL) :</label>
		<input type="url" name="photo" required><br>

		<label for="faiblesses">Faiblesses :</label>
		<div id="faiblesses-container">
			<input type="text" name="faiblesses[]" required><br>
		</div>
		<button type="button" onclick="ajouterChamp('faiblesses-container')">Ajouter une faiblesse</button><br><br>

		<label for="types">Types :</label>
		<div id="types-container">
			<input type="text" name="types[]" required><br>
		</div>
		<button type="button" onclick="ajouterChamp('types-container')">Ajouter un type</button><br><br>

		<label for="evolutions">Évolutions :</label>
		<div id="evolutions-container">
			<input type="text" name="evolutions[]"><br>
		</div>
		<button type="button" onclick="ajouterChamp('evolutions-container')">Ajouter une évolution</button><br><br>

		<label for="talents">Talents :</label>
		<div id="talents-container">
			<input type="text" name="talents[]" required><br>
		</div>
		<button type="button" onclick="ajouterChamp('talents-container')">Ajouter un talent</button><br><br>

		<label for="versions">Versions :</label>
		<div id="versions-container">
			<input type="text" name="versions[]" required><br>
		</div>
		<button type="button" onclick="ajouterChamp('versions-container')">Ajouter une version</button><br><br>

		<input type="submit" value="Créer le Pokémon">
	</form>

	<script src='../JS/ajoutdepokemon.js'></script>
</body>
</html>
<?php
    }
	deconnexion($connexion);
?>