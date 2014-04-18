<html>
    <head>
        <title>Gael Report</title>
        <meta name='viewport' content="minimum-scale=.98; maximum-scale=5; initial-scale=.98; user-scalable=no; width=1024">
        
        <link rel="stylesheet" type="text/css" href="gaelStyles.css">
        <style>
            body {background-color:  maroon;}
            table,th,{
                border: 2px solid gold;
            }
        </style>
    </head>
    <body>
        <div id="TitleBar">
            <b>The Gael Report </b>
        </div>
<div id="menuBar">
            <a href="gaelHomePage.php"><button type="button" style="float:left" >Home</button></a>
            <a href="signin.html"><button type="button" style="float:right">Sign in/Signup</button></a>
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
            $Lname = $_GET['Last_Name'];
            $Fname = $_GET['first_name'];
            $sport = $_GET['Sport'];


            $athletes = $con->query("select * FROM athletes join majors natural join athletesports natural join sports on athletes.AthleteID = majors.athID and athletes.AthleteID =athletesports.athID and sports.sportID = athletesports.sportID 
                where First_Name like'".$Fname."' and Last_Name like'".$Lname."' and sportID like '".$sport."'");
            $athlete = mysqli_fetch_array($athletes);
        echo"    <div id='athleteBio'>\n";
        echo"    <h2>".$athlete['First_Name']." ".$athlete['Last_Name']."<a href='gaelHomePage.php'style='float:right'><button type='button'>".$athlete['Sport_Name']."</button></a></h2>\n";
        echo"   <table style='Border-color:black; color:white; width:400'>\n";
        echo"       </tr><td id='title'><b>Year: </b>".$athlete['Year']."</td>\n";
        echo"        </tr><td id='title'><b>High School: </b>".$athlete['High_School']."</td>\n";
        echo"        <tr><td id='title'><b>Hometown: </b>".$athlete['City']." ".$athlete['State_Country']."</td>\n";
        echo"        <tr><td id='title'><b>Height: </b>".$athlete['Height']."</td>\n";
        echo"        </tr>\n";
        echo"        </tr>\n";
        echo"        <tr><td id='title'><b>Major:</b>".$athlete['Major']."</td>\n";
        echo"       </tr>\n";
        echo"    </table>\n";
        echo"    <a href=''><button type='button'>track athlete</button></a>\n";
        echo"</div>\n";
        ?>
    </body>
</html>