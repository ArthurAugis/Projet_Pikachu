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
    <link rel="stylesheet" href="../CSS/login.css">
    <title>Ajouter un administrateur</title>
    <link rel="icon" type="image/x-icon" href="../IMG/Pokeball.ico">
</head>
<body>
    <form action="adduser.php" method = "POST">
        <input type="text" name="username" placeholder="Un identifiant..." required>
        <input type="password" name="password" placeholder="Un mot de passe..." required>
        <input type="submit" name="login" value="Ajouter un administrateur">
    </form>
</body>
</html>
<?php
    }
    deconnexion($connexion);
?>