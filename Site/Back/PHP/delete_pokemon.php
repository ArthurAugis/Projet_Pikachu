<?php
$pokemon_num = $_POST['pokemon'];

include_once('../../fonc_utiles.php');
$connexion = connexion();

removePokemon($connexion, $pokemon_num);
deconnexion($connexion);
?>