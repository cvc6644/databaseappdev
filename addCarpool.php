<html>
<head>
	<title>Add Carpool</title>
</head>
<body>



<?php>
    global $failed;
    require "connect.php";
    if(!empty($_POST)){
        if(addCarpool($_SESSION["uname"], $_POST["date"],$_POST["origin"] , $_POST["destination"])){
            $failed = FALSE;
        }else{
            $failed = TRUE;
        }
    }

?>
 <form method="post">
            <script type="text/javascript">
                function getCurrentDate(){
                    var currentDate= new Date();
                    var ss = currentDate.toISOString();
                    document.getElementById('date').setAttribute('min',ss.substring(0,ss.length-8));
                }
            </script>
            <?php
                    if(!$failed){
                        echo "<span style='color: green;'>Carpool Created Sucessfully</span>";
                    }else{
                        echo "<span style='color: red;'>Invalid Entry</span>";
                    }
            ?>
            Enter Desired Date and Time: <input type="datetime-local" id="date" name="date" onclick="getCurrentDate();" required><br/>
            Enter Origin: <input type="text" name="origin" required><br/>
            Enter Destination: <input type="text" name="destination" required><br/>
            <input type="submit" value="Submit">
    
        </form>
</body>
</html>