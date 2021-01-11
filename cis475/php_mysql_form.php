<?php
/*
 * This and sc.php use a PHP session to hold onto the form data across the two pages as the
 * user gets redirected back and forth when _POST'ing the form data. The next PHP line will
 * start the session provided to them, allowing access to the form data that is saved into
 * _SESSION via sc.php when the form data becomes validated.
 */
session_start();

require_once "vars.php";
require_once "functions.php";
require_once "db_functions.php";
$pageName = "MySQL Form";
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
        <p>This page will take input from the user from a form and insert it into a database if all of
            the input is valid constraining to the standards for the input type.</p>
        <h4>Thanks,<br>Matt.</h4>
        <hr>
        <br>


        <?php

        /*
         * Connects to the database and creates the table.
         * Then, it checks to see if the page's request method is _GET (meaning you were redirected
         * from the sc.php processing page.
         *
         * If true, and the submit field is not empty, each of the
         * fields that are required in sc.php will append a _GET variable with either a "true" if the
         * verification was fine or "false" if it failed verification.
         *
         * After all of the _GET variables are set using header() and a custom url, this series of if's
         * will check for all of the required fields and determine if they failed verification. If they did,
         * they set a variable that houses a script to alert the user, outputs and clears the _SESSION
         * variable that houses the form data.
         *
         * The purpose is to hold form data until all of it verifys, alerting the user to which inputs
         * did not.
         */

        $mysqli_conn = dbConnect();
        dbCreateContactsTable($mysqli_conn);
        echo "<br>";

        if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['submit'])) {

            if (!empty($_GET['fn']) && $_GET['fn'] == "false") {
                echo "<h3 class='form_warning'>Please enter a first name!</h3>";
                $badNameScript = "<script type='text/javascript'>document.getElementById('firstname').style.border = 'thin solid red';</script>";
                $_SESSION['firstname'] = "";
            }
            if (!empty($_GET['ln']) && $_GET['ln'] == "false") {
                echo "<h3 class='form_warning'>Please enter a last name!</h3>";
                $badLNameScript = "<script type='text/javascript'>document.getElementById('lastname').style.border = 'thin solid red';</script>";
                $_SESSION['lastname'] = "";
            }
            if (!empty($_GET['eml']) && $_GET['eml'] == "false") {
                echo "<h3 class='form_warning'>Please enter an valid email!</h3>";
                $badEmailScript = "<script type='text/javascript'>document.getElementById('email').style.border = 'thin solid red';</script>";
                $_SESSION['email'] = "";
            }
            if (!empty($_GET['phn']) && $_GET['phn'] == "false") {
                echo "<h3 class='form_warning'>Please enter a valid phone number!</h3>";
                $badPhoneScript = "<script type='text/javascript'>document.getElementById('phone').style.border = 'thin solid red';</script>";
                $_SESSION['phone'] = "";
            }
            if (!empty($_GET['zip']) && $_GET['zip'] == "false") {
                echo "<h3 class='form_warning'>Please enter a valid zip code! (5 / 9 digits)</h3>";
                $badZipScript = "<script type='text/javascript'>document.getElementById('zip').style.border = 'thin solid red';</script>";
                $_SESSION['zip'] = "";
            }
        }

        //If all fields did not fail validation, the sc.php page pases insert=true with a header redirect, otherwise
        //it passes a header redirect with the failed form codes as noted above.
        if (!empty($_GET['insert']) && $_GET['insert'] == "true") {



            $query =
                "INSERT INTO contacts (FirstName, LastName, Address, City, State, Zip, Phone, Email, Comments, contactDate)" .
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $statement = $mysqli_conn -> stmt_init();
            $statement -> prepare($query);

            $statement -> bind_param('ssssssssss',
                $_SESSION['firstname'],
                $_SESSION['lastname'],
                $_SESSION['address'],
                $_SESSION['city'],
                $_SESSION['state'],
                $_SESSION['zip'],
                $_SESSION['phone'],
                $_SESSION['email'],
                $_SESSION['comments'],
                $_SESSION['contactdate']);

            echo $mysqli_conn -> error;
            $statement -> execute();

            $_SESSION = array();
            session_write_close();
            echo "<h3 style='color: green'>Thanks for submitting contact info!</h3>";
        }

        ?>

        <!-- The main form for inputting contact information -->
        <div class="form">
            <form action="sc.php" method="post" novalidate>
                <div class="form_item">
                    <div class="form_label"><p>First name</p></div>
                    <input type="text" name="firstname" id="firstname" class="form_field"
                           value="<?php if (!empty($_SESSION['firstname'])) echo $_SESSION['firstname']; ?>">
                </div>
                <div class="form_item">
                    <div class="form_label"><p>Last name</p></div>
                    <input type="text" name="lastname" id="lastname" class="form_field"
                           value="<?php if (!empty($_SESSION['lastname'])) echo $_SESSION['lastname']; ?>">
                </div>
                <div class="form_item">
                    <div class="form_label"><p>Address</p></div>
                    <input type="text" name="address" id="address" class="form_field"
                           value="<?php if (!empty($_SESSION['address'])) echo $_SESSION['address']; ?>">
                </div>
                <div class="form_item" style="clear: left">
                    <div class="form_label"><p>City</p></div>
                    <input type="text" name="city" id="city" class="form_field"
                           value="<?php if (!empty($_SESSION['city'])) echo $_SESSION['city']; ?>">
                </div>
                <div class="form_item" style="clear: left">
                    <div class="form_label"><p>Zip code</p></div>
                    <input type="text" name="zip" id="zip" class="form_field"
                           value="<?php if (!empty($_SESSION['zip'])) echo $_SESSION['zip']; ?>">
                </div>
                <div class="form_item">
                    <div class="form_label" style="margin-right: 182px"><p>State (Select one)</p></div>
                    <select name="state" id="state"
                            value="<?php if (!empty($_SESSION['state'])) echo $_SESSION['state'] ?>">
                        <option value="" selected="selected">Select a State</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
                <div class="form_item" style="display: inline-block; clear: left; margin-top: 50px">
                    <div class="form_label"><p>Phone</p></div>
                    <input type="text" name="phone" id="phone" class="form_field"
                           value="<?php if (!empty($_SESSION['phone'])) echo $_SESSION['phone']; ?>">
                </div>
                <div class="form_item" style="margin-top: 50px">
                    <div class="form_label"><p>Email</p></div>
                    <input type="text" name="email" id="email" class="form_field"
                           value="<?php if (!empty($_SESSION['email'])) echo $_SESSION['email']; ?>">
                </div>
                <div class="form_item" style="margin-bottom: 50px">
                    <div class="form_label"><p>Comments</p></div>
                    <textarea name="comments" id="comments" cols="69" rows="10"><?php if(!empty($_SESSION['comments'])) echo $_SESSION['comments'];?></textarea>
                </div>
                <div class="form_item">
                    <input type="submit" value="submit" id="submit_btn" style="height: 40px; font-size: 1.1em">
                </div>
            </form>
        </div>

        <!-- Echos out the scripts responsible for highlighting bad fields as determined by above -->
        <?php
            if (!empty($badNameScript))     echo $badNameScript . "<script type='text/javascript'>document.getElementById('firstname').focus();</script>";
            if (!empty($badLNameScript))    echo $badLNameScript . "<script type='text/javascript'>document.getElementById('lastname').focus();</script>";
            if (!empty($bademailScript))    echo $bademailScript . "<script type='text/javascript'>document.getElementById('email').focus();</script>";
            if (!empty($badPhoneScript))    echo $badPhoneScript . "<script type='text/javascript'>document.getElementById('phone').focus();</script>";
            if (!empty($badZipScript))      echo $badZipScript . "<script type='text/javascript'>document.getElementById('zip').focus();</script>";
        ?>

        <img src="../images/form.jpg" alt="Form" class="screenshots" width="700" height="800">
        <br><br><br>
        <img src="../images/formsuccess.jpg" alt="Form" class="screenshots" width="700" height="800">
        <br><br><br>
        <img src="../images/formrs.jpg" alt="Form" class="screenshots">
        <br><br><br>

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

<!--In-page functions start here -->
<?php
$_SESSION = array();
session_write_close();
?>