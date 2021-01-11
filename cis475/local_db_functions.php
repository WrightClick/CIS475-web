<?php
//include "vars.php";
include "localdb_vars.php";
/**
 * Creates a new database connection using MySQLi, and if successful, returns the object.
 * @return mysqli - object for the database connection
 */
function dbConnectLocal() {

    //Include the variables containing the database login information
    global $dbLocalServer, $dbLocalPassword, $dbLocalUsername, $dbLocalName;

    //Create the variable for the object and enable error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    //Create new connection, and if an error occurred echo it out
    $mysqli_conn = new mysqli($dbLocalServer, $dbLocalUsername, $dbLocalPassword, $dbLocalName);
    if ($mysqli_conn -> connect_error) {
        echo $mysqli_conn -> connect_error;
    }
    var_dump($mysqli_conn);
    return $mysqli_conn;
}

/**
 * Creates a object for the database, and selects the database to work with.
 * Then drops a table if existing, and creates it if not. Echo's the result of the table creation.
 * @param $mysqli_conn - object for the database connection
 * @return bool|mysqli_result - True if the query was executed successfully and alert user
 */
function dbCreate($mysqli_conn) {

    //Drop the monthsTable table if it already exists and execute query
    $query = "DROP TABLE IF EXISTS monthsTable";
    $mysqli_conn -> query($query);

    //Create the monthsTable and execute query
    $query = "CREATE TABLE monthsTable (monthsID INT PRIMARY KEY, monthName VARCHAR(10), monthDays INT(2))";
    $result = $mysqli_conn -> query($query);

    //If the query result returned true (success) echo for the user
    if ($result == true) echo "<h3>Table dropped / created successfully!</h3>";
    return $result;
}

// This function inserts records into the table
function dbInsertFileRecords($mysqli_conn, $filepath) {

    //Checks to see if the filepath provided has a file
    if (is_file($filepath)) {
        echo "<br>";

        //Opens the file and creates the array
        $months = file($filepath);

        //load array two dimensionally using exploded list, one dimension at a time with three vars each.
        //NOTE: Code snippet from function in functions.php -- NOT COMPLETE FUNCTION
        foreach ($months as $row) {
            list($num, $monthName, $days) = explode(",", $row);
            $query = "INSERT INTO monthsTable (monthsID, monthName, monthDays) VALUES ('$num', '$monthName', '$days')";
            $mysqli_conn -> query($query);
            if ($mysqli_conn -> error) {
                echo "<h4>Query error occured!</h4><br>$mysqli_conn -> error";
                exit();
            }
        }
        echo "<h3>Done inserting records!</h3>";
    } else echo "<h3>Filepath provided does not have a file present!</h3>";

    //$mysqli_conn -> close();
}

function dbSelectToHTMLTable($mysqli_conn) {

    $query = "SELECT * FROM monthsTable";
    $result = $mysqli_conn -> query($query);

    $count = 1;
    echo "<table><tr class='tableHead'><td>Number</td><td>Month</td><td>Days</td></tr>";
    while ($record = $result -> fetch_array(MYSQLI_NUM)) {
        if ($count % 2 == 0) {
            vprintf("<tr class='evenRow'><td>%s</td><td>%s</td><td>%s</td></tr>", $record);
        } else vprintf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $record);
        $count++;
    }

    //$mysqli_conn -> close();
}