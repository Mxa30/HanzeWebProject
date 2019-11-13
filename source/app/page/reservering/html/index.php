<?php include "../../../../meta.php" ?>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php
    $filePath = "/source/app/page/reservering/html/index.php";
    include (COMPONENT_PATH . "/header/index.php");

    $sqlInfoArray = explode("-",$_SESSION['reserveerVal']);
    $sqlInfoKamer = $sqlInfoArray[0];
    $sqlInfoGebouw = "Van " . $sqlInfoArray[1];

    $sql = "
    SELECT kamernummer, ruimte.gebouw, vleugel, faciliteit, verdieping, kamercapaciteit, faciliteit, gebouw.adres
    from ruimte
    INNER JOIN gebouw
    ON ruimte.gebouw=gebouw.gebouw
    WHERE kamernummer='{$sqlInfoKamer}' and ruimte.gebouw='{$sqlInfoGebouw}'";

    $result = $conn->query($sql);
    $record = mysqli_fetch_assoc($result);
    $row = $record;

    foreach ($record as $faciliteit) {
      if ($faciliteit == "digibord") {
        $digibord = true;
        break;
      }else {
        $digibord = false;
      }
    }

    foreach ($record as $faciliteit) {
      if ($faciliteit == "stopcontacten") {
        $stop = true;
        break;
      }else {
        $stop = false;
      }
    }

    foreach ($record as $faciliteit) {
      if ($faciliteit == "whiteboard") {
        $white = true;
        break;
      }else {
        $white = false;
      }
    }
  ?>
  <main>
    <div class="master">
      <p>  <?php echo $row["kamernummer"]; ?> | <?php echo $row["gebouw"]; ?> </p>

      <div class="beschrijvingContainer">
        <div class="informatieContainer">
          <h3>Informatie</h3>
          <?php
            if ($row["gebouw"] == 'Van DoorenVeste') {
              $imgLink = ASSET_PATH . "/afbeelding_vanDoorenveste.jpg";
            }else if($row["gebouw"] == 'Van OlstToren'){
              $imgLink = ASSET_PATH . "/afbeelding_vanOlstToren.jpg";
            }
          ?>
          <hr class="hr">
          <div class="infoContainerData">
            <div class="dataTableContain">
              <table>
                <tr>
                  <td>Gebouw:</td>
                  <td><?php echo $row["gebouw"]; ?></td>
                </tr>
                <tr>
                  <td>Adres:</td>
                  <td><?php echo $row["adres"]; ?></td>
                </tr>
                <tr>
                  <td>Kamernummer:</td>
                  <td><?php echo $row["kamernummer"]; ?></td>
                </tr>
                <tr>
                  <td>Vleugel:</td>
                  <td><?php echo $row["vleugel"]; ?></td>
                </tr>
                <tr>
                  <td>Verdieping:</td>
                  <td><?php echo $row["verdieping"]; ?></td>
                </tr>
                <tr>
                  <td>Aantal personen:</td>
                  <td><?php echo $row["kamercapaciteit"]; ?></td>
                </tr>
              </table>
            </div>
            <div class="image">
              <img src="<?php echo $imgLink; ?>" alt="gebouw foto">
            </div>
          </div>
          <hr class="hr">
          <div class="">
            <h3>Faciliteiten</h3>
            <?php
              $checkBoxImg = ASSET_PATH . "/Check.png";
              $crossBoxImg = ASSET_PATH . "/Cross.png";

              if ($digibord) {
                echo "<img src='{$checkBoxImg}' alt='Checkbox'>";
                echo "Digibord<br/>";
              }else{
                echo "<img src='{$crossBoxImg}' alt='Crossbox'>";
                echo "Digibord<br/>";
              }

              if ($stop) {
                echo "<img src='{$checkBoxImg}' alt='Checkbox'>";
                echo "Stopcontacten<br/>";
              }else{
                echo "<img src='{$crossBoxImg}' alt='Crossbox'>";
                echo "Stopcontacten<br/>";
              }
              if ($white) {
                echo "<img src='{$checkBoxImg}' alt='Checkbox'>";
                echo "Whiteboard<br/>";
              }else{
                echo "<img src='{$crossBoxImg}' alt='Crossbox'>";
                echo "Whiteboard<br/>";
              }
            ?>
          </div>
        </div>
      </div>
      <?php
        function maaktijd($cijfers) {
          return  substr($cijfers, 0,2). ":" .substr($cijfers, 2,2). ":00";
        };
      ?>
      <form class="Reserveringssysteem" action="index.php" method="post">
        <?php
        include "../php/reserveringFunction.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $ok = TRUE;
          if ((int)($_POST["startTime"]) >= (int)($_POST["endTime"])) {
            $ok = FALSE;
            echo "Starttijd moet voor de eindtijd zijn!";
          }
          if ($ok and (isset($timesArrayA))) {
            foreach ($timesArrayA as $blok) {
              if (!(((int)($_POST["endTime"])) <= $blok[0] or ((int)($_POST["startTime"])) >= $blok[1])) {
                $ok = FALSE;
              }
            }
          }
          if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            $row['kamernummer'] = (int)$row['kamernummer'];
            if ($ok) {
                $eindtijdDef = maaktijd($_POST['endTime']);
                $beginTijdDef = maaktijd($_POST['startTime']);
                $stmt = $conn->prepare("INSERT INTO reservering (email, kamernummer, gebouw, starttijd, eindtijd, reserveringsdatum)VALUES (?, ?, ?,?,?,?)");
                $stmt->bind_param("sissss", $email, $row['kamernummer'], $row['gebouw'], $beginTijdDef, $eindtijdDef, $_SESSION['datum']);
                $stmt->execute();
            }
            else {
              echo "Tijden niet beschikbaar!";
            }
          }
        }
         ?>
        <h3>Reservering</h3>
        <hr class="hr">
        <p class="tijden">Tijd: van </p>
        <select class="tijd" name="startTime">
            <option value="0800">08:00</option>
            <option value="0830">08:30</option>
            <option value="0900">09:00</option>
            <option value="0930">09:30</option>
            <option value="1000">10:00</option>
            <option value="1030">10:30</option>
            <option value="1100">11:00</option>
            <option value="1130">11:30</option>
            <option value="1200">12:00</option>
            <option value="1230">12:30</option>
            <option value="1300">13:00</option>
            <option value="1330">13:30</option>
            <option value="1400">14:00</option>
            <option value="1430">14:30</option>
            <option value="1500">15:00</option>
            <option value="1530">15:30</option>
            <option value="1600">16:00</option>
            <option value="1630">16:30</option>
            <option value="1700">17:00</option>
            <option value="1730">17:30</option>
            <option value="1800">18:00</option>
            <option value="1830">18:30</option>
            <option value="1900">19:00</option>
          </select>
        <p class="tijden">Tot </p>
        <select class="tijd" name="endTime">
          <option value="0800">08:00</option>
          <option value="0830">08:30</option>
          <option value="0900">09:00</option>
          <option value="0930">09:30</option>
          <option value="1000">10:00</option>
          <option value="1030">10:30</option>
          <option value="1100">11:00</option>
          <option value="1130">11:30</option>
          <option value="1200">12:00</option>
          <option value="1230">12:30</option>
          <option value="1300">13:00</option>
          <option value="1330">13:30</option>
          <option value="1400">14:00</option>
          <option value="1430">14:30</option>
          <option value="1500">15:00</option>
          <option value="1530">15:30</option>
          <option value="1600">16:00</option>
          <option value="1630">16:30</option>
          <option value="1700">17:00</option>
          <option value="1730">17:30</option>
          <option value="1800">18:00</option>
          <option value="1830">18:30</option>
          <option value="1900">19:00</option>
          </select>
        <br>
        <button id="submitButtonID" type="submit" name="Reserveren">Reserveren</button>
    </form>
      <div class="timeTableContain">
        <h3>Tijden</h3>
        <hr class="hr">
        <div class="timeGraphContain">
          <?php
          include "../php/timeGraphFunction.php";
          if (!isset($timesArray)) {
            $timesArray = [[0,0]];
          }
          ?>
          <table class="timeGraph">
            <tr class="lineContainer">
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL
                <?php
                echo "<pre>";
                print_r($timesArray);
                echo "</pre>";
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(800, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(830, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(830, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(900, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(900, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(930, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(930, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1000, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1000, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1030, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1030, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1100, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1100, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1130, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1130, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1200, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1200, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1230, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1230, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1300, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1300, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1330, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1330, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1400, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1400, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1430, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1430, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1500, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1500, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1530, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1530, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1600, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1600, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1630, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1630, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1700, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
                <div class="timeFrameRedL
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1700, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1730, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
                <div class="timeFrameRedR
                <?php
                for ($i=0; $i < count($timesArray); $i++) {
                  if (in_array(1730, range($timesArray[$i][0],$timesArray[$i][1])) && in_array(1800, range($timesArray[$i][0],$timesArray[$i][1]))) {
                    echo "active";
                  }
                }
                ?>"></div>
              </td>
              <td>
                <div class="line"></div>
                <div class="timeFrame"></div>
              </td>
            </tr>
            <tr class="timeContainer">
              <td>08:00</td>
              <td>09:00</td>
              <td>10:00</td>
              <td>11:00</td>
              <td>12:00</td>
              <td>13:00</td>
              <td>14:00</td>
              <td>15:00</td>
              <td>16:00</td>
              <td>17:00</td>
              <td>18:00</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </main>
</body>
