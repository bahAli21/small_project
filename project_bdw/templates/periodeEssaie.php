<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrollable Div</title>
    <style media="screen">
      .scrollableDiv p {
        font-size: 1.5rem;
        text-align: center;
        font-weight: 300;
      }
    </style>
</head>
<body>

  <div class="scrollableDiv">
    <a href="index.php?page=Services&dir=one" title="Retour"><span class="back"> <-- </span></a>
    <h1>Nos Essais!</h1>
    <?php if (!empty($periode)): ?>
        <?php foreach ($periode as $period): ?>
            <?php if (isset($period['C']) && is_array($period['C'])): ?>
                <?php foreach ($period['C'] as $communeIndex => $commune): ?>
                    <p>
                        <span>Les services :</span>
                        <?php foreach ($period['S'] as $service): ?>
                            <?php echo "$service "; ?>
                        <?php endforeach; ?>
                        <span>à la commune de :</span> <?php echo $commune['nomC']; ?>
                        <span>pour une durée de :</span> <?php echo $period['D'][$communeIndex]; ?> mois
                    </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune commune spécifiée pour cette période.</p>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune période d'essai générée.</p>
  <?php endif; ?>

</div>



</body>
</html>
