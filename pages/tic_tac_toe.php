<?php
session_start();

if (isset($_GET['reinitialiser'])) {
    unset($_SESSION['tableau']);
    unset($_SESSION['tour']);
}

if (!isset($_SESSION['tableau'])) {
    $_SESSION['tableau'] = [
    ['', '', ''],
    ['', '', ''],
    ['', '', ''],
];
    $_SESSION['tour'] = 'X';  
}

$tableau = $_SESSION['tableau'];
$tour = $_SESSION['tour'];

if (isset($_GET['ligne']) && isset($_GET['colonne'])) {
    $ligne = $_GET['ligne'];
    $colonne = $_GET['colonne'];

    
    if ($tableau[$ligne][$colonne] === '') {
        $tableau[$ligne][$colonne] = $tour;
        
        if ($tour === 'X') {
            $tour = 'O';
        } else {
            $tour = 'X';
        }
    }
}

    
    $_SESSION['tableau'] = $tableau;
    $_SESSION['tour'] = $tour;

$gagnant = null;


for ($i = 0; $i < 3; $i++) {
    if ($tableau[$i][0] !== '' && $tableau[$i][0] === $tableau[$i][1] && $tableau[$i][1] === $tableau[$i][2]) {
        $gagnant = $tableau[$i][0];
    }
}


for ($j = 0; $j < 3; $j++) {
    if ($tableau[0][$j] !== '' && $tableau[0][$j] === $tableau[1][$j] && $tableau[1][$j] === $tableau[2][$j]) {
        $gagnant = $tableau[0][$j];
    }
}


if (($tableau[0][0] !== '' && $tableau[0][0] === $tableau[1][1] && $tableau[1][1] === $tableau[2][2]) || 
    ($tableau[0][2] !== '' && $tableau[0][2] === $tableau[1][1] && $tableau[1][1] === $tableau[2][0])) {
    $gagnant= $tableau[1][1];
}


$matchNul = true;
foreach ($tableau as $ligne) {
    foreach ($ligne as $case) {
        if ($case === '') {
            $matchNul = false;
            break 2;
}
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../water.css">
    <title>Tic Tac Toe</title>
    <style>
        .ticTacToe {
            border-collapse: collapse;
            width: auto;
            margin: 20px auto;
        }
        .ticTacToe td {
            border: 1px solid black;
            width: 75px;
            height: 75px;
            text-align: center;
            vertical-align: middle;
            font-size: 2em;
            cursor: pointer;
        }
        .ticTacToe a {
            display: block;
            width: 100%;
            height: 100%;
            color: black;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>
    <h1>Tic Tac Toe</h1>

    <?php
    if ($gagnant) {
        echo "<p><strong> $gagnant</strong> a gagné!</p>";
    } elseif ($matchNul) {
        echo "<p>Match nul!</p>";
    } else {
        echo "<p>C'est au tour de <strong>{$tour}</strong>.</p>";
    }
    ?>

    <table class="ticTacToe">
        <?php
        for ($i = 0; $i < 3; $i++) {
            echo '<tr>';
            for ($j = 0; $j < 3; $j++) {
                if ($tableau[$i][$j] === '') {
                    echo "<td><a href=\"?ligne=$i&colonne=$j\">( )</a></td>";
                } else {
                    echo "<td>{$tableau[$i][$j]}</td>";
                }
            }
            echo '</tr>';
        }
        ?>
    </table>

    <a href="?reinitialiser">Réinitialiser</a>
</body>
</html>
