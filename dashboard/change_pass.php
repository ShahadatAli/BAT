<?php
include('../config.php');

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


if(isset($_POST['current_pass']) && isset($_POST['new_pass']) && isset($_POST['re_new_pass'])){
    
    $current_pass=$_POST['current_pass'];
    $password=$_POST['new_pass'];
    $re_password=$_POST['re_new_pass'];
    
    
    $sql = "SELECT * FROM canteen_app_user WHERE user_email = '$mail'";

    $result = mysqli_query($connection, $sql);
    $data = mysqli_fetch_assoc($result);
    

    $key = "abcd1234";
    $cur_pass = hash_hmac('sha256', $current_pass, $key);
                
    $iterations = 10000;
    $cur_pass_encode = hash_pbkdf2("sha256", $cur_pass, $key, $iterations, 20);
    
    if($data['user_pass'] != $cur_pass_encode)
    {
        echo "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\" style=\"text-align:center;\">Please Enter Your Correct Password</div>";
    }
    else{
            if($password == $re_password)
            {
                        // Validate password strength
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);
                
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 16 || strlen($password) > 64) {
                    echo '<script>alert("Password should be at least 16 characters in length and should include at least one upper case letter, one number, and one special character.")</script>';
                   
                }
                
                    else
                    {
                        
                        $key = "abcd1234";
                        $pass = hash_hmac('sha256', $password, $key);
                        
                        $iterations = 10000;
                        $pass_encode = hash_pbkdf2("sha256", $pass, $key, $iterations, 20);
                        
                        
                        $result = $connection->query("SELECT user_email FROM canteen_app_user WHERE user_email = '$mail'");
                        if($result->num_rows == 0) {
                            // row not found...
                        
                            echo '<script type="text/javascript">'; 
                            echo 'alert("Password change error");'; 
                            echo 'window.location.href = "change_pass.php";';
                            echo '</script>';
                        } else {
                            // do other stuff...
                            mysqli_query($connection, "UPDATE canteen_app_user SET user_pass ='$pass_encode' WHERE user_email='$mail'");
                            echo '<script type="text/javascript">'; 
                            echo 'alert("Password Changed Successfully!");'; 
                            echo 'window.location.href = "index.php";';
                            echo '</script>';
                        }
                        
                    }
                 
            }
        
    }

}


?>


<!DOCTYPE html>

<head>

    <title>Change Password</title>


    <style>
        .head {
            left: 0;
            width: 100%;
            height: 20px;
            background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%), linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%), linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%), linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%), linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%), linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%), linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%), linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%), linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);

        }
        
       @media(max-width : 860px){
            .container-fluid{
                margin-left:80px;
            }
        }


    </style>


</head>

<body>

    <div class="head">

    </div>
    <br>
    <div class="container-fluid">


        <div class="row row justify-content-center">

            <div class="col-md-12 col-md-offset-4" style="margin-top: 1%;">

                <center>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary h-100 py-4 box">
                            <div class="card-body">
                                <h1>Change Your Password</h1>
                                <div class="row no-gutters align-items-center" style="margin: 25px 40px 25px 40px;">
                                    <div class="col mr-3">

                                        <form action="" method="POST" class="login-email">

                                            <div class="input-group">
                                                <div class="input-group">
                                                    <label>Current Password</label>
                                                </div>

                                                <input type="password" class="form-control col-xs-4" placeholder="Current Password" name="current_pass" required>
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <div class="input-group">
                                                    <label>New Password</label>
                                                </div>
                                                <input type="password" class="form-control col-xs-4" placeholder="New" id="new_pass" name="new_pass" onkeyup='check();' required>
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <div class="input-group">
                                                    <label>Re-type New Password</label>
                                                </div>
                                                <input type="password" class="form-control col-xs-4" placeholder="Re-type" id="re_new_pass" name="re_new_pass" onkeyup='check();' required>
                                            </div>

                                            <span id='message'></span>

                                            <br>
                                            <br>

                                            <div class="col-md-12 text-center">
                                                <button name="submit" class="btn btn-dark">Confirm</button>
                                            </div>

                                            <br>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>


            </div>
        </div>


    </div>
    <br>
    <footer class="head" style="
                    position: fixed;
                   left: 0;
                   bottom: 0;
                   width: 100%;   text-align: center;">

    </footer>

    <!-- datatables export functions -->

    <script>
        var check = function() {
            if (document.getElementById('new_pass').value ==
                document.getElementById('re_new_pass').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'matching';
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
            }
        }

    </script>


</body>

</html>
