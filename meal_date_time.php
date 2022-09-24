<?php

date_default_timezone_set("Asia/Dhaka");
    $date = date("Y/m/d");

    $time = date('H:i:s');
    
    if($time > '07:00:00' && $time < '09:30:00'){
        $meal = 'Breakfast';
    }
    else if($time > '09:30:00' && $time < '11:00:00'){
        $meal = 'Others 1';
    }
    
    else if($time > '11:00:00' && $time < '14:00:00'){
        $meal = 'Lunch';
    }
    else if($time > '14:30:00' && $time < '15:00:00'){
        $meal = 'Others 2';
    }
    else if($time > '15:00:00' && $time < '16:30:00'){
        $meal = 'Afternoon Snacks';
    }
    else if($time > '16:30:00' && $time < '18:00:00'){
        $meal = 'Others 3';
    }
    
    else if($time > '18:00:00' && $time < '19:00:00'){
        $meal = 'Dinner';
    }
    
    else if($time > '19:00:00' && $time < '20:30:00'){
        $meal = 'Others 4';
    }
    else if($time > "20:30:00" && $time < '21:30:00'){
        $meal = 'Evening Snacks';
    }
    
    else if($time > '21:30:00' && $time < '23:00:00'){
        $meal = 'Others 5';
    }
    else if($time > '23:00:00' && $time < '24:00:00'){
        $meal = 'Night Snacks';
    }
    
    else if($time > '00:00:00' && $time < '01:00:00'){
        $meal = 'Others 6';
    }
    
    else if($time > '01:00:00' && $time < '02:30:00'){
        $meal = 'Late Night Snacks';
    }
    
    else if($time > '02:30:00' && $time < '07:00:00'){
        $meal = 'Others 7';
    }
    
    else $meal = "Others";

?>