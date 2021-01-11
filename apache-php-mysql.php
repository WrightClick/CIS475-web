<?php
    require_once "cis475/vars.php";
    require_once "cis475/functions.php";
?>
<!--
 Assignment: Apache MySQL PHP Page
 Author: Matt Wright
 Editor: Visual Studio Code
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Apache, MySQL, WAMP, MAMP, Google, Server, Webpage, Website, Assignment">
	<meta name="author" content="Matthew Wright">
	<meta name="generator" content="Visual Studio Code">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>MAMP Setup</title>
</head>
<body>
    <!--WARNING -->
    <!--Starting main container div, do not insert html / php above this line!-->
    <div class="main_container">

        <!--Main navbar-->
        <div class="header">
            <div class="navbar">
                <ul class="navlist">
                    <li class="navitem"><a href="index.php">HOME</a></li>
                    <li class="navitem"><a href="aboutme.php">ABOUT ME</a></li>
                    <li class="navitem"><a href="assignments.php">ASSIGNMENTS</a></li>
                    <li class="navitem"><a href="contact.php">CONTACT</a></li>
                </ul>
            </div>
        </div>
        <!--End main navbar div-->

        <!--Main body content div-->
        <div class="body">
            <h1 class="introtext">MAMP Start Page</h1>
            <img src="server-screenshots/start_page.jpg" alt="MAMP Start page" class="screenshots">
            <h1 class="introtext">MAMP MySQL Server</h1>
            <img class="screenshots" src="server-screenshots/phpMyAdmin-SQL.jpg" alt="MySQL Server Setup">
            <h1 class="introtext">phpMyAdmin Page</h1>
            <img src="server-screenshots/phpMyAdmin.jpg" alt="phpMyAdmin Page Setup" class="screenshots">
            <h1 class="introtext">phpinfo.php Page</h1>
            <img src="server-screenshots/phpinfo.jpg" alt="php info page" class="screenshots">
            <br><br><br><br><br><br>
        </div>
        <!--End main body content div-->
        
        <!--Footer div / navigation-->
        <div class="footer">
            <footer>
                <p>&copy; Matt Wright - 2019</p><div id="dateTime"><?php printDateTime(); ?></div>
            </footer>
        </div>
        <!--End Footer / navigation div-->
    </div>
    <!--WARNING -->
    <!--Ending main container div, do not insert html / php below this line!-->
</body>
</html>