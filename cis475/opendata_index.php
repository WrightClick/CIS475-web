<?php
require_once "vars.php";
require_once "functions.php";
require_once "socrata.php";
$pageName = "OpenData";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="<?php printKeywords($metaKeywords); ?>">
    <?php printMetaTags($metaTags); ?>
    <title><?php echo $pageName ?></title>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
</head>
<body>
<!--WARNING -->
<!--Starting main container div, do not insert html / php above this line!-->
<div class="main_container">

    <!--JQUERY CODE -->
    <script>
        $(document).ready(() => {

            var selectorCount = -99;

            //Look for change in checkbox to show custom selection form and if it is
            //checked, show the form otherwise hide it. First 2 lines is hiding the form by default.
            $('#sel_custom').prop('checked', false);

            //Hide elements until they are selected
            $('#customSelectionForm').hide();
            $('#custom_date').hide();
            $('#custom_date_label').hide();
            $('.second_where').hide();
            $('#mult_filter_cond').hide();
            $('#mult_filter_cond_select').hide();
            $('#mult_custom_date_label').hide();
            $('#mult_custom_date').hide();

            //Clears existing options
            $('#filter_cond_select').empty();

            //Event handler for when the user checks a box to use a custom query
            $('#sel_custom').change(() => {
                if ($('#sel_custom').is(':checked')) {
                    $('#customSelectionForm').show();
                    $('#presetSelectionForm').hide();
                } else {
                    $('#customSelectionForm').hide();
                    $('#presetSelectionForm').show();
                }
            });

            //If the select all checkbox changes values, it is checked if its value is checked,
            //if true, then each field selector checkbox is checked, otherwise each is unchecked.
            if ($('#selector_all').change(function() {
                if ($('#selector_all').is(':checked')) {
                    $('.field_selectors').each(function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $('.field_selectors').each(function() {
                        $(this).prop('checked', false);
                    });
                }
            }));

            //Clears existing options
            $('#filter_cond_select').empty();

            //Fires when the user changes the selected value for the filter condition
            //Responsible for populating the select options for the relevant filter column
            $('#filter_dropdown').change(function() {

                //Clears existing options
                $('#filter_cond_select').empty();

                //If the selected column to filter is the data add the specific options
                if ($('#filter_dropdown').find(':selected').val() === "filter_summdt") {
                    $('#filter_cond_select').append ('<option value="summdt_filter_pastweek">Past week</option>');
                    $('#filter_cond_select').append ('<option value="summdt_filter_pastmonth">Past month</option>');
                    $('#filter_cond_select').append ('<option value="summdt_filter_pastyear">Past year</option>');
                    $('#filter_cond_select').append ('<option value="summdt_filter_custom_date">Enter Date</option>');
                }

                //If the selected column to filter is the time add the specific options
                if ($('#filter_dropdown').find(':selected').val() === "filter_viotime") {
                    $('#filter_cond_select').append ('<option value="viotime_filter_am">AM Hours</option>');
                    $('#filter_cond_select').append ('<option value="viotime_filter_pm">PM Hours</option>');
                }

                //If the selected column to filter is the description add the specific options
                if ($('#filter_dropdown').find(':selected').val() === "filter_viodesc") {
                    $('#filter_cond_select').append ('<option value="viodesc_filter_busroute">Bus Route Parking</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_expired_reg">Expired Reg.</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_alternate_parking">Alternate Prk.</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_handicap">Park. Handicap</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_crosswalk"><20 ft. Crosswalk</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_noparking">No Parking</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_nostanding">No Standing</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_meterovertime">Meter Overtime</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_noconsent">Parking W/O Consent</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_lessthan_15_firehydrant">Parking <15ft. Fire Hydrant</option>');
                    $('#filter_cond_select').append ('<option value="viodesc_filter_unpaved">Parked on Unpaved Rd.</option>');
                }

                //If the selected column to filter is the fine add the specific options
                if ($('#filter_dropdown').find(':selected').val() === "filter_origfine") {
                    $('#filter_cond_select').append ('<option value="fine_filter_lessthan_40">$40 or less</option>');
                    $('#filter_cond_select').append ('<option value="fine_filter_greaterthan_40">More than $40</option>');
                }

                if ($('#filter_dropdown').find(':selected').val() === "filter_violation_full_address") {
                    $('#filter_cond_select').append ('<option value="address_filter_elmwood">Elmwood St.</option>');
                    $('#filter_cond_select').append ('<option value="address_filter_potomac">Potomac St.</option>');
                }

                //If the selected option is to select multiple columns, display the hidden form inputs
                if ($('#filter_dropdown').find(':selected').val() === "filter_mult") {
                    $('#filter_none').prop('selected', true);
                    $('.second_where').show();
                    $('#mult_filter_cond').show();
                    $('#mult_filter_cond_select').show();
                }

                }); //End filter option populating trigger based off of a change

            //This block of code is triggered to check for the selected columns when the select dropdown
            //for a second filtering condition is selected
            $('#multiple_filter_dropdown').change(function() {

                $('#mult_filter_cond_select').empty();

                //Second where condition for the date
                if ($('#multiple_filter_dropdown').find(':selected').val() === "mult_filter_summdt") {
                    $('#mult_filter_cond_select').append ('<option value="mult_summdt_filter_pastweek">Past week</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_summdt_filter_pastmonth">Past month</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_summdt_filter_pastyear">Past year</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_summdt_filter_custom_date">Enter Date</option>');
                }

                //Second where condition for the time
                if ($('#multiple_filter_dropdown').find(':selected').val() === "mult_filter_viotime") {
                    $('#mult_filter_cond_select').append ('<option value="mult_viotime_filter_am">AM Hours</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viotime_filter_pm">PM Hours</option>');
                }

                //Second where condition for the description
                if ($('#multiple_filter_dropdown').find(':selected').val() === "mult_filter_viodesc") {
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_busroute">Bus Route Parking</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_expired_reg">Expired Reg.</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_alternate_parking">Alternate Prk.</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_handicap">Park. Handicap</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_crosswalk"><20 ft. Crosswalk</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_noparking">No Parking</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_nostanding">No Standing</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_meterovertime">Meter Overtime</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_noconsent">Parking W/O Consent</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_lessthan_15_firehydrant">Parking <15ft. Fire Hydrant</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_viodesc_filter_unpaved">Parked on Unpaved Rd.</option>');
                }

                //Second where condition for the fine
                if ($('#multiple_filter_dropdown').find(':selected').val() === "mult_filter_origfine") {
                    $('#mult_filter_cond_select').append ('<option value="mult_fine_filter_lessthan_40">$40 or less</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_fine_filter_greaterthan_40">>More than $40</option>');
                }

                //Second where condition for the address
                if ($('#multiple_filter_dropdown').find(':selected').val() === "mult_filter_violation_full_address") {
                    $('#mult_filter_cond_select').append ('<option value="mult_address_filter_elmwood">Elmwood St.</option>');
                    $('#mult_filter_cond_select').append ('<option value="mult_address_filter_potomac">Potomac St.</option>');
                }

            }); //end multiple filter selection dropdown and options

            //Trigger for when filter conditions change
            $('#filter_cond_select').change(function() {
                if ($('#filter_cond_select').find(':selected').val() === "summdt_filter_custom_date") {
                    $('#custom_date').show();
                    $('#custom_date_label').show();
                } else {
                    $('#custom_date').hide();
                    $('#custom_date_label').hide();
                }
            });

            //Trigger for when second where condition filter conditions change
            $('#mult_filter_cond_select').change(function() {
                if ($('#mult_filter_cond_select').find(':selected').val() === "mult_summdt_filter_custom_date") {
                    $('#mult_custom_date_label').show();
                    $('#mult_custom_date').show();
                } else {
                    $('#mult_custom_date_label').hide();
                    $('#mult_custom_date').hide();
                }
            });

            //Gets the number of checkboxes checked as selected columns, passed as a value
            //to a hidden form input so that a PHP loop in functions.php can process the array
            //and make the query string properly.
            $('#customSelectionForm').submit(function() {
                selectorCount = 0;
                $('.field_selectors').each(function() {
                    if ($(this).is(':checked')) {
                        selectorCount++;
                    }
                });
                $('#selector_count').val(selectorCount);
            });

        }) //End document ready trigger
    </script>

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
        <?php echo "<a href='opendata_index.php'><h1 class='introtext'>$pageName</h1></a>"; ?>
        <?php echo "<h3>Server Software</h3>" . $serverSoftware; ?>
        <h4 class="paragraph_head"></h4>
        <p></p>
        <h4>Thanks,<br>Matt.</h4>
        <p> This page allows you to see the entries in the OpenData Buffalo Parking Summons database.
        Using preset selections will allow for quick access, where as checking the 'Custom Selection?' checkbox
        will allow for a customized query, for viewing data more specifically. With preset selections, the number
         of rows is needed, whereas with custom selections leaving the number of rows blank will select from a default
        of 1000.</p>
        <hr>


        <!-------NOTE: SOCRATA OBJECT CREATION CODE IS SUCCESSFUL.------->
        <?php
        $uid = "yvvn-sykd";
        $root_url = "data.buffalony.gov";
        $app_token = "R1y4bOnGgLzA3ZElJ8ael91KC";
        $PHP_SELF = $_SERVER['PHP_SELF'];
        $year = date("Y");
        $cnt = 0;
        $limit = 50;
        $offset = 0;
        $debug = 0;
        // Create a new unauthenticated client
        $socrata = new Socrata($root_url, $app_token);
        if ($debug) {
            echo("<br />get: ");
            echo("<br />");
        }

        ?>

        <!--HTML form for $_POST'ing data back to the page for processing through
        the API. -->
        <div class="form_item">
            <label for="sel_custom">Custom Selection?</label>
            <input type="checkbox" name="sel_custom" id="sel_custom" style="margin-top: 25px; margin-right: 10px">
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form" method="post" id="presetSelectionForm" style="margin-bottom: 100px">
            <ul>
                <li>
                    <div class="form_item">
                        <div class="form_label"><p>Preset Selections</p></div>
                        <select class="form_field" id="presetSelect" name="presetSelect">
                            <option value="sel_noPreset">None</option>
                            <option value="sel_all">Select All</option>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="form_item">
                        <div class="form_label"><p>Number of Rows</p></div>
                        <input type="text" name="numRows" id="numRows" required>
                    </div>
                </li>
                <li>
                    <div class="form_item">
                        <input type="submit" value="Submit" id="presetSelect_submit"
                               style="height: 40px; font-size: 1.1em; margin-top: 25px">
                    </div>
                </li>
            </ul>
        </form>

        <div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form" id="customSelectionForm" style="margin-bottom: 100px; margin-top: 20px;">
                <!--List of columns to select-->
                <ul>
                    <li>
                        <div class="form_item" style="display: contents">
                            <div class="form_label"><h3>Selectors</h3></div>
                            <ul>
                                <li>
                                    <label for="selector_all" id="selector_all_text">All Columns</label>
                                    <input type="checkbox" id="selector_all" style="float: right">
                                </li>
                                <li>
                                    <label for="selector_summno">Number</label>
                                    <input type="checkbox" id="selector_summno" name="selector_summno" style="float: right" value="checked" class="field_selectors">
                                </li>
                                <li>
                                    <label for="selector_summdt">Date</label>
                                    <input type="checkbox" id="selector_summdt" name="selector_summdt" style="float: right" value="checked" class="field_selectors">
                                </li>
                                <li>
                                    <label for="selector_viotime">Time</label>
                                    <input type="checkbox" id="selector_viotime" name="selector_viotime" style="float: right" value="checked" class="field_selectors">
                                </li>
                                <li>
                                    <label for="selector_viodesc">Desc.</label>
                                    <input type="checkbox" id="selector_viodesc" name="selector_viodesc" style="float: right" value="checked" class="field_selectors">
                                </li>
                                <li>
                                    <label for="selector_origfine">Fine</label>
                                    <input type="checkbox" id="selector_origfine" name="selector_origfine" style="float: right" value="checked" class="field_selectors">
                                </li>
                                <li>
                                    <label for="selector_violation_full_address">Address</label>
                                    <input type="checkbox" id="selector_violation_full_address" name="selector_violation_full_address" style="float: right" value="checked" class="field_selectors">
                                </li>
                                <input type="text" value="" id="selector_count" name="selector_count" hidden>
                            </ul>
                        </div>
                    </li>
                </ul>

                <!--Column selector to filter with WHERE-->
                <ul>
                    <li>
                        <div class="form_label"><h3>Filter</h3></div>
                        <ul>
                            <li>
                                <label for="filter_dropdown">Column</label>
                            </li>
                            <li>
                                <select name="filter_dropdown" id="filter_dropdown">
                                    <option value="none" selected id="filter_none">none</option>
                                    <option value="filter_summdt">Date</option>
                                    <option value="filter_viotime">Time</option>
                                    <option value="filter_viodesc">Desc.</option>
                                    <option value="filter_origfine">Fine</option>
                                    <option value="filter_violation_full_address">Address</option>
                                    <option value="filter_mult">Multiple Columns</option>
                                </select>
                            </li>
                            <p>Condition</p>
                            <li id="filter_condition">
                                <select name="filter_cond_select" id="filter_cond_select">

                                </select>
                                <p id="custom_date_label">Date (YYYY-MM-DD)</p>
                                <input type="text" name="custom_date" id="custom_date" pattern="(\d{4}-\d{2}-\d{2})"
                                       title="Four digit year - two digit month number - two digit day">
                            </li>
                            <li class="second_where"><p>And</p></li>
                            <li class="second_where">
                                <select name="multiple_filter_dropdown" id="multiple_filter_dropdown">
                                    <option value="none" selected>none</option>
                                    <option value="mult_filter_summdt">Date</option>
                                    <option value="mult_filter_viotime">Time</option>
                                    <option value="mult_filter_viodesc">Desc.</option>
                                    <option value="mult_filter_origfine">Fine</option>
                                    <option value="mult_filter_violation_full_address">Address</option>
                                </select>
                            </li>
                            <p class="second_where">Condition</p>
                            <li id="mult_filter_condition">
                                <select name="mult_filter_cond_select" id="mult_filter_cond_select">

                                </select>
                                <p id="mult_custom_date_label">Date (YYYY-MM-DD)</p>
                                <input type="text" name="mult_custom_date" id="mult_custom_date" pattern="(\d{4}-\d{2}-\d{2})"
                                       title="Four digit year - two digit month number - two digit day">
                            </li>
                        </ul>
                    </li>
                </ul>

                <!--Column selector to order results by-->
                <ul>
                    <li>
                        <div class="form_label"><h3>Order By</h3></div>
                        <select name="orderby_dropdown" id="orderby_dropdown">
                            <option value="desc_summdt" selected>Date Descending (Most Recent)</option>
                            <option value="none">Default (Oldest First)</option>
                            <option value="desc_fine">Fine Descending</option>
                            <option value="asc_fine">Fine Ascending</option>
                            <option value="desc_summno">Num. Descending</option>
                            <option value="asc_summno">Num. Ascending</option>
                        </select>
                    </li>
                    <li style="padding-bottom: 20px">
                        <div class="form_label"><p>Num. Rows</p></div>
                        <input type="text" width="20px" name="custom_num_rows" id="custom_num_rows">
                    </li>
                    <li>
                        <input type="submit" name="custom_submit" id="custom_submit" value="Run">
                    </li>
                </ul>
            </form>
        </div>


        <div class="data_scrollbox">
            <!-- TODO add php code for displaying output here -->
            <!--------------------------------------------------------------------------------->
            <!--                        SOCRATA PHP STARTS HERE                              -->
            <!--------------------------------------------------------------------------------->
            <?php

            //Init all parameter values as preparation
            $select = "";
            //Starting as 1 due to requirement to select one field at minimum
            $selectCount = 0;

            $where = "";
            $order = "";
            $group = "";
            $having = "";
            $limit = "";
            $offset = "";
            $q = "";
            $query = "";

            $params = array();

            //Init all variables for easier access
            //NOTE: Some are not included from the dataset due to redundancy of
            //      page objective
            $num = "";
            $date = "";
            $time = "";
            $desc = "";
            $fine = "";
            $full_addr = "";

            //Get the row offset if it is requested
            if (isset($_GET['offset'])) {
                $offset = $_GET['offset'];
            }

            //Run a query preselected from the user (SELECT * LIMIT $limit)
            //
            if (!empty($_POST['presetSelect'])) {

                //Number of rows to display
                if (!empty($_POST['numRows'])) {
                    $limit = $_POST['numRows'];
                }

                $presetSelection = $_POST['presetSelect'];
                if ($presetSelection == "sel_all") {
                    $query = "SELECT summno, summdt, viotime, viodesc, origfine,
                     violation_full_address ORDER BY summdt DESC LIMIT $limit";
                    $params["\$query"] = "$query";
                    $result = $socrata -> get($uid, $params);
                    printSocrataRowsToTable($result);
                }

            }

            //Run a query based off of the custom query parameters selected by the user
            if (!empty($_POST['custom_submit']) && $_POST['custom_submit'] == "Run") {

                $totalSelectors = $_POST['selector_count'];
                $selectors = array();

                //Reinitialize array to clear any previous data from queries
                $params = array();

                //Assign the row limit amount from the form value
                if (!empty($_POST['custom_num_rows']) && $_POST['custom_num_rows'] != "") {
                    $limit = $_POST['custom_num_rows'];
                }

                /*
                 * ---------------------------------------------------------------------
                 * Checks to see if fields are selected for query
                 * ---------------------------------------------------------------------
                 */

                //If the summdt checkbox is selected, make it the select field if its the only one
                //otherwise append it to the select string
                if (isset($_POST['selector_summno'])) {
                    $selectors[] = "summno";
                }

                //If the summdt checkbox is selected, make it the select field if its the only one
                //otherwise append it to the select string
                if (isset($_POST['selector_summdt'])) {
                    $selectors[] = "summdt";
                }

                //If the viotime checkbox is selected, make it the select field if its the only one
                //otherwise append it to the select string
                if (isset($_POST['selector_viotime'])) {
                    $selectors[] = "viotime";
                }

                //If the viodesc checkbox is selected, make it the select field if its the only one
                //otherwise append it to the select string
                if (isset($_POST['selector_viodesc'])) {
                    $selectors[] = "viodesc";
                }

                //If the origfine checkbox is selected, make it the select field if its the only one
                //otherwise append it to the select string
                if (isset($_POST['selector_origfine'])) {
                    $selectors[] = "origfine";
                }

                //If the violation_full_address checkbox is selected, make it the select field if its the only one
                //otherwise append it to the select string
                if (isset($_POST['selector_violation_full_address'])) {
                    $selectors[] = "violation_full_address";
                }

                //Loops through the array of selected columns, and checks to see if it is either
                //the only column selected, or if the array has more than one column.
                //
                //check to see if the element next up is not the last element and add a comma to
                //seperate the column names, but if the next element (element 5) + 1
                //is not < the size of the array (number of columns selected), output the column
                //name as a final name.
                for ($i = 0; $i < sizeof($selectors); $i++) {

                    //If there is only one column name selected
                    if (sizeof($selectors) == 1) {
                        $select = $selectors[0] . ' ';

                        //Otherwise
                    } else if (sizeof($selectors) > 1) {

                        //If the next element isin't last
                        if ($i + 1 < sizeof($selectors)) {
                            $select .= $selectors[$i] . ', ';

                            //And if it is, forgo the comma
                        } else {
                            $select .= $selectors[$i] . ' ';
                        }
                    }
                }

                /*
                 * ---------------------------------------------------------------------
                 * End of selected fields, end of $select parameter for query
                 * ---------------------------------------------------------------------
                 */

                /*
                 * ---------------------------------------------------------------------
                 * Begin checking for first WHERE condition
                 * ---------------------------------------------------------------------
                 */

                //Start checking the value posted by the select dropdown, and build the
                //query WHERE parameter based off of the column to filter and the conditions
                if (!empty($_POST['filter_dropdown'])) {

                    if ($_POST['filter_dropdown'] == "filter_summdt") {

                        $currentDate = date('Y-m-d').'T00:00:00';

                        switch ($_POST['filter_cond_select']) {
                            case "summdt_filter_pastweek":
                                $pastdate = date('Y-m-d', strtotime('-1 week')).'T00:00:00';
                                $where = "summdt BETWEEN '$pastdate' AND '$currentDate' ";
                                break;
                            case "summdt_filter_pastmonth":
                                $pastdate = date('Y-m-d', strtotime('-1 month')).'T00:00:00';
                                $where = "summdt BETWEEN '$pastdate' AND '$currentDate' ";
                                break;
                            case "summdt_filter_pastyear":
                                $pastdate = date('Y-m-d',strtotime('-1 year')).'T00:00:00';
                                $where = "summdt BETWEEN '$pastdate' AND '$currentDate' ";
                                break;
                            case "summdt_filter_custom_date":
                                $custom_date = $_POST['custom_date'].'T00:00:00';
                                $where = "summdt = '$custom_date' ";
                        }
                    } //End summdt filter

                    if ($_POST['filter_dropdown'] == "filter_viotime") {
                        switch ($_POST['filter_cond_select']) {
                            case "viotime_filter_am":
                                $where = "viotime LIKE '%A%' ";
                                break;
                            case "viotime_filter_pm":
                                $where = "viotime LIKE '%P%' ";
                        }
                    } //End viotime filter

                    if ($_POST['filter_dropdown'] == "filter_viodesc") {
                        switch ($_POST['filter_cond_select']) {
                            case "viodesc_filter_busroute":
                                $where = "viodesc LIKE '%BUS%' ";
                                break;
                            case "viodesc_filter_expired_reg":
                                $where = "viodesc LIKE '%EXPIRED%' ";
                                break;
                            case "viodesc_filter_alternate_parking ":
                                $where = "viodesc LIKE '%ALTERNATE%' ";
                                break;
                            case "viodesc_filter_handicap":
                                $where = "viodesc LIKE '%HANDICAPPED%' ";
                                break;
                            case "viodesc_filter_crosswalk":
                                $where = "viodesc LIKE '%CROSSWALK%' ";
                                break;
                            case "viodesc_filter_noparking":
                                $where = "viodesc LIKE '%NO PARKING%' ";
                                break;
                            case "viodesc_filter_nostanding":
                                $where = "viodesc LIKE '%NO STANDING%' ";
                                break;
                            case "viodesc_filter_meterovertime":
                                $where = "viodesc LIKE '%OVERTIME%' ";
                                break;
                            case "viodesc_filter_noconsent":
                                $where = "viodesc LIKE '%CONSENT%' ";
                                break;
                            case "viodesc_filter_lessthan_15_firehydrant":
                                $where = "viodesc LIKE '%FIRE%' ";
                                break;
                            case "viodesc_filter_unpaved":
                                $where = "viodesc LIKE '%UNPAVED%' ";
                        }
                    } //End viodesc filter

                    if ($_POST['filter_dropdown'] == "filter_origfine") {
                        switch ($_POST['filter_cond_select']) {
                            case "fine_filter_lessthan_40":
                                $where = "origfine <= '40' ";
                                break;
                            case "fine_filter_greaterthan_40":
                                $where = "origfine > '40' ";
                                break;
                        }
                    } //End origfine filter

                    if ($_POST['filter_dropdown'] == "filter_violation_full_address") {
                        switch ($_POST['filter_cond_select']) {
                            case "address_filter_elmwood":
                                $where = "violation_full_address LIKE '%ELMWOOD%' ";
                                break;
                            case "address_filter_potomac":
                                $where = "violation_full_address LIKE '%POTOMAC%' ";
                        }
                    } //End violation_full_address filter

                } else if ($_POST['filter_dropdown'] == "none") {echo "<h4>No filter selected</h4>";}

                /*
                 * ---------------------------------------------------------------------
                 * End checking for first WHERE condition
                 * ---------------------------------------------------------------------
                 */

                /*
                 * ---------------------------------------------------------------------
                 * Begin checking for a second WHERE condition to be added at request of user
                 * ---------------------------------------------------------------------
                 */

                //This will append a second condition to the current where statement in the situation
                //that the user selects "multiple columns"
                if (!empty($_POST['multiple_filter_dropdown'])) {

                    if ($_POST['multiple_filter_dropdown'] == "mult_filter_summdt") {

                        $currentDate = date('Y-m-d').'T00:00:00';

                        switch ($_POST['mult_filter_cond_select']) {
                            case "mult_summdt_filter_pastweek":
                                $pastdate = date('Y-m-d', strtotime('-1 week')).'T00:00:00';
                                $where .= "AND summdt BETWEEN '$pastdate' AND '$currentDate' ";
                                break;
                            case "mult_summdt_filter_pastmonth":
                                $pastdate = date('Y-m-d', strtotime('-1 month')).'T00:00:00';
                                $where .= "AND summdt BETWEEN '$pastdate' AND '$currentDate' ";
                                break;
                            case "mult_summdt_filter_pastyear":
                                $pastdate = date('Y-m-d',strtotime('-1 year')).'T00:00:00';
                                $where .= "AND summdt BETWEEN '$pastdate' AND '$currentDate' ";
                                break;
                            case "mult_summdt_filter_custom_date":
                                $custom_date = $_POST['mult_custom_date'].'T00:00:00';
                                $where .= "AND summdt = '$custom_date' ";
                        }
                    } //End summdt filter

                    if ($_POST['multiple_filter_dropdown'] == "mult_filter_viotime") {
                        switch ($_POST['mult_filter_cond_select']) {
                            case "mult_viotime_filter_am":
                                $where .= "AND viotime LIKE '%A%' ";
                                break;
                            case "mult_viotime_filter_pm":
                                $where .= "AND viotime LIKE '%P%' ";
                        }
                    } //End viotime filter

                    if ($_POST['multiple_filter_dropdown'] == "mult_filter_viodesc") {
                        switch ($_POST['mult_filter_cond_select']) {
                            case "mult_viodesc_filter_busroute":
                                $where .= "AND viodesc LIKE '%BUS%' ";
                                break;
                            case "mult_viodesc_filter_expired_reg":
                                $where .= "AND viodesc LIKE '%EXPIRED%' ";
                                break;
                            case "mult_viodesc_filter_alternate_parking ":
                                $where .= "AND viodesc LIKE '%ALTERNATE%' ";
                                break;
                            case "mult_viodesc_filter_handicap":
                                $where .= "AND viodesc LIKE '%HANDICAPPED%' ";
                                break;
                            case "mult_viodesc_filter_crosswalk":
                                $where .= "AND viodesc LIKE '%CROSSWALK%' ";
                                break;
                            case "mult_viodesc_filter_noparking":
                                $where .= "AND viodesc LIKE '%NO PARKING%' ";
                                break;
                            case "mult_viodesc_filter_nostanding":
                                $where .= "AND viodesc LIKE '%NO STANDING%' ";
                                break;
                            case "mult_viodesc_filter_meterovertime":
                                $where .= "AND viodesc LIKE '%OVERTIME%' ";
                                break;
                            case "mult_viodesc_filter_noconsent":
                                $where .= "AND viodesc LIKE '%CONSENT%' ";
                                break;
                            case "mult_viodesc_filter_lessthan_15_firehydrant":
                                $where .= "AND viodesc LIKE '%FIRE%' ";
                                break;
                            case "mult_viodesc_filter_unpaved":
                                $where .= "AND viodesc LIKE '%UNPAVED%' ";
                        }
                    } //End viodesc filter

                    if ($_POST['multiple_filter_dropdown'] == "mult_filter_origfine") {
                        switch ($_POST['mult_filter_cond_select']) {
                            case "mult_fine_filter_lessthan_40":
                                $where .= "AND origfine <= '40' ";
                                break;
                            case "mult_fine_filter_greaterthan_40":
                                $where .= "AND origfine > '40' ";
                                break;
                        }
                    } //End origfine filter

                    if ($_POST['multiple_filter_dropdown'] == "mult_filter_violation_full_address") {
                        switch ($_POST['mult_filter_cond_select']) {
                            case "mult_address_filter_elmwood":
                                $where .= "AND violation_full_address LIKE '%ELMWOOD%' ";
                                break;
                            case "mult_address_filter_potomac":
                                $where .= "AND violation_full_address LIKE '%POTOMAC%' ";
                        }
                    } //End violation_full_address filter

                }

                /*
                 * ---------------------------------------------------------------------
                 * End second WHERE condition
                 * ---------------------------------------------------------------------
                 */


                //Get the ORDER BY parameter, and ignore (use default) if not selecting other
                //options
                if (!empty($_POST['orderby_dropdown'])) {
                    if ($_POST['orderby_dropdown'] == "desc_summdt") $order = "summdt DESC";
                    if ($_POST['orderby_dropdown'] === "desc_fine") $order = "origfine DESC";
                    if ($_POST['orderby_dropdown'] === "asc_fine") $order = "origfine ASC";
                    if ($_POST['orderby_dropdown'] === "desc_summno") $order = "summno DESC";
                    if ($_POST['orderby_dropdown'] === "asc_summno") $order = "summno ASC";
                }

                //Build query with params array
                $params["\$select"] = $select;
                if ($where != "") $params["\$where"] = $where;
                if ($order != "") $params["\$order"] = $order;
                if ($limit != "") $params["\$limit"] = $limit;

                //Run query using API, and assign result set to $result
                //then call function to print results to table
                $result = $socrata -> get($uid, $params);
                printSocrataRowsToTable($result);

            } //End entire if block for when custom selections are made

            ?>

            <!--------------------------------------------------------------------------------->
            <!--                        SOCRATA PHP ENDS HERE                                -->
            <!--------------------------------------------------------------------------------->
        </div>

        <!--End body div -->
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

<?php

?>