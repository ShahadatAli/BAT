<?php

include('../config.php');

//EDIT user
if (isset($_POST['edit_user'])) {

    $serial_id = $_POST['serial'];
    $urfid = $_POST['urfid'];
    $uid = $_POST['uid'];
    $uname = $_POST['uname'];
    $udes = $_POST['udes'];
    $udep = $_POST['udep'];
    
    
    
    $sql = "UPDATE canteen_user_data SET `EMP_NO` = '$uid', `EMPLOYEE_NAME` ='$uname' , `DESIGNATION` ='$udes' , `DEPARTMENT` ='$udep', `RFID_NO` =$urfid WHERE `SL`='$serial_id'";
    
    if (mysqli_query($connection, $sql)) {
                 echo '<script type="text/javascript">'; 
                echo 'alert("User Updated");'; 
                echo 'window.location.href = "user_list.php";';
                echo '</script>';

    } else {
                 echo '<script type="text/javascript">'; 
                echo 'alert("Error");'; 
                echo 'window.location.href = "edit_user.php";';
                echo '</script>';
    }
    mysqli_close($connection);
}


/*
    $sql = "UPDATE canteen_user_data SET `RFID_NO`='$new_id' WHERE `SL`='$serial_id'";

    if (mysqli_query($connection, $sql)) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_error($connection);
    }
    
    mysqli_close($connection);
    */
    
//Delete User
if (isset($_POST['delete'])) {

    $serial_id = $_POST['sl'];
    
    
    $sql = "DELETE from canteen_user_data WHERE `SL`='$serial_id'";
    
    if (mysqli_query($connection, $sql)) {
                 echo '<script type="text/javascript">'; 
                echo 'alert("User Deleted");'; 
                echo 'window.location.href = "user_list.php";';
                echo '</script>';
    } else {
                 echo '<script type="text/javascript">'; 
                echo 'alert("Deletion Error");'; 
                echo 'window.location.href = "user_list.php";';
                echo '</script>';
    }
}

?>