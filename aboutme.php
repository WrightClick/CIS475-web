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
    <title>About Me</title>
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
        <!--End main navbar-->

        <!--Begin body-->
        <div class="body">
        <h2 class="introtext">About Me</h2>
            <h4 class="paragraph_head">Educational Experience</h4>
            <p>
                I graduated from Niagara Falls High School, and promptly enrolled in the Associates
                of Science degree, Digital Media with focus on Web Production. Throughout the program I took many
                courses, most of which were focused around management of media for the web, and some of them were
                for production of media. Some of these courses were web design, social media management, writing,
                writing specifically for the media, communications classes as well as others for video production and
                photography.
            </p>
            <p>
                After a delay between my educational career at NCCC due to a medical issue, I graduated and began
                pursuing the Bachelors in Science, Computer Information Systems here at Buffalo State College. As
                of September 2019, this is my last semester here for the Bachelors degree. Once I graduate, I will
                begin looking for a job in my degrees  field while I begin the process for Masters degree at Buffalo State, in the Data Science
                program.
            </p>
            <p>
                Of course, the future is untold so anything is possible. At my current rate however I am excited
                for what the future offers. 
            </p>
            <h4 class="paragraph_head">Personal Interests</h4>
            <p>
                When I was young I pretended to make up languages to write, just for the fun and interesting
                look on the page. I never knew the reason why I felt the need to, but I did know that I enjoyed
                it. Conveniently enough, such systems exist but not a different language, just different ways of
                writing the same ones much faster. This is called stenography. Before the invention of typewriters
                (and for some time after) stenographers were individuals trained in stenographic writing of
                various systems picked by the teachers at the time. A common one in the United States was Gregg.
            </p>
            <p>
                Turns out that my childish 'fake language' was a early stage form of interest for writing the 
                same language in a different way. I begin to take interest in these stenography systems, trying
                each out. I have not become skilled in any of them, as they take many years to learn and become 
                an expert in. I did however enjoy my experiences with them.
            </p>
            <p>
                The interest in stenographic systems moved into penmanship in general. Growing up, I
                was never given proper time to learn cursive, and therefore was not able to read or write cursive.
                The embarrassment of not being able to read my grandmothers handwriting on my birthday cards was enough to 
                fuel myself to learn it. Since then I spend time everyday to practice and improve my cursive handwriting 
                with rules and constraints taken from traditional penmanship rules of the early 1900's. When it comes 
                to an enjoyable writing experience, nothing quite beats a well-suited fountain pen. This infectious 
                hobby has costed me entirely too much money, but I have and continue to enjoy every single dollar 
                spent on pens, inks and papers. In the United States, we have devalued our writing experience more than
                any other country. In particular Japan upholds the value of fine writing to this date just about 
                the most of any country.
            </p>
            <p>
                Similar to writing and reading, I have enjoyed computing from my early years. I played 
                computer games in my early ten's, and became interested in the complexity of computers
                thanks to a family member that worked in the field. My interest in learning how a computer works
                grew naturally since then and continues to as I progress through my educational career. some of 
                my enjoyment is held in programming, experiments in learning different programming languages and
            </p>
            <h4 class="paragraph_head">Thanks for Reading</h4>
            <p>
                Thanks for reading if you made it all the way through. If not, thats okay too.
            </p>
            <br>    
            <p>Thanks,</p>
            <p>Matt.</p>
        </div>
        <!--End body-->

        <!--Begin footer-->
        <div class="footer">
            <footer>
                <p>&copy; Matt Wright - 2019</p><div id="dateTime"><?php printDateTime(); ?></div>
            </footer>
        </div>
        <!--End footer-->

    </div>
    <!-- WARNING -->
    <!--Ending main container div, do not insert html / php below this line!-->
 </body>
</html>
