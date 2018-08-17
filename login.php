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
	   
	} 

$sql= "use guvispanel";
	if($conn->query($sql)==true){
	   

	} 

$sql= "Create table guvreg (id int(6) auto_increment primary key,fname varchar(20) not null,mname varchar(20) not null,lname varchar(20) not null,phone int(10) not null ,city varchar(20) not null ,institute varchar(20) not null ,email varchar(20) not null ,pwd varchar(20) not null  )";
if($conn->query($sql)){

  
} 


$email=$_GET['email'];
$pwd=$_GET['pwd'];
$stmt = $conn->prepare("SELECT fname,lname,mname FROM guvreg WHERE email = ? AND pwd = ? ");
$stmt->bind_param("ss",$email,$pwd);


$stmt->execute();

$stmt->bind_result($fname,$mname,$lname);

 $stmt->fetch();
 

$str = file_get_contents('results.json');
$json = json_decode($str, true);

foreach ($json['posts'] as $field => $value) {
	if($fname==$value['fname'])
    echo "FirstName:".$value['fname']."<br> MiddleName:".$value['mname']."<br> LastName:".$value['lname']."<br> PhoneNumber:".$value['phone']."<br> city:".$value['city']."<br> Insitute".$value['institute']."<br> Email".$value['email'];
}



mysqli_close($conn);
?>