<!-- contact section design -->
  <section class="myForm" id="periode">
      <h2 class="heading">Add <span>Service !</span></h2>

      <form action="index.php?page=Services&dir=two" method="post">
          <div class="input-box">
              <input type="text" name="libelle" placeholder="Libéllé">
              <input type="text" name="description" placeholder="Description">
          </div>
          <div class="radio">
              Gratuit <input type="radio" name="tarif" value="gratuit"> Payant <input type="radio" name="tarif" value="payant">
          </div>
          <div class="input-box">
              <input type="date" id="dateDebut" name="dateDebut" placeholder="Debut">
              <span>AU</span>
              <input type="date" id="dateFin" name="dateFin" placeholder="FIN">
          </div>
          <div class="input-box">
              <h5>Selectionner la commune </h5> <br>
              <select id="selectOption" name="option">
                  <?php foreach($Form['GAC'] as $f): ?>
                      <option value="<?= $f['nomC'] ?>"><?= $f['nomC'] ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
          <input type="submit" value="Ajoutez" class="btn">
      </form>

  </section>
