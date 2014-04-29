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

<html>
    <head>
        <title>Gael Report</title>
        <meta name='viewport' content="minimum-scale=.98; maximum-scale=5; initial-scale=.98; user-scalable=no; width=1024">
        
        <link rel="stylesheet" type="text/css" href="CSS/gaelStyles.css">
        
        <script type="text/javascript"></script>

        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src='gaeljq.js'></script>
        <style>
            body {background-color:  maroon;}
            table,th,{
                border: 2px solid gold;
            }
        </style>
    </head>
    <body  style='min-width: 1000px'>
        <div id="TitleBar">
            <b>Customization Page</b>
        </div>
        <div id="menuBar">
            <div style="float:left">
                <a href="UserHomePage.php"><button type="button">User HomePage</button></a>
            </div>
            <div id="home button" style='float: right'>
                <a href="logout.php"><button type="button" >LogOut</button></a>
            </div>
            <div align= "center">
                <form action="results.php" method="POST">
                <input  name="result" type="text">
                <font color="white">Search by: </font>
                <select name="searchBy">
                    <option value="First_Name">First Name</option>
                    <option value="Last_Name">Last Name</option>
                    <option value="Height">Height</option>                
                    <option value="Sport_Name">Sport</option>
                    <option value="City">City</option>
                    <option value="State_Country">State/Country</option>
                    <option value="Major">Major</option>
                </select>
                <button type="submit">Select</button>
                </form>
            </div>
        </div>
            
        
        <div id="athleteCustom">
            <center><p>User Information</p></center>
            <hr color='white' size ="4">
            <br>
            <?php
            
            $con = new mysqli($server,$username,$password, $dbname);
           
            if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}

            $user = $con->query("select First_Name, Last_Name, Email from Users where UserID =" .$currUserID);
            $row = $user->fetch_row();

            printf("Email: %s <br><br> First Name: %s <br><br> Last Name: %s <br><br>", $row[2],$row[0],$row[1]);
            $con->close();
            ?>
            <!-- <form>Kester<input type="checkbox"></form> -->
            <!-- <form>Evan<input type="checkbox"></form> -->
            <!-- <form>John<input type="checkbox"></form> -->
            <!-- <button type="submit" style="float:right">delete selected</button> -->
        </div>
        <div id="sportCustom">
            <center><p>Favorite Teams</p></center>
            <hr color='white' size ="4">
            <br>
            <form method = 'POST' action='deleteTeam.php'>
            <?php
            $con = new mysqli($server,$username,$password, $dbname);
          
            if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}

            $teams = $con->query("select Sports_sportID from FavoriteTeams where Users_UserId = ".$currUserID);
            $numTeams = $teams->num_rows;

            $query = "select Sport_Name,sportID from sports where sportID ='";

            for ($i=0; $i < $numTeams; $i++) {
                
                $row = $teams->fetch_row();
                $sportname = $con->query($query.$row[0]."'");
                $rowSN = $sportname->fetch_row();

                printf("%s<input type='checkbox' name='teams[]' value= '%s'>", $rowSN[0], $rowSN[1]);
                printf("<br><br>");
            }

            $con->close();

            ?>
            <button type="submit" style="float:right">Delete</button>
            <button id='addButton' type="button" style="float:left">Add</button>
            </form>     
        </div>
        <div id='newTeamCustom' hidden>
            <center><p>Select As Many As You Want</p></center>
            <hr color='white' size ="4">
            <br>
            <form method = 'POST' action='addTeam.php'>
            <?php
            $con = new mysqli($server,$username,$password, $dbname);
            if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}

            $favTeam = $con->query("select Sports_sportID from FavoriteTeams 
                where Users_UserId = ".$currUserID);
            $favCnt= $favTeam->num_rows;
            $query = "";

            if($favCnt != 0){
                $query = "select sportID, Sport_Name from sports where";

                for ($i=0; $i < $favCnt; $i++){
                    $row = $favTeam->fetch_row();
                    $query = $query." sportID != '".$row[0]."' and";
                }

                $query = explode(" ", $query);
                array_splice(($query), -1);
                $query = implode(" ", $query);

                $nonFavTeam = $con->query($query);
                $cnt = $nonFavTeam->num_rows;

                for ($i=0; $i < $cnt; $i++) {
                
                    $row = $nonFavTeam->fetch_row();
                    

                    printf("%s<input class='checkbox' type='checkbox' name='teams[]' value= '%s'>", $row[1], $row[0]);
                    printf("<br><br>");
                }

            }else{
                $query = "select sportID,Sport_Name from sports"; 

                $nonFavTeam = $con->query($query);
                $cnt = $nonFavTeam->num_rows;

                for ($i=0; $i < $cnt; $i++) {
                
                    $row = $nonFavTeam->fetch_row();
                    

                    printf("%s<input class='checkbox' type='checkbox' name='teams[]' value= '%s'>", $row[1], $row[0]);
                    printf("<br><br>");
                }
            }

            
            ?>

            <button type="Submit" style="float: left">Track</button>
            <button id='cancelButton'type="Button" style="float: right">Cancel</button><br>
            </form>            
        </div>

        <div id="userSettings"> 
            <center><p>Change Information</p></center>
            <hr color='white' size ="4">
            <br>

            <form method='POST' action='userEdit.php'>
                Email:<input type="email" name="email"><br>
                First Name: <input type="text" name="fname"><br>
                Last Name: <input type="text" name="lname"><br>
                Password: <input type="password" name="pass1"><br>
                Confirm: <input type="password" name="pass2"><br> 
                <button type="submit" id="signButton">Change</button><br>
            </form>
        </div>
    </body>
</html>