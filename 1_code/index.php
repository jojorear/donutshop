<?php
// creates login and invalid variables set to 0 to be used to check if the user entered the right credentials to log in
$login=0;
$invalid=0;

if($_SERVER['REQUEST_METHOD']== 'POST'){
    // includes all of the content of connect.php for connecting to the database
    include 'connect.php';

    //collects credentials user inputted and puts them into variables
    $username=$_POST['username'];
    $password=$_POST['password'];

    //sql query to check if there are any users in the database with a username and password that the user inputted
    $sqlquery="Select * from `users` where username='$username' and password='$password'";
    //executes sql query to database and gets results from database and stores query into result variable
    $result=mysqli_query($connect,$sqlquery);
    if($result){
        //counts number of rows inside of the database
        $num=mysqli_num_rows($result);
        if($num>0) { //Checks the number of rows that were returned from the database query result
            $login=1; //if there is a row in the database with the user credentials then the user is logged in
            session_start(); //starts the specific user session
            $_SESSION['username']=$username;
            header('location:home.php'); //directs to the home page or home.php
        }else{
            $invalid=1; //User and credentials is not in database
        }
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Login Page</title>
  </head>
  
  <body>
    <?php
    //if the invalid is true, the users credentials are not in the database, and display an error banner
    if($invalid){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error! </strong> Invalid credentials. Please try again.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
    ?>
    <?php
    //if the login is true, the users credentials are in the database and they are logged in, and display a success banner
    if($login){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success </strong> You are logged in successfully.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
    ?>

    <h1 class= "text-center">Login to Donut Shop Website</h1>
    <div class="container mt-5">
      <!--A form with labels and input text boxes to input user credentials-->
      <form action="index.php" method="post">
        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" class="form-control" placeholder="Enter your username" name="username">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>

        <!--Login button-->
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </body>
</html>