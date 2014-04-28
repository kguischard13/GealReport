<?php

include "databaseDetails.inc";

session_start();

if (isset($_SESSION['UserId'])) {
    $currUserID = $_SESSION['UserId'];
  }
else{
    header("Location: logout.php");
}

$con = new mysqli($server,$username,$password, $dbname);
if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}


$email = $con->real_escape_string($_POST['email']);
$pass = $con->real_escape_string($_POST['pass1']);
$pass2 = $con->real_escape_string($_POST['pass2']);
$fname = $con->real_escape_string($_POST['fname']);
$lname = $con->real_escape_string($_POST['lname']);


if(!ctype_space($email)&& !empty($email)){
	$res=$con->query("update Users set Email = '".$email."' where UserID =".$currUserID);
}

if($pass2 == $pass){
	if (!ctype_space($pass)&& !empty($pass)) {
		$res=$con->query("update Users set Password = '".sha1($pass)."' where UserID =".$currUserID);
	}
}else{
	header("Location: Settings.php");
}

if (!ctype_space($fname) && !empty($fname)) {
	$res=$con->query("update Users set First_Name = '".$fname."' where UserID =".$currUserID);
}

if (!ctype_space($lname)&& !empty($lname)) {
	$res=$con->query("update Users set Last_Name = '".$lname."' where UserID =".$currUserID);
}

$con->close();

Header("Location: Settings.php");

?>