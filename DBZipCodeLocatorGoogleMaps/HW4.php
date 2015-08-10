<!DOCTYPE html>
<html>
    
<head>
	<title>Zip Code Locator</title>
	<link rel="stylesheet" href="HW4.css">
</head>
    
<body>

    <div class="bannerBack">
        <div class="banner">
                <p>  &nbsp;&nbsp;&nbsp;&nbsp;  THE COM 214 ZIP CODE LOCATOR      
                    
                            <form class ="formy" action="HW4.php" method="get">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="button" type="submit" name="button" value="-- Create DB --" />
                            &nbsp;&nbsp;&nbsp;
                            <input class="button" type="submit" name="button" value="-- Drop  DB --" />
                                
                            <?php                                
                                $db_conn = mysql_connect("localhost", "root", "");

                                if( isset($_GET["button"]) ){
                                    
                                    // if the create DB button is pressed then we create the DB
                                    if( $_GET["button"] == "-- Create DB --"){

                                        // we check here if the button has been pressed before or not
                                        if(!mysql_select_db('zipcodes')) 
                                        {
                                            if (!$db_conn)
                                                die("Unable to connect: " . mysql_error()); 

                                             mysql_query("CREATE DATABASE zipcodes;", $db_conn);

                                            // makes the table of values according to CSV data
                                            mysql_select_db("zipcodes", $db_conn);
                                            $cmd = "CREATE TABLE clist (
                                                  zip varchar(5) NOT NULL PRIMARY KEY,
                                                  city varchar(35) ,
                                                  state varchar(2),
                                                  lat float(7,4),
                                                  lon float(7,4),
                                                  time int(1)
                                                );";
                                            mysql_query($cmd);

                                            // puts data from CSV file directly into DB
                                            $cmd = "LOAD DATA LOCAL INFILE 'zip_codes_usa.csv' INTO TABLE clist
                                                    FIELDS TERMINATED BY ',';";
                                            
                                            mysql_query($cmd);
                                          
                                            echo "DataBase Created";
                                        }
                                        
                                        // this is to check if we try to create again
                                        else
                                        {
                                            echo "DataBase Already Created";
                                        }
                                    }
                                    
                                    // action to drop database through button press
                                    if( $_GET["button"] == "-- Drop  DB --")
                                    {
                                        $retval = mysql_query( "DROP DATABASE zipcodes;", $db_conn );
                                        
                                        // to check if user hits button again - give message
			                             if(!$retval )
                                         {
  				                              echo "No DataBase to Drop";
                                         }
                                        else 
                                        {
			                                  echo "DataBase Dropped";	
                                        }
                                    }  
                                }
                        ?>  
                        </form>
                </p>
            <br>
        <div>
    <div>
                
    <div class = "mapCan">
          <div> 
            <canvas id="myCanvas" width="855" height="364" >
                        Your browser does not support the canvas element.
            </canvas>
    </div>
    </div>
    
    <div class="bottom">
        <div class="banner">
            <p>    
                    <form action="HW4.php" method="get" >
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    LATITUDE:   <input type="text" input size="5" id="xpos" name="xpos" readonly>
                    LONGITUDE:  <input type="text"  input size="5" id="ypos" name="ypos" readonly>              
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="button" type="submit" name="button" value="-- List Nearby Zipcodes --"  />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Items per Page   
                    <select type="submit" name="drop" id="selectImg">
                              <option >5</option>
                              <option >10</option>
                              <option >15</option>
                              <option >20</option>
                        </select> 
                    </form>                   
            </p>       
         </div>
        <div class ="tableIt">
            <?php

            // converts two lat-long values to distance in miles -- from Moodle
            // changed as to only keep two decimal points with number_format method
            function latLonToMiles($lat1, $lon1, $lat2, $lon2)
            {  //haversine formula
                $R = 3961;  // radius of the Earth in miles
                $dlon = ($lon2 - $lon1)*M_PI/180;
                $dlat = ($lat2 - $lat1)*M_PI/180;
                $lat1 *= M_PI/180;
                $lat2 *= M_PI/180;
                $a = pow(sin($dlat/2),2) + cos($lat1) * cos($lat2) * pow(sin($dlon/2),2) ;
                $c = 2 * atan2( sqrt($a), sqrt(1-$a) ) ;
                $d = $R * $c;
                return number_format((float)$d, 2, '.', '');	
            }

            if(isset($_GET["button"]) )
            {
                if( $_GET["button"] == "-- List Nearby Zipcodes --" )              
                {
                    $db_conn = mysql_connect("localhost", "root", "");

                    if (!$db_conn)
                        echo (" &nbsp;&nbsp;&nbsp; Error: " . mysql_error());

                    if( !mysql_select_db("zipcodes", $db_conn) )
                        echo ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No Existing DataBases, Create DataBase First!");
                    
                    else{
                    // obtain the lat, long from forms, and number of desired comparisons drop down is on
                    $mouseLat = $_GET['xpos'];
					$mouseLong = $_GET['ypos'];
					$rows = $_GET['drop'];      
                    
                    // this keeps the drop down menu on the current value even on refresh - writing to JS
                    echo "<script> selectImg.value = " . $rows. "</script>";

                    // Euclidean distance is found through Pythagorean Theorem, 
                    // we limit the number of rows we compare to and crosslist by comparison with this distance value
                    $cmd = "SELECT *,SQRT(POW((lat - $mouseLat),2)+POW((lon - $mouseLong),2)) AS distance
							FROM clist ORDER BY distance ASC limit $rows ";
                    
                    $printOut =  mysql_query($cmd);	
                    
					echo "<table id='table'>";	
					echo "<tr>";
                    echo("<td>Zip Code</td>
                          <td>City</td>
                          <td>State</td>
                          <td>Lat</td>
                          <td>Lon</td>
                          <td>Distance (miles)</td>
                          <td>Time Diff(ET)</td></tr>" ); 	
                

                    // Here each table data element is filled by going through the DB
                    // we index through the rows retrieved from the query above in ascending order of distance
                    // Actual Haversine distance is displayed in the output table and ET zone is adjusted with +5
					while($row = mysql_fetch_array($printOut))
                    {
						 echo( "<tr><td class='zip'>" .$row['zip'] . "</td> 
                                    <td class= 'twoCol'>" .$row['city']. "</td> 
                                    <td class= 'twoCol'>" .$row['state']."</td>
                                    <td class= 'threeCol'>" .$row['lat']."</td> 
                                    <td class= 'threeCol'>" .$row['lon']. "</td> 
                                    <td >" .(latLonToMiles($row['lat'], $row['lon'], $mouseLat, $mouseLong))."</td>
                                    <td >" .($row['time']+5). "</td></tr>" ); 
					}
					echo " </table>"."<br>";
                  }
                    
                }
            }
        ?>
        </div>
    </div>

   	<script type="text/javascript">   
        
        var canv=document.getElementById("myCanvas");
        
        // made global primarily to make drawing cursor simpler with 2 parameters
        var c=canv.getContext("2d");  
        
		function draw() {  
			    
			var img = new Image();  
			var w, h;
			
			img.onload = function(){  			  	  
				w=canv.width;		
				h=canv.height;					
				c.drawImage(img, 0, 0, w, h ); 	
                
                // local storage gets the previous location values and draws the cursor
                // see onload function below for more detail -- also updates the two lat-long forms
                if(sessionStorage.getItem("lastX"))
                {
					drawCircle(sessionStorage.lastX, sessionStorage.lastY);		
					xpos.value = sessionStorage.localtx;
					ypos.value = sessionStorage.localty;
                }
			} 
            img.src = "http://maps.googleapis.com/maps/api/staticmap?center="
        +"38.7,-96.5"+"&zoom=4&size=1200x340&sensor=false";
		}
		  		  
        // follows the cursor position - gets x and y of mouse
		function getMousePos(canvas, events){
    		var obj = canvas;
    		var top = 0, left = 0;
			var mX = 0, mY = 0;
   			while (obj && obj.tagName != 'BODY') { 
        		top += obj.offsetTop;
        		left += obj.offsetLeft;
        		obj = obj.offsetParent;
    		}
    		mX = events.clientX - left + window.pageXOffset;
    		mY = events.clientY - top + window.pageYOffset;
    		return { x: mX, y: mY };
		}
        
          //  draws cursor
         function drawCircle(w, h){      
            
            // outer black border with inner transparency circle, .35 alpha
            c.beginPath();
			c.arc(w,h,17,0,Math.PI*2);
			c.fillStyle = 'rgba(255,255,255,0.35)'; 
			c.strokeStyle = "black";  
			c.fill();
			c.stroke();
			c.closePath();
			
            // inner dot with small white boundary
			c.beginPath();
			c.arc(w,h,3,0,Math.PI*2);
			c.fillStyle = 'black';
			c.strokeStyle = "white";
			c.fill();
			c.stroke();
			c.closePath();
        }
			
		      window.onload = function(){
            
                draw();
    		    var canvas = document.getElementById('myCanvas'); 
    		    canvas.addEventListener('mousedown', function(events){
        		var mousePos = getMousePos(canvas, events);
   		  		var tx = document.getElementById("xpos");
                var ty = document.getElementById("ypos");
                    
                // uses ratio of X and Y coordinates of two points to Lat and Long
                // this becomes the slope and then point-slope form is used to formulate equation
                // decimal places are limited to 4 by toFixed method
		  		tx.value = (-.07403*mousePos.y + 52.0718).toFixed(4);
		  		ty.value = (.0657*mousePos.x - 124.6241).toFixed(4);
                       
                // creating local storage -- from class file   
                // here we store X and Y position and the form data.
                // draw is then called again to update cursor
                if(typeof(Storage)!=="undefined") {
                    
                    // stores each field - similar to count in local_storage.html but no incrementation
					sessionStorage.lastX = mousePos.x;
					sessionStorage.lastY = mousePos.y;
					sessionStorage.localtx = tx.value;
					sessionStorage.localty = ty.value;
				}
                draw();
			    }, false);
		  }	  	  	    
      </script>  
</body>

</html>