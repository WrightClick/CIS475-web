<?php
require_once "vars.php";
require_once "functions.php";
require_once "db_functions.php";
$pageName = "PHP MySQL Table";
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
        <h4 class="paragraph_head"></h4>
        <p>This page will create a table to display with records from a database, using the row number
        to determine if the row is odd or even.</p>
        <h4>Thanks,<br>Matt.</h4>
        <hr>
        <?php
            $mysqli_conn = dbConnect();
            dbSelectToHTMLTable($mysqli_conn);
            $mysqli_conn -> close();
        ?>
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