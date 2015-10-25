<html>
<head>
<title>Connecting MySQL Server</title>
</head>
<body>
<?php
   $dbhost = 'mydbinstance.caaxufewczs3.us-east-1.rds.amazonaws.com:3036';
   $dbuser = 'awsuser';
   $dbpass = 'iste43201';
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   if(! $conn )
   {
     die('Could not connect: ' . mysql_error());
   }
   echo 'Connected successfully';
   mysql_close($conn);
?>
</body>
</html>