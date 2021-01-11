<?php
require_once("socrata.php");
require_once("socrata_functions.php");
require_once("socrata_vars.php");
$debug = 0;
$title = "City of Buffalo Crime Incidents";
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta name="author" content="Jim Gerland" />
        <meta charset="UTF-8" />
        <meta name="Generator" content="Notepad++" />
        <meta name="Author" content="Jim Gerland" />
        <meta name="Keywords" content="PHP, Socrata, Buffalo, Crime" />
        <meta name="Description" content="City of Buffalo Crime Incidents" />
        <title><?php echo($title); ?></title>
        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="/socrata/socrata.css" />
    </head>
<body>
<main>
    <div id="main">
    <div id="selectDiv">
        <div id="nav">
            <p><a href="../" title="Home">Home</a> | <a href="about.php" target="_blank" title="About this site">About</a>
                <span style="font-size: large; font-weight: bold; margin: 0 0 0 20%;"><?php echo($title); ?></span></p>
        </div> <!-- end id="nav" -->
        <p><span style="font-size: small;"><a href="https://data.buffalony.gov/Public-Safety/Crime-Incidents/d6g9-xbgu" target="_blank">Data Reference (https://data.buffalony.gov/Public-Safety/Crime-Incidents/d6g9-xbgu)</a></span></p>
        <?php
        function array_get($needle, $haystack) {
            return (in_array($needle, array_keys($haystack)) ? $haystack[$needle] : NULL);
        }


        //Create the socrata connection and check for debug value.
        //If offset was requested then assign value
        // https://data.buffalony.gov/resource/d6g9-xbgu.json
        $view_uid = "d6g9-xbgu";
        $root_url = "data.buffalony.gov";
        $app_token = "tGvRleHbINzi7AhfN4bhhFfg9";
        // Create a new unauthenticated client
        $socrata = new Socrata($root_url, $app_token);
        $response = NULL;
        if ($debug) { echo("<br />get: "); var_dump($_GET); echo("<br />"); }
        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        }


        //Var initialization
        $incident_type_primary = "";
        $incident_datetime = "";
        $day_of_week = "";
        $incident_mm = "";
        $incident_dd = "";
        $incident_yy = "";
        $address_1 = "";
        $zipCode = "";


        //Query and orderby strings
        $query = "select%20*%20";
        $orderBy = "incident_type_primary, address_1, incident_datetime";


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_POST['incident_type_primary']) && ($_POST['incident_type_primary'] != "")) {
            $incident_type_primary = $_POST['incident_type_primary'];
            $where = "incident_type_primary='$incident_type_primary'";
        }


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_GET['incident_type_primary']) && ($_GET['incident_type_primary'] != "")) {
            $incident_type_primary = $_GET['incident_type_primary'];
            $where = "incident_type_primary='$incident_type_primary'";
        }


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_POST['incident_mm']) && ($_POST['incident_mm'] != "")) {
            $incident_datetime = $_POST['incident_yy'] . "-" . $_POST['incident_mm'] . "-" . $_POST['incident_dd'];
            $where = "date_trunc_ymd(incident_datetime)='$incident_datetime'";
            $orderBy = "zip," . $orderBy;
        }


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_GET['incident_datetime']) && ($_GET['incident_datetime'] != "")) {
            $incident_datetime = $_GET['incident_datetime'];
            $where = "date_trunc_ymd(incident_datetime)='$incident_datetime'";
            $orderBy = "zip," . $orderBy;
        }


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_POST['day_of_week']) && ($_POST['day_of_week'] != "")) {
            $day_of_week = $_POST['day_of_week'];
            $where = "day_of_week='$day_of_week'";
            $orderBy = "day_of_week," . $orderBy;
        }


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_GET['day_of_week']) && ($_GET['day_of_week'] != "")) {
            $day_of_week = $GET['day_of_week'];
            $where = "day_of_week='$day_of_week'";
            $orderBy = "day_of_week," . $orderBy;
        }


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_POST['address_1']) && ($_POST['address_1'] != "")) {
            $address_1 = $_POST['address_1'];
            $where = "lower(address_1) like '%" . strtolower($address_1) . "%'";
        }


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_GET['address_1']) && ($_GET['address_1'] != "")) {
            $address_1 = $_GET['address_1'];
            $where = "lower(address_1) like '%" . strtolower($address_1) . "%'";
        }


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_POST['zipCode']) && ($_POST['zipCode'] != "")) {
            $zipCode = $_POST['zipCode'];
            $where = "zip like \"$zipCode%\"";
            $orderBy = "zip, " . $orderBy;
        }


        //Checks if a post value was set when posted by the form, assign value
        if (isset($_GET['zipCode']) && ($_GET['zipCode'] != "")) {
            $zipCode = $_GET['zipCode'];
            $where = "zip like \"$zipCode%\"";
            $orderBy = "zip, " . $orderBy;
        }


        //Checks if a post value was set when posted by the form, assign value
        if (($zipCode != "") || ($incident_type_primary != "") || ($incident_datetime != "")
            || ($day_of_week != "") || ($address_1 != "")) {
            $countQuery = "select count(*) as numRows where $where";
            $params = array("\$query" => $countQuery);

            //Query against API
            $response = $socrata->get($view_uid, $params);

            //Assign num of rows from query
            foreach ($response as $row) {
                $numRows = $row['numRows'];
            }


            if ($debug) { echo("<br />\ncount=$countQuery<br />\nnumRows=$numRows<br />\n"); }


            $params = array("\$where" => "$where", "\$order" => $orderBy, "\$limit" => $limit, "\$offset" => $offset);


            if ($debug) {
                echo("<a href='https://$root_url/resource/$view_uid.json?");
                foreach ($params as $param => $value) {
                    if ($cnt > 1) { echo("&"); }
                    $cnt++;
                    echo("$param=" . str_replace("%", "%25", $value));
                }


                echo("' target='_blank'>https://$root_url/resource/$view_uid.json? ");
                echo("https://$root_url/resource/$view_uid.json?");
                $cnt = 1;


                foreach ($params as $param => $value) {
                    if ($cnt > 1) { echo("&"); }
                    $cnt++;
                    echo("$param=" . str_replace("%", "%25", $value));
                }


                echo("</a><br />\n");
                print_r($params);
                echo("<br />\n");
                print_r($_POST);
            }


            $response = $socrata->get($view_uid, $params);
        }
        ?>
        <form name="myForm" id="myForm" action="<?php echo($PHP_SELF); ?>" method="POST">
            <div id="choices">
                Select field to query:
                <input type="radio" name="choice" id="choice_incident_type" onclick="document.getElementById('addressDiv').style.display = 'none';
        document.getElementById('incidentDateDiv').style.display = 'none';
        document.getElementById('dayOfWeekDiv').style.display = 'none';
        document.getElementById('zipCodeDiv').style.display = 'none';        document.getElementById('incidentTypeDiv').style.display = 'block';"
                       aria-labelledby="choices" /> <label for="choice_incident_type">Incident Type</label>
                <input type="radio" name="choice" id="choice_day_of_week" onclick="document.getElementById('addressDiv').style.display = 'none'; document.getElementById('incidentTypeDiv').style.display = 'none'; document.getElementById('incidentDateDiv').style.display = 'none';
        document.getElementById('zipCodeDiv').style.display = 'none';
        document.getElementById('dayOfWeekDiv').style.display = 'block';"
                       aria-labelledby="choices" /> <label for="choice_day_of_week">Day of Week</label>
                <input type="radio" name="choice" id="choice_incident_datetime" onclick="document.getElementById('addressDiv').style.display = 'none'; document.getElementById('incidentTypeDiv').style.display = 'none'; document.getElementById('dayOfWeekDiv').style.display = 'none';
        document.getElementById('zipCodeDiv').style.display = 'none';
        document.getElementById('incidentDateDiv').style.display = 'block';"
                       aria-labelledby="choices" /> <label for="choice_incident_datetime">Incident Date</label>
                <input type="radio" name="choice" id="choice_address_1"  onclick="
        document.getElementById('incidentTypeDiv').style.display = 'none';
        document.getElementById('incidentDateDiv').style.display = 'none';
        document.getElementById('dayOfWeekDiv').style.display = 'none';
        document.getElementById('zipCodeDiv').style.display = 'none';
        document.getElementById('addressDiv').style.display = 'block';"
                       aria-labelledby="choices" /> <label for="choice_address_1">Address</label>
                <input type="radio" name="choice" id="choice_zip"  onclick="
        document.getElementById('incidentTypeDiv').style.display = 'none';
        document.getElementById('incidentDateDiv').style.display = 'none';
        document.getElementById('dayOfWeekDiv').style.display = 'none';
        document.getElementById('addressDiv').style.display = 'none';
        document.getElementById('zipCodeDiv').style.display = 'block';"
                       aria-labelledby="choices" /> <label for="choice_zip">Zip Code</label>
            </div>
            <div id="incidentTypeDiv" style="display: none;">
                <label for="incident_type_primary">Select an Incident Type:</label>
                <select name="incident_type_primary" id="incident_type_primary" >
                    <option value="">Choose an Incident Type</option>
                    <?php
                    $incdentQuery = "select distinct(incident_type_primary) order by incident_type_primary";
                    $params = array("\$query" => $incidentQuery);
                    $incidentResponse = $socrata->get($view_uid, $params);
                    foreach ($incidentResponse as $row) {
                        $incidentTypesArray[] = $row['incident_type_primary'];
                    }
                    $incidentTypesArray = array_unique($incidentTypesArray);
                    sort($incidentTypesArray);
                    // print_r(incidentTypesArray);
                    // return $incidentTypesArray;
                    foreach ($incidentTypesArray as $key) {
                        echo("    <option value=\"$key\">$key</option>\n");
                    }
                    ?>
                </select>
            </div>
            <div id="dayOfWeekDiv" style="display: none;">
                <label for="day_of_week">Select an Incident Day:</label>
                <select name="day_of_week" id="day_of_week" >
                    <option value="">Choose an Week Day</option>
                    <?php
                    for ($i = 0; $i < count($daysArray); $i++) {
                        echo("    <option value=\"$daysArray[$i]\">$daysArray[$i]</option>\n");
                    }
                    ?>
                </select>
            </div>
            <div id="incidentDateDiv" style="display: none;">
                <label for="incident_mm">Incident Date:</label>
                <select name="incident_mm" id="incident_mm">
                    <option value="">Choose an Incident Month</option>
                    <?php
                    foreach ($monthsArray as $key => $val) {
                        echo("<option value=\"$key\">$val</option>\n");
                    }
                    ?>
                </select>
                <select name="incident_dd" id="incident_dd">
                    <option value="">Choose an Incident Day</option>
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        if ($i < 10) { $iStr = "0$i"; } else { $iStr = $i; }
                        echo("<option value=\"$iStr\">$i</option>\n");
                    }
                    ?>
                </select>
                <select name="incident_yy" id="incident_yy" >
                    <option value="">Choose an Incident Year</option>
                    <?php
                    for ($i = date("Y"); $i >= 2009; $i--) {
                        echo("<option value=\"$i\">$i</option>\n");
                    }
                    ?>
                </select>
            </div>
            <div id="addressDiv" style="display: none;">
                <label for="address_1">Incident Address (contains):</label>
                <input type="text" name="address_1" id="address_1" size="10"  />
            </div>
            <div id="zipCodeDiv" style="display: none;">
                <label for="zipCode">Zip Code:</label>
                <input type="text" name="zipCode" id="zipCode" size="10"  pattern="[0-9]{1,5}" />
                1 to 5 digits is allowed.
            </div>
            <input type="submit" name="submit" id="submit" value="Submit" />
        </form>


    </div> <!-- end id="selectDiv" -->
<?php if ($response != NULL) { ?>
    <div id="prevNext" style="text-align: center;">
        <?php
        echo("<h2>Results: Displaying records " . ($offset + 1) . " through ");
        if (($limit + $offset) < $numRows) {
            echo(($limit + $offset) . " of " . number_format($numRows) . " ");
        } else {
            echo(number_format($numRows) . " ");
        }
        if ($offset > 0) {
            echo("<a href=\"$PHP_SELF?incident_type_primary=$incident_type_primary&address_1=$address_1&incident_datetime=$incident_datetime&zipCode=$zipCode&day_of_week=$day_of_week&limit=$limit&offset=" . ($offset-$limit) . "\">Previous $limit </a>");
        }
        if ($numRows > ($limit + $offset)) {
            echo("| <a href=\"$PHP_SELF?incident_type_primary=$incident_type_primary&address_1=$address_1&incident_datetime=$incident_datetime&zipCode=$zipCode&day_of_week=$day_of_week&limit=$limit&offset=" . ($offset+$limit) . "\">Next $limit</a>");
        }
        echo("</h2>\n");
        ?>
    </div><!-- end id="prevNext" -->
    <div id="resultsTable">
        <!-- Create a table for our actual data  -->
        <table class="sortable">
            <thead>
            <tr>
                <th>Case Number</th>
                <th>Incident Type</th>
                <th>Incident Date</th>
                <th>Incident Description</th>
                <th>Address</th>
                <th>Zip Code</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($response as $row) {
                $cnt++;
                $case_number = "";
                $incident_type_primary = "";
                $parent_incident_type = "";
                $incident_datetimetime = "";
                $incident_description = "";
                $address_1 = "";
                $address_2 = "";
                $zipCode = "";
                $day_of_week = "";
                if (!empty($row["case_number"])) { $case_number = $row["case_number"]; }
                if (!empty($row["incident_type_primary"])) { $incident_type_primary = $row["incident_type_primary"]; }
                if (!empty($row["incident_datetime"])) {
                    $incident_datetimetime = $row["incident_datetime"];
                    $incident_datetimetime = preg_replace("/T/", " ", $incident_datetimetime);
                    $incident_datetimetime = preg_replace("/.000/", "", $incident_datetimetime);
                }
                if (!empty($row["parent_incident_type"])) { $parent_incident_type = $row["parent_incident_type"]; }
                if (!empty($row["incident_description"])) { $incident_description = $row["incident_description"]; }
                if (!empty($row["address_1"])) { $address_1 = $row["address_1"]; }
                if (!empty($row["address_2"])) { $address_2 = $row["address_2"]; }
                if (!empty($row["zip"]) || ($row['zip'] == "null")) { $zipCode = $row["zip"]; }
                if (!empty($row["day_of_week"])) { $day_of_week = $row["day_of_week"]; }
                /*
                */
                ?>
                <tr <?php if ($cnt % 2) { echo("style=\"background-color: #CCC;\""); } ?>>
                    <td><?php echo($case_number); ?></td>
                    <td><?php
                        if ($parent_incident_type != "") {
                            echo("$parent_incident_type:<br />");
                        }
                        echo($incident_type_primary); ?></td>
                    <td><?php echo($incident_datetimetime);
                        if ($day_of_week != "") { echo("<br />$day_of_week"); } ?></td>
                    <td style="width: 30%;"><?php echo($incident_description); ?></td>
                    <td><?php echo($address_1);
                        if ($address_2 != "") { echo("<br />$address_2"); } ?></td>
                    <td><?php echo($zipCode); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div> <!-- end id="resultsTable" -->
<?php } ?>
<?php endHTML(); ?>