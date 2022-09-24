<?php
include('../config.php');

//session code
session_start();
if(!ISSET($_SESSION['user_email'])){
    header('location:admin_login.php');
}

$mail = $_SESSION['user_email'];

//check if the user is superuser
if($mail != 'superadmin@gmail.com')
{
    include('sidebar.php');
}
else{
    include('sidebar1.php');
}


$sql = "SELECT * FROM canteen_user_data WHERE RFID_NO != '0'";

$result = mysqli_query($connection, $sql);


?>


<!DOCTYPE html>

<head>

    <title>User List</title>

    
    <style>
            .head{
                left:0;
                width: 100%;height:20px;background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%), linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%), linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%), linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%), linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%), linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%), linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%), linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%), linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);
                
            }
            
            .container-fluid{
                margin-left: 200px; 
                width: 80%;
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
                                <th>Emp No.</th>
                                <th>Employee Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>RFID No.</th>
                                <th>Actions</th>
            
                            </tr>
                        </thead>
                        <?php while($row = mysqli_fetch_object($result)){ ?>
                        <tr>
                            <td><?php echo $row->EMP_NO ?></td>
                            <td><?php echo $row->EMPLOYEE_NAME ?></td>
                            <td><?php echo $row->DESIGNATION ?></td>
                            <td><?php echo $row->DEPARTMENT ?></td>
                            <td><?php echo $row->RFID_NO ?></td>
                            <td>
                                <form action="edit_user.php" method="POST">
                                    <input type="hidden" id="rfid" name="rfid" value="<?php echo $row->RFID_NO ?>">
                                    <input type="hidden" id="sl" name="sl" value="<?php echo $row->SL ?>">
                                    <input type="hidden" id="emp_no" name="emp_no" value="<?php echo $row->EMP_NO ?>">
                                    <input type="hidden" id="emp_name" name="emp_name" value="<?php echo $row->EMPLOYEE_NAME ?>">
                                    <input type="hidden" id="desig" name="desig" value="<?php echo $row->DESIGNATION ?>">
                                    <input type="hidden" id="dep" name="dep" value="<?php echo $row->DEPARTMENT ?>">
                                    <button name="edit" class="btn btn-outline-warning">Edit</button>
                                </form>
                                
                                <form action="edit_delete_code.php" method="POST">

                                    <input type="hidden" id="sl" name="sl" value="<?php echo $row->SL ?>">
                                    <button name="delete" class="btn btn-outline-danger" onclick="return confirm('Are You Sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
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
