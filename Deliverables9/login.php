<?php 

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
	echo "We Gucci";


$username = $_POST['username'];
$password = $_POST['password'];

 $sql= "SELECT password, staff FROM register WHERE userid='$username'";
 

$rs = mysqli_query($con, $sql);

 $row = mysqli_fetch_assoc($rs);
 

if ($password == $row['password'] ) 
{
	if($row['staff']){
		echo '<script type= "text/javascript">';
		echo 'alert("A Staff Member is log in now");';
		echo 'window.location.href="CRUD.php";';
		echo '</script>';
	}
	else
	{		
		echo '<script type= "text/javascript">';
		echo 'alert("User is now log in.");';
		echo 'window.location.href="SolarPV.html";';
		echo '</script>'; 	
	}
 
} 
else 
{
 //echo "Error: " . $sql . "<br>" . mysqli_error($con);
	echo '<script type= "text/javascript">';
	echo 'alert("Wrong username or password.");';
	echo 'window.location.href="Login.html";';
	echo '</script>'; 
}


exit();
mysqli_close($con);

?>