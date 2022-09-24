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




if(isset($_POST['uname']) && isset($_POST['umail']) && isset($_POST['upass']) && isset($_POST['utype'])){

    $i=$_POST['uname'];
    $j=$_POST['umail'];
    $k=$_POST['utype'];
    $password=$_POST['upass'];
    
    
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
        //hashing according to BAT standard
        $key = "abcd1234";
        $pass = hash_hmac('sha256', $password, $key);
        
        $iterations = 10000;
        $pass_encode = hash_pbkdf2("sha256", $pass, $key, $iterations, 20);
        
        
        $result = $connection->query("SELECT user_email FROM canteen_app_user WHERE user_email = '$j'");
        if($result->num_rows == 0) {
            // row not found...
            mysqli_query($connection, "insert into canteen_app_user (user_name, user_email, user_type, user_pass) values ('$i','$j','$k','$pass_encode')");
        
            echo '<script type="text/javascript">'; 
            echo 'alert("User Added");'; 
            echo 'window.location.href = "create-user.php";';
            echo '</script>';
        } else {
            // do other stuff...
             echo '<script type="text/javascript">'; 
            echo 'alert("Email Exists. Use Another Email.");'; 
            echo 'window.location.href = "create-user.php";';
            echo '</script>';
        }
        
    }


}


?>


<!DOCTYPE html>

<head>

    <title>Create User</title>
    <!-- Datatable links add -->
    <!-- JS -->


 
    
    
    <style>
            .head{
                left:0;
                width: 100%;height:20px;background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%), linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%), linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%), linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%), linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%), linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%), linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%), linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%), linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);
                
            }

            </style>
            
 
</head>

<body>
    
    <div class="head">
            
    </div>

    <div class="container-fluid" style="margin-left: 220px; width: 80%; margin-top:1%;">
            
        <br><br>
        <div class="row justify-content-center">
            <h1>Create Application User</h1>
        </div>
        <br>
        <div class="row justify-content-md-center">

            
            <div class="col-4" style="">
                 
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="uname" id="uname" class="form-control col-xs-4"  placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="umail" id="umail" class="form-control"  placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="upass" id="upass" class="form-control"  placeholder="Password" required>
                        <p id="pass_validation"></p>
                    </div>
                    
                    
                     <div class="form-group">
                         <label>User Type: </label>
                         <div>
                                <select name="utype" id="utype" required>
                                     <option disabled selected value> -- select an option -- </option>
                                    <option value="general admin">General Admin</option>
                                    <option value="canteen Admin">Canteen Admin</option>
                                    <option value="employee">Employee</option>
                                </select>
                                </div>
                    </div>
                    <br>
                    <div class="col-md-12 text-center">
                        <input type="submit" class="btn btn-success" value="CREATE" style="padding: 8px 20px 8px;">
                    </div>
                </form>
            </div>
            
            
        </div>
        <br>

        
       
    </div>

    <br>
    
    <footer class="head" style="
        position: fixed;
       left: 0;
       bottom: 0;
       width: 100%;   text-align: center;">
                
    </footer>

    

</body>

</html>
