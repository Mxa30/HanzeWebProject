<?php include "../../../../meta.php" ?>

<?php include "../php/sqlfilter.php" ?>

<form method="post">
  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes(0)">
      <select>
        <option>Gebouw</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div class="checkboxes">

      <?php
      while($record = mysqli_fetch_assoc($sqlGetOptionGebouwResult)){
        echo("<input type='checkbox' name='{$record['gebouw']}'/>{$record['gebouw']}</br>");
      }
      ?>

    </div>
  </div>
  </br>

  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes(1)">
      <select>
        <option>Vleugel</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div class="checkboxes">

    <?php

    while ($record = mysqli_fetch_assoc($sqlGetOptionVleugelResult)) {
      echo("<input type='checkbox' name= '{$record['vleugel']}'/>{$record['vleugel']}</br>");
    }
    ?>

    </div>
  </div>
  </br>

  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes(2)">
      <select>
        <option>Verdieping</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div class="checkboxes">

    <?php

    while ($record = mysqli_fetch_assoc($sqlGetOptionVerdiepingResult)) {
      echo("<input type='checkbox' name= '{$record['verdieping']}'/>{$record['verdieping']}</br>");
    }
    ?>

    </div>
  </div>
  </br>

  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes(3)">
      <select>
        <option>Aantal personen</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div class="checkboxes">
      <label for="one">
        <input type="checkbox" id="one" />0-5</label></br>
      <label for="two">
        <input type="checkbox" id="two" />5-10</label></br>
      <label for="three">
        <input type="checkbox" id="three" />10-15</label></br>
    </div>
  </div>
  </br>

  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes(4)">
      <select>
        <option>Faciliteiten</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div class="checkboxes">

    <?php

    while ($record = mysqli_fetch_assoc($sqlGetOptionFaciliteitResult)) {
      echo("<input type='checkbox' name= '{$record['faciliteit']}'/>{$record['faciliteit']}</br>");
    }
    ?>

    </div>
  </div>
  <input type="submit" name="filterToepassen" value="Toepassen">
</form>
<script>
  var expanded = [false, false, false];
  var checkboxes;

  function showCheckboxes(i) {
    var checkboxes = checkboxes || document.getElementsByClassName("checkboxes");
    if (!expanded[i]) {
      checkboxes[i].style.display = "block";
      expanded[i] = true;
    } else {
      checkboxes[i].style.display = "none";
      expanded[i] = false;
    }
  }
</script>
