<!-- contact section design -->
  <section class="myForm" id="periode">
      <h2 class="heading">Add <span>Essaie !</span></h2>

      <form action="index.php?page=OursEssaie" method="post">

          <div class="input-box">
              <h5>Selectionner le departement : </h5>
              <select id="selectOption" name="option">
                  <?php foreach($AllDepartController['GAD'] as $d): ?>
                      <option value="<?= $d['nomD'] ?>"><?= $d['nomD'] ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
          <div class="input-box">
              <input type="number" name="nbMois" placeholder="Le nombre de moi">
          </div>
          <div class="input-box">
              <input type="number" name="kilometre" placeholder="nombre de kilometre">
          </div>
          <input type="submit" value="Ajoutez" class="btn">
      </form>

  </section>
