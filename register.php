<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE guvispanel";
	if (mysqli_query($conn, $sql)) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . mysqli_error($conn);
	}

$sql= "use guvispanel";
	if($conn->query($sql)==true){
	   echo "database selected MyGuests created successfully";

	} else {
	    echo "Error creating table: " . $conn->error;
	}

$sql= "Create table guvreg (id int(6) auto_increment primary key,fname varchar(20) not null,mname varchar(20) not null,lname varchar(20) not null,phone int(10) not null ,city varchar(20) not null ,institute varchar(20) not null ,email varchar(20) not null ,pwd varchar(20) not null  )";
if($conn->query($sql)==true){
   echo "Table MyGuests created successfully";

} else {
    echo "Error creating table: " . $conn->error;
}
$fname=$_GET['fname'];
$mname=$_GET['mname'];
$lname=$_GET['lname'];
$phone=$_GET['phone'];
$city=$_GET['city'];
$institute=$_GET['institute'];

$email=$_GET['email'];
$pwd=$_GET['pwd'];
$stmt = $conn->prepare("INSERT INTO guvreg (fname,mname,lname,phone,city,institute,email,pwd) VALUES (?, ?, ?,?,?, ?, ?, ?)");
$stmt->bind_param("sssissss", $fname,$mname,$lname,$phone,$city,$institute,$email,$pwd);


$stmt->execute();

$sql="select fname,mname,lname,phone,city,institute,email,pwd from guvreg "; 

$response = array();
$posts = array();
$result=$conn->query($sql);
while($row=$result->fetch_assoc()) { 
  $fname=$row['fname'];
	$mname=$row['mname'];
	$lname=$row['lname'];
	$phone=$row['phone'];
	$city=$row['city'];
	$institute=$row['institute'];
	$email=$row['email'];
	$pwd=$row['pwd'];

  $posts[] = array('fname'=> $fname, 'mname'=> $mname,'lname'=> $lname,'phone'=> $phone,'city'=> $city,'institute'=> $institute,'email'=> $email,'pwd'=> $pwd);
} 

$response['posts'] = $posts;

$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($response));
fclose($fp);






mysqli_close($conn);
header('Location: login.html');
?>