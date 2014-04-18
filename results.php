<html>
    <head>
        <title>Gael Report</title>
        <meta name='viewport' content='minimum-scale=0.98; maximum-scale=5;  initial-scale=0.98; user-scalable=no; width=1024'>
        
        <link rel="stylesheet" type="text/css" href="gaelStyles.css">
        <style>
            body {background-color:  maroon;}
            table,th,td{
                border: 2px solid gold;
            }
        </style>
        
        

    </head>
    
    <body>
        <div id="TitleBar">
            <b>The Gael Report SportsPage </b>
        </div>
      <div id="menuBar">
            <div id="home button">
            <a href="gaelHomePage.php"><button type="button" style="float:left" >Home</button></a>
            <a href="signin.html"><button type="button" style="float:right">Sign in/Signup</button></a>
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
            </div>
        <?php 
            include("databaseDetails.inc");

            $con = mysqli_connect($server,$username,$password, $dbname);

            if (mysqli_connect_errno() ){
                echo "Couldnt connect ".mysql_connect_error();
            }
            $result = $_GET['result'];
            $searchBy = $_GET['searchBy'];
            
                $athletes = mysqli_query($con,"select * FROM athletes join majors join athletesports join sports on athletes.AthleteID = majors.athID and athletes.AthleteID = athletesports.athID and sports.sportID = athletesports.sportID and ".$searchBy." LIKE '".$result."'");
        echo"<div id='results'>";
        echo "<table>
            <tr><th>Name</th><th>Sport</th></tr>";
        while($row = mysqli_fetch_array($athletes))
        {
            echo "<tr>";
            echo "<td><a href='athletebio.php?Last_Name=". $row['Last_Name'] ."&first_name=".$row['First_Name']."&Sport=".$row['sportID']."'>". $row['First_Name'] ."". 
            $row['Last_Name'] . "</a></td>";
            echo "<td>" . $row['Sport_Name'] . "</td>";
            echo "</tr>";
            
  }
echo "</table>";
echo "</div>";
        ?>
    <a href="athletebio.php"></a>
    </body>
</html>
