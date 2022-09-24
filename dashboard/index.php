<?php
include('../config.php');
include('../meal_date_time.php');

//session code
session_start();
if(!ISSET($_SESSION['user_email'])){
    header('location:admin_login.php');
}
$mail = $_SESSION['user_email'];


if($mail != 'superadmin@gmail.com')
{
    include('sidebar.php');
}
else{
    include('sidebar1.php');
}


    
    //Code for pass change suggestion
    $q = "SELECT * FROM canteen_app_user WHERE user_email = '$mail'";

    $res = mysqli_query($connection, $q);
    $data = mysqli_fetch_assoc($res);
    
    $password = "randomA@123456789";
    $key = "abcd1234";
    $pass = hash_hmac('sha256', $password, $key);
                
    $iterations = 10000;
    $pass_encode = hash_pbkdf2("sha256", $pass, $key, $iterations, 20);

    
//Meal Counts Show
    $sql = "SELECT * from canteen_counter WHERE meal_date = '$date'"; 

    
  if ($result = mysqli_query($connection, $sql)) {

    // Return the number of rows in result set
    $count = mysqli_num_rows( $result );

 }
 
 
 $sql1 = "SELECT * from canteen_counter WHERE meal_type = '$meal' AND meal_date = '$date'"; 

    
  if ($result1 = mysqli_query($connection, $sql1)) {

    // Return the number of rows in result set
    $count1 = mysqli_num_rows( $result1 );

 }


?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

        <title>Dashboard</title>
        
        <style>
            body{
                background-color: white;
            }
            
            .head{
                left:0;
                width: 100%;height:20px;background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%), linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%), linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%), linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%), linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%), linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%), linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%), linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%), linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);
                
            }
            .logo{
                background-color:white;
                
            }

            
        </style>
    </head>
    <body>
        <div class="head">
            
        </div>
         <center>
        <h3 class="text-danger" style="margin-left:10%;">
            <?php 
                if($data['user_pass'] == $pass_encode)
                {
                    echo "{ Password Change Required }";
                }
            ?>
            </h3>
       
            
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2" style="margin-top:5%; margin-left:20%;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center" style="margin:30px;">
                                        <div class="col mr-3">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 30px;">
                                                Total Count For Meals Today: </div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800" style="font-size: 100px;text-shadow: 0 0 7px black;"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
            
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2" style="margin-left:20%;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center" style="margin:30px;">
                                        <div class="col mr-3">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 20px;">
                                                Total Count For Meal: <?php echo $meal;?></div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800" style="font-size: 100px;text-shadow: 0 0 7px black;"><?php echo $count1; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


            </center>
            
            
            <footer class="head" style="position: fixed;
   left: 0;
   bottom: 0;
   wi25h: 100%25   text-align: center;;">
            
        </footer>
            
        
    </body>

</html>
