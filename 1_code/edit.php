<?php
// includes all of the content of connect.php for connecting to the database
include 'connect.php';

//starts a session for a specific user
session_start();

if(!isset($_SESSION['username'])){ //if the user is not logged in for the session
    header('location:index.php');//redirect back to the login page and prevents access if not logged in
}

$id=$_GET['editid']; //access id

//sql query to select the store and its information with a certain id based on which edit button was pressed
$sqlquery="Select * from `stores` where id=$id";

//runs query and stores whether the query worked
$result=mysqli_query($connect,$sqlquery);
$row=mysqli_fetch_assoc($result); //getting the query result store information related to one specific id or store row
$store_name=$row['store_name']; //passing column name from database
$street_address=$row['street_address'];
$city=$row['city'];
$state=$row['state'];
$zip_code=$row['zip_code'];
$phone_number=$row['phone_number']; 

//collect form data when the submit button is pressed
if(isset($_POST['submit'])){

    //collects form data and puts them into variables
    $store_name=$_POST['store_name'];
    $street_address=$_POST['street_address'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $zip_code=$_POST['zip_code'];
    $phone_number=$_POST['phone_number'];

    //sql query to update or edit each attributes or columns in the row in the database
    $sqlquery="update `stores` set id=$id,store_name='$store_name',street_address='$street_address',city='$city',state='$state',zip_code='$zip_code',phone_number='$phone_number' where id=$id";
    $result=mysqli_query($connect,$sqlquery);
    if($result){ //if query is true
        //Edited successfully
        header('location:home.php'); //goes back to the home.php or the homepage (store list)
    } else{ //give an error if query did not work
        die(mysqli_error($connect));
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <!--Attaches External Style CSS sheet-->
    <link rel="stylesheet" href="style.css">

    <title>Edit Store Information</title>
</head>

<body>
    <!--Navigation bar with a title and links to the store list and log out-->
    <nav class="navbar"> 
        <a href="home.php" class="navItem">Store List</a>
        <h2 class="title">Donut Shop</h2>
        <h5 class="loggedInUser">Welcome
        <?php echo $_SESSION['username'];?>
        </h5>
        <a href="logout.php" class="navItem logout">Logout</a>
    </nav>

    <div class="container my-5">
        <h1>Edit Store Information</h1>
        <!--A form with labels and input text boxes to input/edit store information-->
        <form method="post">
            <div class="form-group">
                <label>Store Name</label>
                <input type="text" class="form-control" placeholder="Enter Store Name" name="store_name" autocomplete="off" value="<?php echo $store_name;?>">
            </div>

            <h4><u>Location</u></h4>

            <div class="form-group">
                <label>Store Street Address</label>
                <input type="text" class="form-control" placeholder="Enter Store Street Address" name="street_address" autocomplete="off" value="<?php echo $street_address;?>">
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" placeholder="Enter City" name="city" autocomplete="off" value="<?php echo $city;?>">
            </div>

            <div class="form-group">
                <label>State</label>
                <input type="text" class="form-control" placeholder="Enter State" name="state" autocomplete="off" value="<?php echo $state;?>">
            </div>

            <div class="form-group">
                <label>Zip Code</label>
                <input type="text" class="form-control" placeholder="Enter Zip Code" name="zip_code" autocomplete="off" value="<?php echo $zip_code;?>">
            </div>

            <h4><u>Contact Information</u></h4>

            <div class="form-group">
                <label>Store Phone Number</label>
                <input type="text" class="form-control" placeholder="Enter Store Phone Number" name="phone_number" autocomplete="off" value="<?php echo $phone_number;?>">
            </div>

            <!--Submit edit button-->
            <button type="submit" class="btn btn-primary" name="submit">Submit Edit</button>
        </form>
    </div>



  </body>
</html>