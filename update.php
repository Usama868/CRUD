<?php
// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$name= $fathername= $contact = $cnic = "";
$name_err = $fathername_err = $contact_err = $cnic_err =  "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate fname
    $input_fathername = trim($_POST["fathername"]);
    if(empty($input_fathername)){
        $fathername_err = "Please enter an father Name.";
    } elseif(!filter_var($input_fathername, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fathername_err = "Please enter a valid father name.";
    } else{
        $fathername = $input_fathername;
    }
    
    // Validate contact
    $input_contact = trim($_POST["contact"]);
    if(empty($input_contact)){
        $contact_err = "Please enter the Correct no.";     
    } elseif(!ctype_digit($input_contact)){
        $contact_err = "Please enter a correct format.";
    } else{
        $contact = $input_contact;
       
    }
     //cnic no 
    $input_cnic = trim($_POST["cnic"]);
    if(empty($input_cnic)){
        $cnic_err = "Please enter the Correct cnic no.";     
    } elseif(!ctype_digit($input_cnic)){
        $cnic_err = "Please enter a correct format.";
    } else{
      $cnic = $input_cnic;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($fathername_err) && empty($contact_err) && empty($cnic_err)){
        // Prepare an update statement
        $sql = "UPDATE form SET name=?, fathername=?, contact=?, cnic=? WHERE id=?";
         
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_fathername, $param_contact, $param_cnic, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_fathername = $fathername;
            $param_contact = $contact;
            $param_cnic = $cnic;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($connect);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM form WHERE id = ?";
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
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
        <title>25-7-19</title>
        <script src = "script/jquery-min-js.js"></script>
        <script src = "script/bootstap-min-js.js"></script>
                  <link href = "bootstrap/bootstrapCSS.css" rel = "stylesheet" type="text/css">
                  <link href = "Css/style.css" rel = "stylesheet" type="text/css">
                  <link rel="stylesheet" type="text/css" href="Css/w3.css">
                  <link rel="stylesheet" type="text/css" href="Css/colors.css">
            <div class="head img-responsive">
           
            <img src="images/photog1.png" width="150px" height="auto"  style="max-width: 100%">
         
        </div>
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body class=" container" background="images/email-pattern.png">
      <nav class="col-md-6 navmargin">
            
            <div class="">
            <ul class="nav  nav-pills">
                <li class="active"><a href="index.php" target="_self">Home</a></li>
               <li><a href="#" target="_self">ADD</a></li>
                <li><a href="update.php" target="_self">Update</a></li>
               
               
                
            </ul>
        </div>
        </nav>
    
   
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 class="green">Update Record</h2>
                  
                    <p class="gray">Please edit the input values and submit to update the record.</p>
                      </div>
                    <br/>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                       <div class="form-group">
                <div class="<?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label class="col-md-2 black" for=Name">Name</label>
                
                <div class="col-md-4">
                    <input name="name" type="text" id="focusedInput" class="form-control"   placeholder="enter name" required="name" value="<?php echo $name; ?>">
                    <span class="help-block"><?php echo $name_err;?></span>
                </div>
                </div>
                
                <div class="<?php echo (!empty($fathername_err)) ? 'has-error' : ''; ?>">
                <label class="col-md-2 black" for="fname">Father Name</label>
                <div class="col-md-4">
                    <input name="fathername" type="text" id="focusedInput" class="form-control"  placeholder="enter father name" required="fathername" value="<?php echo $fathername; ?>">
                      <span class="help-block"><?php echo $fathername_err;?></span>
                </div>
                </div>
                
                <Div class="<?php echo (!empty($contact_err)) ? 'has-error' : ''; ?>">
                    <label class="col-md-2 black" for="contact">Contact</label>
                <div class="col-md-4">
                    <input name="contact" type="text" id="focusedInput" class="form-control"  placeholder="enter phone no" required="contact" value="<?php echo $contact; ?>">
                      <span class="help-block"><?php echo $contact_err;?></span>
                </div>
                </div>
                
                <div class="<?php echo (!empty($cnic_err)) ? 'has-error' : ''; ?>">
                  <label class="col-md-2 black" for="cnic">CNIC No</label>
                <div class="col-md-4">
                    <input name="cnic" type="text" id="focusedInput"  placeholder="enter cnic no" class="form-control" required="cnic" value="<?php echo $cnic; ?>">
                      <span class="help-block"><?php echo $cnic_err;?></span>
                    
                 </div>
                </div>
                </div>
               
                        <div class="btnm">
                        
                        <button type="submit" class="btn btn-success btnm">Submit   </button>
                      
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <button class="btn btn-warning btnm"><a href="index.php">Cancel</button></a>
                        </div>
                    </form>
                 </div>
                   
         <div class="img-responsive" align="center">
             
             <img src="images/copyright.png" class="copyright">
                        </div>
    
</body>
</html>