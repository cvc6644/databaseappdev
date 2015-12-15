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
$inputArr = isset($inputArr)?$inputArr:array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$inputArr = array(
		"user"=>empty($_POST["username"])?"":allOtherCheck("user",$_POST["username"],"/^[a-zA-Z0-9]*$/",6,20,"only numbers letters and white space allowed"),
		"pass"=>empty($_POST["password1"]) && empty($_POST["password2"])?"":passCheck($_POST["password1"],$_POST["password2"]),
		"name"=>empty($_POST["name"])?"":allOtherCheck("name",$_POST["name"],"/^[a-zA-Z]*$/",3,35,"only letters and white space allowed"),
		"email"=>empty($_POST["email"])?"":emailCheck($_POST["email"]),
		"add1"=>empty($_POST["address1"])?"":allOtherCheck("add1",$_POST["address1"],"/^[a-zA-Z0-9]*$/",6,254,"only numbers letters and white space allowed"),
		"add2"=>empty($_POST["address2"])?"":$_POST["address2"],
		"city"=>empty($_POST["city"])?"":allOtherCheck("city",$_POST["city"],"/^[a-zA-Z]*$/",3,35,"only letters and white space allowed"),
		"state"=>empty($_POST["state"])?"":$_POST["state"],
		"gender"=>empty($_POST["gender"])?"":$_POST["gender"]
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

if($allValid){ //needs to be updated to prompt before submission
	insertUser($inputArr['user'],$inputArr['pass'],$inputArr['name'],$inputArr['email'],$inputArr['add1'],$inputArr['add2'],$inputArr['city'],$inputArr['state'],$inputArr['gender']);
	  header("Location: index.php");
 
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
		
		$errArr["email"] = "Invalid email format";
		return "";
	}
	return $email;
}

function allOtherCheck($errKey,$input,$regex,$minLen,$maxLen,$errMsg){
	global $errArr;
	$input = test_input($input);
	if(strlen($input) > $maxLen || strlen($input) < $minLen){
		$errArr[$errKey] = "field is too long or too short must be between $minLen and $maxLen characters";
		return "";
	}
	
	if (!preg_match($regex,$input)) {
		$errArr[$errKey] = $errMsg;
		return "";
	}
	return $input;
}


?>
	<h1>User Registration</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  Username: <input type="text" name="username" value="<?php echo isset($inputArr['user'])?$inputArr['user']:"";?>"/>
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
   Name: <input type="text" name="name" value="<?php echo isset($inputArr['name'])?$inputArr['name']:"";?>"/>
   <span class="error"><?php 
   echo $requiredArr["name"]?"*":"";
   echo $errArr['name'] ?></span>
   <br/><br/>
   E-mail: <input type="text" name="email" value="<?php echo isset($inputArr['email'])?$inputArr['email']:"";?>" />
   <span class="error"> <?php 
   echo $requiredArr["email"]?"*":"";
   echo $errArr['email'] ?></span>
   <br/><br/>
   Address Line 1: <input type="text" name = "address1" value="<?php echo isset($inputArr['add1'])?$inputArr['add1']:"";?>"/>
   <span class="error"><?php 
   echo $requiredArr["add1"]?"*":"";
   echo $errArr['add1']
   ?></span>
    <br/><br/>
   Address Line 2: <input type="text" name="address2" value="<?php echo isset($inputArr['add2'])?$inputArr['add2']:"";?>" />
   <span class="error"> <?php 
   echo $requiredArr["add2"]?"*":"";
   echo $errArr['add2'] ?></span>
   <br/><br/>
   City: <input type="text"  name="city" value="<?php echo isset($inputArr['city'])?$inputArr['city']:"";?>"/>
   <span class="error"> <?php 
   echo $requiredArr["city"]?"*":"";
   echo $errArr['city'] ?></span>
   <br/><br/>
   State: <select name="state" value="<?php echo isset($inputArr['state'])?$inputArr['state']:"";?>">
  <option value="AL">AL</option>
	<option value="AK">AK</option>
	<option value="AZ">AZ</option>
	<option value="AR">AR</option>
	<option value="CA">CA</option>
	<option value="CO">CO</option>
	<option value="CT">CT</option>
	<option value="DE">DE</option>
	<option value="DC">DC</option>
	<option value="FL">FL</option>
	<option value="GA">GA</option>
	<option value="HI">HI</option>
	<option value="ID">ID</option>
	<option value="IL">IL</option>
	<option value="IN">IN</option>
	<option value="IA">IA</option>
	<option value="KS">KS</option>
	<option value="KY">KY</option>
	<option value="LA">LA</option>
	<option value="ME">ME</option>
	<option value="MD">MD</option>
	<option value="MA">MA</option>
	<option value="MI">MI</option>
	<option value="MN">MN</option>
	<option value="MS">MS</option>
	<option value="MO">MO</option>
	<option value="MT">MT</option>
	<option value="NE">NE</option>
	<option value="NV">NV</option>
	<option value="NH">NH</option>
	<option value="NJ">NJ</option>
	<option value="NM">NM</option>
	<option value="NY">NY</option>
	<option value="NC">NC</option>
	<option value="ND">ND</option>
	<option value="OH">OH</option>
	<option value="OK">OK</option>
	<option value="OR">OR</option>
	<option value="PA">PA</option>
	<option value="RI">RI</option>
	<option value="SC">SC</option>
	<option value="SD">SD</option>
	<option value="TN">TN</option>
	<option value="TX">TX</option>
	<option value="UT">UT</option>
	<option value="VT">VT</option>
	<option value="VA">VA</option>
	<option value="WA">WA</option>
	<option value="WV">WV</option>
	<option value="WI">WI</option>
	<option value="WY">WY</option>
  
   </select>
   <span class="error"><?php 
   echo $requiredArr["state"]?"*":"";
   echo $errArr['state'] ?></span>
   <br/><br/>
   Gender:
   <input type="radio" name="gender"  value="F"/>Female
   <input type="radio" name="gender" value="M"/>Male
   <span class="error"> <?php 
   echo $requiredArr["gender"]?"*":"";
   echo $errArr['gender'] ?></span>
   <br/><br/>
   <input type="submit" name="submit" value="Submit"/> 
   <br/>  <br/>  <br/>
   <span class = "error">* required field</span>
   <h4 class = "error"></h4>
</form>
</center>
</body>
</html>