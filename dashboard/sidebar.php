<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <!-- <title>Responsive Sidebar Menu</title> -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="styles.css">




    <!-- Stylesheets -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



    <meta http-equiv="X-UA-Compatible" content="IE=edge">



    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <style>
        .sidebar {
            background-color: white;
        }

        .sidebar a {
            text-decoration: none;
        }

        #nav_bar .active {
            color: #F8F8F8;
            background-color: rgb(0, 177, 235);
        }

    </style>


</head>

<body>

    <div id="nav_bar" class="sidebar" style="background-color: rgb(14, 43, 99);">
        <div class="logo" style="background-color: rgb(14, 43, 99);">
            <div class="d-flex">
                <img alt="BAT" src="bat-white.png" class="bat" style="">
            </div>

        </div>
        <header style="background-color: rgb(14, 43, 99);">Admin Menu</header>
        <ul>
            <li>
                <a href="index.php">
                    <i class="fas fa-qrcode"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li>
            <a href="user_list.php">
                <i class="fas fa-list"></i>
                <span>User List</span>
            </a>
            </li>
            
            <li>
            <a href="detailed_reports.php">
                <i class="fas fa-file-invoice"></i>
                <span style="font-size:13.5px;">Consumption Report</span>
            </a>
            </li>
            
            <li>
            <a href="insert_user.php">
                <i class="fas fa-upload"></i>
                <span>Insert New Users</span>
            </a>
            </li>
            
            <li>
            <a href="change_pass.php">
                <i class="far fa-question-circle"></i>
                <span>Change Password</span>
            </a>
            </li>
            
            <li>
            <a href="create-user.php">
                <i class="fas fa-plus"></i>
                <span style="font-size:14px;">Create New User</span>
            </a>
            </li>
            
            <li>
            <a href="admin-logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            </li>
        </ul>
    </div>




</body>


<script>
    $(function activ() {
        $('a').each(function() {
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('active');
                $(this).parents('li').addClass('active');
            }
        });
    });

</script>

</html>
