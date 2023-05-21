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
	<link rel="stylesheet" href="../CSS/supprimerpokemon.css">
	<link rel="icon" type="image/x-icon" href="../IMG/Pokeball.ico">
	<title>Supprimer un Pokémon</title>
</head>

<body>
	<form action="delete_pokemon.php" method="post">

		<label for="pokemon">Pokémon à supprimer :</label>
		<select name="pokemon" required>
            <?php
                $rep = getPokemonListe($connexion);
                foreach ($rep as $pokemon) {
                    $pok_num = $pokemon['clp'];
                    $pok_nom = $pokemon['nom'];
                    echo '<option value="'.$pok_num.'">'.$pok_nom.'</option>';
                }
            ?>
		</select><br>

		<input type="submit" value="Supprimer le Pokémon">
	</form>
</body>

</html>
<?php
    }
    deconnexion($connexion);
?>