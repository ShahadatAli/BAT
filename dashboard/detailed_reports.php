<?php
include('../config.php');

session_start();
if(!ISSET($_SESSION['user_email'])){
    header('location:admin_login.php');
}

$mail = $_SESSION['user_email'];


//check if user is superuser
if($mail != 'superadmin@gmail.com')
{
    include('sidebar.php');
}
else{
    include('sidebar1.php');
}



$sql = "SELECT * FROM canteen_counter ORDER BY meal_id DESC";

$result = mysqli_query($connection, $sql);


//custom searches
if(ISSET($_GET['id'])){
    $date = $_GET['date'];
    $end_date = $_GET['end_date'];
    $rfid = $_GET['id'];
    $meal_select = $_GET['meal'];
    
    //to show employee name
    $resultx = mysqli_query($connection, "SELECT EMPLOYEE_NAME FROM canteen_user_data WHERE RFID_NO = '$rfid'");
    $row1 = mysqli_fetch_row($resultx);
    //var_dump($row);
    $emp_name = $row1[0];
    
    //search by date
    if($date!=null && $end_date==null && $rfid==null  && $meal_select=='All')
    {
    
        $sql1 = "SELECT * FROM canteen_counter WHERE meal_date = '$date' ORDER BY meal_id DESC";

        $result = mysqli_query($connection, $sql1);
    
    }
    
    
    //search by start and end date
    if($date!=null && $end_date!=null && $rfid==null  && $meal_select=='All')
    {
    
        $sql1 = "SELECT * FROM canteen_counter WHERE meal_date BETWEEN '$date' AND '$end_date' ORDER BY meal_id DESC";

        $result = mysqli_query($connection, $sql1);
    
    }
    
    
    
    else if($date!=null && $rfid!=null && $meal_select=='All')
    {
        
        $sql1 = "SELECT * FROM canteen_counter WHERE meal_date = '$date' AND card_id = '$rfid' ORDER BY meal_id DESC";

        $result = mysqli_query($connection, $sql1);
    
    }
    
    else if($date!=null && $rfid!=null && $meal_select!='All')
    {
        
        if($meal_select != 'All'){
            $sql2 = "SELECT * FROM canteen_counter WHERE meal_type = '$meal_select' AND meal_date = '$date' AND card_id = '$rfid' ORDER BY meal_id DESC";

            $result = mysqli_query($connection, $sql2);
            
        }
    
    }
    
    
    else if($rfid!=null && $date==null && $meal_select=='All'){
    
        $sql2 = "SELECT * FROM canteen_counter WHERE card_id = '$rfid' ORDER BY meal_id DESC";

        $result = mysqli_query($connection, $sql2);
    }
    
    else if($rfid!=null && $date==null && $meal_select!='All'){
    
        $sql2 = "SELECT * FROM canteen_counter WHERE card_id = '$rfid' AND meal_type = '$meal_select' ORDER BY meal_id DESC";

        $result = mysqli_query($connection, $sql2);
    }
    
    else if($rfid==null && $date!=null && $meal_select!='All'){
    
        $sql2 = "SELECT * FROM canteen_counter WHERE meal_date = '$date' AND meal_type = '$meal_select' ORDER BY meal_id DESC";

        $result = mysqli_query($connection, $sql2);
    }
    
    else if($meal_select!=null){
        
        
        if($meal_select != 'All'){
            $sql2 = "SELECT * FROM canteen_counter WHERE meal_type = '$meal_select' ORDER BY meal_id DESC";

            $result = mysqli_query($connection, $sql2);
            
        }
        else if($meal_select == 'All'){
            $sql2 = "SELECT * FROM canteen_counter ORDER BY meal_id DESC";

            $result = mysqli_query($connection, $sql2);
            
        }
    
        
    }
    
    
}


?>


<!DOCTYPE html>

<head>

    <title>Detailed Reports</title>



    <style>
        .head {
            left: 0;
            width: 100%;
            height: 20px;
            background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%), linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%), linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%), linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%), linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%), linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%), linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%), linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%), linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);

        }

        .generate {
            margin-right: 15px;
        }

        .show-all {
            margin-left: 15px;
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
                <form action="" method="GET" class="login-email">

                    <div class="container">
                        <div class="searching row justify-content-between">
                            <div>
                                <div>
                                    <label>Employee RFID:&nbsp</label>
                                </div>
                                <div>
                                    <input type="text" placeholder="id" name="id" value="">
                                </div>
                            </div>

                            <div>
                                <div>
                                    <label>START DATE:&nbsp</label>
                                </div>

                                <div>
                                    <input type="date" id="date" name="date">
                                </div>
                            </div>

                            <div>
                                <div>
                                    <label>END DATE:&nbsp</label>
                                </div>

                                <div>
                                    <input type="date" id="date" name="end_date">
                                </div>
                            </div>



                            <div>
                                <div>
                                    <label>Meal:&nbsp</label>
                                </div>

                                <div class="input-group">
                                    <select name="meal" id="meal">
                                        <option value="All" selected>All</option>
                                        <option value="Breakfast">Breakfast</option>
                                        <option value="Others 1">Others1</option>
                                        <option value="Lunch">Lunch</option>
                                        <option value="Others 2">Others2</option>
                                        <option value="Afternoon Snacks">Afternoon snacks</option>
                                        <option value="others 3">Others3</option>
                                        <option value="Dinner">Dinner</option>
                                        <option value="Others 4">Others4</option>
                                        <option value="Evening Snacks">Evening snacks</option>
                                        <option value="others 5">Others5</option>
                                        <option value="Night Snacks">Night snacks</option>
                                        <option value="others 6">Others6</option>
                                        <option value="Late Night Snacks">Late night snacks</option>
                                        <option value="others 7">Others7</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <br>

                        <div class="row">

                            <button name="submit" class="generate  btn btn-outline-dark" style="font-weight: bold;">Generate</button>

                            <br>
                </form>

                <form action="" method="GET" class="login-email">

                    <button name="submit" class="show-all btn btn-outline-dark" style="font-weight: bold;" onclick="<?php unset($date); unset($rfid); ?>">Show All Entries</button>

                </form>
            </div>
        </div>
        <br>

        <h1 style="text-align: center;">Meal Consumption</h1>
        <div class="table">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Card ID</th>
                        <th>Employee Name</th>
                        <th>Meal Type</th>
                        <th>Meal Time</th>
                        <th>Date</th>

                    </tr>
                </thead>
                <?php while($row = mysqli_fetch_object($result)){
                                ?>

                <tr>
                    <td><?php echo $row->card_id ?></td>
                    <td><?php 
                            
                                $resultx = mysqli_query($connection, "SELECT EMPLOYEE_NAME FROM `canteen_user_data` WHERE RFID_NO =".$row->card_id);
                                $row1 = mysqli_fetch_row($resultx);
                                echo $row1['0'];
                            ?></td>
                    <td><?php echo $row->meal_type ?></td>
                    <td><?php echo $row->meal_time ?></td>
                    <td><?php echo $row->meal_date ?></td>

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
        $(document).ready(function() {
            $('#example').DataTable({
                order: [
                    [4, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        title: "<?php
                                    if($_GET['id']!=null)
                                    {
                                        echo $rfid = $_GET['id'];
                                    }
                                    else
                                    {
                                        echo $date_today;
                                    }
                                     
                                ?>"
                    },
                    {
                        extend: 'csvHtml5',
                        title: "<?php
                                    if($_GET['id']!=null)
                                    {
                                        echo $rfid = $_GET['id'];
                                    }
                                    else
                                    {
                                        echo $date_today;
                                    }
                                     
                                ?>"
                    },
                    {
                        extend: 'pdfHtml5',
                        title: "<?php
                                    if($_GET['id']!=null)
                                    {
                                        echo $rfid = $_GET['id'];
                                    }
                                    else
                                    {
                                        echo $date_today;
                                    }
                                     
                                ?>"
                    }

                ]
            });
        });

    </script>


</body>

</html>
