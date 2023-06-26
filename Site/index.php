<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Front/CSS/index.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="Front/IMG/Pokeball.ico">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Pokedex</title>
</head>
<body>
    <header>
        <a href="https://bit.ly/EasterEgg_Projet_Pikachu"><button class="title">Pokedex de SIO</button></a>
        <button class="pokemon-number">
            <img src="Front/IMG/Pokeball.ico" id="pokeball"> 
            <?php
                include_once('fonc_utiles.php');
                $connexion = connexion();
                echo getNumberPokemon($connexion);
            ?>
        </button>
        <?php
            if (isset($_POST['genre'])) {
        ?>
        <button class="pokemon-number">
            <img src="Front/IMG/search.png" id="pokeball"> 
            <?php
                    echo resultNumber($connexion);
            ?>
        </button>
        <?php
            }
        ?>
    </header>
    <div class="container">
        <div class="pokemon-img-container">
            <img src="Front/IMG/noname.jpg" id="pokemon-img">
            <a href="Back/login.php"><button class="ajoutpokemon">Modifier le Pokedex</button></a>
            <a href="Front/PHP/search.php"><button class="searchpokemon"><i class="las la-search"></i> Rechercher des Pokémon</button></a>
            <a href="index.php"><button class="resetsearch">Retirer les filtres</button></a>
            <a href="https://github.com/ArthurAugis/Projet_Pikachu" target="_blank"><button class="github">Github</button></a>
        </div>
        <div class="pokemon-liste">
            <?php
                if (!isset($_POST['genre'])) {
                    $rep = getPokemonListe($connexion);
                }
                else
                {
                    $rep = searchPokemonListe($connexion);
                }
                foreach ($rep as $pokemon) {
                    $clp_pokedex = $pokemon['clp'];
                    $pok_image = $pokemon['photo'];
                    $pok_nom = $pokemon['nom'];
                    echo '<a href="Front/PHP/pokemon.php?pokemon=' . $clp_pokedex . '"><button class="pokemon" data-image="' . $pok_image . '">' . $pok_nom . '</button></a>';
                }
                deconnexion($connexion);
			?>
        </div>
    </div>
    <script src="Front/JS/index.js"></script>
</body>
</html>