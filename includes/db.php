<?php  

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "root";
$db['db_name'] = "cms";

foreach($db as $key => $value) {
    
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

function makeQuery($query){
    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function confirmQuery($result) {
    global $connection;
    if(!$result) {
        return die("<br>QUERY FAILED " . mysqli_error($connection));
    }
}


?>