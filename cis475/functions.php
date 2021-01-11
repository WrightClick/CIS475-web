<?php

include "/home/bsclogon.buffalostate.edu/wrightm02/public_html/cis475/ODBuffalo_vars.php";


//Prints out the array of keywords
function printKeywords($metaKeywords) {
    foreach ($metaKeywords as $keyword) {
        echo $keyword . ", ";
    }
}

//Prints out the date and time
function printDateTime() {
    echo date('m \/ d \/ Y');
    echo " --- ";
    echo date('g \: i A');
}

//Prints out the array of assignments
function printAssignments($assignments) {
    echo "<p>";
    echo "<ol>";
    foreach ($assignments as $assignment) {
        echo "<li class='assignment'>" . $assignment ;
    }
    echo "</ol>";
}

//Prints out the standard meta tags
function printMetaTags($metaTags) {
    foreach ($metaTags as $metaTag) {
        print($metaTag);
    }
}

//called in download.php to read a file path passed to the page and download it
function downloadFile($file) {
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}

function readFileToTable($filePath) {

    //----------------------------------------------------
    //BEGIN READING FROM EXTERNAL FILE

    //Checks if the file exists, creates a list of vars seperated by  explode and a delim
    //then echos the variables in the table
    if (is_file($filePath)) {
        echo "<br>";

        $months = file($filePath);
        $monthArr = [];

        //load array two dimensionally using exploded list, one dimension at a time with three vars each.
        foreach ($months as $row) {
            list($num, $monthName, $days) = explode(",", $row);
            $monthArr[] = array($num, $monthName, $days);
        }

        //prints the first row of the table
        echo "<table><tr class='tableHead'><td>Number</tr><td>Month</tr><td>Days</tr></tr>";

        //starts a count to check for even rows, and prints out the array using foreach
        $count = 1;
        //$i = 0;
        for ($i = 0; $i < sizeof($monthArr); $i++) {
            if ($count % 2 == 0)
                 vprintf("<tr class='evenRow'><td>%s</tr><td>%s</tr><td>%s</tr></tr>", $monthArr[$i]);
            else vprintf("<tr><td>%s</tr><td>%s</tr><td>%s</tr></tr>", $monthArr[$i]);
            $count++;
            //$i++;
        }

        //if file doesnt exist warn user and exit function
    } else {
        echo "<h2>File could not be opened! Please check the file specified and ensure it is in its location!</h2>";
    }

    //closes table
    echo "</table>";
    echo "<br>";

}

function writeReversed($writePath, $readPath) {

    //Checks if the file to read from exists and if not don't run
    if (file_exists($readPath)) {
        //Checks if the file already exists before trying to open and write
        if (file_exists($writePath)) {
            echo "<h3>The file already exists!</h3>";
        } else {

            //Opens the file for writing, reads in the original file and creates an array
            $writeFile = fopen($writePath, "w+");
            $months = file($readPath);
            $monthArr = [];

            //Loads the normal array with one line / record per element
            foreach ($months as $record) {
                $monthArr[] = $record;
            }

            //Reverses the array
            $reversed = array_reverse($monthArr);

            //$setFirstLine will add a newline between the first and second record (fwrite wont add it) using if check.
            //The reversed array loops through each record and writes it to the file.
            $setFirstLine = true;
            foreach ($reversed as $record) {
                if ($setFirstLine) {
                    fwrite($writeFile, $record."\n");
                    $setFirstLine = false;
                } else fwrite($writeFile, $record);
            }

            //Checks that the written file is present
            if (file_exists($writePath)) {
                echo "<h3>File written successfully!</h3>";
                fclose($writeFile);
            }

        }
    } else echo "<h3>The original file 'cis475_io.txt' is not present! file <br> File not written!</h3>";
}

function checkContactFormSubmission() {
    global $firstName, $lastName, $address, $city, $state, $zip, $phone, $email, $comments, $contactDate;

    if (isset($_POST['submit'])) {
        if (isset($_POST['firstname'])) {
            $firstName = addslashes($_POST['firstname']);
        }
        if (isset($_POST['lastname'])) {
            $lastName = addslashes($_POST['lastname']);
        }
        if (isset($_POST['address'])) {
            $address = addslashes($_POST['address']);
        }
        if (isset($_POST['city'])) {
            $city = addslashes($_POST['city']);
        }
        if (isset($_POST['state'])) {
            $state = addslashes($_POST['state']);
        }
        if (isset($_POST['zip'])) {
            if (strlen($_POST['zip']) == 5 || strlen($_POST['zip']) == 9) {
                $zip = addslashes($_POST['zip']);
            } else  {
                echo "<h4 style='color: lightcoral'>Please enter a valid zipcode!</h4>";
                echo "<script type='text/javascript'>document.getElementById('zip').focus();</script>";
            }
        }
        if (isset($_POST['phone'])) {
            if (filter_var($_POST['phone'], FILTER_VALIDATE_INT)) {
                if (strlen($_POST['phone']) == 10) {
                    $phone = addslashes($_POST['phone']);
                } else {
                    echo "<h4 style='color: lightcoral'>Please enter a valid 10-digit phone number!</h4>";
                    echo "<script type='text/javascript'>document.getElementById('phone').focus();</script>";
                }
            }
        }
        if (isset($_POST['email'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = addslashes($_POST['email']);
            } else {
                echo "<h4 style='color: lightcoral'>Please enter a valid email!</h4>";
                echo "<script type='text/javascript'>document.getElementById('email').focus();</script>";
            }
        }
        if (isset($_POST['comments'])) {
            $comments = addslashes($_POST['comments']);
        }
        $contactDate = date('Y/m/d');

    }

}

function printSocrataRowsToTable($query_set) {

    if (sizeof($query_set) == 0) {
        echo "<h2>No results!</h2>";
        exit();
    }

    //Reference variables
    /*
     *      $num = "";
            $date = "";
            $time = "";
            $desc = "";
            $fine = "";
            $addr = "";
            $street = "";
            $full_addr = "";
            $city = "";
     */

    $tableHeads = [];
    $count = 1;

    /*
     * Adds all of the column headers in an easier to read format by referencing the proper
     * column names rather than the databases. If the variable is set then a string that would echo
     * a table head is added to an array for later output before outputting the data set returned.
     */
    if (empty($query_set[0]["summno"])) {
        if (!empty($query_set[3]["summno"])) {
            $tableHeads[] = "<td>Num.</td>";
        }
    } else if (!empty($query_set[0]["summno"])) $tableHeads[] = "<td>Num.</td>";

    if (empty($query_set[0]["summdt"])) {
        if (!empty($query_set[3]["summdt"])) {
            $tableHeads[] = "<td>Date</td>";
        }
    } else if (!empty($query_set[0]["summdt"])) $tableHeads[] = "<td>Date</td>";

    if (empty($query_set[0]["viotime"])) {
        if (!empty($query_set[3]["viotime"])) {
            $tableHeads[] = "<td>Time</td>";
        }
    } else if (!empty($query_set[0]["viotime"])) $tableHeads[] = "<td>Time</td>";

    if (empty($query_set[0]["viodesc"])) {
        if (!empty($query_set[3]["viodesc"])) {
            $tableHeads[] = "<td>Desc.</td>";
        }
    } else if (!empty($query_set[0]["viodesc"])) $tableHeads[] = "<td>Desc.</td>";

    if (empty($query_set[0]["origfine"])) {
        if (!empty($query_set[3]["origfine"])) {
            $tableHeads[] = "<td>Fine</td>";
        }
    } else if (!empty($query_set[0]["origfine"])) $tableHeads[] = "<td>Fine</td>";

    if (empty($query_set[0]["violation_full_address"])) {
        if (!empty($query_set[3]["violation_full_address"])) {
            $tableHeads[] = "<td>Addr.</td>";
        }
    } else if (!empty($query_set[0]["violation_full_address"])) $tableHeads[] = "<td>Addr.</td>";


    //Starts the table with the header row, and outputs the headers created above in the series of if's
    echo "<table><tr class='tableHead'>";
    foreach ($tableHeads as $head) {
        echo $head;
    }
    echo "</tr>";

    //Main loop that loops through each main array (each element of this array is a subarray of the result fields from
    //the data set
    for ($row = 0; $row < sizeof($query_set); $row++) {

        //If the row number is even then use custom styles when outputting table row start
        //otherwise use normal.
        if ($count % 2 == 0) {
            echo "<tr class='evenRow'>";
        } else echo "<tr>";

        //Keeps track of the row number for the table
        $count++;

        $result_row = $query_set[$row];

        //Loops through the array elements for each result row and prints out the column data for the table
        foreach ($result_row as $field) {

            //Check if the field resembles the summdt column data, and cut the string size down as time is not reported
            //to the database field, resulting in extra space taken up as "00:00:000" rather than an actual time.
            if (preg_match("(\d{4}-\d{2}-\d{2})", $field)) {
                $field = substr($field, 0, -13);
            }

            echo "<td>" . $field . "</td>";
        }

        //closes table row
        echo "</tr>";

    } //End outer for to loop through main array elements (the array of results)

}

?>