<?php
    require_once "cis475/vars.php";
    require_once "cis475/functions.php";
    $pageTitle = "Assignments";
?>
<!--
 Assignment: Homepage
 Author: Matt Wright
 Date: 08/27/2019
 Editor: Visual Studio Code
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="<?php printKeywords($metaKeywords); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="About, Me, Buffalo, State, College, Buffalo State College, School, University, SUNY, Server, Web, Development, HTML, CSS, Javascript, Styles, Homepage, Home, Page, HTML5, CSS3">
    <meta name="author" content="Matthew Wright">
    <meta name="generator" content="Visual Studio Code">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="assignments.js"></script>
    <?php echo "<title>$pageTitle</title>"; ?>
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
            <p><script>printTime();</script></p>
            <h1>Assignments</h1>
            <h2>If assignments / links do not appear, refresh your browsers cache as some browsers will use a cached .js
                file instead from the last time the page was visited instead of an updated one!</h2>
            <p><script>printAssignments()</script></p>
            <br><br>
        </div>
        <!--End main content div-->

        <!--Footer div / navigation-->
        <div class="footer">
            <footer>
                <p>&copy; Matt Wright - 2019</p><div id="dateTime"><?php printDateTime(); ?></div>
            </footer>
        </div>
        <!--End Footer / navigation div-->

    </div>
    <!--WARNING -->
    <!--End main container div, do not insert html / php below this line!-->
</body>
</html>