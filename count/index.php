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
            <img alt="BAT" src="https://savar.info/bat/BAT%20logo.png" style="margin: 18px 0px 20px 100px; height:65px; width:154px;">


            <div class="align-self-end ml-auto p-2 col-sm-3" style="margin-right:30px;">

            </div>
            <br>
        </div>

    </div>


    <center>
        <div class="col-md-12 text-center">
            <br>
            <br>

            <a href="view.php?device_id=1" id="singlebutton" name="singlebutton" class="btn btn-primary btn-lg">Device 1 User</a>


            <a href="cat.php?device_id=1" id="singlebutton" name="singlebutton" class="btn btn-primary btn-lg">Device 1 Caterar</a>
            <br>
            <br>
        </div>
        <div class="col-md-12 text-center">
            <br>
            <a href="view.php?device_id=2" id="singlebutton" name="singlebutton" class="btn btn-primary btn-lg">Device 2 User</a>
            <a href="cat.php?device_id=2" id="singlebutton" name="singlebutton" class="btn btn-primary btn-lg">Device 2 Caterar</a>
            <br>
            <br>
        </div>

    </center>


    <footer class="head" style="position: fixed;
   left: 0;
   bottom: 0;
   wi25h: 100%25   text-align: center;;">

    </footer>


</body>

</html>
