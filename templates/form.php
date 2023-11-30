<!-- contact section design -->
  <section class="contact" id="periode">
      <h2 class="heading">Add <span>Service !</span></h2>

      <form action="#">
          <div class="input-box">
              <input type="text" placeholder="Libéllé">
              <input type="email" placeholder="Description">
          </div>
          <div class="input-box">
              <label>
                  <input type="radio" name="tarif" value="gratuit">
                  Gratuit
              </label>

              <label>
                  <input type="radio" name="tarif" value="payant">
                  Payant
              </label>
          </div>
          <div class="input-box">
              <label for="dateDebut">Du</label>
              <input type="date" id="dateDebut" name="dateDebut">

              <label for="dateFin">Au</label>
              <input type="date" id="dateFin" name="dateFin">
          </div>

          <div class="input-box">
            <label for="selectOption">Quelle Commune :</label>
            <select id="selectOption" name="selectOption">
                <option value="option1">Option 1</option>
            </select>
          </div>

          <input type="submit" value="Ajoutez" class="btn">
      </form>
  </section>
