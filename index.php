<?php
    require_once "cis475/vars.php";
    require_once "cis475/functions.php";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="About, Me, Buffalo, State, College, Buffalo State College, School, University, SUNY, Server, Web, Development, HTML, CSS, Javascript, Styles, Homepage, Home, Page, HTML5, CSS3">
	<meta name="author" content="Matthew Wright">
	<meta name="generator" content="Visual Studio Code">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>Homepage</title>
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
            <h1 class="introtext">Hello, My name is Matthew Wright.</h1>
            <img id="profilepicture" src="images/profilepicture.jpg" alt="Profile Picture">
            <h3 class="introtext">I'm thankful you are here. Let me take the opportunity to tell you a little about myself.</h3>
            <hr><br>
                <h4>Brief Info</h4>
                <h4 class="paragraph_head">Educational Background</h4>
                <p>
                    I graduated from Niagara County Community College with an Associates in Science for
                    Digital Media with a focus on Web Production. This means that I have taken courses related to web design, writing for the media, photography, social media management and more.
                </p>
                <p>
                    Here at Buffalo State, I am enrolled in the Computer Information Systems program and will graduate after the Fall 2019 semester with a Bachelors degree. After this, my plan is to go on and pursue a Masters degree in Data Science following the program here at Buffalo State. In the mean time I may look for a job to take advantage of the Bachelors degree, or I may continue to work in my current job while continuing directly from graduation.
                </p>
                <h4 class="paragraph_head">Personal Interests</h4>
                <p>
                    Some of my personal interests are writing, various computer things such as programming and related fields. I also enjoy learning different things such as stenography, penmanship and what not. Not the most exciting things for most, but I enjoy it myself.
                </p>
                <h4 class="paragraph_head">Thanks</h4>
                <p>
                    Thanks for reading, and I hope you enjoy the rest of the sites content. Please use the navigation at the top of the page to move through the different pages I have made and view their content. On longer pages the navigation bar will also be present at the bottom of the page.
                </p>
            <br><br>
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