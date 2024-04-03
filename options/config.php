<?php
$servername = "10.10.2.140\SQLEXPRESS";
$username = "maria";
$password = "qwerty@12345";
$dbname = "Cyberia";

$connectionOptions = array(
    "Database" => $dbname,
    "Uid" => $username,
    "PWD" => $password
);

$conn = sqlsrv_connect($servername, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>
