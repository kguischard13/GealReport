<?php
    include "databaseDetails.inc";

    session_start();

    if(isset($_POST['email']) && isset($_POST['pass'])  ){
        $email = $_POST['email'];
        $pass  = $_POST['pass'];

        $con = new mysqli($server,$username,$password, $dbname);
        if (mysqli_connect_errno() ){echo "Couldnt connect ".mysql_connect_error();}

        $email = $con->real_escape_string($email);
        $pass = $con->real_escape_string($pass);

        $res = $con->query("select * from Users where Email= '".$email."' and
            Password= '".sha1($pass)."'");

        if ($res->num_rows) {
            $row = $res->fetch_assoc();
            $_SESSION['UserId'] = $row['UserId'];
        }

        $con->close();
    }


    if (isset($_SESSION['UserId'])) {
                header("Location: UserHomePage.php");
    }
    else{
        if ($email != "") {
                    echo "<span style='color:red;'>LOGIN FAILURE: ".$email." is not an authorized user.</span><br>\n";
        
                }
                else{
                    echo "";
                }
            }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gael Report</title>
        <meta name='viewport' content="minimum-scale=.98; maximum-scale=5; initial-scale=.98; user-scalable=no; width=1024">
        
        <link rel="stylesheet" type="text/css" href="CSS/gaelStyles.css">
        <style>
            body {background-color:  maroon;}
            table,th,td{
                background-color: black;
                border: 1px solid gold;
            }
        </style>
    </head>
    <body>

        <?php

        ?>
        <div id="TitleBar">
            <b>The Gael Report</b>
        </div>
        <div id="menuBar">
            <div id="home button">
                <a href="gaelHomePage.php"><button type="button" style="float:left" >Home</button></a>
            <a href="signin.php"><button type="button" style="float:right">Sign in/Signup</button></a>
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
            <table id="signUp" style="width:750px" align= "center">
                <tr><td><h3 align= "center">Sign in</h3></td>
                    <td><h3 align= "center">Sign up</h3></td>
                </tr>
                <tr>
                <td>
                    <form method = 'POST' action='signin.php'>
                        Email: <input type="text" name="email"><br>
                        Password: <input type="password" name="pass"><br>
                        <button type="submit" id="signButton">Sign In</button>
                    </form>
                    </td>
                <td >
                    <form method='POST' action='addnewuser.php'>
                        Email:<input type="email" name="email"><br>
                        First Name: <input type="text" name="fname"><br>
                        Last Name: <input type="text" name="lname"><br>
                        Password: <input type="password" name="pass1"><br>
                        Confirm Password: <input type="password" name="pass2"><br>
                        
                        <button type="submit" id="signButton">sign up</button>
                    </form></td>		
                </tr>
                
            </table>
    </body>
</html>