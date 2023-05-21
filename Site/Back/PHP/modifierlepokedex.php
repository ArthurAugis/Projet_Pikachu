<?php
$identifiant = $_POST['username'];
$mdp = $_POST['password'];
$mdp = hash('sha256', (get_magic_quotes_gpc() ? stripslashes($_POST['password']) : $_POST['password']));
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
	<link rel="stylesheet" href="../CSS/modifierlepokedex.css">
	<link rel="icon" type="image/x-icon" href="../IMG/Pokeball.ico">
	<title>Modifier le Pokedex</title>
</head>

<body>
    <?php
    ?>
	<div class="container">
        <a href="ajoutdepokemon.php?identifiant=<?php echo $identifiant; ?>&mdp=<?php echo $mdp; ?>"><button>Ajouter un Pokémon</button></a>
        <a href="modifierpokemon.php?identifiant=<?php echo $identifiant; ?>&mdp=<?php echo $mdp; ?>"><button>Modifier un Pokémon</button></a>
        <a href="supprimerpokemon.php?identifiant=<?php echo $identifiant; ?>&mdp=<?php echo $mdp; ?>"><button>Supprimer un Pokémon</button></a>
        <a href="ajoututilisateur.php?identifiant=<?php echo $identifiant; ?>&mdp=<?php echo $mdp; ?>"><button>Ajouter un administrateur</button></a>
        <a href="../../index.php"><button>Revenir à l'accueil</button></a>
    </div>
</body>

</html>
<?php
    }
    deconnexion($connexion);
?>