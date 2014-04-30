<?php 
  include("databaseDetails.inc");
  session_start();

  if (isset($_SESSION['UserId'])) {
    $currUserID = $_SESSION['UserId'];
  }
  else{
    header("Location: logout.php");
  }
  $con = mysqli_connect($server,$username,$password, $dbname);
	if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}
  $email = $_POST['email'];
	$account = mysqli_query($con,"select email,UserID from users where Email ='" .$email."'");
	$account = mysqli_fetch_array($account);

  if( isset($_POST['email']) && isset($_POST['delete']) ){
  	if($_POST['delete'] == 'yes' && $_SESSION['UserID'] !=$account['UserID']){

  		mysqli_query($con,'delete from users where UserId ='.$account['UserID']);
  	}
  }
  elseif (isset($_POST['email']) && isset($_POST['newpass'])) {
      mysqli_query($con,"update users set Password = '".sha1($_POST['newpass'])."' where userID =".$account['UserID']);
  }
header("Location: Settings.php");
mysqli_close($con);
?>