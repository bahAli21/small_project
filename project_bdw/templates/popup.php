

<div class="popup">
    <div>
        <div class="popup-box">
            <h1>La reponse : </h1>
            <div class="">
                <span class="one hidden">
                    <?php foreach ($statsData['child']['CWCS'] as $enfant): ?>
                        <?= "Nom: " . $enfant['nomE'] . " | Ecole: " . $enfant['Ecole'] ?> <br>
                    <?php endforeach; ?>
                </span>
                <span class="two hidden">
                    <?php foreach ($statsData['child']['CWCFD'] as $enf): ?>
                        <?= "Nom: " . $enf['nomE'] . " | Cantine: " . $enf['nomCantine'] ?> <br>
                    <?php endforeach; ?>
                </span>
                <span class="three hidden">
                    <?php foreach ($statsData['child']['CWSNIDS'] as $e): ?>
                        <?= "Nom: " . $e['nomE'] . " | Prenom: " . $e['prenom'] ?> <br>
                    <?php endforeach; ?>
                </span>
                <span class="four hidden">
                    <?php foreach ($statsData['top3']['T3DWMC'] as $Dept): ?>
                        <?= "Nom: " . $Dept['nomD'] . " | Nombre: " . $Dept['nb'] ?> <br>

                    <?php endforeach; ?>
                </span>
                <span class="five hidden">
                  <?php foreach ($statsData['top3']['T3MRS'] as $Dem): ?>
                      <?= "Libéllé: " . $Dem['libelle'] . " | Nombre: " . $Dem['nb'] ?> <br>
                  <?php endforeach; ?>
                </span>
                <span class="six hidden">
                  <?php foreach ($statsData['top3']['T3MOS'] as $prop): ?>
                      <?= "Libéllé: " . $prop['libelle'] . " | Nombre: " . $prop['nb'] ?> <br>
                  <?php endforeach; ?>
                </span>
                <span class="seven hidden">
                  <?php foreach ($statsData['top3']['T3CWMU'] as $unions): ?>
                      <?= "id: " . $unions['idC'] . " | Nom: " . $unions['nomC']." | nb_unions: ".$unions['NombreUnions'] ?> <br>
                  <?php endforeach; ?>
                </span>
                <span class="height hidden"><?= $statsData['instance'] ?></span>

            </div>
        </div>
    </div>
</div>
