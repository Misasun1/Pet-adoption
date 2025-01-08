<?php

try {
    $host = "localhost";
    $user = "root";
    $password = "";
    // create at first a database in phpmyadmin
    $database = "";

    $connect = mysqli_connect(
        $host,
        $user,
        $password,
        $database
    );
    // echo 'Successful connection';
} catch (mysqli_sql_exception $excep) {
    echo "connection to database failed" . $excep->getMessage();
}




function cleanData($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
