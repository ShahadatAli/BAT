<?php
include('config.php');
/**
 * Created by PhpStorm.
 * User: sayed
 * Date: 2/10/19
 * Time: 1:04 PM
 */
 date_default_timezone_set('Asia/Dhaka');
    $time = date('H:i:s');
    $device_id = $_POST['device_id'];
    
        if($time > '07:00:00' && $time < '09:30:00'){
        $meal = 'Breakfast';
    }
    
    else if($time > '11:00:00' && $time < '14:00:00'){
        $meal = 'Lunch';
    }
    else if($time > '15:00:00' && $time < '16:30:00'){
        $meal = 'Afternoon Snacks';
    }
    else if($time > '18:00:00' && $time < '19:00:00'){
        $meal = 'Dinner';
    }
    else if($time > "20:30:00" && $time < '21:30:00'){
        $meal = 'Evening Snacks';
    }
    else if($time > '23:00:00' && $time < '24:00:00'){
        $meal = 'Night Snacks';
    }
    
    else if($time > '01:00:00' && $time < '02:30:00'){
        $meal = 'Late Night Snacks';
    }

header('Content-Type: application/json');
 $dateTime = new DateTime("$lang",new DateTimeZone('Asia/Dhaka'));
    $date = $dateTime->format('Y-m-d');
    //echo $date;
    
    date_default_timezone_set('Asia/Dhaka');
    $time = date('H:i:s');
   // echo $time;

    
  
   $sql = "SELECT * from canteen_counter WHERE meal_date = '$date'"; // and device_id and date - shahadat
 // and device_id and date - shahadat

    
  if ($result = mysqli_query($connection, $sql)) {

    // Return the number of rows in result set
    $count = mysqli_num_rows( $result );

 }
 
  $sql1 = "SELECT * from canteen_counter WHERE meal_type = '$meal' AND device_id = '$device_id' AND meal_date = '$date'"; // and device_id and date - shahadat
  // and device_id and date - shahadat

    
  if ($result1 = mysqli_query($connection, $sql1)) {

    // Return the number of rows in result set
    $count_device = mysqli_num_rows( $result1 );

 }

echo json_encode(array("count" => $count, "count_device" => $count_device));


