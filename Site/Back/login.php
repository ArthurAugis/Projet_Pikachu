<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login.css">
    <title>Page de connexion</title>
    <link rel="icon" type="image/x-icon" href="IMG/Pokeball.ico">
</head>
<body>
    <form action="PHP/modifierlepokedex.php" method = "POST">
        <input type="text" name="username" placeholder="Votre identifiant..." required>
        <input type="password" name="password" placeholder="Votre mot de passe..." required>
        <input type="submit" name="login" value="Se connecter">
    </form>
</body>
</html>
