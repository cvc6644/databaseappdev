<?php
    global $badPassword;
    $badPassword = FALSE;
    require "connect.php";
    if(!empty($_POST)){
        if(validatePassword($_POST["username"], $_POST["password"])){
            $_SESSION['uname']= $_POST["username"];
            header("Location: "."http://".$_SERVER['HTTP_HOST']."directions.html");
            exit();
                    
        }else{
            
            $badPassword= TRUE;
        }
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .hf{
                background: #6699ff;
                height: 10em;
            }
            #bottom{
                position: absolute;
                top: 82.4%;
                width: 100%;
                
                padding-left: 1em;
            }
            footer{
                margin-top: 6em;
            }
            body{
                margin: 0;
            }
            #left {
                float: left;
                background: #669900;
                border-style: inset;
                height: 36.5em;
                width: 32.5%;
                z-index: 0;
                
                padding-left: 1em;
            }
            #center {
                left: 33%;
                background: #666666;
                position: absolute;
                width: 33%;
                height: 36.5em;
                border-style: outset;
                
                padding-left: 1em;
            }
            #header{
                padding-top: 1px;
                padding-left: 1em;
            }
            #right {
                left: 66.5%;
                
                background: #669900;
                position: absolute;
                border-style: inset;
                height: 36.5em;
                width: 33.4%;
                
                padding-left: 1em;
            }
            #invalid{
                color: red;
            }
            p{
                word-wrap: break-word;
                font-size: 1.5em;
                color: #ffffff;
            }
            #goal{
                
                color: #ffffff;
            }
            
        </style>
    </head>
    <body>
        <div id="header" class="hf"><h1>Let's Ride!</h1>
            <h5>Getting you to where you need to go.</h5></div>
        <div id="left">
            <form method="post"> 
                Username:<input name="username" type="text"/>
                Password:<input name="password" type="password"/>
                <?php
                    if($badPassword){
                        echo "<span id='invalid'>Invalid username or Password</span>";
                    }
                ?>
                <!--<span id="invalid">Invalid Username or Password</span>-->
                <br/><input type="submit" value="Login"/>
            </form>
            <a href="register.php">New User</a>
        </div>
        <div id="center"><h1 id="goal">Our Goal:</h1><p>
            We are attempting to create a carpool service such that residents of 
            both cities and towns will be able to find a suitable car pool for 
            their individual needs. By doing <br/>this we hope to reduce our carbon 
            footprint and to<br/> decrease traffic congestion in the places this
            website will work best.
            </p></div>
        <div id="right"><h1>Technologies Used:</h1>
            <ul>
                <li>Google Maps</li>
            </ul>
        </div>
        <div id="bottom" class="hf"><footer> created by Chase Caynoski, Alex Parkes, and Maxwell Sweikert</div>
        
    </body>
</html>



