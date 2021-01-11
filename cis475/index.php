<?php
    require_once "vars.php";
    require_once "functions.php";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="<?php printKeywords($metaKeywords); ?>">
    <?php printMetaTags($metaTags); ?>
    <?php echo "<title>$title</title>"?>
</head>
<body>
<!--WARNING -->
<!--Starting main container div, do not insert html / php above this line!-->
<div class="main_container">

    <!--Main navbar-->
    <div class="header">
        <div class="navbar">
            <ul class="navlist">
                <li class="navitem"><a href="../index.php">HOME</a></li>
                <li class="navitem"><a href="../aboutme.php">ABOUT ME</a></li>
                <li class="navitem"><a href="../assignments.php">ASSIGNMENTS</a></li>
                <li class="navitem"><a href="../contact.php">CONTACT</a></li>
            </ul>
        </div>
    </div>
    <!--End main navbar div-->

    <!--Main body content div-->
    <div class="body">
        <?php echo "<h1 class='introtext'>$pageName</h1>"; ?>
        <?php echo "<h3>Server Software</h3>" . $serverSoftware; ?>
        <h4 class="paragraph_head">Brief Info</h4>
        <p>Hello, my name is Matt Wright.</p>
        <p>I am currently an undergraduate enrolled in the Computer Information Systems
        program at Buffalo State College. Some of my interests are writing, computers
        and programming languages among others.</p>
        <p>If you would like to contact me, please feel free to click the 'CONTACT'
        navigation link up top to get in touch.</p>
        <p>This page is a landing page for the assignments for the CIS475 Web
        Programming II course. Below you will find links to all of the assignments
        in the course so far, but if the link is not active then I have not made the
        assignment ready to view.</p>
        <h4>Thanks,<br>Matt.</h4>
        <hr>
        <?php printAssignments($assignments); ?>
        <br>
    </div>
    <!--End main body content div-->

    <!--Footer div / navigation-->
    <div class="footer">
        <footer><p>&copy; Matt Wright - 2019</p><div id="dateTime"><?php printDateTime(); ?></div></footer>
    </div>
    <!--End Footer / navigation div-->
</div>
<!--WARNING -->
<!--Ending main container div, do not insert html / php below this line!-->
</body>
</html>