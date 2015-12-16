<html>
<head>
<title>Connecting MySQL Server</title>
</head>
<body>
<?php
require 'PasswordHash.php';
function connect(){
   $dbhost = 'mydbinstance.caaxufewczs3.us-east-1.rds.amazonaws.com';
   $dbuser = 'awsuser';
   $dbpass = 'iste43201';
   
   $conn = new mysqli($dbhost, $dbuser, $dbpass,"databaseappdev","3306");
   if($conn->connect_error )
   {
     die('Could not connect: ' . $conn->connect_error);
   }

   return $conn;
}
function validatePassword($username, $password){
    $connection = connect();
    $stmt = $connection->prepare("select uID from user where uID=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $cnt = $stmt->num_rows;
    if($cnt!=0){
        $stmt = $connection->prepare("select password from user where uID=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($pw);
        $stmt->store_result();
        $stmt->fetch();
        if(validate_password($password, $pw)){
            return TRUE;
        }else{
            return FALSE;
        }
    }else{
        return FALSE;
    }
    close($connection);
}  
function close($connection){
    $connection->close();
}

function insertUser($uName,$pass,$name,$email,$add1,$add2,$city,$state,$gender){
	$connection = connect();
    $stmt = $connection->prepare("select uID from user where uID=?");
    $stmt->bind_param("s", $unName);
    $stmt->execute();
    $cnt = $stmt->num_rows;
	close($connection);
	if($cnt!=0){
		echo "<span class='error'> username exsists please choose another</span>";
	}
	else{
		$connection = connect();
                
		$stmt = $connection->prepare("insert into user (uID,password,name,email,city,state,gender,add1,add2) values (?,?,?,?,?,?,?,?,?)");
		
		$stmt->bind_param("sssssssss", $uName,  create_hash($pass),$name,$email,$city,$state,$gender,$add1,$add2);
		$stmt->execute();
	}
	
	 close($connection);
}
function addCarpool($username,$date,$origin,$destination) {
    $connection = connect();
    
    $stmt = $connection->prepare("insert into Carpools (username,date,origin,destination) values (?,?,?,?)");
    $stmt->bind_param("ssss", $username,$date,$orgin,$destination);
    $stmt->execute();
    if($stmt->affected_rows > 0){
        return TRUE;
    }else{
        return FALSE;
    }
}

?>
</body>
</html>