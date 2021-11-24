<!DOCTYPE html>
<html>
<body>

<h1>Form</h1>

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
	echo "we Gucci";


$username = $_POST['username'];
$password = $_POST['password'];
$firstName = $_POST['fname'];
$middleName = $_POST['mname'];
$lastName = $_POST['lname'];
$compName = $_POST['cname'];
$address = $_POST['address'];
$officePhoneNo = $_POST['ophone'];
$cellPhoneNo = $_POST['hphone'];
$email = $_POST['email'];
 $sql= "INSERT INTO register (userid,password,firstName,lastName,middleName,officephone,cellphone,address,compname,email) 
 VALUES 
 ('$username', '$password','$firstName', '$middleName', '$lastName', '$officePhoneNo', '$cellPhoneNo', '$compName', '$address', '$email')";

$rs = mysqli_query($con, $sql);




if ($rs) {
  echo '<script type= "text/javascript">';
  echo 'alert("Congrats you are registered");';
  echo 'window.location.href="SolarPV.html";';
  echo '</script>'; 
} else {
 //echo "Error: " . $sql . "<br>" . mysqli_error($con);
  echo '<script type= "text/javascript">';
  echo 'alert("Username Taken");';
  echo 'window.location.href="Form.html";';
  echo '</script>';  
}


exit();
mysqli_close($con);

?>

</body>
</html>