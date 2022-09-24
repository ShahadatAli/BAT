<?php
include('../config.php');

session_start();
if(!ISSET($_SESSION['user_email'])){
    header('location:admin_login.php');
}

$mail = $_SESSION['user_email'];

if($mail != 'superadmin@gmail.com')
{
    include('sidebar.php');
}
else{
    include('sidebar1.php');
}

?>


<!DOCTYPE html>

<head>

    <title>Insert User</title>

    <style>
            .head{
                left:0;
                width: 100%;height:20px;background-image: linear-gradient(90deg, rgb(14, 43, 99) 30.4785%, rgba(0, 0, 0, 0) 30.4785%), linear-gradient(90deg, rgb(0, 79, 159) 52.1579%, rgba(0, 0, 0, 0) 52.1579%), linear-gradient(90deg, rgb(0, 177, 235) 64.7281%, rgba(0, 0, 0, 0) 64.7281%), linear-gradient(90deg, rgb(239, 125, 0) 73.2255%, rgba(0, 0, 0, 0) 73.2255%), linear-gradient(90deg, rgb(255, 187, 0) 79.6279%, rgba(0, 0, 0, 0) 79.6279%), linear-gradient(90deg, rgb(80, 175, 71) 86.6924%, rgba(0, 0, 0, 0) 86.6924%), linear-gradient(90deg, rgb(175, 202, 11) 92.0305%, rgba(0, 0, 0, 0) 92.0305%), linear-gradient(90deg, rgb(90, 50, 138) 97.0083%, rgba(0, 0, 0, 0) 97.0083%), linear-gradient(90deg, rgb(231, 37, 130) 100%, rgba(0, 0, 0, 0) 100%);
                
            }
            .multiple > a:hover{
                  border-left: unset;
                  color: #b93632;
            }
            
            .container-fluid{
                margin-left: 220px; 
                width: 80%; 
                margin-top:1%;
            }
            
            .vertical-bar{
                height: 570px; 
                width:2px;
                background-color:#a6a4a4;
                margin:20px;
            }
            
            @media(max-width : 860px){
                .sample-img{
                    visibility:hidden;
                }
                .container-fluid{
                    margin-left: 80px;
                    
                }
                .vertcial-bar{
                    margin:10px;
                }
                .multi-file{
                    position: relative;
                    margin-left: 50px;
                }
                
            }

            </style>
            
 
</head>

<body>
    
    <div class="head">
            
    </div>

    <div class="container-fluid" style="">
            
        <br><br>
        <div class="row justify-content-md-center">

            
            <div class="col-4" style="">
                 <h1>Add Single User</h1>
                <form action="upload.php" method="get">
                    <div class="form-group">
                        <label>Employee Number:</label>
                        <input type="text" name="enum" id="enum" class="form-control col-xs-4"  placeholder="Number" required>
                    </div>
                    <div class="form-group">
                        <label>Employee Name:</label>
                        <input type="text" name="ename" id="ename" class="form-control"  placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label>Designation:</label>
                        <input type="text" name="edes" id="edes" class="form-control"  placeholder="Designation" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Department:</label>
                        <input type="text" name="edep" id="edep" class="form-control"  placeholder="Department" required>
                    </div>
                    
                    <div class="form-group">
                        <label>RFID Number:</label>
                        <input type="number" name="eid" id="eid" class="form-control"  placeholder="RFID" required>
                    </div>
                    <div class="row justify-content-center">
                        <input type="submit" class="btn btn-outline-success" style="width:80px;font-weight: bold;" value="Add">
                    </div>
                    
                </form>
            </div>
            
            <div class="d-flex vertical-bar" style="">
              <div class="vr"></div>
            </div>
            
            <div class="col-4 multiple" style="">
                <h1>Add Multiple User</h1>
                <label style="color:red;">(ONLY <strong>.CSV</strong> FILES ACCEPTED WITH 6 COLUMNS)</label>
                <img src="sample.png" class="sample-img" style="height:70px;">
                <br>
                <br>
                <a href="Sample Excel Datasheet.csv">Download Sample File</a>
                <br><br>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                      <div class="input-group multi-file">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" name="file">
                          <label class="custom-file-label" for="customFileInput">Select file</label>
                        </div>
                        <div class="input-group-append">
                           <input type="submit" name="submit" value="Upload" class="btn btn-success">
                        </div>
                      </div>
                </form>
            </div>
            
            
        </div>
        <br>

        
       
    </div>

    <br>
    
    <footer class="head" style="
        position: fixed;
       left: 0;
       bottom: 0;
       width: 100%;   text-align: center;">
                
    </footer>
    
    <script type="application/javascript">
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
    </script>

    

</body>

</html>
