<?php

include_once('../../fonc_utiles.php');
$connexion = connexion();

if (isset($_POST['pokemon'])) {
    $pokemon = $_POST['pokemon'];
    $nom = $_POST['nom'];
    $numero = $_POST['numero'];
    $taille = $_POST['taille'];
    $poids = $_POST['poids'];
    $genre = $_POST['genre'];
    $points_vie = $_POST['points_vie'];
    $attaque = $_POST['attaque'];
    $defense = $_POST['defense'];
    $attaque_speciale = $_POST['attaque_speciale'];
    $defense_speciale = $_POST['defense_speciale'];
    $vitesse = $_POST['vitesse'];
    $categorie = $_POST['categorie'];
    $region = $_POST['region'];
    $photo = $_POST['photo'];
    $faiblesses = $_POST['faiblesses'];
    $types = $_POST['types'];
    $evolutions = $_POST['evolutions'];
    $talents = $_POST['talents'];
    $versions = $_POST['versions'];
    $author = "Arthur AUGIS";

    updatePokemon($connexion, $pokemon, $nom, $numero, $taille, $poids, $genre, $points_vie, $attaque, $defense, $attaque_speciale, $defense_speciale, $vitesse, $categorie, $region, $photo, $faiblesses, $types, $evolutions, $talents, $versions, $author);
}
deconnexion($connexion);
?>
