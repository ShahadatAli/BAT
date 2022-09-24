<?php
// include mysql database configuration file
include_once '../config.php';


//multiple user insertion with csv file
if (isset($_POST['submit']))
{
 
    // Allowed mime types
    //creating a multidimensional array
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
 
            // Skip the first line
            fgetcsv($csvFile);
 
            // Parse data from CSV file line by line
             // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
                // Get row data
                $emp_no = $getData[1];
                $emp_name = $getData[2];
                $designation = $getData[3];
                $department = $getData[4];
                $rfid = $getData[5];
                
               // If user already exists in the database with the same email
                    $query = "SELECT RFID_NO FROM canteen_user_data WHERE RFID_NO = '" . $getData[5] . "' AND EMP_NO = '" . $getData[1] . "' ";
    
                    $check = mysqli_query($connection, $query);
                    
                    if ($check->num_rows > 0)
                    {
                                        
                        if($rfid!=null)
                        {
                     
                            echo '<script type="text/javascript">'; 
                            echo 'alert("RFID No. Already Exists");'; 
                            echo 'window.location.href = "insert_user.php";';
                            echo '</script>';
                        }
                                   else{
                                    mysqli_query($connection, "INSERT INTO canteen_user_data (SL,EMP_NO, EMPLOYEE_NAME, DESIGNATION, DEPARTMENT, RFID_NO) VALUES ('','" . $emp_no . "', '" . $emp_name . "', '" . $designation . "', '" . $department . "', '" . $rfid . "' )");
                         }
                    }


                else{
                    mysqli_query($connection, "INSERT INTO canteen_user_data (SL,EMP_NO, EMPLOYEE_NAME, DESIGNATION, DEPARTMENT, RFID_NO) VALUES ('','" . $emp_no . "', '" . $emp_name . "', '" . $designation . "', '" . $department . "', '" . $rfid . "' )");
                    
                            echo '<script type="text/javascript">'; 
                            echo 'alert("Users Added");'; 
                            echo 'window.location.href = "insert_user.php";';
                            echo '</script>';
                }
 
                
            }
 
            // Close opened CSV file
            fclose($csvFile);
 
            header("Location: insert_user.php");
         
    }
    else
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Invalid File");'; 
        echo 'window.location.href = "insert_user.php";';
        echo '</script>';

    }
}

//single user insertion
if(isset($_GET['enum']) && isset($_GET['ename']) && isset($_GET['edes']) && isset($_GET['edep']) && isset($_GET['eid']) ){

    $i=$_GET['enum'];
    $j=$_GET['ename'];
    $k=$_GET['edes'];
    $l=$_GET['edep'];
    $m=$_GET['eid'];
    
    
    
    // If user already exists in the database with the same rfid
    $query = "SELECT RFID_NO FROM canteen_user_data WHERE RFID_NO = '$m'";

    $check = mysqli_query($connection, $query);
    
    if ($check->num_rows > 0)
    {

        echo '<script type="text/javascript">'; 
        echo 'alert("RFID No. Already Exists");'; 
        echo 'window.location.href = "insert_user.php";';
        echo '</script>';
        

    }


    else
    {
        mysqli_query($connection, "insert into canteen_user_data (EMP_NO,EMPLOYEE_NAME,DESIGNATION,DEPARTMENT,RFID_NO) values ('$i','$j','$k','$l','$m')");
        
        echo '<script type="text/javascript">'; 
        echo 'alert("User Added");'; 
        echo 'window.location.href = "insert_user.php";';
        echo '</script>';
    }


}


?>