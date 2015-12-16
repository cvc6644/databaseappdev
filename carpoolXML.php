<?php
require("connect.php");

 $center_lat = $_GET["lat"];
 $center_lng = $_GET["lng"];
 $radius = $_GET["radius"];
 //Start XML file, create parent node
 $doc = = new DOMDocument("1.0");
 $node = $doc->createElement("markers");
 $parnode = $doc->appendchild($node);
  
  $conn = new mysql_connect($dbhost, $dbuser, $dbpass);
   if(!conn)
   {
     die('Could not connect: ' . mysql_error());
   }
   $database = mysql_select_db($cardb,$conn);
   if(!database){
		die('Can\'t use db:' . mysql_error());
   }
   $query = sprintf("SELECT address,lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($center_lng),
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($radius));
   $result = mysql_query($query);
	while($row =$result->@mysql_fetch_assoc($result)){		
			$node = $doc->create_element("marker");
			$newnode = $parnode->append_child($node);			
			$newnode->setAttribute("address",$row['address']);
			$newnode->setAttribute("lat", $row['latitude']);
			$newnode->setAttribute("lng", $row['longitude']);
    }
	
	echo $doc->saveXML();
	  ; 
?>