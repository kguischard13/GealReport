<?php 
  include("databaseDetails.inc");

  session_start();

  if (isset($_SESSION['UserId'])) {
    $currUserID = $_SESSION['UserId'];
    header("Location: UserHomePage.php");
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
            function toggleDiv(divid, datadiv){
                /*var div = document.getElementById("teamBar"+divid);
                var test = document.getElementsByClassName(datadiv)
                //alert(test.innerText);
                for(var i =0; i<test.length; i++){
                  var item = test[i];
                    item.innerText = "Information About " +div.innerHTML;  
                }*/

                window.location = "gaelHomePage.php?tm="+divid;
                
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
            <b>Gael Report Homepage </b>
        </div>


        <!-- main div -->
        <div>
        <div id="menuBar">
            <div id="home button">
            <a href="signin.php"><button type="button" style="float:right">Sign in/Signup</button></a>
            </div>
            <div align= "center" id=search>
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
        <div id="divTeamBar">
           <font color="white" align="center"><table >
                <tr>
                    <td id="teamBar1" class="teamBar" onmouseover="teamBarMouseOver(1)" onmouseout="teamBarMouseOut(1)" onclick="toggleDiv('0', 'dataDiv')">Baseball</td>
                    <td id="teamBar2" class="teamBar" onmouseover="teamBarMouseOver(2)" onmouseout="teamBarMouseOut(2)" onclick="toggleDiv('1', 'dataDiv')">Men's Basketball</td>
                    <td id="teamBar3" class="teamBar" onmouseover="teamBarMouseOver(3)" onmouseout="teamBarMouseOut(3)" onclick="toggleDiv('2', 'dataDiv')">Men's Cross Country/Track</td>
                    <td id="teamBar4" class="teamBar" onmouseover="teamBarMouseOver(4)" onmouseout="teamBarMouseOut(4)" onclick="toggleDiv('3', 'dataDiv')"> Golf </td>
                    <td id="teamBar5" class="teamBar" onmouseover="teamBarMouseOver(5)" onmouseout="teamBarMouseOut(5)" onclick="toggleDiv('4', 'dataDiv')">Men's Rowing</td>
                    <td id="teamBar6" class="teamBar" onmouseover="teamBarMouseOver(6)" onmouseout="teamBarMouseOut(6)" onclick="toggleDiv('5', 'dataDiv')">Men's Soccer</td>
                    <td id="teamBar7" class="teamBar" onmouseover="teamBarMouseOver(7)" onmouseout="teamBarMouseOut(7)" onclick="toggleDiv('6', 'dataDiv')">Men's Swimming and Diving</td>
                    <td id="teamBar8" class="teamBar" onmouseover="teamBarMouseOver(8)" onmouseout="teamBarMouseOut(8)" onclick="toggleDiv('7', 'dataDiv')">Men's Water Polo</td>
                    <td id="teamBar9" class="teamBar" onmouseover="teamBarMouseOver(9)" onmouseout="teamBarMouseOut(9)" onclick="toggleDiv('8', 'dataDiv')">Women's Basketball</td>
                    <td id="teamBar10" class="teamBar" onmouseover="teamBarMouseOver(10)" onmouseout="teamBarMouseOut(10)" onclick="toggleDiv('9', 'dataDiv')">Women's Cross Country/Track</td>
                    <td id="teamBar11" class="teamBar" onmouseover="teamBarMouseOver(11)" onmouseout="teamBarMouseOut(11)" onclick="toggleDiv('10', 'dataDiv')">Lacrosse</td>
                    <td id="teamBar12" class="teamBar" onmouseover="teamBarMouseOver(12)" onmouseout="teamBarMouseOut(12)" onclick="toggleDiv('11', 'dataDiv')">Women's Rowing</td>
                    <td id="teamBar13" class="teamBar" onmouseover="teamBarMouseOver(13)" onmouseout="teamBarMouseOut(13)" onclick="toggleDiv('12', 'dataDiv')">Women's Soccer</td>
                    <td id="teamBar14" class="teamBar" onmouseover="teamBarMouseOver(14)" onmouseout="teamBarMouseOut(14)" onclick="toggleDiv('13', 'dataDiv')">Softball</td>
                    <td id="teamBar15" class="teamBar" onmouseover="teamBarMouseOver(15)" onmouseout="teamBarMouseOut(15)" onclick="toggleDiv('14', 'dataDiv')">Women's Swimming and Diving</td>
                    <td id="teamBar16" class="teamBar" onmouseover="teamBarMouseOver(16)" onmouseout="teamBarMouseOut(16)" onclick="toggleDiv('15', 'dataDiv')">Volleyball</td>
                    <td id="teamBar17" class="teamBar" onmouseover="teamBarMouseOver(17)" onmouseout="teamBarMouseOut(17)" onclick="toggleDiv('16', 'dataDiv')">Women's Water Polo</td>
                </tr>
            </table></font> 
        </div>
      </div>
      <!-- end of two-->
        <nobr><hr color= "black" size = "4"></nobr>
        
        
<!--        <a href="javascript:;" onclick="toggleDiv('mydiv');">Click to Expand</a>-->
<!--        <div id="mydiv" style="display:none"><h3>Popup text<br>How does this look?</h3></div>-->
    
        
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
                      $currteam = 1;
            if (isset($_GET["tm"])) $currteam = $_GET["tm"];

                    $con = new mysqli($server,$username,$password, $dbname);
          
                  if (mysqli_connect_errno() ){
                      echo "Couldnt connect ".mysql_connect_error();
                  }


                  $sports = $con->query("select sportID from sports");
                  $sports->data_seek(intval($currteam));
                  $row = $sports->fetch_row();

                  $res = $con->query("select Opponent, date, status from schedule where sportID = '".$row[0]. "'");
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
                        $currteam = 1;
                        if (isset($_GET["tm"])) $currteam = $_GET["tm"];

                        $con = new mysqli($server,$username,$password, $dbname);
          
                        if (mysqli_connect_errno() ){
                          echo "Couldnt connect ".mysql_connect_error();
                        }

                         $query = "select athletes.`AthleteID`,first_name, last_name from athletesports  
                           join athletes on athletesports.athID = athletes.`AthleteID`where athletesports.sportID like '";

                         $sports = $con->query("select sportID from sports");
                         $sports->data_seek(intval($currteam));
                         $row = $sports->fetch_row();

                         $res = $con->query($query.$row[0]. "'");
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
        $currteam = 1;
        if (isset($_GET["tm"])) $currteam = $_GET["tm"];

        $con = new mysqli($server,$username,$password, $dbname);
          
        if (mysqli_connect_errno() ){
          echo "Couldnt connect ".mysql_connect_error();
        }

        $sports = $con->query("select sportID from sports");
        $sports->data_seek(intval($currteam));
        $row = $sports->fetch_row();

        $res = $con->query("select * from stats where sportID like '".$row[0]."'");
        $row2 = $res->fetch_row();
        printf("With %s number of games there were %s Away wins, 
        %s Home Wins and a Win/Loss Percentage of %s", $row2[2],$row2[4],$row2[5],$row2[1])


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
