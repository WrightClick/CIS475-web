<?php
require_once "vars.php";
require_once "functions.php";
require_once "db_functions.php";
require_once "mysqli_vars.php";
$pageTitle = "Create / Pop";
$pageName = "MySQL Months";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="<?php printKeywords($metaKeywords); ?>">
    <?php printMetaTags($metaTags); ?>
    <?php echo "<title>$pageName</title>" ?>
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
        <h4 class="paragraph_head">monthsTable</h4>
        <p>This PHP page will create / drop a table from a database upon clicking the button below. The table contains records
            of the months of the year.</p>
        <h4>Thanks,<br>Matt.</h4>
        <hr>

        <img class="screenshots" src="../images/monthsTable.jpg" alt="Table of months from a database" width="600" height="1000">

        <form id="submitForm" name="submitForm" method="POST" action="">
            <input type="submit" id="submit" name="submit" />
        </form>
        <br>
        <h3>Click the above button to create / drop table!</h3>
        <br>
        <?php
        // check to see if the form was submitted
        if (isset($_POST['submit'])) {
            $mysqli_conn = dbConnect();
            dbCreate($mysqli_conn);
            dbInsertFileRecords($mysqli_conn, "cis475_io.txt");
        }
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