<?php
    $r = $_POST['rnum'];
    $g = $_POST['gnum'];
    $b = $_POST['bnum'];

    $mysqli = dbConnect();

    $query = "INSERT INTO color_history (r, g, b) VALUES (?, ?, ?)";
    $statement = $mysqli -> stmt_init();
    $statement -> prepare($query);
    $statement -> bind_param('iii', $r, $g, $b);
    $statement -> execute();
