<?php
// Login functie
function loginFunc($email, $pass, $conn) {
  $sqlLoginQ = "
  select email, password
  from login
  where email = '{$email}' and password = '$pass'";
  $sqlLoginResult = mysqli_query($conn, $sqlLoginQ);
  while ($record = mysqli_fetch_assoc($sqlLoginResult)) {
    if ($record['email'] == $email && $record['password'] == $pass) {
      if ($email == "m.van.der.velde@st.hanze.nl" && $pass = "Wachtwoord123") {
        $_SESSION['logged'] = true;
        $_SESSION['admin'] = true;
        $_SESSION['email'] = $email;
        $redirectlocation = PAGE_PATH . "/cms-kamer/html/index.php";
      }else {
        $_SESSION['logged'] = true;
        $_SESSION['admin'] = false;
        $_SESSION['email'] = $email;
        $redirectlocation = PAGE_PATH . "/kamer_overzicht/html/index.php";
      }
      header("location: {$redirectlocation}");
  		exit;
    }
  }
  // Als de while loop niets kan vinden.
  $_SESSION['logged'] = false;
  $_SESSION['admin'] = false;
  return "Onbekend E-mail of Wachtwoord";
}

function aanmeldFunc($email, $pass, $conn) {
  $sqlLoginQ = "
  select email
  from login
  where email = '{$email}'";
  $sqlLoginResult = mysqli_query($conn, $sqlLoginQ);
  // Checken of het email an bestaat in de database
  while ($record = mysqli_fetch_assoc($sqlLoginResult)) {
    // Als deze bestaat, geef dan een error dat het email al bestaat.
    if ($record['email'] == $email) {
      return "Dat email bestaat al, log in op de login-pagina.";
      header("location: {$redirectlocation}");
  		exit;
    }
  }
  // Als de while loop niets kan vinden.
  $sqlNewAccountQ = "
  insert into login (email, password)
  values ('{$email}','{$pass}')";
  if (mysqli_query($conn, $sqlNewAccountQ)) {
    // Added succesfully.
    $_SESSION['logged'] = true;
    $_SESSION['admin'] = false;
    $_SESSION['email'] = $email;

    $redirectlocation = PAGE_PATH . "/kamer_overzicht/html/index.php";
    header("location: {$redirectlocation}");
    exit;
  }
  else{
    echo "Error: " . $sqlNewAccountQ . "<br>" . mysqli_error($conn);
  }
}

// Als er een request word gedaan naar de server door middel van POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Als de POST request van de knop 'loginButton' komt
  if (isset($_POST['loginButton'])) {
    // Als ze niet zijn ingevuld of leeg zijn, return dan
    if (!isset($_POST['email']) || !isset($_POST['password']) || empty($_POST['email']) || empty($_POST['password'])) {
      return;
    }
    else {
      $email = $_POST['email'];
      $pass = $_POST['password'];
      $errorCode = loginFunc($email,$pass,$conn);
    }
  }
  // Als de POST request van de knop 'aanmeldButton' komt
  elseif (isset($_POST['aanmeldButton'])) {
    // Als ze niet zijn ingevuld of leeg zijn, return dan
    if (!isset($_POST['email']) || !isset($_POST['password']) || empty($_POST['email']) || empty($_POST['password'])) {
      return;
    }
    else {
      $email = $_POST['email'];
      $pass = $_POST['password'];
      $errorCodeA = aanmeldFunc($email,$pass,$conn);
    }
  }
}




// OUDE CODE
//
// if(isset($_POST['aanmelden'])){
//   $email = $_POST['email'];
//   $password = $_POST['password'];
// //email sanitizen
//   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
// if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     echo "Dit email adres is goedgekeurd\n";
// }
//
//   $sqlAanmeldquery = "insert into Login (email, password) values ('$email', '$password');";
//   if (mysqli_query($conn, $sqlAanmeldquery)) {
//   echo "je bent aangemeld ".$email;
//   echo "<a href=\"../../login/html/index.php\">naar loginpagina</a>";
//   }else{
//     echo "Error: " . $sqlAanmeldquery . "<br>" . mysqli_error($conn);
//   }
// }
//
// //login functie;
// if(isset($_POST['login'])) {
//   if($_POST['email'] == "" || $_POST['password'] == ""){
//   echo "niet gelukt";
//   echo "<br/>";
//   echo "<a href=\"../../login/html/index.php\">naar loginpagina</a>";
//
//   }
// else {
//
//
//   //ophalen email en gebruikersnaam;
//   $email = $_POST['email'];
//   $password = $_POST['password'];
//   //variabelen in een session zetten
//
//
//
//   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
//   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     echo "Dit email adres is legitiem";
//     echo "<br/>";
//   }
//   $getSqlPassword = "SELECT password FROM Login WHERE email = '$email';";
//   $getPassword = mysqli_query($conn, $getSqlPassword);
//
//
//   if($getPassword == $password){
//     echo "het wachtwoord is $password";
//     echo "<br/>";
//     echo " het wachtwoord is correct";
//     echo "<br/>";
//   }else {
//     echo "het wachtwoord: ".$email." is niet correct";
//     echo "<br/>";
//
//   }
//
//   $sqlLoginQuery = "SELECT email, password FROM Login WHERE email = '$email' AND password = '$password';";
//   $runSqlLoginQuery = (mysqli_query($conn, $sqlLoginQuery));
//   if($email == 'm.van.der.velde@st.hanze.nl' && $password == 'Wachtwoord123') {
//     echo "<a href=\"../../login/html/login-pagina.php\">naar loginpagina</a>";
//   }elseif ($runSqlLoginQuery && $verifyPassword) {
//     echo "login gelukt";
//     echo "<br/>";
//     echo "<a href=\"ingelogd.php\">hallo</a>";
//     echo "<a href=\"../../reservering/html/index.php\">naar reserveringspagina</a>";
//     $_SESSION['email'] = $email;
//     $_SESSION['password'] = $password;
//     echo $_SESSION['email'];
//     echo "<br/>";
//     echo $_SESSION['password'];
//   }else{
//     echo "<br/>";
//     echo "Verkeerde login of wachtwoord: " . $sqlLoginQuery . "<br>" . mysqli_error($conn);
//     echo "<a href=\"../../login/html/index.php\">naar loginpagina</a>";
//
//   }
//
// }
// }

 ?>
