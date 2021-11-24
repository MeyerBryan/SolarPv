<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "solarpv";
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) 
{
	 die("Connection failed: " . mysqli_connect_error());
}
// Define variables and initialize with empty values
$modelnum = $celltech = $cellman = $numcels = $cellseries = $numdio = $len = $width = $weight= "";
$modelnum_err = $celltech_err = $cellman_err = $numcels_err = $cellseries_err = $numdio_err = $len_err = $width_err = $weight_err = "";
 
if(isset($_POST["modelnum"]) && !empty($_POST["modelnum"])){ 
// Processing form data when form is submitted
    // Get hidden input value
    $modelnum = $_POST["modelnum"];

   
 
    // Validate 
    $input_celltech = trim($_POST["celltech"]);
    if(empty($input_celltech)){
        $celltech_err = "Please enter Cell tech.";     
    } else{
        $celltech = $input_celltech;
    }
    
    // Validate 
    $input_cellman = trim($_POST["cellman"]);
    if(empty($input_cellman)){
        $cellman_err = "Please enter the Cell Manufacturer.";     
    } else{
        $cellman = $input_cellman;
    }
     // Validate 
    $input_numcels = trim($_POST["numcels"]);
    if(empty($input_numcels)){
        $numcels_err = "Please enter number of cells.";     
    } else{
        $numcels = $input_numcels;
    }
    
    
    $input_cellseries = trim($_POST["cellseries"]);
    if(empty($input_cellseries)){
        $cellseries_err = "Please enter the Cell Series.";     
    } else{
        $cellseries = $input_cellseries;
    }
	
	// Validate 
    $input_numdio = trim($_POST["numdio"]);
    if(empty($input_numdio)){
        $numdio_err = "Please enter number of dios.";     
    } else{
        $numdio = $input_numdio;
    }
    
    // Validate 
    $input_len = trim($_POST["len"]);
    if(empty($input_len)){
        $len_err = "Please enter the lenght.";     
    } else{
        $len = $input_len;
    }
     // Validate 
    $input_width = trim($_POST["width"]);
    if(empty($input_width)){
        $width_err = "Please enter the width.";     
    } else{
        $width = $input_width;
    }
    
    
    $input_weight = trim($_POST["weight"]);
    if(empty($input_weight)){
        $weight_err = "Please enter the weight.";     
    } else{
        $weight = $input_weight;
    }
    // Check input errors before inserting in database
    if(empty($modelnum_err)){
        // Prepare an update statement
        $sql = "UPDATE product SET celltech=?, cellman=?, numcels=?, cellseries=?, numdio=?, len=?, width=?, weight=? WHERE modelnum=?";
  
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssi", $param_celltech, $param_cellman, $param_numcels, $param_cellseries, $param_numdio, $param_len, $param_width, $param_weight, $param_modelnum);
            
            // Set parameters
            $param_modelnum = $modelnum;
            $param_celltech = $celltech;
            $param_cellman = $cellman;
			$param_numcels = $numcels;
			$param_cellseries = $cellseries;
			$param_numdio = $numdio;
			$param_len = $len;
			$param_width = $width;
			$param_weight = $weight;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: CRUD.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($con);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["modelnum"]) && !empty(trim($_GET["modelnum"]))){
        // Get URL parameter
        $modelnum =  trim($_GET["modelnum"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM employees WHERE modelnum = ?";
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_modelnum);
            
            // Set parameters
            $param_modelnum = $modelnum;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        
        
        
        // Close connection
        mysqli_close($con);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        echo "yeah thats a big negative chief";
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                       
                        <div class="form-group">
                            <label>Cell Tech</label>
                            <input type="text" name="celltech"  <?php echo (!empty($celltech_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $celltech; ?>">
                            <span class="invalid-feedback"><?php echo $celltech_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Cell Manufacturer</label>
                            <input type="text" name="cellman"  <?php echo (!empty($cellman_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cellman; ?>">
                            <span class="invalid-feedback"><?php echo $cellman_err;?></span>
                        </div>
						 <div class="form-group">
                            <label>Number of Cells</label>
                            <input type="text" name="numcels"  <?php echo (!empty($numcels_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $numcels; ?>">
                            <span class="invalid-feedback"><?php echo $numcels_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Cell Series</label>
                            <input type="text" name="cellseries"  <?php echo (!empty($cellseries_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cellseries; ?>">
                            <span class="invalid-feedback"><?php echo $cellseries_err;?></span>
                        </div>
						
						 <div class="form-group">
                            <label>Number of Dios</label>
                            <input type="text" name="numdio"  <?php echo (!empty($numdio_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $numdio; ?>">
                            <span class="invalid-feedback"><?php echo $numdio_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Lenght</label>
                            <input type="text" name="len"  <?php echo (!empty($len_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $len; ?>">
                            <span class="invalid-feedback"><?php echo $len_err;?></span>
                        </div>
						
						 <div class="form-group">
                            <label>Width</label>
                            <input type="text" name="width"  <?php echo (!empty($width_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $width; ?>">
                            <span class="invalid-feedback"><?php echo $width_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="text" name="weight"  <?php echo (!empty($weight_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $weight; ?>">
                            <span class="invalid-feedback"><?php echo $weight_err;?></span>
                        </div>
                        <input type="hidden" name="modelnum" value="<?php echo $modelnum; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="CRUD.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>