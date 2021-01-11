<?php
/*
 * This and php_mysql_form.php use a PHP session to hold onto the form data across the two pages as the
 * user gets redirected back and forth when _POST'ing the form data. The next PHP line will
 * start the session provided to them, allowing access to the form data that is saved into
 * _SESSION via sc.php when the form data becomes validated.
 */
session_start();

/*
 * This PHP script will take posted data, and check to see if the form it came from was filled in or not.
 * Some data will be filtered and verified it meets constraints.
 *
 * Once the data is valid, a variable is created with the valid data and the valid data is saved into
 * the running _SESSION array so that it can be filled into the form again after a redirect.
 *
 * If any data fails validity checks, a string is appended indicating the data was invalid by sending _GET
 * variables over with the redirect, which are then checked on php_mysql_form.php to determine if any
 * required fields failed verification. An example looks like this:
 *
 *                              "fn=false&"                             <- Indicated failed verification
 *                              $_SESSION['firstname'] = $firstname;    <- Indicated success by storing data
 *
 * Once all data is _POST'ed successfully and verified to be valid, the form data is inserted into a database table.
 */

global $firstName, $lastName, $address, $email, $phone, $city, $state, $zip, $phone, $comments;
$readyToInsert = true;
if($_SERVER['REQUEST_METHOD'] == "POST") {

    //Prepares the string to append to a header redirect
    $headStr = "?submit=true&";

    //Checks if the posted input is not empty, and if it is good, save to a variable, and save to session superglobal.
    if (!empty($_POST['firstname'])) {
        $firstName = addslashes($_POST['firstname']);
        $_SESSION['firstname'] = $firstName;
    } else {
        $readyToInsert = false;
        $headStr = $headStr . "fn=false&";
    }

    //Checks if the posted input is not empty, and if it is good, save to a variable, and save to session superglobal.
    if (!empty($_POST['lastname'])) {
        $lastName = addslashes($_POST['lastname']);
        $_SESSION['lastname'] = $lastName;
    } else {
        $readyToInsert = false;
        $headStr = $headStr . "ln=false&";
    }

    //Checks if the posted input is not empty, and if it is good, save to a variable, and save to session superglobal.
    if (!empty($_POST['address'])) {
        $address = addslashes($_POST['address']);
        $_SESSION['address'] = $address;

    } else {
        $_SESSION['address'] = "";
        $headStr = $headStr . "adr=false&";
    }

    //Checks if the posted input is not empty, and if it is good, save to a variable, and save to session superglobal.
    if (!empty($_POST['city'])) {
        $city = addslashes($_POST['city']);
        $_SESSION['city'] = $city;

    } else {
        $_SESSION['city'] = "";
        $headStr = $headStr . "cty=false&";
    }

    //Checks if the posted input is not empty, and if it is good, save to a variable, and save to session superglobal.
    if (!empty($_POST['state'])) {
        $state = addslashes($_POST['state']);
        $_SESSION['state'] = $state;

    } else {
        $_SESSION['state'] = "";
        $headStr = $headStr . "sta=false&";
    }

    //Checks if the posted input is not empty, and if it is good, save to a variable, and save to session superglobal.
    //The data must meet the condition of being five or nine characters in length.
    if (!empty($_POST['zip'])) {
        if (strlen($_POST['zip']) == 5 || strlen($_POST['zip']) == 9) {
            $zip = addslashes($_POST['zip']);
            $_SESSION['zip'] = $zip;

        } else {
            $readyToInsert = false;
            $headStr = $headStr . "zip=false&";
        }
    } else {
        $readyToInsert = false;
        $headStr = $headStr . "zip=false&";
    }

    //Checks if the posted input is not empty, and if it is good, save to a variable, and save to session superglobal.
    //The data must be an integer, and the length must be ten in length.
    if (!empty($_POST['phone'])) {
        if (filter_var($_POST['phone'], FILTER_VALIDATE_INT)) {
            if (strlen($_POST['phone']) == 10) {
                $phone = addslashes($_POST['phone']);
                $_SESSION['phone'] = $phone;

            } else {
                $readyToInsert = false;
                $headStr = $headStr . "phn=false&";
            }
        } else {
            $readyToInsert = false;
            $headStr = $headStr . "phn=false&";
        }
    } else {
        $readyToInsert = false;
        $headStr = $headStr . "phn=false&";
    }

    //Checks if the posted input is not empty, and if it is good, save to a variable, and save to session superglobal.
    //The data must meet the filter requirements of a valid email address.
    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = addslashes($_POST['email']);
            $_SESSION['email'] = $email;

        } else {
            $readyToInsert = false;
            $headStr = $headStr . "eml=false&";
        }
    } else if ($_POST['email'] == ""){
        $readyToInsert = false;
        $headStr = $headStr . "eml=false&";
    }

    //Checks if the posted input is not empty, and if it is good, save to a variable, and save to session superglobal.
    if (!empty($_POST['comments'])) {
        $comments = addslashes($_POST['comments']);
        $_SESSION['comments'] = $comments;
    } else {
        $_SESSION['comments'] = "";
        $headStr = $headStr . "cmt=false&";
    }

    //Sets the contact date.

    $contactDate = date('Y/m/d');
    $_SESSION['contactdate'] = $contactDate;

    if ($readyToInsert) {
        header("Location: http://bscacad3.buffalostate.edu/~wrightm02/cis475/php_mysql_form.php?insert=true");
    } else header("Location: http://bscacad3.buffalostate.edu/~wrightm02/cis475/php_mysql_form.php" .
        $headStr);

} else echo "No submission!";