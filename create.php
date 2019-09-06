<?php
// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$name= $fathername= $contactno = $cnic = "";
$name_err = $fathername_err = $contactno_err = $cnic_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
    
    // Validate salary
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
    if(empty($name_err) && empty($fathername_err) && empty($contact_err && empty($cnic_err))){
        // Prepare an insert statement
        $sql = "INSERT INTO form (name, fathername, contact,cnic) VALUES (?, ?, ?,?)";
         
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_fathername, $param_contact, $param_cnic);
            
            // Set parameters
            $param_name = $name;
            $param_fathername = $fathername;
            $param_contact = $contact;
            $param_cnic = $cnic;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html>
     
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
    
    </head>
    <body class="background container" background="images/fabric1.png">
        
        
        <nav class="col-md-6 navmargin">
            
            <div class="">
            <ul class="nav navbar-nav nav-pills">
                <li class="active"><a href="form.php" target="_self">Home</a></li>
                <li><a href="index.php" target="_self">SELECT</a></li>
                <li><a href="update.php" target="_self">UPDATE</a></li>
                <li><a href="read.php" target="_self">READ</a></li>
                
            </ul>
        </div>
        </nav>
       
       
        
    
     
      
        <div class="col-md-12">
            <h2>Create Record</h2>
                   <p>Please fill this form and submit to add User record to the database.</p>
                   <br/>
                   
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            
            <div class="form-group">
                <label class="col-md-2" for=Name">Name</label>
                <div class="col-md-4">
                    <input name="name" type="text" id="focusedInput" class="form-control"   placeholder="enter name">
                </div>
                <label class="col-md-2" for="fname">Father Name</label>
                <div class="col-md-4">
                    <input name="fathername" type="text" id="focusedInput" class="form-control"  placeholder="enter father name">
                </div>
                <label class="col-md-2" for="contact">Contact</label>
                <div class="col-md-4">
                    <input name="contact" type="text" id="focusedInput" class="form-control"  placeholder="enter phone no">
                </div>
                  <label class="col-md-2" for="cnic">CNIC No</label>
                <div class="col-md-4">
                    <input name="cnic" type="text" id="focusedInput"  placeholder="enter cnic no" class="form-control">
                    
                 </div>
               
                </div>
                <div class=" col-md-12 btnm">
                <diV>
                 <button type="submit" class="btn btn-primary btnm">Submit   </button>
          
             
      
                    <button type="reset" class="btn btn-primary btn-danger btnm   "> Reset  </button> 
                </div> 
            </div>
                   </form>
                   
        </div>
            
        
       
        
          
          
      
                    
     
             
        <div class="img-responsive" align="center">
             
             <img src="images/copyright.png" class="copyright">
                        </div>
    </body>
</html>
 