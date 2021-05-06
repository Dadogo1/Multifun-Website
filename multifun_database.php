<?php
$multifun_database = mysqli_connect("localhost", "domingd5_double", "Gomez25!", "domingd5_multifun_database");
if (!$multifun_database) {
    die("CONNECTION FAIL: " . mysqli_connection_error());
}
?>