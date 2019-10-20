<?php
/*	$dbname = 'wideworldimporters';
	$dbuser = 'root';
	$dbpass = 'Fasha2808';
	$dbhost = '127.0.0.1';
	$connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to connect to '$dbhost'");
	mysqli_select_db($connect, $dbname) or die("Could not open the database '$dbname'");

*/

$servername = "ssh@78.46.199.112";
$username = "root";
$password = "Strongpassword123";
$dbname = "roomservice";

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
    echo "failed to connect";
}else {
  echo "connection succesfull";
}





?>
