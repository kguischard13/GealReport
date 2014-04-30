<?php 
  include("databaseDetails.inc");
  session_start();

  if (isset($_SESSION['UserId'])) {
    $currUserID = $_SESSION['UserId'];
  }
  else{
    header("Location: logout.php");
  }
?>

<?php
if(!empty($_POST['teams'])){
  $con = new mysqli($server,$username,$password, $dbname);
	foreach ($_POST['teams'] as $delTeam) {
        if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}

        $teams = $con->query("Delete From FavoriteTeams where Users_UserId = ".$currUserID." and Sports_sportID = '".$delTeam."'");
        

        if(!$teams){
           printf("Delete Unsuccessful ");
           printf("Please <a href='Settings.php'>Try Again</a><br>");
           exit();
        }

        
	}
  $con->close();
}else{
	header("Location: Settings.php");
}

Header("Location: UserHomePage.php");
?>

