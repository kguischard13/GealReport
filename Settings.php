<html>
    <head>
        <title>Gael Report</title>
        <meta name='viewport' content="minimum-scale=.98; maximum-scale=5; initial-scale=.98; user-scalable=no; width=1024">
        
        <link rel="stylesheet" type="text/css" href="CSS/gaelStyles.css">
        <style>
            body {background-color:  maroon;}
            table,th,{
                border: 2px solid gold;
            }
        </style>
    </head>
    <body>
        <div id="TitleBar">
            <b>The Gael Report Homepage </b>
        </div>
        <div id="menuBar">
            <div id="home button" style="float:left">
                <a href="gaelHomePage.php"><button type="button">Home</button></a>
            </div>
            <div id="home button" style='float: right'>
            <a href="signin.php"><button type="button" >Sign In/Sign Up</button></a>
            </div>
            <div align= "center" id='search'>
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
            
        
        <div id="athleteCustom">
            <form>Kester<input type="checkbox"></form>
            <form>Evan<input type="checkbox"></form>
            <form>John<input type="checkbox"></form>
            <button type="submit" style="float:right">delete selected</button>
        </div>
        <div id="sportCustom">
            <form>Men's Basketball<input type="checkbox"></form>
            <form>Women's Basketball<input type="checkbox"></form>
            <form>Baseball<input type="checkbox"></form>
            <form>Softball<input type="checkbox"></form>
            <button type="submit" style="float:right">delete selected</button>
        </div>
            <div id="userSettings">                        
                Username: <input type="text" name="username"><br>
                Email:<input type="email" name="email"><br>
                First Name: <input type="text" name="First Name"><br>
                Last Name: <input type="text" name="Last Name"><br>
                <button type="submit" id="signButton">Change</button></div>
    </body>
</html>