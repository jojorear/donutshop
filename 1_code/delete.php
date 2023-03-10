<?php
// includes all of the content of connect.php for connecting to the database
include 'connect.php';

//starts a session for a specific user
session_start();

if(!isset($_SESSION['username'])){ //if the user is not logged in for the session
    header('location:index.php'); //redirect back to the login page and prevents access if not logged in
}

//when the deleteid is set based on what delete button was pressed
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid']; //getting delete id from url
    
    //sql query to delete the store with a certain id based on which delete button was pressed
    $sqlquery="delete from `stores` where id=$id";

    //runs query and stores whether the query worked
    $result=mysqli_query($connect,$sqlquery);
    if($result){ //if query sucessfully happened
        //Deleted Successfully from database
        header('location:home.php'); //goes back to the home.php or the homepage (store list)
    }else{ //give an error if query did not work
        die(mysqli_error($connect));
    }
}


?>