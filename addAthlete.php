<?php 
  include("databaseDetails.inc");
  session_start();

  if (isset($_SESSION['UserId'])) {
    $currUserID = $_SESSION['UserId'];
  }
  else{
    header("Location: logout.php");
  }
  if( isset($_POST['fname']) && isset($_POST['lname']) ){

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$year = $_POST['year'];
$height = $_POST['height'];
$city = $_POST['city'];
$weight = $_POST['weight'];
$sport = $_POST['sport'];
$stateCountry = $_POST['stateCountry'];
$highSchool = $_POST['highSchool'];
$gender = $_POST['gender'];


$con = mysqli_connect($server,$username,$password, $dbname);
if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}
$account = mysqli_query($con,"select AccountType from Users where UserID =" .$currUserID);
$accountType = mysqli_fetch_array($account);
if ($accountType['AccountType'] != '0') {
	header("Location: logout.php");}

mysqli_query($con, "insert into athletes (First_Name,Last_name,Year,Height,Weight,City,State_Country,High_School,Gender) values ('".$fname."','".$lname."','".$year."','".$height."','".$weight."','".$city."','".$stateCountry."','".$highSchool."','".$gender."')");
mysqli_query($con, "insert into athletesports (athID,sportID) values(".mysqli_insert_id($con).",'".$sport."')");
}
header("Location: Settings.php");
mysqli_close($con);
?>