<?php
// Check existence of modelnum parameter before processing further
if(isset($_GET["modelnum"]) && !empty(trim($_GET["modelnum"]))){
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "solarpv";
	$con = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}
    else
		
    // Prepare a select statement
    $sql = "SELECT * FROM product WHERE modelnum = ?";
    
    if($stmt = mysqli_prepare($con, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_modelnum);
      
        // Set parameters
        $param_modelnum = trim($_GET["modelnum"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
               
				
            } else{
                // URL doesn't contain valid modelnum parameter. Redirect to error page
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($con);
} else{
    // URL doesn't contain modelnum parameter. Redirect to error page
   echo "something is wrong";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Model Name</label>
                        <p><b><?php echo $row["modelnum"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>celltech</label>
                        <p><b><?php echo $row["celltech"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>cellman</label>
                        <p><b><?php echo $row["cellman"]; ?></b></p>
                    </div>
					<div class="form-group">
                        <label>numcels</label>
                        <p><b><?php echo $row["numcels"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>cellseries</label>
                        <p><b><?php echo $row["cellseries"]; ?></b></p>
                    </div>
					<div class="form-group">
                        <label>Number of Dios</label>
                        <p><b><?php echo $row["numdio"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Length</label>
                        <p><b><?php echo $row["len"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Width</label>
                        <p><b><?php echo $row["width"]; ?></b></p>
                    </div>
					<div class="form-group">
                        <label>Weight</label>
                        <p><b><?php echo $row["weight"]; ?></b></p>
                    </div>
                    		
                    <p><a href="CRUD.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>