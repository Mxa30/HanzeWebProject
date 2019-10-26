<style>
.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {

}
</style>

<form>
  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes(0)">
      <select>
        <option>Gebouw</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div class="checkboxes">
      <label for="one">
        <input type="checkbox" id="one" />Van Doorenveste</label></br>
      <label for="two">
        <input type="checkbox" id="two" />De Deimten</label></br>
      <label for="three">
        <input type="checkbox" id="three" />Van OlstToren</label></br>
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
      <label for="one">
        <input type="checkbox" id="one" />A</label></br>
      <label for="two">
        <input type="checkbox" id="two" />B</label></br>
      <label for="three">
        <input type="checkbox" id="three" />C</label></br>
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
      <label for="one">
        <input type="checkbox" id="one" />1</label></br>
      <label for="two">
        <input type="checkbox" id="two" />2</label></br>
      <label for="three">
        <input type="checkbox" id="three" />3</label></br>
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
      <label for="one">
        <input type="checkbox" id="one" />Digibord</label></br>
      <label for="two">
        <input type="checkbox" id="two" />Stopcontacten</label></br>
      <label for="three">
        <input type="checkbox" id="three" />Whiteboard</label></br>
    </div>
  </div>
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
