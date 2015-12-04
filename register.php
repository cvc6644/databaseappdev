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

if($allValid){ //needs to be updated to prompt before submission
	$conn = new mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,$dbport); #need to edit connect.php variables
	$sql = "SELECT uID FROM user WHERE uID = $_POST[uID]'" ; #change uID to usernme

	$usernamequery = $conn ->query($sql);

	if($usernamequery->num_rows != 0){
		echo "The username is taken";
	}
	else{
		$insert = "INSERT INTO user(uID,password,name,email,address,city,state,gender)
		VALUES ('$username,'$password,'$name','$email','$address','$city','$state','$gender')";
	
		if($conn->query($insert) == TRUE){
			echo "New record created successfully";
		}
		else{
			echo "Error: " .$sql . "<br>" . $conn ->error;
		}
		$conn ->close();
	}
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
   State: <select name="state">
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