<?php
require_once "vars.php";
require_once "functions.php";
$pageName = "File IO Page";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="">
    <meta name="author" content="Matthew Wright">
    <meta name="generator" content="Visual Studio Code">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <?php echo "<title>$pageName</title>"; ?>
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
        <h4 class="paragraph_head">Assignment Description</h4>
        <p>This page uses a PHP function to read a file and output its contents in a table.</p>
        <p>The file is read line by line, with each record being seperated by the delimiter
        using PHP's 'explode()' function. It returns an array to a list that stores each array element
        into the list, and then the lists vars are added into a two dimension array to store them.</p>
        <p>The number of rows is counted and even rows are highlighted. As this is done, the row is printed using
        'vprintf' by passing it the array element (containing the second dimension elements).</p>
        <p>A function then writes the reversed order to a file named
        'cis475_ior.txt'.</p>
        <h4>Thanks,<br>Matt.</h4>
        <hr>

        <!--Outputs the two tables from the file -->
        <h3>Regular Order</h3>
        <div class="tableOutput">
            <?php readFileToTable("cis475_io.txt"); ?>
        </div>
        <br>
        <h3>Reversed order (Written to cis475_ioreversed.txt)</h3>
        <?php writeReversed("cis475_ior.txt", "cis475_io.txt"); ?>
        <br>

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