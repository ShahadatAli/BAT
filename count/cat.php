<?php
include('config.php');
include('meal_date_time.php');
$device_id = $_GET['device_id'];
//echo $device_id;
    
//echo $meal;
    
    
  
  //count for today's total meal consumption

    $sql = "SELECT * from canteen_counter WHERE meal_date = '$date'"; // and device_id and date

    
  if ($result = mysqli_query($connection, $sql)) {

    // Return the number of rows in result set
    $count = mysqli_num_rows( $result );

 }
 
   //count for today's specific meal consumption

 $sql1 = "SELECT * from canteen_counter WHERE meal_type = '$meal' AND device_id = '$device_id' AND meal_date = '$date'"; 

    
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

    <div class="logo"><img alt="BAT" src="BAT logo.png" style="margin: 18px 0px 20px 100px; height:65px; width:154px;"></div>

    <center>
        <div class="">
            <div class="" style="background-color: rgb(0, 79, 159); height:310px;">
                <div class="" style="padding:0px;">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-3">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 " style="font-size:30px; text-align:center;padding-top:10px;">
                                Total Count For Meal: <?php echo $meal;?></div>
                            <div id="counttotalchange" class="h5 mb-0 font-weight-bold text-gray-800" style="color:White; font-size: 250px; text-align: center; margin-top:-40px; text-shadow: 0 0 15px black;">
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
                        <span id="countchange" class="align-middle h5 mb-0 font-weight-bold text-gray-800" style="font-size: 100px;text-shadow: 0 0 10px black;">
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

                responseCount = JSON.parse(data.count);
                responseCountTotal = JSON.parse(data.count_device);

                if (responseCount !== reloadCount) {

                    //audioPlay();


                    reloadCount = responseCount;
                    console.log(reloadCount);
                    $("#countchange").html(reloadCount);
                    $("#counttotalchange").html(responseCountTotal);
                    //location.reload();
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


        (function reloadFun() {
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
