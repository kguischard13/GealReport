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
            table,th,td{
                border: 2px solid gold;
                color: white;
            }
            h2,h3{
                color: gold
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
            
                <?php
            $con = mysqli_connect($server,$username,$password, $dbname);
            if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}
            $account = mysqli_query($con,"select AccountType from Users where UserID =" .$currUserID);
            $accountType = mysqli_fetch_array($account);
            if ($accountType['AccountType'] == '0') {
            echo'<div id="adminSettings">';
            echo'<center><h2>Admin Tools</h2></center>';
            echo'<table>';
            echo'<tr><td>';
            echo'        <center><h3>Add Athlete</h3></center>';
            echo'        <hr color="white" size ="4">';
            echo'        <br>';
            echo'        <form method="POST" action="addAthlete.php">';
            echo'        First Name: <br><input type="text" name="fname"><br>';
            echo'        Last Name: <br><input type="text" name="lname"><br>';
            echo'        Year:<br><input type="text" name="year"><br>';
            echo'        Height: <br><input type="text" name="height"><br>';
            echo'        Weight: <br><input type="text" name="weight"><br>';
            echo'        City: <br><input type="text" name="city"><br>';
            echo'        State/Country:<br> <input type="text" name="stateCountry"><br>';
            echo'        High School: <br><input type="text" name="highSchool"><br>';
            echo'        Gender: ';
            echo'        <input type="radio" name="gender" value="M">Male';
            echo'        <input type="radio" name="gender" value="F">Female<br>';
            echo'        Sport(abbreviation): <br><input type="text" name="sport"><br>';
            echo'        <button type="submit" id="signButton">Add</button><br>';
            echo'    </form>';
            echo'</td>';

            echo'<td>';
            echo'<center><h3>Add Coach</h3></center>';
            echo'        <hr color="white" size ="4">';
            echo'        <br>';
            echo'        <form method="POST" action="addCoach.php">';
            echo'        First Name: <br><input type="text" name="fname"align="right"><br>';
            echo'        Last Name:<br><input type="text" name="lname"align="right"><br>';
            echo'        coach ID: <br><input type="text" name="coachID"align="right"><br>';
            echo'        Sport(abbreviation): <br><input type="text" name="sport"><br>';
            echo'        Graduation Year:<br><input type="text" name="gradYear"align="right"><br>';
            echo'        Alma Mater:<br><input type="text" name="almaMater"align="right"><br>';
            echo'        Position: <br><input type="text" name="position"align="right"><br>';
            echo'        Phone: <br><input type="text" name="phone"align="right"><br>';
            echo'        <button type="submit" id="signButton">Add</button><br>';
            echo'    </form>';
            echo'</td>';

            echo'<td>';
            echo'<center><h3>Manage Users</h3></center>';
            echo'        <hr color="white" size ="4">';
            echo'        <br>';
            echo'        <form method="POST" action="updateUser.php">';
            echo'        Email:<br> <input type="text" name="email"><br>';
            echo'        New password:<br><input type="password" name="newpass"><br>';
            echo'        Delete user:<br>';
            echo'        <input type="radio" name="delete" value="yes">Yes';
            echo'        <input type="radio" name="delete" value="no">No<br>';
            echo'        <button type="submit" id="signButton">Update User</button><br>';
            echo'    </form>';
            echo'</td>';
            echo'</tr>';
            echo'</table>';
            echo'</div>' ;
            };


         ?>
        <div id="athleteCustom">
            <center><h3>User Information</h3></center>
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
            <center><h3>Favorite Teams</h3></center>
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
            <center><h3>Select As Many As You Want</h3></center>
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
            <center><h3>Change Information</h3></center>
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