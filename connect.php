<html>
<head>
<title>Connecting MySQL Server</title>
</head>
<body>
<?php
function connect(){
   $dbhost = 'mydbinstance.caaxufewczs3.us-east-1.rds.amazonaws.com';
   $dbuser = 'awsuser';
   $dbpass = 'iste43201';
   
   $conn = new mysqli($dbhost, $dbuser, $dbpass,"databaseappdev","3306");
   if($conn->connect_error )
   {
     die('Could not connect: ' . $conn->connect_error);
   }
   echo 'Connected successfully';
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
        if($password == $pw){
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
?>
</body>
</html>