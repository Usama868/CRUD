<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
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
           
            <img src="images/photog2.png" width="180px" height="180px"  style="max-width: 100%;">
            
        </div>
    <style type="text/css">
        .wrapper{
            width: auto;
            max-width: 100%;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    
</head>
<body class="container" style= "background-image:url('images/abstract-art2 (2).jpg'); background-repeat: repeat; background-size: cover;">
    <nav class="col-md-6 navmargin">
            
            <div class="">
            <ul class="nav nav-divider nav-pills">
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
                    <div class="silver page-header clearfix">
                        <h2 class="pull-left"><i><b>User's Details</b></i></h2>
                        <a href="create.php" class=" btn btn-success pull-right"><span>ADD New User</span></a>
                    </div>
                    <?php
                    // Include config file
                    require_once "connect.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM form";
                    if($result = mysqli_query($connect, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class=' table table-responsive'>";
                                echo "<thead>";
                                    echo "<tr style='color:black; background-color:sandybrown;'>";
                                        echo "<th>ID</th>";
                                        echo "<th>Name</th>";
                                       
                                        echo "<th>Father-name</th>";
                                        echo "<th>Contact no</th>";
                                        echo "<th>Cnic  no</th>";
                                         
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr style='background-color:darkgray;  font-weight:normal';>";
                                        echo "<td style='color:brown'>" . $row['id'] . "</td>";
                                        echo "<td style='color:black'>" . $row['name'] . "</td>";
                                      
                                        echo "<td style='color:black'>" . $row['fathername'] . "</td>";
                                        echo "<td style='color:black'>" . $row['contact'] . "</td>";
                                        echo "<td style='color:black'>" . $row['cnic'] . "</td>";
                                        
                                        echo "<td align='center'>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='btn btn-success glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='btn btn-info glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='btn btn-danger glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect);
                    }
 
                    // Close connection
                    mysqli_close($connect);
                    ?>
                </div>
            </div>        
        </div>
    </div>
     <div>     
        <div class="img-responsive" align="center">
             
             <img src="images/copyright.png" class="copyright">
                        </div>
        </div>
</body>
</html>
