// Iterates over an array containing string of remaining assignments
function printAssignments(){
    listStr = "<ol id='assignments'>";
    var assignments = 
        [
            '<a href="index.php">Homepage</a>',
            '<a href="apache-php-mysql.php">Apache/PHP/MySQL Server</a>',
            '<a href="cis475/index.php">First PHP Webpage</a>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/vars.php" target="_blank">(Download vars.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/index.php" target="_blank">(Download index.php)</a></li>',
            '<a href="cis475/lfa.php">PHP Page: LFA</a>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/lfa.php" target="_blank">(Download lfa.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/vars.php" target="_blank">(Download vars.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/functions.php" target="_blank">(Download functions.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/index.php" target="_blank">(Download index.php)</a></li>',
            '<a href="cis475/fileio.php">File IO Page</a>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/fileio.php" target="_blank">(Download fileio.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/vars.php" target="_blank">(Download vars.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/functions.php" target="_blank">(Download functions.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/cis475_io.txt" target="_blank">(Download cis475_io.txt)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/cis475_ior.txt" target="_blank">(Download cis475_ior.txt)</a></li>',
            '<a href="cis475/db.php">Create and Populate a MySQL Table</a>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/db.php" target="_blank">(Download db.php)</a></li>' +
                ' <li class="downloadlists"><a href="download.php?path=cis475/db_functions.php" target="_blank">(Download db_functions.php)</a></li>',
            '<a href="cis475/php_mysql_table.php">Create an HTML5/PHP Table From a MySQL Database</a>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/php_mysql_table.php" target="_blank">(Download php_mysql_table.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/db_functions.php" target="_blank">(Download db_functions.php)</a></li>',
            '<a href="cis475/php_mysql_form.php">PHP Form That Populates A Table</a>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/php_mysql_form.php" target="_blank">(Download php_mysql_form.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/sc.php" target="_blank">(Download sc.php) - contacts Processing Script</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/db_functions.php" target="_blank">(Download db_functions.php) - Creates the contacts table</a></li>',
            '<a href="cis475/php_ajax.php">PHP AJAX Page</a>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/php_ajax.php" target="_blank">(Download php_ajax.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/styles.css" target="_blank">(Download styles.css)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/insert_color.php" target="_blank">(Download insert_color.php)</a></li>',
            'Create a User Registeration Site',
            'Create a User Login Site',
            'Create an Admin Web Site',
            '<a href="cis475/opendata_index.php">Create a Web Page to Access OpenData</a>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/opendata_index.php" target="_blank">(Download opendata_index.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=cis475/functions.php" target="_blank">(Download functions.php)</a></li>' +
                '<li class="downloadlists"><a href="download.php?path=styles.css" target="_blank">(Download styles.css)</a></li>',
            'Connect With Professor Gerland On LinkedIn (Extra Credit)',
            'Brief Introduction',
        ];
    for (i = 0; i < 13; i++) {
        listStr += "<li class='assignment'>" + assignments[i] + "</li>";
    }
    listStr += "</ol>";
    document.write(listStr);
}

function printTime(){
    // Creates a Date object then writes the formatted string
    document.write("<br><h3 class='paragraph_head'>Current Time and Date</h3>");
    now = new Date();
    
    document.write("<h3>" + now.toLocaleString('en-US', 
        {hour: 'numeric',
        minute: 'numeric',
        hour12: true}) + "</h3>"
    );
}
