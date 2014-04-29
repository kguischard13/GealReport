<?php
include("databaseDetails.inc");



$con = new mysqli($server,$username,$password, $dbname);
if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}


if(isset($_POST['athID'])){
    $athID = $_POST['athID'];
    $athlete = $con->query("select * from athletes where AthleteID =".$athID);
    $row = $athlete->fetch_assoc();

    $res = $con->query("select * from majors where athID =".$athID);
    $row2 = $res->fetch_assoc();

    $result = "<h1>".$row['First_Name']." ".$row['Last_Name'] . " </h1><br><br><br>
        <b>Year: </b>".$row['Year']."<br><br><b>High School: </b>".$row['High_School']."
        <br><br><b>Hometown: </b>".$row['City'].", ".$row['State_Country']."
        <br><br><b>Height: </b>".$row['Height']."<br><br><b>Major: </b>".$row2['Major']."<br><br>";

    echo $result;
}else{
    echo "<h1>Error</h1>";
}



?>



