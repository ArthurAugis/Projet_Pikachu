<?php
require_once('bdd_connexion.php');

function connexion()
{
    try {
        $connexion = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BDD, USER, PWD);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connexion;
    } catch (PDOException $e) {
        echo "Problème de connexion Bdd : " . $e->getMessage() . "<br/>";
        exit();
    }
}

function getNumberPokemon(PDO $connexion)
{
    $sql = "SELECT COUNT(*) as count FROM tab_pokedex";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['count'];
}

function getPokemonListe(PDO $connexion)
{
    if (!isset($_POST['genre'])) {
    $requete = "SELECT POK_nom, POK_photo, CLP_pokedex FROM tab_pokedex ORDER BY POK_numero ASC";

    try {
        $res = $connexion->query($requete);
        $res->setfetchMode(PDO::FETCH_OBJ);
        
        $tabValeur = array();
        while ($result = $res->fetch()) {
            $tabValeur[] = array(
                "nom" => $result->POK_nom,
                "photo" => $result->POK_photo,
                "clp" => $result->CLP_pokedex
            );
        }
        return $tabValeur;
    } catch (PDOException $e) {
        echo "Problème lors de la récupération de la liste des pokemons : " . $e->getMessage() . "<br/>";
        exit();
    }
}
}

function deconnexion($connexion)
{
    $connexion = NULL;
}

function resultNumber($connexion)
{
    if (isset($_POST['genre'])) {
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
        $faiblesses = $_POST['faiblesses'];
        $types = $_POST['types'];
        $evolutions = $_POST['evolutions'];
        $talents = $_POST['talents'];
        $versions = $_POST['versions'];
        $sql = "";
        $select = "SELECT COUNT(POK_nom) AS count ";
        $join = "FROM tab_pokedex ";
        $where = "WHERE ";
        $order = "ORDER BY POK_numero ASC";
        if (!empty($nom)) {
            $where = $where . "POK_nom LIKE '%$nom%' ";
        }
        if($where !== "WHERE " && !empty($numero))
        {
            $where = $where . "AND POK_numero = $numero ";
        }
        else if(!empty($numero))
        {
            $where = $where . "POK_numero = $numero ";
        }
        if($where !== "WHERE " && !empty($taille))
        {
            $where = $where . "AND POK_taille = $taille ";
        }
        else if(!empty($taille))
        {
            $where = $where . "POK_taille = $taille ";
        }
        if($where !== "WHERE " && !empty($poids))
        {
            $where = $where . "AND POK_poids = $poids ";
        }
        else if(!empty($poids))
        {
            $where = $where . "POK_poids = $poids ";
        }
        if($where !== "WHERE " && !empty($genre))
        {   
            $join = $join . "JOIN tab_genres ON tab_pokedex.CLE_genre = tab_genres.CLP_genre ";
            $where = $where . "AND tab_genres.TGE_libelle LIKE '$genre' ";
        }
        else if(!empty($genre))
        {
            $join = $join . "JOIN tab_genres ON tab_pokedex.CLE_genre = tab_genres.CLP_genre ";
            $where = $where . "tab_genres.TGE_libelle LIKE '$genre' ";
        }
    
        if($where !== "WHERE " && !empty($points_vie))
        {
            $where = $where . "AND POK_point_vie = $points_vie ";
        }
        else if(!empty($points_vie))
        {
            $where = $where . "POK_point_vie = $points_vie ";
        }
    
        if($where !== "WHERE " && !empty($attaque))
        {
            $where = $where . "AND POK_attaque = $attaque ";
        }
        else if(!empty($attaque))
        {
            $where = $where . "POK_attaque = $attaque ";
        }
    
        if($where !== "WHERE " && !empty($defense))
        {
            $where = $where . "AND POK_defense = $defense ";
        }
        else if(!empty($defense))
        {
            $where = $where . "POK_defense = $defense ";
        }
    
        if($where !== "WHERE " && !empty($attaque_speciale))
        {
            $where = $where . "AND POK_attaque_speciale = $attaque_speciale ";
        }
        else if(!empty($attaque_speciale))
        {
            $where = $where . "POK_attaque_speciale = $attaque_speciale ";
        }
    
        if($where !== "WHERE " && !empty($defense_speciale))
        {
            $where = $where . "AND POK_defense_speciale = $defense_speciale ";
        }
        else if(!empty($defense_speciale))
        {
            $where = $where . "POK_defense_speciale = $defense_speciale ";
        }
    
        if($where !== "WHERE " && !empty($vitesse))
        {
            $where = $where . "AND POK_vitesse = $vitesse ";
        }
        else if(!empty($vitesse))
        {
            $where = $where . "POK_vitesse = $vitesse ";
        }
    
        if($where !== "WHERE " && !empty($categorie))
        {   
            $join = $join . "JOIN tab_categorie ON tab_pokedex.CLE_categorie = tab_categorie.CLP_categorie ";
            $where = $where . "AND tab_categorie.TCA_libelle LIKE '%$categorie%' ";
        }
        else if(!empty($categorie))
        {
            $join = $join . "JOIN tab_categorie ON tab_pokedex.CLE_categorie = tab_categorie.CLP_categorie ";
            $where = $where . "tab_categorie.TCA_libelle LIKE '%$categorie%' ";
        }
    
        if($where !== "WHERE " && !empty($region))
        {   
            $join = $join . "JOIN tab_region ON tab_pokedex.CLE_region = tab_region.CLP_region ";
            $where = $where . "AND tab_region.TRE_libelle LIKE '%$region%' ";
        }
        else if(!empty($region))
        {
            $join = $join . "JOIN tab_region ON tab_pokedex.CLE_region = tab_region.CLP_region ";
            $where = $where . "tab_region.TRE_libelle LIKE '%$region%' ";
        }
    
        if(!empty($faiblesses) && $faiblesses[0] != "")
        {
            $faiblesses_str = implode("', '", $faiblesses);
            $join = $join . "JOIN tab_subir ON tab_pokedex.CLP_pokedex = tab_subir.CLE_pokedex JOIN tab_types AS subir_types ON tab_subir.CLE_faiblesse = subir_types.CLP_types ";
            if($where !== "WHERE ")
            {  
                $where = $where . "AND subir_types.TTY_libelle IN ('$faiblesses_str') ";
            }
            else
            {
                $where = $where . "subir_types.TTY_libelle IN ('$faiblesses_str') ";
            }
        }
    
        if(!empty($types) && $types[0] != "")
        {
            $types_str = implode("', '", $types);
            $join = $join . "JOIN tab_disposer ON tab_pokedex.CLP_pokedex = tab_disposer.CLE_pokedex JOIN tab_types AS disposer_types ON tab_disposer.CLE_type = disposer_types.CLP_types ";
            if($where !== "WHERE ")
            {  
                $where = $where . "AND disposer_types.TTY_libelle IN ('$types_str') ";
            }
            else
            {
                $where = $where . "disposer_types.TTY_libelle IN ('$types_str') ";
            }
        }
    
        if(!empty($evolutions) && $evolutions[0] != "")
        {
            $evolutions_str = implode("', '", $evolutions);
            $select = "SELECT DISTINCT tab_pokedex.POK_nom, tab_pokedex.POK_photo, tab_pokedex.CLP_pokedex ";
            $join = $join . "JOIN tab_evoluer ON tab_pokedex.CLP_pokedex = tab_evoluer.CLE_pokedex JOIN tab_pokedex AS tab_evolution ON tab_evoluer.CLE_evolution = tab_evolution.CLP_pokedex ";
            $order = "ORDER BY tab_pokedex.POK_numero ASC";
            if($where !== "WHERE ")
            {  
                $where = $where . "AND tab_evolution.POK_nom IN ('$evolutions_str') ";
            }
            else
            {
                $where = $where . "tab_evolution.POK_nom IN ('$evolutions_str') ";
            }
        }
    
        if(!empty($talents) && $talents[0] != "")
        {
            $talents_str = implode("', '", $talents);
            $join = $join . "JOIN tab_avoir ON tab_pokedex.CLP_pokedex = tab_avoir.CLE_pokedex JOIN tab_talents ON tab_avoir.CLE_talent = tab_talents.CLP_talent ";
            if($where !== "WHERE ")
            {  
                $where = $where . "AND tab_talents.TTA_libelle IN ('$talents_str') ";
            }
            else
            {
                $where = $where . "tab_talents.TTA_libelle IN ('$talents_str') ";
            }
        }
    
        if(!empty($versions) && $versions[0] != "")
        {
            $versions_str = implode("', '", $versions);
            $join = $join . "JOIN tab_decrire ON tab_pokedex.CLP_pokedex = tab_decrire.CLE_pokedex JOIN tab_versions ON tab_decrire.CLE_version = tab_versions.CLP_version ";
            if($where !== "WHERE ")
            {  
                $where = $where . "AND tab_versions.TVE_libelle IN ('$versions_str') ";
            }
            else
            {
                $where = $where . "tab_versions.TVE_libelle IN ('$versions_str') ";
            }
        }
    
        if($where !== "WHERE ")
        {
            $sql = $select . $join . $where . $order;
        }
    
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $row['count'];
    }
}

function searchPokemonListe($connexion)
{
    if (isset($_POST['genre'])) {
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
    $faiblesses = $_POST['faiblesses'];
    $types = $_POST['types'];
    $evolutions = $_POST['evolutions'];
    $talents = $_POST['talents'];
    $versions = $_POST['versions'];

    $sql = "";
    $select = "SELECT DISTINCT POK_nom, POK_photo, CLP_pokedex ";
    $join = "FROM tab_pokedex ";
    $where = "WHERE ";
    $order = "ORDER BY POK_numero ASC";
    if (!empty($nom)) {
        $where = $where . "POK_nom LIKE '%$nom%' ";
    }
    if($where !== "WHERE " && !empty($numero))
    {
        $where = $where . "AND POK_numero = $numero ";
    }
    else if(!empty($numero))
    {
        $where = $where . "POK_numero = $numero ";
    }
    if($where !== "WHERE " && !empty($taille))
    {
        $where = $where . "AND POK_taille = $taille ";
    }
    else if(!empty($taille))
    {
        $where = $where . "POK_taille = $taille ";
    }
    if($where !== "WHERE " && !empty($poids))
    {
        $where = $where . "AND POK_poids = $poids ";
    }
    else if(!empty($poids))
    {
        $where = $where . "POK_poids = $poids ";
    }
    if($where !== "WHERE " && !empty($genre))
    {   
        $join = $join . "JOIN tab_genres ON tab_pokedex.CLE_genre = tab_genres.CLP_genre ";
        $where = $where . "AND tab_genres.TGE_libelle LIKE '$genre' ";
    }
    else if(!empty($genre))
    {
        $join = $join . "JOIN tab_genres ON tab_pokedex.CLE_genre = tab_genres.CLP_genre ";
        $where = $where . "tab_genres.TGE_libelle LIKE '$genre' ";
    }

    if($where !== "WHERE " && !empty($points_vie))
    {
        $where = $where . "AND POK_point_vie = $points_vie ";
    }
    else if(!empty($points_vie))
    {
        $where = $where . "POK_point_vie = $points_vie ";
    }

    if($where !== "WHERE " && !empty($attaque))
    {
        $where = $where . "AND POK_attaque = $attaque ";
    }
    else if(!empty($attaque))
    {
        $where = $where . "POK_attaque = $attaque ";
    }

    if($where !== "WHERE " && !empty($defense))
    {
        $where = $where . "AND POK_defense = $defense ";
    }
    else if(!empty($defense))
    {
        $where = $where . "POK_defense = $defense ";
    }

    if($where !== "WHERE " && !empty($attaque_speciale))
    {
        $where = $where . "AND POK_attaque_speciale = $attaque_speciale ";
    }
    else if(!empty($attaque_speciale))
    {
        $where = $where . "POK_attaque_speciale = $attaque_speciale ";
    }

    if($where !== "WHERE " && !empty($defense_speciale))
    {
        $where = $where . "AND POK_defense_speciale = $defense_speciale ";
    }
    else if(!empty($defense_speciale))
    {
        $where = $where . "POK_defense_speciale = $defense_speciale ";
    }

    if($where !== "WHERE " && !empty($vitesse))
    {
        $where = $where . "AND POK_vitesse = $vitesse ";
    }
    else if(!empty($vitesse))
    {
        $where = $where . "POK_vitesse = $vitesse ";
    }

    if($where !== "WHERE " && !empty($categorie))
    {   
        $join = $join . "JOIN tab_categorie ON tab_pokedex.CLE_categorie = tab_categorie.CLP_categorie ";
        $where = $where . "AND tab_categorie.TCA_libelle LIKE '%$categorie%' ";
    }
    else if(!empty($categorie))
    {
        $join = $join . "JOIN tab_categorie ON tab_pokedex.CLE_categorie = tab_categorie.CLP_categorie ";
        $where = $where . "tab_categorie.TCA_libelle LIKE '%$categorie%' ";
    }

    if($where !== "WHERE " && !empty($region))
    {   
        $join = $join . "JOIN tab_region ON tab_pokedex.CLE_region = tab_region.CLP_region ";
        $where = $where . "AND tab_region.TRE_libelle LIKE '%$region%' ";
    }
    else if(!empty($region))
    {
        $join = $join . "JOIN tab_region ON tab_pokedex.CLE_region = tab_region.CLP_region ";
        $where = $where . "tab_region.TRE_libelle LIKE '%$region%' ";
    }

    if(!empty($faiblesses) && $faiblesses[0] != "")
    {
        $faiblesses_str = implode("', '", $faiblesses);
        $join = $join . "JOIN tab_subir ON tab_pokedex.CLP_pokedex = tab_subir.CLE_pokedex JOIN tab_types AS subir_types ON tab_subir.CLE_faiblesse = subir_types.CLP_types ";
        if($where !== "WHERE ")
        {  
            $where = $where . "AND subir_types.TTY_libelle IN ('$faiblesses_str') ";
        }
        else
        {
            $where = $where . "subir_types.TTY_libelle IN ('$faiblesses_str') ";
        }
    }

    if(!empty($types) && $types[0] != "")
    {
        $types_str = implode("', '", $types);
        $join = $join . "JOIN tab_disposer ON tab_pokedex.CLP_pokedex = tab_disposer.CLE_pokedex JOIN tab_types AS disposer_types ON tab_disposer.CLE_type = disposer_types.CLP_types ";
        if($where !== "WHERE ")
        {  
            $where = $where . "AND disposer_types.TTY_libelle IN ('$types_str') ";
        }
        else
        {
            $where = $where . "disposer_types.TTY_libelle IN ('$types_str') ";
        }
    }

    if(!empty($evolutions) && $evolutions[0] != "")
    {
        $evolutions_str = implode("', '", $evolutions);
        $select = "SELECT DISTINCT tab_pokedex.POK_nom, tab_pokedex.POK_photo, tab_pokedex.CLP_pokedex ";
        $join = $join . "JOIN tab_evoluer ON tab_pokedex.CLP_pokedex = tab_evoluer.CLE_pokedex JOIN tab_pokedex AS tab_evolution ON tab_evoluer.CLE_evolution = tab_evolution.CLP_pokedex ";
        $order = "ORDER BY tab_pokedex.POK_numero ASC";
        if($where !== "WHERE ")
        {  
            $where = $where . "AND tab_evolution.POK_nom IN ('$evolutions_str') ";
        }
        else
        {
            $where = $where . "tab_evolution.POK_nom IN ('$evolutions_str') ";
        }
    }

    if(!empty($talents) && $talents[0] != "")
    {
        $talents_str = implode("', '", $talents);
        $join = $join . "JOIN tab_avoir ON tab_pokedex.CLP_pokedex = tab_avoir.CLE_pokedex JOIN tab_talents ON tab_avoir.CLE_talent = tab_talents.CLP_talent ";
        if($where !== "WHERE ")
        {  
            $where = $where . "AND tab_talents.TTA_libelle IN ('$talents_str') ";
        }
        else
        {
            $where = $where . "tab_talents.TTA_libelle IN ('$talents_str') ";
        }
    }

    if(!empty($versions) && $versions[0] != "")
    {
        $versions_str = implode("', '", $versions);
        $join = $join . "JOIN tab_decrire ON tab_pokedex.CLP_pokedex = tab_decrire.CLE_pokedex JOIN tab_versions ON tab_decrire.CLE_version = tab_versions.CLP_version ";
        if($where !== "WHERE ")
        {  
            $where = $where . "AND tab_versions.TVE_libelle IN ('$versions_str') ";
        }
        else
        {
            $where = $where . "tab_versions.TVE_libelle IN ('$versions_str') ";
        }
    }

    if($where !== "WHERE ")
    {
        $sql = $select . $join . $where . $order;
    }

    try {
        $res = $connexion->query($sql);
        $res->setfetchMode(PDO::FETCH_OBJ);
        
        $tabValeur = array();
        while ($result = $res->fetch()) {
            $tabValeur[] = array(
                "nom" => $result->POK_nom,
                "photo" => $result->POK_photo,
                "clp" => $result->CLP_pokedex
            );
        }
        return $tabValeur;
    } catch (PDOException $e) {
        echo "Problème lors de la récupération de la liste des pokemons : " . $e->getMessage() . "<br/>";
        exit();
    }
}
}

function connexionAdmin($connexion, $identifiant, $mdp)
{
    $requete = $connexion->prepare("SELECT LOG_identifiant, LOG_mdp FROM tab_login WHERE LOG_identifiant = :identifiant AND LOG_mdp = :mdp");

    try {
        $requete->bindParam(':identifiant', $identifiant);
        $requete->bindParam(':mdp', $mdp);
        $requete->execute();
        $result=$requete->fetch(PDO::FETCH_OBJ);
        if(!$result){
            header("Location: ../../index.php");
            exit();
        }else{
            $retour = true;
        }
    } catch (PDOException $e) {
        $retour = null;
    }

    return $retour;
}

function removePokemon($connexion, $clp)
{
    $requete = $connexion->prepare("DELETE FROM tab_subir WHERE CLE_pokedex = :num");
    $requete2 = $connexion->prepare("DELETE FROM tab_evoluer WHERE CLE_pokedex = :num");
    $requete3 = $connexion->prepare("DELETE FROM tab_disposer WHERE CLE_pokedex = :num");
    $requete4 = $connexion->prepare("DELETE FROM tab_decrire WHERE CLE_pokedex = :num");
    $requete5 = $connexion->prepare("DELETE FROM tab_avoir WHERE CLE_pokedex = :num");
    $requete6 = $connexion->prepare("DELETE FROM tab_pokedex WHERE CLP_pokedex = :num");

    try {
        $requete->bindParam(':num', $clp);
        $requete->execute();
        $requete2->bindParam(':num', $clp);
        $requete2->execute();
        $requete3->bindParam(':num', $clp);
        $requete3->execute();
        $requete4->bindParam(':num', $clp);
        $requete4->execute();
        $requete5->bindParam(':num', $clp);
        $requete5->execute();
        $requete6->bindParam(':num', $clp);
        $requete6->execute();
        header("Location: ../../index.php");
        exit();
    } catch (PDOException $e) {
        header("Location: ../../index.php");
        exit();
    }

    return $retour;
}

function previousPokemon($connexion, $clp)
{
    $previous = 0;

    $query = "SELECT POK_numero FROM tab_pokedex WHERE CLP_pokedex = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$clp]);

    if($stmt->rowCount() > 0) {
        $pokemon_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $previous = $pokemon_data['POK_numero'] - 1;
        $query = "SELECT CLP_pokedex FROM tab_pokedex WHERE POK_numero = ?";
        $stmt = $connexion->prepare($query);
        $stmt->execute([$previous]);

        if($stmt->rowCount() > 0) {
            $pokemon_data = $stmt->fetch(PDO::FETCH_ASSOC);
            $previous = $pokemon_data['CLP_pokedex'];
            return $previous;
        } else {
            return null;
        }
    }
}

function nextPokemon($connexion, $clp)
{
    $next = 0;

    $query = "SELECT POK_numero FROM tab_pokedex WHERE CLP_pokedex = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$clp]);

    if($stmt->rowCount() > 0) {
        $pokemon_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $next = $pokemon_data['POK_numero'] + 1;
        $query = "SELECT CLP_pokedex FROM tab_pokedex WHERE POK_numero = ?";
        $stmt = $connexion->prepare($query);
        $stmt->execute([$next]);

        if($stmt->rowCount() > 0) {
            $pokemon_data = $stmt->fetch(PDO::FETCH_ASSOC);
            $next = $pokemon_data['CLP_pokedex'];
            return $next;
        } else {
            return null;
        }
    }
}

function statsPokemon(PDO $connexion, $clp)
{
    $requete = "SELECT tab_pokedex.CLP_pokedex, tab_pokedex.POK_nom AS pokemon_nom, tab_categorie.TCA_libelle AS categorie_nom, tab_region.TRE_libelle
    AS region_nom, tab_genres.TGE_libelle AS genre_nom, tab_talents.TTA_libelle AS talent_nom, disposer_types.TTY_libelle AS disposer_type_nom, 
    subir_types.TTY_libelle AS subir_type_nom, tab_pokedex.POK_photo AS pokemon_photo, tab_pokedex.POK_taille AS pokemon_taille, tab_pokedex.POK_poids 
    AS pokemon_poids, tab_pokedex.POK_point_vie AS pokemon_vie, tab_pokedex.POK_attaque AS pokemon_attaque, tab_pokedex.POK_defense AS pokemon_defense, 
    tab_pokedex.POK_attaque_speciale AS pokemon_attaq_spec, tab_pokedex.POK_defense_speciale AS pokemon_defen_spec, 
    tab_pokedex.POK_vitesse AS pokemon_vitesse, tab_pokedex.POK_numero AS pokemon_numero, tab_versions.TVE_libelle AS version_nom, 
    tab_evolution.POK_nom AS evolution_nom
   FROM tab_pokedex
   JOIN tab_categorie ON tab_pokedex.CLE_categorie = tab_categorie.CLP_categorie
   JOIN tab_region ON tab_pokedex.CLE_region = tab_region.CLP_region
   JOIN tab_genres ON tab_pokedex.CLE_genre = tab_genres.CLP_genre
   JOIN tab_avoir ON tab_pokedex.CLP_pokedex = tab_avoir.CLE_pokedex
   JOIN tab_talents ON tab_avoir.CLE_talent = tab_talents.CLP_talent
   JOIN tab_disposer ON tab_pokedex.CLP_pokedex = tab_disposer.CLE_pokedex
   JOIN tab_types AS disposer_types ON tab_disposer.CLE_type = disposer_types.CLP_types
   JOIN tab_subir ON tab_pokedex.CLP_pokedex = tab_subir.CLE_pokedex
   JOIN tab_types AS subir_types ON tab_subir.CLE_faiblesse = subir_types.CLP_types
   JOIN tab_decrire ON tab_pokedex.CLP_pokedex = tab_decrire.CLE_pokedex
   JOIN tab_versions ON tab_decrire.CLE_version = tab_versions.CLP_version
   JOIN tab_evoluer ON tab_pokedex.CLP_pokedex = tab_evoluer.CLE_pokedex
   JOIN tab_pokedex AS tab_evolution ON tab_evoluer.CLE_evolution = tab_evolution.CLP_pokedex
   WHERE tab_pokedex.CLP_pokedex = $clp";

   $nom = "";
   $photo = "";
   $numero = "";
   $taille = "";
   $poids = "";
   $categorie = "";
   $pv = "";
   $attack = "";
   $defense = "";
   $attackspe = "";
   $defensespe = "";
   $vitesse = "";
   $genre = "";
   $region = "";
   $types = "";
   $faiblesses = "";
   $talents = "";
   $versions = "";
   $evolutions = "";

    try {
        $res = $connexion->query($requete);
        $res->setfetchMode(PDO::FETCH_OBJ);
        if ($res->rowCount() > 0) {
        while ($result = $res->fetch()) {
            $nom = $result->pokemon_nom;
            $photo = $result->pokemon_photo;
            $numero = $result->pokemon_numero;
            $taille = $result->pokemon_taille;
            $poids = $result->pokemon_poids;
            $categorie = $result->categorie_nom;
            $pv = $result->pokemon_vie;
            $attack = $result->pokemon_attaque;
            $defense = $result->pokemon_defense;
            $attackspe = $result->pokemon_attaq_spec;
            $defensespe = $result->pokemon_defen_spec;
            $vitesse = $result->pokemon_vitesse;
            $genre = $result->genre_nom;
            $region = $result->region_nom;
            if($types != "" && strpos($types, $result->disposer_type_nom) === false)
            {
                $types = $types . ", " . $result->disposer_type_nom;
            }
            else if(strpos($types, $result->disposer_type_nom) === false)
            {
                $types = $result->disposer_type_nom;
            }
            if($faiblesses != "" && strpos($faiblesses, $result->subir_type_nom) === false)
            {
                $faiblesses = $faiblesses . ", " . $result->subir_type_nom;
            }
            else if(strpos($faiblesses, $result->subir_type_nom) === false)
            {
                $faiblesses = $result->subir_type_nom;
            }
            if($talents != "" && strpos($talents, $result->talent_nom) === false)
            {
                $talents = $talents . ", " . $result->talent_nom;
            }
            else if(strpos($talents, $result->talent_nom) === false)
            {
                $talents = $result->talent_nom;
            }
            if($versions != "" && strpos($versions, $result->version_nom) === false)
            {
                $versions = $versions . ", " . $result->version_nom;
            }
            else if(strpos($versions, $result->version_nom) === false)
            {
                $versions = $result->version_nom;
            }
            if($evolutions != "" && strpos($evolutions, $result->evolution_nom) === false)
            {
                $evolutions = $evolutions . ", " . $result->evolution_nom;
            }
            else if(strpos($evolutions, $result->evolution_nom) === false)
            {
                $evolutions = $result->evolution_nom;
            }
        }
        echo "<h1>".$nom."</h1>";
        echo "<img src='".$photo."'id='pokemon-img' alt='".$nom."'>";
        echo "<p>Numéro dans le pokedex : ".$numero."</p>";
        echo "<p>Taille : ".$taille."</p>";
        echo "<p>Poids : ".$poids."</p>";
        echo "<p>Catégorie : ".$categorie."</p>";
        echo "<p>Vie : ".$pv."</p>";
        echo "<p>Attaque : ".$attack."</p>";
        echo "<p>Défense : ".$defense."</p>";
        echo "<p>Attaque spéciale : ".$attackspe."</p>";
        echo "<p>Défense spéciale : ".$defensespe."</p>";
        echo "<p>Vitesse : ".$vitesse."</p>";
        echo "<p>Genre : ".$genre."</p>";
        echo "<p>Region : ".$region."</p>";
        echo "<p>Types : ".$types."</p>";
        echo "<p>Faiblesses : ".$faiblesses."</p>";
        echo "<p>Talents : ".$talents."</p>";
        echo "<p>Versions : ".$versions."</p>";
        echo "<p>Evolutions : ".$evolutions."</p>";

    }
        else
        {
            $requete = "SELECT tab_pokedex.CLP_pokedex, tab_pokedex.POK_nom AS pokemon_nom, tab_categorie.TCA_libelle AS categorie_nom, tab_region.TRE_libelle
            AS region_nom, tab_genres.TGE_libelle AS genre_nom, tab_talents.TTA_libelle AS talent_nom, disposer_types.TTY_libelle AS disposer_type_nom, 
            subir_types.TTY_libelle AS subir_type_nom, tab_pokedex.POK_photo AS pokemon_photo, tab_pokedex.POK_taille AS pokemon_taille, tab_pokedex.POK_poids 
            AS pokemon_poids, tab_pokedex.POK_point_vie AS pokemon_vie, tab_pokedex.POK_attaque AS pokemon_attaque, tab_pokedex.POK_defense AS pokemon_defense, 
            tab_pokedex.POK_attaque_speciale AS pokemon_attaq_spec, tab_pokedex.POK_defense_speciale AS pokemon_defen_spec, 
            tab_pokedex.POK_vitesse AS pokemon_vitesse, tab_pokedex.POK_numero AS pokemon_numero, tab_versions.TVE_libelle AS version_nom
           FROM tab_pokedex
           JOIN tab_categorie ON tab_pokedex.CLE_categorie = tab_categorie.CLP_categorie
           JOIN tab_region ON tab_pokedex.CLE_region = tab_region.CLP_region
           JOIN tab_genres ON tab_pokedex.CLE_genre = tab_genres.CLP_genre
           JOIN tab_avoir ON tab_pokedex.CLP_pokedex = tab_avoir.CLE_pokedex
           JOIN tab_talents ON tab_avoir.CLE_talent = tab_talents.CLP_talent
           JOIN tab_disposer ON tab_pokedex.CLP_pokedex = tab_disposer.CLE_pokedex
           JOIN tab_types AS disposer_types ON tab_disposer.CLE_type = disposer_types.CLP_types
           JOIN tab_subir ON tab_pokedex.CLP_pokedex = tab_subir.CLE_pokedex
           JOIN tab_types AS subir_types ON tab_subir.CLE_faiblesse = subir_types.CLP_types
           JOIN tab_decrire ON tab_pokedex.CLP_pokedex = tab_decrire.CLE_pokedex
           JOIN tab_versions ON tab_decrire.CLE_version = tab_versions.CLP_version
           WHERE tab_pokedex.CLP_pokedex = $clp";

    try {
        $res = $connexion->query($requete);
        $res->setfetchMode(PDO::FETCH_OBJ);
        while ($result = $res->fetch()) {
            $nom = $result->pokemon_nom;
            $photo = $result->pokemon_photo;
            $numero = $result->pokemon_numero;
            $taille = $result->pokemon_taille;
            $poids = $result->pokemon_poids;
            $categorie = $result->categorie_nom;
            $pv = $result->pokemon_vie;
            $attack = $result->pokemon_attaque;
            $defense = $result->pokemon_defense;
            $attackspe = $result->pokemon_attaq_spec;
            $defensespe = $result->pokemon_defen_spec;
            $vitesse = $result->pokemon_vitesse;
            $genre = $result->genre_nom;
            $region = $result->region_nom;
            if($types != "" && strpos($types, $result->disposer_type_nom) === false)
            {
                $types = $types . ", " . $result->disposer_type_nom;
            }
            else if(strpos($types, $result->disposer_type_nom) === false)
            {
                $types = $result->disposer_type_nom;
            }
            if($faiblesses != "" && strpos($faiblesses, $result->subir_type_nom) === false)
            {
                $faiblesses = $faiblesses . ", " . $result->subir_type_nom;
            }
            else if(strpos($faiblesses, $result->subir_type_nom) === false)
            {
                $faiblesses = $result->subir_type_nom;
            }
            if($talents != "" && strpos($talents, $result->talent_nom) === false)
            {
                $talents = $talents . ", " . $result->talent_nom;
            }
            else if(strpos($talents, $result->talent_nom) === false)
            {
                $talents = $result->talent_nom;
            }
            if($versions != "" && strpos($versions, $result->version_nom) === false)
            {
                $versions = $versions . ", " . $result->version_nom;
            }
            else if(strpos($versions, $result->version_nom) === false)
            {
                $versions = $result->version_nom;
            }
        }
        echo "<h1>".$nom."</h1>";
        echo "<img src='".$photo."'id='pokemon-img' alt='".$nom."'>";
        echo "<p>Numéro dans le pokedex : ".$numero."</p>";
        echo "<p>Taille : ".$taille."</p>";
        echo "<p>Poids : ".$poids."</p>";
        echo "<p>Catégorie : ".$categorie."</p>";
        echo "<p>Vie : ".$pv."</p>";
        echo "<p>Attaque : ".$attack."</p>";
        echo "<p>Défense : ".$defense."</p>";
        echo "<p>Attaque spéciale : ".$attackspe."</p>";
        echo "<p>Défense spéciale : ".$defensespe."</p>";
        echo "<p>Vitesse : ".$vitesse."</p>";
        echo "<p>Genre : ".$genre."</p>";
        echo "<p>Region : ".$region."</p>";
        echo "<p>Types : ".$types."</p>";
        echo "<p>Faiblesses : ".$faiblesses."</p>";
        echo "<p>Talents : ".$talents."</p>";
        echo "<p>Versions : ".$versions."</p>";

    } catch (PDOException $e) {
        echo "Problème lors de la récupération de la liste des pokemons : " . $e->getMessage() . "<br/>";
        exit();
    }
}
    } catch (PDOException $e) {
        echo "Problème lors de la récupération de la liste des pokemons : " . $e->getMessage() . "<br/>";
        exit();
    }
}

function addPokemon($connexion, $nom, $numero, $taille, $poids, $genre, $points_vie, $attaque, $defense, $attaque_speciale, $defense_speciale, $vitesse, $categorie, $region, $photo, $faiblesses, $types, $evolutions, $talents, $versions, $author)
{
    $sql = "SELECT * FROM tab_categorie WHERE TCA_libelle LIKE '$categorie'";
    $result = $connexion->query($sql);
    $cle_categorie = 0;

    if ($result->rowCount() == 0) {
        $description = "Pokemon possédant la catégorie $categorie";
        $sql = "INSERT INTO tab_categorie (TCA_libelle, TCA_description, TCA_auteur_derniere_modification) VALUES ('$categorie', '$description', '$author')";
        if ($connexion->query($sql) === TRUE) {
            $cle_categorie = $connexion->lastInsertId();
        } else {
            echo "erreur: " . $connexion->error;
        }
    }
    else 
    {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $cle_categorie = $row['CLP_categorie'];
    }

    $sql = "SELECT * FROM tab_region WHERE TRE_libelle LIKE '$region'";
    $result = $connexion->query($sql);
    $cle_region = 0;

    if ($result->rowCount() == 0) {
        $description = "Pokemon venant de $region";
        $sql = "INSERT INTO tab_region (TRE_libelle, TRE_description, TRE_auteur_derniere_modification) VALUES ('$region', '$description', '$author')";
        if ($connexion->query($sql) === TRUE) {
            $cle_region = $connexion->lastInsertId();
        } else {
            echo "erreur: " . $connexion->error;
        }
    }
    else 
    {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $cle_region = $row['CLP_region'];
    }

    $clp_talents = array();

    foreach ($talents as $talent) {
        $sql = "SELECT * FROM tab_talents WHERE TTA_libelle LIKE '$talent'";
        $result = $connexion->query($sql);

        if ($result->rowCount() == 0) {
            $description = "Pokemon possédant le talent $talent";
            $sql = "INSERT INTO tab_talents (TTA_libelle, TTA_description, TTA_auteur_derniere_modification) VALUES ('$talent', '$description', '$author')";
            if ($connexion->query($sql) === TRUE) {
                $clp_talents[] = $connexion->lastInsertId();
            } else {
                echo "Une erreur c'est produite lors de l'ajout d'un talent: " . $connexion->error;
            }
        }
        else 
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $clp_talents[] = $row['CLP_talent'];
        }
    }

    $clp_types = array();

    foreach ($types as $type) {
        $sql = "SELECT * FROM tab_types WHERE TTY_libelle LIKE '$type'";
        $result = $connexion->query($sql);

        if ($result->rowCount() == 0) {
            $description = "Pokemon possédant le type ou la faiblesse $type";
            $sql = "INSERT INTO tab_types (TTY_libelle, TTY_description, TTY_auteur_derniere_modification) VALUES ('$type', '$description', '$author')";
            if ($connexion->query($sql) === TRUE) {
                $clp_types[] = $connexion->lastInsertId();
            } else {
                echo "Une erreur c'est produite lors de l'ajout d'un type: " . $connexion->error;
            }
        }
        else 
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $clp_types[] = $row['CLP_types'];
        }
    }

    $clp_faiblesses = array();

    foreach ($faiblesses as $faiblesse) {
        $sql = "SELECT * FROM tab_types WHERE TTY_libelle LIKE '$faiblesse'";
        $result = $connexion->query($sql);

        if ($result->rowCount() == 0) {
            $description = "Pokemon possédant le type ou la faiblesse $faiblesse";
            $sql = "INSERT INTO tab_types (TTY_libelle, TTY_description, TTY_auteur_derniere_modification) VALUES ('$faiblesse', '$description', '$author')";
            if ($connexion->query($sql) === TRUE) {
                $clp_faiblesses[] = $connexion->lastInsertId();
            } else {
                echo "erreur: " . $connexion->error;
            }
        }
        else 
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $clp_faiblesses[] = $row['CLP_types'];
        }
    }

    $clp_versions = array();

    foreach ($versions as $version) {
        $sql = "SELECT * FROM tab_versions WHERE TVE_libelle LIKE '$version'";
        $result = $connexion->query($sql);

        if ($result->rowCount() == 0) {
            $description = "Pokemon possédant la version $version";
            $sql = "INSERT INTO tab_versions (TVE_libelle, TVE_description, TVE_auteur_derniere_modification) VALUES ('$version', '$description', '$author')";
            if ($connexion->query($sql) === TRUE) {
                $clp_versions[] = $connexion->lastInsertId();
            } else {
                echo "Une erreur c'est produite lors de l'ajout d'une version: " . $connexion->error;
            }
        }
        else 
    {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $clp_versions[] = $row['CLP_version'];
    }
    }

    $sql = "SELECT * FROM tab_genres WHERE TGE_libelle LIKE '$genre'";
    $result = $connexion->query($sql);

    $cle_genre = 0;

    if ($result->rowCount() == 0) {
        $description = "Sexe du pokemon: $genre";
        $sql = "INSERT INTO tab_genres (TGE_libelle, TGE_description, TGE_auteur_derniere_modification) VALUES ('$genre', '$description', '$author')";
        if ($connexion->query($sql) === TRUE) {
            $cle_genre = $connexion->lastInsertId();
        } else {
            echo "erreur: " . $connexion->error;
        }
    }
    else 
    {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $cle_genre = $row['CLP_genre'];
    }


    $sql = "SELECT * FROM tab_pokedex WHERE POK_nom LIKE '$nom'";
    $result = $connexion->query($sql);
    $clp_pokedex = "";

    if ($result->rowCount() == 0) {
        $sql = "INSERT INTO tab_pokedex (POK_nom, POK_numero, POK_taille, POK_poids, CLE_genre, POK_point_vie, POK_attaque, POK_defense, POK_attaque_speciale, POK_defense_speciale, 
        POK_vitesse, CLE_categorie, CLE_region, POK_photo,POK_auteur_derniere_modification) VALUES 
        (:nom, :numero, :taille, :poids, :cle_genre, :points_vie, :attaque, :defense, :attaque_speciale, :defense_speciale, :vitesse, :cle_categorie, :cle_region, :photo, :author)";
    
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':taille', $taille);
        $stmt->bindParam(':poids', $poids);
        $stmt->bindParam(':cle_genre', $cle_genre);
        $stmt->bindParam(':points_vie', $points_vie);
        $stmt->bindParam(':attaque', $attaque);
        $stmt->bindParam(':defense', $defense);
        $stmt->bindParam(':attaque_speciale', $attaque_speciale);
        $stmt->bindParam(':defense_speciale', $defense_speciale);
        $stmt->bindParam(':vitesse', $vitesse);
        $stmt->bindParam(':cle_categorie', $cle_categorie);
        $stmt->bindParam(':cle_region', $cle_region);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':author', $author);
    
        if ($stmt->execute()) {
            $clp_pokedex = $connexion->lastInsertId();
        } else {
            echo "erreur: " . $stmt->errorInfo()[2];
        }
    } else {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $clp_pokedex = $row['CLP_pokedex'];
    }

    foreach ($clp_faiblesses as $faible) {
        $sql = "INSERT INTO tab_subir (CLE_faiblesse, CLE_pokedex, TSU_taux_degats,TSU_auteur_derniere_modification) VALUES (:faible, :pokedex, '2',:author)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':faible', $faible);
        $stmt->bindParam(':pokedex', $clp_pokedex);
        $stmt->bindParam(':author', $author);
    
        if ($stmt->execute()) {

        } else {
            echo "Une erreur c'est produite lors de l'ajout d'une version: " . $connexion->error;
        }
    }
    

    foreach ($clp_types as $type) {
        $sql = "INSERT INTO tab_disposer (CLE_type, CLE_pokedex, TDI_auteur_derniere_modification) VALUES (:type, :pokedex, :author)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindValue(':type', $type, PDO::PARAM_INT);
        $stmt->bindValue(':pokedex', $clp_pokedex, PDO::PARAM_INT);
        $stmt->bindValue(':author', $author, PDO::PARAM_STR);
        if ($stmt->execute()) {
        } else {
            echo "Une erreur s'est produite lors de l'ajout d'une version: " . $stmt->errorInfo()[2];
        }
    }

    foreach ($clp_versions as $version) {
        $sql = "INSERT INTO tab_decrire (CLE_version, CLE_pokedex, TDE_auteur_derniere_modification) VALUES (?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$version, $clp_pokedex, $author]);
        if ($stmt->rowCount() > 0) {
        } else {
            echo "Une erreur c'est produite lors de l'ajout d'une version: " . $connexion->errorInfo()[2];
        }
    }
    
    foreach ($clp_talents as $talent) {
        $sql = "INSERT INTO tab_avoir (CLE_talent, CLE_pokedex, TAV_auteur_derniere_modification) VALUES (?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$talent, $clp_pokedex, $author]);
        if ($stmt->rowCount() > 0) {
        } else {
            echo "Une erreur c'est produite lors de l'ajout d'une version: " . $connexion->errorInfo()[2];
        }
    }

    if (!empty($evolutions)) {
        foreach ($evolutions as $evolution) {
            $sql = "SELECT CLP_pokedex FROM tab_pokedex WHERE POK_nom LIKE ?";
            $stmt = $connexion->prepare($sql);
            $stmt->bindValue(1, $evolution, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($stmt->rowCount() == 1) {
                $clp_evolution = $row['CLP_pokedex'];
                $sql = "INSERT INTO tab_evoluer (CLE_pokedex, CLE_evolution, TEV_auteur_derniere_modification) VALUES (?, ?, ?)";
                $stmt = $connexion->prepare($sql);
                $stmt->bindValue(1, $clp_pokedex, PDO::PARAM_INT);
                $stmt->bindValue(2, $clp_evolution, PDO::PARAM_INT);
                $stmt->bindValue(3, $author, PDO::PARAM_STR);
                if ($stmt->execute()) {
                } else {
                    echo "Une erreur c'est produite lors de l'ajout d'une version: " . $stmt->errorInfo()[2];
                }
            }
        }
    }
    header("Location: ../../index.php");
    exit();
}

function updatePokemon($connexion, $pokemon, $nom, $numero, $taille, $poids, $genre, $points_vie, $attaque, $defense, $attaque_speciale, $defense_speciale, $vitesse, $categorie, $region, $photo, $faiblesses, $types, $evolutions, $talents, $versions, $author)
{
    if (!empty($nom)) {
        $sql = "UPDATE tab_pokedex SET POK_nom = :nom WHERE CLP_pokedex = :pokemon";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':pokemon', $pokemon);
        $stmt->execute();
    }
    
    if(!empty($numero))
    {
        $sql = "UPDATE tab_pokedex SET POK_numero = :numero WHERE CLP_pokedex = :pokemon";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':pokemon', $pokemon);
        $stmt->execute();
    }
    
    if(!empty($taille))
    {
        $sql = "UPDATE tab_pokedex SET POK_taille = :taille WHERE CLP_pokedex = :pokemon";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':taille', $taille);
        $stmt->bindParam(':pokemon', $pokemon);
        $stmt->execute();
    }
    
    if(!empty($poids))
    {
        $sql = "UPDATE tab_pokedex SET POK_poids = :poids WHERE CLP_pokedex = :pokemon";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':poids', $poids);
        $stmt->bindParam(':pokemon', $pokemon);
        $stmt->execute();
    }

    if(!empty($genre))
{
    $sql = "SELECT * FROM tab_genres WHERE TGE_libelle LIKE ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(array($genre));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $cle_genre = 0;

    if (!$result) {
        $description = "Sexe du pokemon: $genre";
        $sql = "INSERT INTO tab_genres (TGE_libelle, TGE_description, TGE_auteur_derniere_modification) VALUES (?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute(array($genre, $description, $author));
        $cle_genre = $connexion->lastInsertId();
    }
    else 
    {
        $cle_genre = $result['CLP_genre'];
    }

    $sql = "UPDATE tab_pokedex SET CLE_genre = ? WHERE CLP_pokedex = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(array($cle_genre, $pokemon));

    }

    if(!empty($points_vie))
{
    $sql = "UPDATE tab_pokedex SET POK_point_vie = :points_vie WHERE CLP_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':points_vie', $points_vie);
    $stmt->bindParam(':pokemon', $pokemon);
    $stmt->execute();
}

if(!empty($attaque))
{
    $sql = "UPDATE tab_pokedex SET POK_attaque = :attaque WHERE CLP_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':attaque', $attaque);
    $stmt->bindParam(':pokemon', $pokemon);
    $stmt->execute();
}

if(!empty($defense))
{
    $sql = "UPDATE tab_pokedex SET POK_defense = :defense WHERE CLP_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':defense', $defense);
    $stmt->bindParam(':pokemon', $pokemon);
    $stmt->execute();
}

if(!empty($attaque_speciale))
{
    $sql = "UPDATE tab_pokedex SET POK_attaque_speciale = :attaque_speciale WHERE CLP_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':attaque_speciale', $attaque_speciale);
    $stmt->bindParam(':pokemon', $pokemon);
    $stmt->execute();
}

if(!empty($defense_speciale))
{
    $sql = "UPDATE tab_pokedex SET POK_defense_speciale = :defense_speciale WHERE CLP_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':defense_speciale', $defense_speciale);
    $stmt->bindParam(':pokemon', $pokemon);
    $stmt->execute();
}

if(!empty($vitesse))
{
    $sql = "UPDATE tab_pokedex SET POK_vitesse = :vitesse WHERE CLP_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':vitesse', $vitesse);
    $stmt->bindParam(':pokemon', $pokemon);
    $stmt->execute();
}

if(!empty($photo))
{
    $sql = "UPDATE tab_pokedex SET POK_photo = :photo WHERE CLP_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':photo', $photo);
    $stmt->bindParam(':pokemon', $pokemon);
    $stmt->execute();
}

if(!empty($categorie))
{
    $sql = "SELECT * FROM tab_categorie WHERE TCA_libelle LIKE :categorie";
    $stmt = $connexion->prepare($sql);
    $stmt->bindValue(':categorie', $categorie, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cle_categorie = 0;

    if (count($result) == 0) {
        $description = "Pokemon possédant la catégorie $categorie";
        $sql = "INSERT INTO tab_categorie (TCA_libelle, TCA_description, TCA_auteur_derniere_modification) VALUES (:categorie, :description, :author)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindValue(':categorie', $categorie, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':author', $author, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $cle_categorie = $connexion->lastInsertId();
        } else {
            echo "erreur: " . $stmt->errorInfo()[2];
        }
    }
    else 
    {
        $cle_categorie = $result[0]['CLP_categorie'];
    }

    $sql = "UPDATE tab_pokedex SET CLE_categorie = :cle_categorie WHERE CLP_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindValue(':cle_categorie', $cle_categorie, PDO::PARAM_INT);
    $stmt->bindValue(':pokemon', $pokemon, PDO::PARAM_INT);
    $stmt->execute();
}

if(!empty($region))
{
    $sql = "SELECT * FROM tab_region WHERE TRE_libelle LIKE ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(array($region));
    $result = $stmt->fetchAll();

    $cle_region = 0;

    if (count($result) == 0) {
        $description = "Pokemon venant de $region";
        $sql = "INSERT INTO tab_region (TRE_libelle, TRE_description, TRE_auteur_derniere_modification) VALUES (?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute(array($region, $description, $author));
        $cle_region = $connexion->lastInsertId();
    }
    else 
    {
        $cle_region = $result[0]['CLP_region'];
    }

    $sql = "UPDATE tab_pokedex SET CLE_region = ? WHERE CLP_pokedex = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(array($cle_region, $pokemon));
}

if(!empty($faiblesses) && $faiblesses[0] != "")
{
    $sql = "DELETE FROM tab_subir WHERE CLE_pokedex = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$pokemon]);

    foreach ($faiblesses as $faiblesse) {
        $sql = "SELECT * FROM tab_types WHERE TTY_libelle LIKE ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$faiblesse]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $description = "Pokemon possédant le type ou la faiblesse $faiblesse";
            $sql = "INSERT INTO tab_types (TTY_libelle, TTY_description, TTY_auteur_derniere_modification) VALUES (?, ?, ?)";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$faiblesse, $description, $author]);
            $clp_faiblesses[] = $connexion->lastInsertId();
        }
        else 
        {
            $clp_faiblesses[] = $result['CLP_types'];
        }
    }

    foreach ($clp_faiblesses as $faible) {
        $sql = "INSERT INTO tab_subir (CLE_faiblesse, CLE_pokedex, TSU_taux_degats,TSU_auteur_derniere_modification) VALUES (?, ?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$faible, $pokemon, 2, $author]);
    }
}

if(!empty($types) && $types[0] != "")
{
    $sql = "DELETE FROM tab_disposer WHERE CLE_pokedex = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$pokemon]);

    $clp_types = array();

    foreach ($types as $type) {
        $sql = "SELECT * FROM tab_types WHERE TTY_libelle LIKE ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$type]);

        if ($stmt->rowCount() == 0) {
            $description = "Pokemon possédant le type ou la faiblesse $type";
            $sql = "INSERT INTO tab_types (TTY_libelle, TTY_description, TTY_auteur_derniere_modification) VALUES (?, ?, ?)";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$type, $description, $author]);
            $clp_types[] = $connexion->lastInsertId();
        }
        else 
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $clp_types[] = $row['CLP_types'];
        }
    }

    foreach ($clp_types as $type) {
        $sql = "INSERT INTO tab_disposer (CLE_type, CLE_pokedex, TDI_auteur_derniere_modification) VALUES (?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$type, $pokemon, $author]);
    }
}

if(!empty($evolutions) && $evolutions[0] != "")
{
    $sql = "DELETE FROM tab_evoluer WHERE CLE_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':pokemon', $pokemon, PDO::PARAM_INT);
    $stmt->execute();

    if (!empty($evolutions)) {
        foreach ($evolutions as $evolution) {
            $sql = "SELECT CLP_pokedex FROM tab_pokedex WHERE POK_nom LIKE :evolution";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':evolution', $evolution, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $clp_evolution = $row['CLP_pokedex'];
                $sql = "INSERT INTO tab_evoluer (CLE_pokedex, CLE_evolution, TEV_auteur_derniere_modification) VALUES (:pokemon, :clp_evolution, :author)";
                $stmt = $connexion->prepare($sql);
                $stmt->bindParam(':pokemon', $pokemon, PDO::PARAM_INT);
                $stmt->bindParam(':clp_evolution', $clp_evolution, PDO::PARAM_INT);
                $stmt->bindParam(':author', $author, PDO::PARAM_STR);
                if ($stmt->execute()) {
                } else {
                    echo "Une erreur c'est produite lors de l'ajout d'une version: " . $connexion->errorInfo()[2];
                }
            }
        }
    }
}

if(!empty($talents) && $talents[0] != "")
{
    $sql = "DELETE FROM tab_avoir WHERE CLE_pokedex = :pokemon";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':pokemon', $pokemon, PDO::PARAM_INT);
    $stmt->execute();

    $clp_talents = array();

    foreach ($talents as $talent) {
        $sql = "SELECT * FROM tab_talents WHERE TTA_libelle LIKE :talent";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':talent', $talent, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $description = "Pokemon possédant le talent $talent";
            $sql = "INSERT INTO tab_talents (TTA_libelle, TTA_description, TTA_auteur_derniere_modification) VALUES (:talent, :description, :author)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':talent', $talent, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $clp_talents[] = $connexion->lastInsertId();
            } else {
                echo "Une erreur c'est produite lors de l'ajout d'un talent: " . $connexion->error;
            }
        }
        else 
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $clp_talents[] = $row['CLP_talent'];
        }
    }

    foreach ($clp_talents as $talent) {
        $sql = "INSERT INTO tab_avoir (CLE_talent, CLE_pokedex, TAV_auteur_derniere_modification) VALUES (:talent, :pokemon, :author)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':talent', $talent, PDO::PARAM_INT);
        $stmt->bindParam(':pokemon', $pokemon, PDO::PARAM_INT);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        if ($stmt->execute()) {
        } else {
            echo "Une erreur c'est produite lors de l'ajout d'une version: " . $connexion->error;
        }
    }
}

if(!empty($versions) && $versions[0] != "")
{
    $sql = "DELETE FROM tab_decrire WHERE CLE_pokedex = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$pokemon]);

    $clp_versions = array();
    foreach ($versions as $version) {
        $sql = "SELECT * FROM tab_versions WHERE TVE_libelle LIKE ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$version]);

        if ($stmt->rowCount() == 0) {
            $description = "Pokemon possédant la version $version";
            $sql = "INSERT INTO tab_versions (TVE_libelle, TVE_description, TVE_auteur_derniere_modification) VALUES (?, ?, ?)";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([$version, $description, $author]);
            $clp_versions[] = $connexion->lastInsertId();
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $clp_versions[] = $row['CLP_version'];
        }
    }

    foreach ($clp_versions as $version) {
        $sql = "INSERT INTO tab_decrire (CLE_version, CLE_pokedex, TDE_auteur_derniere_modification) VALUES (?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$version, $pokemon, $author]);
    }
}

    header("Location: ../../index.php");
    exit();
}

function addAdmin($connexion, $identifiant, $mdp)
{
    $stmt = $connexion->prepare("INSERT INTO tab_login (LOG_identifiant, LOG_mdp) VALUES (?, ?)");
    $stmt->execute([$identifiant, $mdp]);
    header("Location: ../../index.php");
    exit();
}