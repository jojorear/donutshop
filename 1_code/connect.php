<?php
// Adds variables for connecting to the database
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='';
$DATABASE='donutshop';

//function to coonnect to the database
$connect=mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

//If the the software does not connect to the database properly, show an error
if(!$connect){
    die(mysqli_error($connect));
}

?>