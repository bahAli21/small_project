<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics Page</title>
</head>
<body>

<h1>Statistics Page</h1>

<!-- Display Number of Instances -->
<h2>Number of Instances for Selected Tables</h2>
<p>Total Instances: <?= $statsData["instances"] ?></p>

<!-- Display Children with Current School -->
<h2>Children with Current School</h2>
<ul>
    <?php foreach ($statsData['child']['CWCS'] as $child): ?>
        <li><?= $child['nom'] . ' ' . $child['prenom'] . ' - ' . $child['ecole_actuelle'] ?></li>
    <?php endforeach; ?>
</ul>

<!-- Display Children with Cantine for Date -->
<h2>Children with Cantine for Date (01/01/2024)</h2>
<ul>
    <?php foreach ($statsData['child']['CWCFD'] as $child): ?>
        <li><?= $child['nom'] . ' ' . $child['prenom'] . ' - ' . $child['cantine'] ?></li>
    <?php endforeach; ?>
</ul>

<!-- Display Children with Same Name in Different Schools -->
<h2>Children with Same Name in Different Schools</h2>
<ul>
    <?php foreach ($statsData['child']['CWSNIDS'] as $child): ?>
        <li><?= $child['nom'] . ' ' . $child['prenom'] . ' - School A: ' . $child['ecole_A'] . ', School B: ' . $child['ecole_B'] ?></li>
    <?php endforeach; ?>
</ul>

<!-- Display Top 3 Departements with Most Communes -->
<h2>Top 3 Departements with Most Communes</h2>
<ol>
    <?php foreach ($statsData['top3']['T3DWMC'] as $departement): ?>
        <li><?= $departement['nom'] . ' - Number of Communes: ' . $departement['nombre_communes'] ?></li>
    <?php endforeach; ?>
</ol>

<!-- Display Top 3 Most Requested Services -->
<h2>Top 3 Most Requested Services</h2>
<ol>
    <?php foreach ($statsData['top3']['T3MRS'] as $service): ?>
        <li><?= $service['Libelle'] . ' - Number of Requests: ' . $service['nombre_demandes'] ?></li>
    <?php endforeach; ?>
</ol>

<!-- Display Top 3 Communes with Most Unions -->
<h2>Top 3 Communes with Most Unions</h2>
<ol>
    <?php foreach ($statsData['top3']['T3CWMU'] as $commune): ?>
        <li><?= $commune['nom'] . ' - Number of Unions: ' . $commune['nombre_unions'] ?></li>
    <?php endforeach; ?>
</ol>

</body>
</html>
