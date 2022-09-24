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


$sql = "SELECT * FROM canteen_user_data WHERE RFID_NO != '0'";

$result = mysqli_query($connection, $sql);


    $serial_id = $_POST['sl'];
    $rfid = $_POST['rfid'];
    $emp_no = $_POST['emp_no'];
    $emp_name = $_POST['emp_name'];
    $desig = $_POST['desig'];
    $dep = $_POST['dep'];

?>


<!DOCTYPE html>

<head>

    <title>Edit Users</title>

    
    <style>
            .head{
                left:0;
                width: 100%;height:20px;background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%), linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%), linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%), linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%), linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%), linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%), linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%), linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%), linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);
                
            }
            .generate{
                margin-right:15px;
            }
            .show-all{
                margin-left:15px;
            }

            </style>
            
 
</head>

<body>
    
    <div class="head">
            
    </div>
    <br>
    <div class="container-fluid" style="margin-left: 200px; width: 80%;">
            
            
        <div class="row row justify-content-center">
            
            <div class="col-md-8 col-md-offset-2" style="margin-top: 1%;">

                <h1 style="text-align: center;">Edit User</h1>
                
                <form action="edit_delete_code.php" method="POST">
                    <div class="form-group">
                        <label>Employee ID:</label>
                        <input type="text" name="uid" id="uid" class="form-control col-xs-4"  placeholder="<?php echo $emp_no; ?>" value="<?php echo $emp_no; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Employee Name:</label>
                        <input type="text" name="uname" id="uname" class="form-control col-xs-4"  placeholder="<?php echo $emp_name; ?>" value="<?php echo $emp_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Designation:</label>
                        <input type="text" name="udes" id="udes" class="form-control col-xs-4"  placeholder="<?php echo $desig; ?>" value="<?php echo $desig; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Department:</label>
                        <input type="text" name="udep" id="udep" class="form-control col-xs-4"  placeholder="<?php echo $dep; ?>" value="<?php echo $dep; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>RFID:</label>
                        <input type="number" name="urfid" id="urfid" class="form-control col-xs-4"  placeholder="<?php echo $rfid; ?>" value="<?php echo $rfid; ?>" required>
                    </div>
                    
                    <input type="hidden" id="serial" name="serial" value="<?php echo $serial_id ?>">
                    
                    <div class="col-md-12 text-center">
                        <input type="submit" name="edit_user" class="btn btn-success" value="Confirm Changes" style="padding: 8px 20px 8px;">
                    </div>
                </form>
                <br>
                
                    <div class="col-md-12 text-center">
                        <button class="btn btn-secondary" 
    onclick="window.location.href = 'user_list.php'">
        Back
    </button>
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

    

</body>

</html>
