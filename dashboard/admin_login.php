<?php 

include '../config.php';

session_start();

error_reporting(0);


if (isset($_SESSION['user_email'])) {
    header("Location: index.php");
}


if (isset($_POST['submit'])) {
    $email = $_POST['user_email'];
    $password = $_POST['password'];
    
    //hashing according to BAT standard
    $key = "abcd1234";
    $pass = hash_hmac('sha256', $password, $key);
        
    $iterations = 10000;
    $pass_encode = hash_pbkdf2("sha256", $pass, $key, $iterations, 20);
    

    $sql = "SELECT * FROM canteen_app_user WHERE user_email='$email' AND user_pass='$pass_encode'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    
    if ($result->num_rows > 0) {
        
        
        if($row['attempts']>4){
            $msg = "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Your account is locked. Please contact with the Authority.</div>";
            echo $msg;
            
        }else{
                    $sql = "UPDATE canteen_app_user SET attempts=0 WHERE user_email='$email'";
                    $result = mysqli_query($connection, $sql);
                    
                    
                    $_SESSION['user_email'] = $row['user_email'];
                    header("Location: index.php");
                    
        }
        

    } else {
        
        $sql = "UPDATE canteen_app_user SET attempts=attempts+1 WHERE user_email='$email'";
        $result = mysqli_query($connection, $sql);
        echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
    }
}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: rgb(14, 43, 99);
        }

        .box {
            box-shadow: 0 0 6px white;
        }

    </style>

    <title>Login</title>
</head>

<body>
    <div class="text-center">
        <img src="bat-white.png" style="height:80px;margin-top:5%;">
    </div>


    <div class="container-fluid" style="margin-top:3%;">
        <center>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary h-100 py-4 box">
                    <div class="card-body">
                        <p class="login-text" style="font-size: 2rem; font-weight: 800;color:rgb(14, 43, 99); ">Login</p>
                        <div class="row no-gutters align-items-center" style="margin: 25px 40px 25px 40px;">
                            <div class="col mr-3">

                                <form action="" method="POST" class="login-email">

                                    <div class="input-group">
                                        <i class="fa fa-user fa-lg" style="margin: 18px 10px 0px 0px; color:grey;"></i>
                                        <input type="email" class="form-control col-xs-4" placeholder="Email" name="user_email" value="<?php echo $user_email; ?>" required>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <i class="fa fa-key fa-lg" style="margin: 19px 8px 0px 0px; color:grey;"></i>
                                        <input type="password" class="form-control col-xs-4" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
                                    </div>
                                    <br>

                                    <div class="col-md-12 text-center">
                                        <button name="submit" class="btn btn-success">LOG IN</button>
                                    </div>
                                    <br>

                                </form>

                            </div>

                        </div>
                                    <p><?php 
                                        $q = "SELECT * FROM canteen_app_user WHERE user_email='$email'";
                                        $res = mysqli_query($connection, $q);
                                        $roww = mysqli_fetch_assoc($res);
                                        $attempt = $roww['attempts'];
                                        
                                        if($attempt < 5){
                                            echo "Login attempts left: " . 5 - $attempt; 
                                        }
                                        elseif($attempt > 5){
                                             $msg = "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">You have attempted the maximum amount of tryouts</div>";
                                            echo $msg;
                                        }
                                    ?></p>

                                    <br>
                    </div>
                </div>
            </div>
        </center>
    </div>




</body>

</html>
