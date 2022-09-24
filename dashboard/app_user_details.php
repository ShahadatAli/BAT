<?php
include('../config.php');

session_start();
if(!ISSET($_SESSION['user_email'])){
    header('location:admin_login.php');
}


$mail = $_SESSION['user_email'];

if($mail != 'superadmin@gmail.com')
{
    echo '<script>alert("This is not a Super Admin"); location.replace(document.referrer);</script>';
}
else{
    include('sidebar1.php');
}



$sql = "SELECT * FROM canteen_app_user";

$result = mysqli_query($connection, $sql);


//Delete User
if (isset($_POST['user_email']) && isset($_POST['user_name'])) {

    $email = $_POST['user_email'];
    
    
    $sql = "DELETE from canteen_app_user WHERE user_email='$email'";
    
    if (mysqli_query($connection, $sql)) {
                 echo '<script type="text/javascript">'; 
                echo 'alert("User Deleted");'; 
                echo 'window.location.href = "app_user_details.php";';
                echo '</script>';
    } else {
                 echo '<script type="text/javascript">'; 
                echo 'alert("Deletion Error");'; 
                echo 'window.location.href = "app_user_details.php";';
                echo '</script>';
    }
}

//Reset Password
if (isset($_POST['user_email']) && isset($_POST['reset_pass'])) {
    
    $email = $_POST['user_email'];
    $password = 'randomA@123456789';
    
     $key = "abcd1234";
    $pass = hash_hmac('sha256', $password, $key);
        
    $iterations = 10000;
    $pass_encode = hash_pbkdf2("sha256", $pass, $key, $iterations, 20);
    
    
    $sql = "UPDATE canteen_app_user SET user_pass ='$pass_encode' WHERE user_email='$email'";
    
    if (mysqli_query($connection, $sql)) {
                 echo '<script type="text/javascript">'; 
                echo 'alert("Password Reset to randomA@123456789");'; 
                echo 'window.location.href = "app_user_details.php";';
                echo '</script>';

    } else {
                 echo '<script type="text/javascript">'; 
                echo 'alert("Error");'; 
                echo 'window.location.href = "app_user_details.php";';
                echo '</script>';
    }
}

//Reset attempts
if (isset($_POST['submit_attempts'])) {

    $email = $_POST['user_email'];
    
    
    $sql = "UPDATE canteen_app_user SET attempts=0 WHERE user_email='$email'";
    
    if (mysqli_query($connection, $sql)) {
                 echo '<script type="text/javascript">'; 
                echo 'alert("Account Unlocked!");'; 
                echo 'window.location.href = "app_user_details.php";';
                echo '</script>';
    } else {
                 echo '<script type="text/javascript">'; 
                echo 'alert("Unlock Error");'; 
                echo 'window.location.href = "app_user_details.php";';
                echo '</script>';
    }
}



?>


<!DOCTYPE html>

<head>

    <title>User Details</title>

    
    <style>
            .head{
                left:0;
                width: 100%;height:20px;background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%), linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%), linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%), linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%), linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%), linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%), linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%), linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%), linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);
                
            }

            button{
                margin:3px;
                width: 90px;
            }
            .reset{
               
                line-height: 0.9;
            }
            .container-fluid{
                margin-left: 200px; width: 80%;
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
    <div class="container-fluid" style="">
            
            
        <div class="row row justify-content-center">
            
            <div class="col-md-8 col-md-offset-2" style="margin-top: 1%;">

                <h1 style="text-align: center;">User List</h1>
                <div class="table">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Password</th>
                                <th>Actions</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <?php while($row = mysqli_fetch_object($result)){ ?>
                        <tr>
                            <td><?php echo $row->user_name ?></td>
                            <td><?php echo $row->user_email ?></td>
                            <td><?php echo $row->user_type ?></td>
                            <td><?php echo $row->user_pass ?></td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" id="user_email" name="user_email" value="<?php echo $row->user_email ?>">
                                    <input type="hidden" id="user_name" name="user_name" value="<?php echo $row->user_name ?>">
                                    <button name="submit" class="btn btn-outline-danger" onclick="return confirm('Confirm Delete User?')">Delete</button>
                                </form>
                                
                                <form action="" method="POST">
                                    <input type="hidden" id="user_email" name="user_email" value="<?php echo $row->user_email ?>">
                                    <input type="hidden" id="reset_pass" name="reset_pass" value="<?php echo $row->user_pass ?>">
                                    <button name="submit" class="btn btn-outline-warning reset" style="color:#806600;">Reset Password</button>
                                </form>
                            </td>
                            
                            <td>
                                <?php 
                                if($row->attempts>4)
                                {
                                    echo "<p class='text-danger' style='margin:12px;'>Locked</p>";
                                    ?>
                                     <form action="" method="POST">
                                        <input type="hidden" id="user_email" name="user_email" value="<?php echo $row->user_email ?>">
                                        
                                        <button name="submit_attempts" class="btn btn-outline-info">Unlock</button>
                                    </form>
                                    <?php
                                }
                                else{
                                    echo "Not Locked";
                                }
                                
                                ?>
                            </td>
                        </tr>
                        <?php  } ?>
                    </table>
                    </div>
                
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
                $(document).ready(function () {
                    $('#example').DataTable({
                       order: [[1, 'asc']],
                    });
                });
            </script>
    

</body>

</html>
