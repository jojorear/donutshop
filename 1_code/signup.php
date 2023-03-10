<?php
// creates success and user variables set to 0 to be used to check if the user and their username already exists and if the sign up was successful
$success=0;
$user=0;

if($_SERVER['REQUEST_METHOD']== 'POST'){
    // includes all of the content of connect.php for connecting to the database
    include 'connect.php';

    //collects credentials user inputted and puts them into variables
    $username=$_POST['username'];
    $password=$_POST['password'];

    //sql query to check if there is any users in the database with a username and password that the user inputted
    $sqlquery="Select * from `users` where username='$username'";
    //executes sql query to database and gets results from the database and stores query into result variable
    $result=mysqli_query($connect,$sqlquery);
    if($result){
        //counts number of rows inside of the database
        $num=mysqli_num_rows($result);
        if($num>0) {
           //User already exists
           $user=1;
        }else{ //user does not exists and gets created or inserted with sql query
             $sqlquery="insert into `users`(username,password) values('$username', '$password')";
             $result=mysqli_query($connect,$sqlquery);
        if($result){
            //Signup Successful
            $success=1;
            header('location:index.php'); //directs to the login page or index.php to have user log in
        } else { //if query does not work, give an error
            die(mysqli_error($connect));
        }
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

    <title>Signup Page</title>
  </head>
  <body>
  
    <?php
    //if the user is true, the users already exists in the database, and display an error banner
    if($user){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Oh no sorry!</strong> User already exists.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
      </div>';
    }
    ?>
    <?php
    //if the success is true, the the user signed up successfully, and display a success banner
    if($success){
     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success </strong> You are successfully signed up.
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
      </div>';
    }
    ?>
    <h1 class= "text-center">Sign up Page</h1>
    <div class="container mt-5">
    <!--A form with labels and input text boxes to input user credentials to sign up-->
     <form action="signup.php" method="post">
       <div class="form-group">
         <label for="exampleInputEmail1">Name</label>
         <input type="text" class="form-control" placeholder="Enter your username" name="username">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
         <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
       </div>
       
       <!--Sign up button-->
        <button type="submit" class="btn btn-primary">Sign up</button>
      </form>
   </div>
  </body>
</html>