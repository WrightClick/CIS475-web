<?php
require_once "vars.php";
require_once "functions.php";
$pageName = "PHP AJAX";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="<?php printKeywords($metaKeywords); ?>">

    <!-- Inlcudes the script from the jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <!--
        The script included below is sourced from: http://chir.ag/projects/ntc/
        The script contains functions for determining the color names from given hex
        values.
    -->
    <script src="http://chir.ag/projects/ntc/ntc.js"></script>

    <?php printMetaTags($metaTags); ?>
    <?php echo "<title>$pageName</title>"?>

    <!--
        The Ajax script starts here.

        The script will create an array of three values between 0 and 255 (rgb values).

        When a button is clicked, a for loop will loop start.

            A setTimeout call will run an anonymous function that takes the value of i.

                it will then create jQuery objects that reference
                each respective text box using the id and the value of 'i'/. The same is done for the
                text value paragraph below it.

                the rgb array is repopulated with random values for each element, (0, 1, 2) representing
                red, green and blue values.

                Using the selected elements from the jQuery objects, the textbox input has its background
                color set to the rgb values, and the paragraph element below it has its text set to notify
                the user of the rgb values.

                The colors created are checked using an script that will determine if they are either an
                exact match to a color, or a close one. Depending on user choice the closest color name
                can be displayed.

                Each time the function runs, it checks to see if the history <h3> element was created by
                attempting to check its length. If it does not exist it creates it.

                A string is set up to style an element. Then, by selecting the history element using its tag
                a p element is inserted after it, with the styling set to the rgb values set up in the style string.
                This will output the raw rgb values, and the string is styled to reflect the color.
    -->
    <script>
        $(document).ready(function() {

            //Creates and populates the array with random values
            var rgb = Array.from({length: 3}, () =>  Math.floor(Math.random() * 256));

            $(".ajaxBtnStart").click(function (event) {

                var boxElement, valueElement, styleString, colorName, hex, colorMatch;

                //Change time to affect how fast colors are added with setTimeout.
                //Value is in ms.
                var time = 50;

                //The outside loop that will go across each box element
                for (var i = 1; i < 9 + 1; i++) {

                    //This will run a function that does the majority of the work.
                    //Elements are selected, css values are set and the values are printed out.
                    setTimeout(function(i) {

                        //Selects elements
                        boxElement = jQuery('#box' + i.toString());
                        valueElement = jQuery('#valueList' + i.toString());

                        //New color values
                        rgb = Array.from({length: 3}, () =>  Math.floor(Math.random() * 256));

                        //Converts the rgb values to hex and checks if there is a result
                        hex = rgbToHex(rgb[0], rgb[1], rgb[2]);
                        colorMatch = ntc.name(hex);

                        if ($('#DB').is(':checked')) {
                            sendToDB(rgb[0], rgb[1], rgb[2]);
                        }

                        //If color was an exact match
                        if (colorMatch[2] === true) {
                            boxElement.css('border', 'thick solid green');
                            colorName = " Exact Match: " + colorMatch[1];
                        }

                        //If the user wants to see the closest color match name
                        if ($('#closeMatch').prop('checked')) {
                            colorName = " Closest Match: " + colorMatch[1];
                        } else colorName = "";

                        //Sets colors for elements
                        boxElement.css('background-color', 'rgb(' + rgb[0].toString() + ',' + rgb[1].toString() + ',' + rgb[2].toString() + ')');
                        valueElement.text('RGB: (' + rgb[0] + ', ' + rgb[1] + ', ' + rgb[2] + ')' + colorName);


                        //Checks to see if the history header already exists and create it if not
                        if ( !$('#history').length) {
                            $('#valueList9').after("<br><br><hr><br><br><h3 id='history'>History (reverse order)</h3><br><br><hr>");
                        }

                        //Formats string and adds a paragraph with color values reflected in text
                        styleString = "rgb" + '(' + [rgb[0]] + ', ' + rgb[1] + ', ' + rgb[2] + ')';
                        $('#history')
                            .after('<p class="colorList" style="color: ' + styleString + '; font-size: larger">'
                                + styleString + colorName + '</p>');

                    }, i * time, i);                                                                //End setTimeout
                }                                                                                   //End for

                //Sends rgb values to insert_color.php to insert the rgb values into database
                function sendToDB(r, g, b) {

                    //var dataString = "?rnum=" + r + "&gnum=" + g + "&bnum=" + b;
                    $.post("insert_color.php",
                        {rnum: r, gnum: g, bnum: b},
                        function(response) {
                            if(response.status === "FALSE") {
                                $('#ajaxResult').append("FAILURE");
                            } else {
                                $('#ajaxResult').append("Success");
                            }
                        },
                        "text"
                    );
                }


                event.preventDefault();
            }); //End click function for button

            /*---------------------------------------------------------------------------
            Function source:    https://stackoverflow.com/a/5624139

            Authors:            https://stackoverflow.com/users/381345/casablanca
                                https://stackoverflow.com/users/96100/tim-down
                                https://stackoverflow.com/users/578895/mark-kahn
                                https://stackoverflow.com/users/632950/sindar
             */
            function rgbToHex(r, g, b) {
                return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
            }

            /*
            Function source:    https://stackoverflow.com/questions/5623838/rgb-to-hex-and-hex-to-rgb

            Authors:            https://stackoverflow.com/users/96100/tim-down
             */
            function hexToRgb(hex) {
                var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                return result ? {
                    r: parseInt(result[1], 16),
                    g: parseInt(result[2], 16),
                    b: parseInt(result[3], 16)
                } : null;
            }
            //----------------------------------------------------------------------------



        });
    </script>

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
        <h4 class="paragraph_head">AJAX Color Swatcher</h4>
        <p>This page will use PHP and AJAX to generate nine random colors using RGB values, and
         display them for the user. A history of the colors is available below the swatches, but in
        reverse order.</p>
        <p>When printing an exact match to a color that has a name, the swatch is highlighted green.
         If you want to see the color name for the closest representation, check the 'Show closest color names'
         checkbox.</p>

        <h4>Thanks,<br>Matt.</h4>

        <p id="ajaxResult"></p>



        <hr>
        <div>
            <br>
            <div>
                <label for="closeMatch">Show closest color names?</label>
                <input type="checkbox" id="closeMatch">
            </div>
            <br>
            <div>
                <input class="ajaxBtnStart" type="submit" name="start" id="start" value="Generate">
            </div>
            <br>
            <div>
                <label for="DB">Send palette to database?</label>
                <input type="checkbox" id="DB">
            </div>
            <br>
            <div>
                <input type="text" name="box1" id="box1" disabled style="width: 500px; height: 50px">
                <p id="valueList1"></p>
            </div>
            <br>
            <div>
                <input type="text" name="box2" id="box2" disabled style="width: 500px; height: 50px">
                <p id="valueList2"></p>
            </div>
            <br>
            <div>
                <input type="text" name="box3" id="box3" disabled style="width: 500px; height: 50px">
                <p id="valueList3"></p>
            </div>
            <br>
            <div>
                <input type="text" name="box4" id="box4" disabled style="width: 500px; height: 50px">
                <p id="valueList4"></p>
            </div>
            <br>
            <div>
                <input type="text" name="box5" id="box5" disabled style="width: 500px; height: 50px">
                <p id="valueList5"></p>
            </div>
            <br>
            <div>
                <input type="text" name="box6" id="box6" disabled style="width: 500px; height: 50px">
                <p id="valueList6"></p>
            </div>
            <br>
            <div>
                <input type="text" name="box7" id="box7" disabled style="width: 500px; height: 50px">
                <p id="valueList7"></p>
            </div>
            <br>
            <div>
                <input type="text" name="box8" id="box8" disabled style="width: 500px; height: 50px">
                <p id="valueList8"></p>
            </div>
            <br>
            <div>
                <input type="text" name="box9" id="box9" disabled style="width: 500px; height: 50px">
                <p id="valueList9"></p>
            </div>
        </div>
        <br><br>
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