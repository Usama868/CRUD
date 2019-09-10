<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "connect.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM form WHERE id = ?";
    
    if($stmt = mysqli_prepare($connect, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($connect);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
           
            <img src="images/photog1.png" width="150px" height="auto"  style="max-width: 100%">
         
        </div>
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="container" style= "background-image:url('images/abstract-art2 (2).jpg'); background-repeat: repeat-y; background-size: cover;">
       
        <nav class="col-md-6 navmargin">
            
            <div class="">
            <ul class="nav nav-pills">
                <li class="active"><a href="form.php" target="_self">Home</a></li>
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
                        <h1 class="red">Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>