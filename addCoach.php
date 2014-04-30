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

$gradYear = $_POST['gradYear'];
$almaMater = $_POST['almaMater'];
$position = $_POST['position'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$sport = $_POST['sport'];
$coachID= $_POST['coachID'];

$con = mysqli_connect($server,$username,$password, $dbname);
if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}
$account = mysqli_query($con,"select AccountType from Users where UserID =" .$currUserID);
$accountType = mysqli_fetch_array($account);
if ($accountType['AccountType'] != '0') {
	header("Location: logout.php");}

mysqli_query($con, "insert into coaches (coachID,First_Name,Last_name,sportID,Graduate_Year,Alma_Mater,Position,Phone) values ('".$coachID."','".$fname."','".$lname."','".$sport."','".$gradYear."','".$almaMater."','".$position."','".$phone."')");
}
header("Location: Settings.php");
mysqli_close($con);
?>