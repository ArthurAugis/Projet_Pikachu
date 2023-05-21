<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../CSS/pokemon.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="../IMG/Pokeball.ico">
    <title>Pokedex</title>
</head>
<body>
    <header>
        <a href="https://bit.ly/EasterEgg_Projet_Pikachu"><button class="title">Pokedex de SIO</button></a>
        <a href="../../index.php">
            <button class="pokemon-number">
                Revenir à l'accueil
            </button>
        </a>
    </header>
    <div class="container">
    <div class="button-container">
        <?php
        if(isset($_GET['pokemon'])) {
        
            include_once('../../fonc_utiles.php');
            $connexion = connexion();
    
            $pokemon_id = $_GET['pokemon'];
            $previous_pokemon = previousPokemon($connexion, $pokemon_id);
                if($previous_pokemon != null)
                {
                    echo "<a href='pokemon.php?pokemon=" . $previous_pokemon . "'>";
                
        ?>
        <button class="previous"><</button>
        <?php 
        echo "</a>";
                }
                $next_pokemon = nextPokemon($connexion, $pokemon_id);
                if($next_pokemon != null)
                {
                    echo "<a href='pokemon.php?pokemon=" . $next_pokemon . "'>";
                
                    ?>
                   <button class="next">></button>
        <?php 
        echo "</a>"; 
            }
        }
        ?>
    </div>
    <?php
    if(isset($_GET['pokemon'])) {
        
        $pokemon_id = $_GET['pokemon'];
    
        $stats = statsPokemon($connexion, $pokemon_id);

        if(isset($stats[0]['evolutions']))
        {
            echo "<p>Evolutions : ".$stats[0]['evolutions']."</p>";
        }
        
        deconnexion($connexion);

        
    }
    else {
        deconnexion($connexion);
        header("Location: ../../index.php");
        exit();
    }
    ?>
    </div>
</body>
</html>