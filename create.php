<?php
// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$name= $fathername= $contact = $cnic = $email = "";
$name_err = $fathername_err = $contact_err = $cnic_err = $email_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] === "POST"){
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
        $contact_err = "Please enter the  no.";     
    } elseif(!ctype_digit($input_contact)){
        $contact_err = "Please enter a correct format.";
    } else{
        $contact = $input_contact;
       
    }
     //cnic no 
    $input_cnic = trim($_POST["cnic"]);
    if(empty($input_cnic)){
        $cnic_err = "Please enter the  cnic no.";     
    }  else{
      $cnic = $input_cnic;
    }
     //email address
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter the  email address.";     
    }  else{
      $email = $input_email;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($fathername_err) && empty($contact_err) && empty($cnic_err) && empty($email_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO form (name, fathername, contact,cnic,email) VALUES (?, ?, ?,?,?)";
         
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_fathername, $param_contact, $param_cnic, $param_email);
            
            // Set parameters
            $param_name = $name;
            $param_fathername = $fathername;
            $param_contact = $contact;
            $param_cnic = $cnic;
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //Records created successfully. Redirect to landing page
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
        <title>ADD USER</title>
        <script src = "script/jquery-min-js.js"></script>
        <script src = "script/bootstap-min-js.js"></script>
                  <link href = "bootstrap/bootstrapCSS.css" rel = "stylesheet" type="text/css">
                  <link href = "Css/style.css" rel = "stylesheet" type="text/css">
                  <link rel="stylesheet" type="text/css" href="Css/w3.css">
                  <link rel="stylesheet" type="text/css" href="Css/colors.css">
            <div class="head img-responsive">
           
            <img src="images/photog2.png" width="180px" height="180px"  style="max-width: 100%">
         
        </div>
    
    </head>
    <body class="container" style= "background-image:url('images/abstract-art2 (2).jpg'); background-repeat: repeat-y; background-size: cover;">
        
        
        <nav class="col-md-6 navmargin">
            
            <div class="">
            <ul class="nav nav-divider  nav-pills">
                <li class="active"><a href="index.php" target="_self">Home</a></li>
                <li><a href="#" target="_self">ADD</a></li>
                <li><a href="update.php" target="_self">Update</a></li>
              
               
               
                
            </ul>
        </div>
        </nav>
       
       
        
    
     
      
        <div class="col-md-12">
            <div class="page-header">
                <h2 class="green"><I><b>Create Record</b></i></h2>
                <p class="silver"><i>Please fill this form and submit to add User record to the database.</i></p>
            </div>
                   <br/>
                   
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          
            <div class="form-group">
                <div class="<?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label class="col-md-2 silver" for=Name">Name</label>
                
                <div class="col-md-4">
                    <input name="name" type="text" id="focusedInput" class="form-control"   placeholder="enter name"  value="<?php echo $name; ?>">
                    <span class="help-block"><?php echo $name_err;?></span>
                </div>
                </div>
                
                <div class="<?php echo (!empty($fathername_err)) ? 'has-error' : ''; ?>">
                <label class="col-md-2 silver" for="fname">Father Name</label>
                <div class="col-md-4">
                    <input name="fathername" type="text" id="focusedInput" class="form-control"  placeholder="enter father name"  value="<?php echo $fathername; ?>">
                      <span class="help-block"><?php echo $fathername_err;?></span>
                </div>
                </div>
              
                
                <Div class="<?php echo (!empty($contact_err)) ? 'has-error' : ''; ?>">
                    <label class="col-md-2 silver" for="contact">Contact</label>
                <div class="col-md-4">
                    <input name="contact" type="text" id="focusedInput" class="form-control"  placeholder="enter phone no" value="<?php echo $contact; ?>">
                      <span class="help-block"><?php echo $contact_err;?></span>
                </div>
                </div>
                
                <div class="<?php echo (!empty($cnic_err)) ? 'has-error' : ''; ?>">
                  <label class="col-md-2 silver" for="cnic">CNIC No</label>
                <div class="col-md-4">
                    <input name="cnic" type="text" id="focusedInput"  placeholder="enter cnic no" class="form-control" value="<?php echo $cnic; ?>">
                      <span class="help-block"><?php echo $cnic_err;?></span>
                    
                 </div>
                </div>
              
                </div>
                <div class="btnm">
                <diV>
                 <button type="submit" class="btn btn-success btnm">Submit   </button>
          
             
      
                   
                    <a href="index.php" class="btn btn-warning btnm">Cancel</a>
                </div> 
            </div>
                   </form>
                   
        </div>
            
        
       
        
          
          
      
                    
     
        <div>     
        <div class="img-responsive" align="center">
             
             <img src="images/copyright.png" class="copyright">
                        </div>
        </div>
    </body>
</html>
 