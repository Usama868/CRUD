<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "connect.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM form WHERE id = ?";
    
    if($stmt = mysqli_prepare($connect, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $fathername = $row["fathername"];
                $contact = $row["contact"];
                $cnic = $row["cnic"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($connect);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link href = "jqueryUi/jquery-ui-lightness.css" type="text/css" rel = "stylesheet">
        <script src = "jqueryUi/jquery1.10.2-js.js" type="text/javascript"></script>
        <script src = "jqueryUi/jquery-ui-js.js" type="text/javascript"></script>
          <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
       
        <script src = "script/jquery-min-js.js"></script>
        <script src = "script/bootstap-min-js.js"></script>
                  <link href = "bootstrap/bootstrapCSS.css" rel = "stylesheet" type="text/css">
                  <link href = "Css/style.css" rel = "stylesheet" type="text/css">
                  <link rel="stylesheet" type="text/css" href="Css/w3.css">
                  <link rel="stylesheet" type="text/css" href="Css/colors.css">
            <div class="head img-responsive">
           
            <img src="images/photog2.png" width="180px" height="180px"  style="max-width: 100%;">
         
        </div>
    
    
    
        
     
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: auto;
            margin: 0 auto;
        }
    </style>
</head>
<body class="container" style= "background-image:url('images/abstract-art2 (2).jpg'); background-repeat: repeat-y; background-size: cover;">
       
        <nav class="col-md-6 navmargin">
            
            <div class="">
            <ul class="nav  nav-pills">
                <li class="active"><a href="index.php" target="_self">Home</a></li>
                 <li><a href="#" target="_self">ADD</a></li>
                <li><a href="update.php" target="_self">Update</a></li>
                
            </ul>
        </div>
        </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1 style="color:black; background-color: orange; text-align: center;"><i><b>View Record</b></i></h1>
                    </div>
                    <div class="form-group"style="font-size:25px;">
                        <label style="color:silver">Name :</label>
                        
                        <p class="form-control-static" style="color:springgreen; "><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group" style="font-size:25px;">
                        <label style="color:silver" >Father name :</label>
                        <p class="form-control-static" style="color:springgreen;"><?php echo $row["fathername"]; ?></p>
                    </div>
                    <div class="form-group" style="font-size:25px;">
                        <label style="color:silver">Contact :</label>
                        <p class="form-control-static" style="color:springgreen;"><?php echo $row["contact"]; ?></p>
                    </div>
                    <div class="form-group" style="font-size:25px;">
                        <label style="color:silver;"> Cnic :</label>
                        <p class="form-control-static" style="color:springgreen;"><?php echo $row["cnic"]; ?></p>
                    </div>
                    <div align="center">
                   
                   <?php
                     echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='btn btn-info btnm  '>Update</span></a>";
                     
                     echo "<a href='index.php'<span class='btn btn-danger btnm'>Back</span></a>";
                   ?>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        