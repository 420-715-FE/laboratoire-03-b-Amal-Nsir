<?php
$villeRegion = [
    "Montréal" => "Montréal",
    "Québec" => "Québec",
    "Laval" => "Laval",
    "Gatineau" => "Outaouais",
    "Longueuil" => "ontérégie",
    "Sherbrooke" => "Estrie",
    "Magog" => "Estrie",
    "Coaticook" => "Estrie",
    "Trois-Rivières" => "Mauricie",
    "Drummondville" => "Centre-du-Québec"
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Villes et régions</title>
    <link rel="stylesheet" href="../water.css">
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>
    <h1>Villes et régions</h1>
    <?php
    if (isset($_POST['ville'])) {
        $ville = $_POST ['ville'];
            if (isset($villeRegion[$ville])) {
                echo '<p>La ville de ' .$ville. ' est dans la région administrative"' .$villeRegion[$ville]. '"</p>';
            }
            else {
                echo "<p> La région administrative de la ville de $ville est inconnue</p>";
            }
            echo '<p><a href="">Entrer une autre ville</a></p>';
        }
    
    else {
        echo "<p>Entrez le nom d'une ville: </p>";
    ?>
    <form action ="villes_regions.php" method="POST">
        <input name = 'ville' type="text">
        <button type="submit"> Soumettre </button>
    </form>
    <?php
    }
    ?>
</body>
</html>