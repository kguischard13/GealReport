<?php

include "databaseDetails.inc";

if( isset($_POST['email']) && isset($_POST['pass1']) ){

$email = $_POST['email'];
$pass = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

if ($pass != $pass2) {
	Header("Location: signIn.php");
}

$con = new mysqli($server,$username,$password, $dbname);
if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}


$email = $con->real_escape_string($email);
$pass = $con->real_escape_string($pass);
$fname = $con->real_escape_string($fname);
$lname = $con->real_escape_string($lname);



$query = "Insert Into Users (First_Name, Last_Name, Password, Email) Values ('".$fname."','".$lname."','".sha1($pass)."','".$email."')";



$res=$con->query($query);

if($res){
	printf("Sign Up was successful. ");
	printf("Please <a href='gaelHomePage.php'>Click Here</a>");
}

$con->close();

}


// Header("Location: gaelHomePage.php");

?>