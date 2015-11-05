<html>
<head>
<style>
.error {
	color: #FF0000;
	}
</style>
</head>
<body>
<center>

<?php
require_once("dbException.php");
require_once("connect.php");


$errArr = array(
		"user"=>"",
		"pass"=>"",
		"name"=>"",
		"email"=>"",
		"add1"=>"",
		"add2"=>"",
		"city"=>"",
		"state"=>"",
		"gender"=>""
);
$requiredArr = array(
		"user"=>true,
		"pass"=>true,
		"name"=>true,
		"email"=>true,
		"add1"=>true,
		"add2"=>false,
		"city"=>true,
		"state"=>true,
		"gender"=>true

);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$inputArr = array(
		"user"=>empty($_POST["username"])?"":allOtherCheck("user",$_POST["username"]),
		"pass"=>empty($_POST["password1"]) && empty($_POST["password2"])?"":passCheck($_POST["password1"],$_POST["password2"]),
		"name"=>empty($_POST["name"])?"":allOtherCheck("name",$_POST["name"]),
		"email"=>empty($_POST["email"])?"":emailCheck($_POST["email"]),
		"add1"=>empty($_POST["address1"])?"":allOtherCheck("add1",$_POST["address1"]),
		"add2"=>empty($_POST["address2"])?"":allOtherCheck("add2",$_POST["address2"]),
		"city"=>empty($_POST["city"])?"":allOtherCheck("city",$_POST["city"]),
		"state"=>empty($_POST["state"])?"":allOtherCheck("state",$_POST["state"]),
		"gender"=>empty($_POST["gender"])?"":allOtherCheck("gender",$_POST["gender"])
);


$allValid = true;
foreach($inputArr as $key => &$value){
	if($errArr[$key] == "" || empty($errArr[$key])){
		if($value == "" && $requiredArr[$key] == true){
			$errArr[$key] = "this is a required field";
			$allValid = false;
		}
	}
	else 
		$allValid = false;
}

if($allValid){
	//db query here 
}

 


}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function passCheck($pass1,$pass2){
	global $errArr;
	if(!($pass1 == $pass2)){
		$errArr["pass"] = "passwords do not match";
		return "";
	}
	
	return $pass1;
}

function emailCheck($email){
	global $errArr;
	$email = test_input($email);
	// check if e-mail address is well-formed
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "here";
		$errArr["email"] = "Invalid email format";
		return "";
	}
	return $email;
}

function allOtherCheck($errKey,$input){
	global $errArr;
	$input = test_input($input);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$input)) {
		$errArr[$errKey] = "Only letters and white space allowed";
		return "";
	}
	return $input;
}
?>
	<h1>User Registration</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  Username: <input type="text" name="username"/>
   <span class="error"><?php 
   echo $requiredArr["user"]?"*":"";
   echo $errArr["user"]?></span>
   <br/><br/>
    Password: <input type="password" name="password1"/>
   <span class="error"><?php 
   echo $requiredArr["pass"]?"*":"";
   echo $errArr["pass"] ?></span>
   <br/><br/>
    Repeate password: <input type="password" name="password2"/>
     <span class="error"><?php 
     echo $requiredArr["pass"]?"*":"";
     echo $errArr["pass"];
     ?></span>
   <br/><br/>
   Name: <input type="text" name="name"/>
   <span class="error"><?php 
   echo $requiredArr["name"]?"*":"";
   echo $errArr['name'] ?></span>
   <br/><br/>
   E-mail: <input type="text" name="email" name="email" />
   <span class="error"> <?php 
   echo $requiredArr["email"]?"*":"";
   echo $errArr['email'] ?></span>
   <br/><br/>
   Address Line 1: <input type="text" name = "address1"/>
   <span class="error"><?php 
   echo $requiredArr["add1"]?"*":"";
   echo $errArr['add1']
   ?></span>
    <br/><br/>
   Address Line 2: <input type="text" name="address2" />
   <span class="error"> <?php 
   echo $requiredArr["add2"]?"*":"";
   echo $errArr['add2'] ?></span>
   <br/><br/>
   City: <input type="text"  name="city"/>
   <span class="error"> <?php 
   echo $requiredArr["city"]?"*":"";
   echo $errArr['city'] ?></span>
   <br/><br/>
   State: <input type="text" name="state"/>
   <span class="error"><?php 
   echo $requiredArr["state"]?"*":"";
   echo $errArr['state'] ?></span>
   <br/><br/>
   Gender:
   <input type="radio" name="gender"  value="female"/>Female
   <input type="radio" name="gender" value="male"/>Male
   <span class="error"> <?php 
   echo $requiredArr["gender"]?"*":"";
   echo $errArr['gender'] ?></span>
   <br/><br/>
   <input type="submit" name="submit" value="Submit"/> 
   <br/>  <br/>  <br/>
   <span class = "error">* required field</span>
   <h4 class = "error"><?php 
//	echo //$dbError;
   ?></h4>
</form>
</<center>
</body>
</html>