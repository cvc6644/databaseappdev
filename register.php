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
// define variables and set to empty values
$name = $email = $addressLine1 = $addressLine2 = $city = $state = $gender = "";
$nameErr = $emailErr = $addr1Err = $add2Err = $cityErr = $stateErr = $genderErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
   if (empty($_POST["address1"])) {
		   $addr1Err = "address is required";
   }
    else {
     $addressLine1 = test_input($_POST["address1"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $addr1Err = "Only letters and white space allowed"; 
     }
	}
   
   
   if (!empty($_POST["address2"])) {
     $addressLine2 = test_input($_POST["address2"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $add2Err = "Only letters and white space allowed"; 
	   }
   }
   
    if (empty($_POST["city"])) {
		$cityErr = "city is required";
	}
	else{
     $city = test_input($_POST["city"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $cityErr = "Only letters and white space allowed"; 
     }
   }
   
    if (empty($_POST["state"])) {
		$stateErr = "state is required";
	}
	else{
     $state = test_input($_POST["state"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $stateErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["gender"])) {
     $genderErr = "Gender is required";
   } else {
     $gender = test_input($_POST["gender"]);
   }
   
  
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
	<h1>User Registration</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Name: <input type="text" name="name"/>
   <span class="error">* <?php echo $nameErr;?></span>
   <br/><br/>
   E-mail: <input type="text" name="email" name="email" />
   <span class="error">* <?php echo $emailErr;?></span>
   <br/><br/>
   Address Line 1: <input type="text" name = "address1"/>
   <span class="error">* <?php echo $addr1Err;?></span>
    <br/><br/>
   Address Line 2: <input type="text" name="address2" />
   <span class="error">* <?php echo $add2Err;?></span>
   <br/><br/>
   City: <input type="text"  name="city"/>
   <span class="error">* <?php echo $cityErr;?></span>
   <br/><br/>
   State: <input type="text" name="state"/>
   <span class="error">* <?php echo $stateErr;?></span>
   <br/><br/>
   Gender:
   <input type="radio" name="gender"  value="female"/>Female
   <input type="radio" name="gender" value="male"/>Male
   <span class="error">* <?php echo $genderErr;?></span>
   <br/><br/>
   <input type="submit" name="submit" value="Submit"/> 
   <br/>  <br/>  <br/>
   <span class = "error">* required field</span>
</form>
</<center>
</body>
</html>