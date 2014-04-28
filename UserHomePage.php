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


<!DOCTYPE html>
<html>
    <head>
        <title>Gael Report</title>
        <meta name='viewport' content='minimum-scale=0.98; maximum-scale=5;  initial-scale=0.98; user-scalable=no; width=1024'>
        
        <link rel="stylesheet" type="text/css" href="CSS/gaelStyles.css">
        
        <style>
            body {background-color:  maroon;}
            table,th,td{
                background-color: black;
                border: 1px solid gold;
            }
        </style>
        
        <script language="javascript">
            function toggleDiv(divid){
                /*var div = document.getElementById("teamBar"+divid);
                var test = document.getElementsByClassName(datadiv)
                //alert(test.innerText);
                for(var i =0; i<test.length; i++){
                  var item = test[i];
                    item.innerText = "Information About " +div.innerHTML;  
                }*/
                
                window.location = "UserHomePage.php?tm="+divid;
                
            }
            function teamBarMouseOver(divid){
              document.getElementById("teamBar"+divid).style.backgroundColor="grey";
            }  
            function teamBarMouseOut(divid){
              document.getElementById("teamBar"+divid).style.backgroundColor="black";
            } 
        </script>

    </head>
    
   <body>
    <div style='min-width: 1000px'>

        <div id="TitleBar">
            <b>The Gael Report Homepage </b>
        </div>


        <!-- main div -->
        <div>
        <div id="menuBar">

          <div id="Profile" style='float:left'>
              <a href="Settings.php">
                <button type="button">
                  <?php
                  $con = new mysqli($server,$username,$password, $dbname);
          
                  if (mysqli_connect_errno() ){
                      echo "Couldnt connect ".mysql_connect_error();
                  }

                  $profile = $con->query("select Email from Users where UserId =".$currUserID);

                  $row = $profile->fetch_row();
                  printf("%s", $row[0]);

                  $con->close();

                  ?>
                </button>
              </a>
            </div>
            <div id="home button" style='float: right'>
            <a href="logout.php"><button type="button" >LogOut</button></a>
            </div>
            <div align= "center" id=search>
            <form action="results.php" method="get">
            <input  name="result" type="text">
            <font color="white">Search by: </font>
            <select name="searchBy">
                <option value="First_Name">First Name</option>
                <option value="Last_Name">Last Name</option>
                <option value="Height">height</option>                
                <option value="Sport">sport</option>
                <option value="City">City</option>
                <option value="State_Country">State/Country</option>
                <option value="Major">Major</option>
            </select>
            <button type="submit">Select</button>
            </form>
            </div>

            
        <div id="divTeamBar">
           <font color="white" align="center"><table>
                <tr>
                    <?php
                    $con = new mysqli($server,$username,$password, $dbname);
          
                  if (mysqli_connect_errno() ){
                      echo "Couldnt connect ".mysql_connect_error();
                  }

                  $teams = $con->query("select Sports_sportID from FavoriteTeams where Users_UserId = ".$currUserID);
                  $numTeams = $teams->num_rows;

                  $query = "select Sport_Name from sports where sportID ='";

                  for ($i=0; $i < $numTeams; $i++) {
                    $cnt = $i + 1; 
                    $row = $teams->fetch_row();
                    $sportname = $con->query($query.$row[0]."'");
                    $rowSN = $sportname->fetch_row();

                    printf("<td id='teamBar%d' class='teamBar' onmouseover='teamBarMouseOver(%d)' onmouseout='teamBarMouseOut(%d)' onclick=\"toggleDiv('%s')\">%s</td>", $cnt,$cnt,$cnt,$row[0], $rowSN[0]);
                  }

                  $con->close();


                    
                    ?>
                    
                </tr>
            </table></font> 
        </div>
      </div>
      <!-- end of two-->
        <nobr><hr color= "black" size = "4"></nobr>
        

    
        
        <!-- Content div -->
        <div >
          <h2></h2>

      <div id="Teams" >
        <table>
                      <tr>
                          <th>Opponents</th>
                          <th>Date</th>
                          <th>Results</th>
                      </tr>
                     <?php
                     $con = new mysqli($server,$username,$password, $dbname);
          
                  if (mysqli_connect_errno() ){
                      echo "Couldnt connect ".mysql_connect_error();
                  }

                  $teams = $con->query("select Sports_sportID from FavoriteTeams where Users_UserId = ".$currUserID);

                     $row = $teams->fetch_row();
                      $currteam = $row[0];
            if (isset($_GET["tm"])) $currteam = $_GET["tm"];

                  


               
                  $res = $con->query("select Opponent, date, status from schedule where sportID = '".$currteam. "'");
                  $resCount = $res->num_rows;
                  
                  for($i = 0; $i<$resCount; $i++){
                      $row2 = $res->fetch_row();
                      printf("<tr> <td>%s</td> ", $row2[0]);
                      $newDate = date("F j, Y", strtotime($row2[1]));
                      echo "<td>". $newDate."</td>";
                      printf("<td> %s </td> </tr>", $row2[2]);
                  }
                  $con->close();

                  ?>
                </table>
      </div>


      <div id="Athletes">
        <table style='width: 100%'>
                      <tr>
                          <th>Athletes</th>
                      </tr>
                      <?php
                       $con = new mysqli($server,$username,$password, $dbname);
          
                  if (mysqli_connect_errno() ){
                      echo "Couldnt connect ".mysql_connect_error();
                  }

                  $teams = $con->query("select Sports_sportID from FavoriteTeams where Users_UserId = ".$currUserID);

                     $row = $teams->fetch_row();
                      $currteam = $row[0];
            if (isset($_GET["tm"])) $currteam = $_GET["tm"];


                     
                         $query = "select athletes.`AthleteID`,first_name, last_name from athletesports  
                           join athletes on athletesports.athID = athletes.`AthleteID`where athletesports.sportID like '";

                         $res = $con->query($query.$currteam. "'");
                         $resCount = $res->num_rows;
                  
                         for($i = 0; $i<$resCount; $i++){
                            $row2 = $res->fetch_row();
                            printf("<tr> <td>%s %s</td> </tr>", $row2[1], $row2[2]);
                         }
                         $con->close();

                  ?>
              </table>
      </div>

      

      <div id="footer" style="margin-top: 100px;background-color:black;clear:both;text-align:center; color: white">
        <?php
        $con = new mysqli($server,$username,$password, $dbname);
          
        if (mysqli_connect_errno() ){
                      echo "Couldnt connect ".mysql_connect_error();
                  }

                  $teams = $con->query("select Sports_sportID from FavoriteTeams where Users_UserId = ".$currUserID);

                     $row = $teams->fetch_row();
                      $currteam = $row[0];
            if (isset($_GET["tm"])) $currteam = $_GET["tm"];


        $res = $con->query("select * from stats where sportID like '".$currteam."'");
        $row2 = $res->fetch_row();
        printf("With %s number of games there were %s Away wins, 
        %s Home Wins and a Win/Loss Percentage of %s", $row2[2],$row2[4],$row2[5],$row2[1])

        //$con->close();
        ?>
      </div>






    </div>
  
     

    
    
            
    

  </div>
    </body>
<!--
    $db = new mysqli($server, $username, $password, $dbname);
                if(mysqli_connect_errno() ){
                  echo "Couldnt not connect to the database";
                }
-->

</html>
