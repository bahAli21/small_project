<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrollable Div</title>
</head>
<body>

<div class="scrollableDiv">
  <a href="index.php?page=Services&dir=one" title="Retour"><span class="back"> <-- </span></a>
    <?php

    foreach($allServicesData['GAS'] as $all) {
        echo "<p> <h2>libelle:</h2> <span>{$all['libelle']}</span><h2>Description:</h2>  <span>{$all['descriptions']}</span>
                <h2>Tarif:</h2> <span>{$all['decisionTarif']} </span>  <h2>Proposer par : </h2> <span>{$all['nomC']}</span> </p> <br>";
    }
    ?>
</div>

</body>
</html>
