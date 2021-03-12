<?php

$hn = "localhost";
$un = "John";
$pw = "804315";
$db = "trackme";
//table users ---id /username/useremail/pwd 
$conn = mysqli_connect($hn,$un, $pw, $db);
if(!$conn){
    die ("Could not connect: ".mysqli_connect_error());
}