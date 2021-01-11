<?php
require_once "vars.php";
require_once "functions.php";
$pageName = "Thanks";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="<?php printKeywords($metaKeywords); ?>">
    <?php printMetaTags($metaTags); ?>
    <?php echo "<title>$pageName</title>"?>
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
        <?php echo "<h1 class='introtext'>$pageName</h1>"; ?>
        <h4 class="paragraph_head"></h4>
        <h3>Thanks for submitting contact info! Please follow the links below to go back.</h3>
        <hr>
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