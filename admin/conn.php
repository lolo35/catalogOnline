<?php
$host = "localhost";
$dbname = "catalog_online";
$user = "root";
$passw = "";

$conn = new mysqli($host,$user,$passw,$dbname);

if($conn -> connect_error){
    die("Couldn't connect to mysql " . $conn -> connect_error);
}
/**
 * Created by PhpStorm.
 * User: raul.filimon
 * Date: 7/30/2018
 * Time: 10:29 AM
 */
?>
