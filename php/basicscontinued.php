<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basics Continued</title>
</head>
<body>
    <?php
        // Defining a constant
        define("PI", 3.14159426);
        print("Pi is:\t");
        printf("%.4f", PI);
    ?>
    <br><br>
    <?php
        print('Escape characters are included whithin single qoutes\n');
    ?>
    <br><br>
    <?php
        $website = "www.google.com";
        //HereDocs are a quick way to output a large amount of code at once using echo
        // <<<_NOTE - will start the doc and _NOTE; will end the doc. This can be used to 
        // output all of the html for a document
    ?>
    <br>
    <?php
        for ($kilometers = 1; $kilometers <=5; $kilometers++) {
            printf("%d kilometers is:\t %.3f miles.", $kilometers, $kilometers * 0.621371);
            print("<br>");
        }
    ?>
</body>
</html>