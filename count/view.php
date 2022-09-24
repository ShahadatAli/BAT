<?php
include('config.php');
include('meal_date_time.php');
$device_id = $_GET['device_id'];
//echo $device_id;

  
  if(isset($_POST['card_id']) &&  $card_id != NULL && $card_id_len > "2"){
     $device_id=$_GET['device_id'];
      $card_id=$_POST['card_id'];
      $card_id_original = $card_id; // Full RFID number at the back of the card
      
                $d = $card_id;
            
             $e = dechex($d);
            
            $e1 = str_split($e);
            
            $g = $e1[0].$e1[1];
            
            $h = $e1[2].$e1[3].$e1[4].$e1[5];
            
            $card_id = hexdec($h); //only the important rfid digits
            //echo $card_id;
    
    
    //MySQL queries
    //checking id in counter table
    $select = mysqli_query($connection, "SELECT card_id FROM canteen_counter WHERE card_id = '$card_id' AND meal_type = '$meal' AND meal_date = '$date'");
    //code to check id in user_data table
    $id_check = mysqli_query($connection, "SELECT RFID_NO FROM canteen_user_data WHERE RFID_NO = '$card_id' GROUP BY RFID_NO");
    
    $resultx = mysqli_query($connection, "SELECT EMPLOYEE_NAME FROM canteen_user_data WHERE RFID_NO = '$card_id' GROUP BY RFID_NO");
    $row = mysqli_fetch_row($resultx);
    //var_dump($row);
  $emp_name = $row[0];
    
      
      //check for duplicate id in counter table
    if(mysqli_num_rows($id_check)) {
        
        if(mysqli_num_rows($select)) {
        echo 'This id is already being used';
        }
        else{
            
            $connection->query("insert into canteen_counter (card_id,meal_time,meal_date,meal_type,device_id,card_id_original) values ('$card_id','$time','$date','$meal','$device_id','$card_id_original')");
            //echo '<script>alert("ID inserted!")</script>';
            $redirect_url = 'location:view.php?device_id='. $device_id;
              echo $emp_name;
           // header();
        
        }
        
    }
    
    
}
  
  
    $sql = "SELECT * from canteen_counter WHERE meal_date = '$date'"; // and device_id and date 

    
  if ($result = mysqli_query($connection, $sql)) {

    // Return the number of rows in result set
    $count = mysqli_num_rows( $result );

 }
 
 
 $sql1 = "SELECT * from canteen_counter WHERE meal_type = '$meal' AND device_id = '$device_id' AND meal_date = '$date'"; // and device_id and date - shahadat

    
  if ($result1 = mysqli_query($connection, $sql1)) {

    // Return the number of rows in result set
    $count1 = mysqli_num_rows( $result1 );

 }





?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Canteen Management System</title>

    <style>
        body {
            background-color: #0e2b63;
            color: white;
        }

        .head {
            left: 0;
            width: 100%;
            height: 20px;
            background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%), linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%), linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%), linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%), linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%), linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%), linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%), linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%), linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);

        }

        .logo {
            background-color: white;

        }

    </style>
</head>

<body>
    <div class="head">

    </div>

    <div class="logo">
        <div class="d-flex">
            <img alt="BAT" src="BAT logo.png" style="margin: 18px 0px 20px 100px; height:65px; width:154px;">


            <div class="align-self-end ml-auto p-2 col-sm-3" style="margin-right:30px;">
                <form action="" method="POST" class="login-email">
                    <p class="login-text" style="font-size: 2rem; font-weight: 800;"></p>
                    <div class="input-group">
                        <input type="text" placeholder="id" id="card_id" name="card_id" value="" required autofocus>
                    </div>


                    <div class="input-group">
                        <input type="submit" hidden />
                        <!--<button name="submit" class="btn btn-outline-primary" style="color:white">Insert</button>-->
                    </div>

                    <br>
                </form>
            </div>
            <br>
        </div>

    </div>


    <center>
        <div class="">
            <div class="" style="background-color: rgb(0, 79, 159); height:310px;">
                <div class="" style="padding:0px;">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 " style="font-size:30px; text-align:center;padding-top:10px;">
                                Total Count For Meal: <?php echo $meal;?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color:White; font-size: 250px; text-align: center; margin-top:-40px; text-shadow: 0 0 15px black;">
                                <?php echo $count1; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="" style="background-color:rgb(0, 177, 235); height:150px;">

                <div class="" style="">
                    <div class="col mr-3">
                        <span class="align-middle text-xs font-weight-bold text-uppercase mb-1" style="color:black;font-size:25px;padding:20px; ">
                            Total Count For Meals Today: </span>
                        <span id="counttotalchange" class="align-middle h5 mb-0 font-weight-bold text-gray-800" style="font-size: 100px;text-shadow: 0 0 10px black;">
                            <?php echo $count; ?>
                        </span>
                    </div>

                </div>

            </div>
        </div>
    </center>


    <footer class="head" style="position: fixed;
   left: 0;
   bottom: 0;
   wi25h: 100%25   text-align: center;;">

    </footer>


</body>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    // Using jQuery.

    $(function() {
        $('form').each(function() {
            $(this).find('input').keypress(function(e) {
                // Enter pressed?
                if (e.which == 10 || e.which == 13) {
                    this.form.submit();
                }
            });

            $(this).find('input[type=submit]').hide();
        });
    });

</script>
<script>
    $(document).ready(function() {

        let loginTimeCount = <?php echo json_encode($_SESSION['loginTimeCount'] ); ?>;


        let text = "";
        let payload = "";
        let device_id = <?php print $_GET['device_id'] ?>;
        let reloadCount = <?php echo $count; ?>;

        function reload() {
            $.ajax({
                url: "reload.php",
                data: {
                    device_id: device_id,
                    loginTimeCount: loginTimeCount
                },
                type: "POST",
            }).done(function(data) {

                let responseCount;

                responseCountTotal = JSON.parse(data.count);


                if (responseCountTotal !== reloadCount) {

                    reloadCount = responseCount;
                    console.log(reloadCount);

                    $("#counttotalchange").html(responseCountTotal);

                }


            })

        }


        (function reloadFun() {
            document.getElementById("card_id").focus();
            reload();
            setTimeout(reloadFun, 500);
        })();






        /*User Input Message End*/
    });

</script>
<script>
    $(document).ready(function() {
        let version = "11";
        let device_id = <?php print $_GET['device_id'] ?>;
        let loginTimeCount = <?php echo json_encode($_SESSION['loginTimeCount'] ); ?>;

        function reload2() {
            $.ajax({
                url: "change.php",
                data: {
                    device_id: device_id,
                    loginTimeCount: loginTimeCount
                },
                type: "POST",
            }).done(function(data) {

                let responseCount;

                responseVersion = JSON.parse(data.version);
                //    responseChange = JSON.parse(data.change);
                console.log(responseVersion);
                responseVersion = parseInt(responseVersion);
                version = parseInt(version);
                console.log(version);
                if (responseVersion !== version) {
                    location.reload();

                }

                //  if (responseCount !== reloadCount) {

                //      //audioPlay();


                //     reloadCount = responseCount;
                //     console.log(reloadCount);
                //  $("#countchange").html(reloadCount);
                //  $("#countchange").html(reloadCount);
                //     //location.reload();
                // }

            })

        }


        (function reloadFun2() {
            reload2();
            setTimeout(reloadFun2, 50000);
        })();






        /*User Input Message End*/
    });

</script>

</html>
