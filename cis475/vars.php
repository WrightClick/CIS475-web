<?php
    $title = "PHP Index Page";
    $pageName = "PHP Homepage";
    $serverSoftware = $_SERVER['SERVER_SOFTWARE'];
    $editorUsed = "PhpStorm";
    $metaKeywords = [
        'HTML',
        'Tag',
        'CSS',
        'Homepage',
        'Index',
        'PHP',
        'Code',
        'JavaScript',
        'JS',
        'HTML5',
        'CSS3',
        'Page'
    ];
    $metaTags = [
        '<meta charset="UTF-8">',
        '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
        '<meta http-equiv="X-UA-Compatible" content="ie=edge">',
        '<meta name="author" content="Matthew Wright">',
        '<meta name="generator" content="PhpStorm">',
        '<link rel="stylesheet" type="text/css" href="../styles.css">',
        '<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">',
    ];
    $assignments = [
        '<a href="../index.php">Homepage (Non-PHP)</a>',
        '<a href="../apache-php-mysql.php">Apache/PHP/MySQL Server</a>',
        '<a href="index.php">First PHP Page</a> 
            <li class="downloadlists"><a href="../download.php?path=cis475/vars.php" target="_blank">(Download vars.php)</a></li> 
            <li class="downloadlists"><a href="../download.php?path=cis475/index.php" target="_blank">(Download index.php)</a></li> ',
        '<a href="lfa.php">PHP Page: LFA</a> 
            <li class="downloadlists"><a href="../download.php?path=cis475/lfa.php" target="_blank">(Download lfa.php)</a></li> 
            <li class="downloadlists"><a href="../download.php?path=cis475/vars.php" target="_blank">(Download vars.php)</a></li> 
            <li class="downloadlists"><a href="../download.php?path=cis475/functions.php" target="_blank">(Download functions.php)</a></li> 
            <li class="downloadlists"><a href="../download.php?path=cis475/index.php" target="_blank">(Download index.php)</a></li> ',
        '<a href="fileio.php">File IO Page</a>
            <li class="downloadlists"><a href="../download.php?path=cis475/fileio.php" target="_blank">(Download fileio.php)</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/vars.php" target="_blank">(Download vars.php)</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/functions.php" target="_blank">(Download functions.php)</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/cis475_io.txt" target="_blank">(Download cis475_io.txt)</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/cis475_ior.txt" target="_blank">(Download cis475_ior.txt)</a></li>',
        '<a href="db.php">Create and Populate a MySQL Table</a>
            <li class="downloadlists"><a href="../download.php?path=cis475/db.php" target="_blank">(Download db.php)</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/db_functions.php" target="_blank">(Download db_functions.php)</a></li>',
        '<a href="php_mysql_table.php">Create an HTML5/PHP Table From a MySQL Database</a>
            <li class="downloadlists"><a href="../download.php?path=cis475/php_mysql_table.php" target="_blank">(Download php_mysql_table.php)</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/db_functions.php" target="_blank">(Download db_functions.php)</a></li>',
        '<a href="php_mysql_form.php">PHP Form That Populates A Table</a>
            <li class="downloadlists"><a href="../download.php?path=cis475/php_mysql_form.php" target="_blank">(Download php_mysql_form.php)</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/sc.php" target="_blank">(Download sc.php) - contacts Processing Script</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/db_functions.php" target="_blank">(Download db_functions.php) - Creates the contacts table</a></li>',
        '<a href="php_ajax.php">PHP AJAX Page</a>
            <li class="downloadlists"><a href="../download.php?path=cis475/php_ajax.php" target="_blank">(Download php_ajax.php)</a></li>
            <li class="downloadlists"><a href="../download.php?path=styles.css" target="_blank">(Download styles.css)</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/insert_color.php" target="_blank">(Download insert_color.php)</a></li>',
        'Create a User Registeration Site',
        'Create a User Login Site',
        'Create an Admin Web Site',
        '<a href="opendata_index.php">Create a Web Page to Access OpenData</a>
            <li class="downloadlists"><a href="../download.php?path=cis475/opendata_index.php" target="_blank">(Download opendata_index.php)</a></li>
            <li class="downloadlists"><a href="../download.php?path=cis475/functions.php" target="_blank">(Download functions.php)</a></li>
            <li class="downloadlists"><a href="../download.php?path=styles.css" target="_blank">(Download styles.css)</a></li>',
        'Connect With Professor Gerland On LinkedIn (Extra Credit)',
        'Brief Introduction',
    ];

    //Forces all php errors to be displayed by web server
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);



