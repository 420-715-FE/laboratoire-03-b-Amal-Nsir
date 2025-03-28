<?php
session_start();

$users = [
    'jaja72' => ['nom' => 'Jacynthe Laplante', 'mdp' => 'lapin'],
    'petitefleur145' => ['nom' => 'Rose Lafleur', 'mdp' => 'chat'],
    'bob' => ["nom" => "Bob L'éponge", 'mdp' => 'poisson']
];


if (isset($_SESSION['user']) && isset($users[$_SESSION['user']])) {
    $user = $_SESSION['user'];
} else if (isset($_POST['user']) && isset($_POST['mdp'])) {

    if (isset($users[$_POST['user']]) && $_POST['mdp'] == $users[$_POST['user']]['mdp']) {
    
        $_SESSION['user'] = $_POST['user'];
        $user = $_POST['user'];
    } else {
    
        $msgErreur = "Nom utilisateur ou mot de passe incorrect.";
    }
}

if (isset($_GET['deconnexion'])) {
    session_unset();
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page secrète</title>
    <link rel="stylesheet" href="../water.css">
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>
    <h1>Page secrète</h1>
    <?php
        if (isset($user)) {
    
            echo "<p>Bonjour <strong>" . $users[$user]['nom'] . "</strong>! Bienvenue à la page secrète! </p>";
            echo '<p><a href="?deconnexion">Se déconnecter</a></p>';
        } else {
            
            if (isset($msgErreur)) {
                echo "<p>$msgErreur</p>"; 
            }
    ?>
    
    <form action="page_secrete.php" method="POST">
        <label>Nom d'utilisateur:</label>
        <input type="text" name="user">
        <label>Mot de passe:</label>
        <input type="password" name="mdp">
        <button type="submit">Envoyer</button>
    </form>
    <?php
        }
    ?>
</body>
</html>



