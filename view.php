<?php
include('config.php');
include('meal_date_time.php');

$device_id = $_GET['device_id'];
$card_id_original = '';
$emp_name = '';

// Validate and process the card ID
if (isset($_POST['card_id']) && ($_POST['card_id']) != NULL && ($_POST['card_id']) > "2") {
    $card_id_original = $_POST['card_id'];
    $card_id = processCardID($card_id_original);

    // Check if the card ID exists in `canteen_user_data`
    $id_check = mysqli_query($connection, "SELECT RFID_NO FROM canteen_user_data WHERE RFID_NO = '$card_id' GROUP BY RFID_NO");

    // Retrieve employee name
    $resultx = mysqli_query($connection, "SELECT EMPLOYEE_NAME FROM canteen_user_data WHERE RFID_NO = '$card_id' GROUP BY RFID_NO");
    $row = mysqli_fetch_row($resultx);
    $emp_name = $row[0] ?? '';

    // Prevent duplicate entries in the `canteen_counter`
    if (mysqli_num_rows($id_check)) {
        $select = mysqli_query($connection, "SELECT card_id FROM canteen_counter WHERE card_id = '$card_id' AND meal_type = '$meal' AND meal_date = '$date'");
        if (mysqli_num_rows($select)) {
            echo 'This ID is already being used';
        } else {
            $query = "INSERT INTO canteen_counter (card_id, meal_time, meal_date, meal_type, device_id, card_id_original)
                      VALUES ('$card_id', '$time', '$date', '$meal', '$device_id', '$card_id_original')";
            $connection->query($query);
            echo $emp_name;
        }
    }
}

// Retrieve total meal count for the day and specific meal type
$count = getMealCount($connection, $date);
$count1 = getMealCount($connection, $date, $meal, $device_id);

// Helper functions
function processCardID($card_id) {
    $hex_value = dechex($card_id);
    $important_digits = substr($hex_value, 2);
    return hexdec($important_digits);
}

function getMealCount($connection, $date, $meal = null, $device_id = null) {
    $query = "SELECT * FROM canteen_counter WHERE meal_date = '$date'";
    if ($meal && $device_id) {
        $query .= " AND meal_type = '$meal' AND device_id = '$device_id'";
    }
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
}
?>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #0e2b63;
            color: white;
        }

        .head {
            width: 100%;
            height: 20px;
            background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%),
                linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%),
                linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%),
                linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%),
                linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%),
                linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%),
                linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%),
                linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%),
                linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);
        }

        .logo {
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="head"></div>
    <div class="logo">
        <div class="d-flex">
            <img src="BAT logo.png" alt="BAT" style="margin: 18px 0 20px 100px; height:65px; width:154px;">
            <div class="align-self-end ml-auto p-2 col-sm-3" style="margin-right:30px;">
                <form action="" method="POST" class="login-email">
                    <div class="input-group">
                        <input type="text" placeholder="ID" id="card_id" name="card_id" required autofocus>
                    </div>
                    <div class="input-group">
                        <input type="submit" hidden />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <center>
        <div class="" style="background-color: rgb(0, 79, 159); height:310px;">
            <div class="text-xs font-weight-bold text-uppercase mb-1" style="font-size:30px; padding-top:10px;">
                Total Count For Meal: <?php echo $meal; ?>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color:White; font-size: 250px; margin-top:-40px; text-shadow: 0 0 15px black;">
                <?php echo $count1; ?>
            </div>
        </div>
        <div class="" style="background-color:rgb(0, 177, 235); height:150px;">
            <span class="align-middle text-xs font-weight-bold text-uppercase mb-1" style="color:black;font-size:25px; padding:20px;">
                Total Count For Meals Today:
            </span>
            <span id="counttotalchange" class="align-middle h5 mb-0 font-weight-bold text-gray-800" style="font-size: 100px; text-shadow: 0 0 10px black;">
                <?php echo $count; ?>
            </span>
        </div>
    </center>

    <footer class="head" style="position: fixed; left: 0; bottom: 0; width: 100%; text-align: center;"></footer>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
        $(document).ready(function () {
            let loginTimeCount = <?php echo json_encode($_SESSION['loginTimeCount']); ?>;
            let device_id = <?php echo $device_id; ?>;
            let reloadCount = <?php echo $count; ?>;

            function reload() {
                $.post("reload.php", { device_id: device_id, loginTimeCount: loginTimeCount }, function (data) {
                    let responseCountTotal = JSON.parse(data.count);
                    if (responseCountTotal !== reloadCount) {
                        reloadCount = responseCountTotal;
                        $("#counttotalchange").html(responseCountTotal);
                    }
                });
            }

            (function reloadFun() {
                $("#card_id").focus();
                reload();
                setTimeout(reloadFun, 500);
            })();
        });
    </script>
</body>
</html>
