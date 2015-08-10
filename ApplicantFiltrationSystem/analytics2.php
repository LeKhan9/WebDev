<html>
    
<head>
	<title>Applicant Rankings</title>
    <link rel="stylesheet" href="applicant.css"> 
    <div6><a href="documentation.html">Documentation Page</a> | <a href="index.php">Main Page</a></div6>
</head>
    
        <!--Creates main title block of page and fills COMPANY name dynamically using the GET from URL-->
        <center><div>
            <h1>Company Analytics Portal</h1>
            <form action="analytics2.php" method="get">
                <h1> - APPLICANT FILTERED LIST -</h1>
                <h2>
                Filtered List is below. Please go back to filtering page if more filtering is desired. </br>
                </h2>
                COMPANY:   <input type="text" name="user" id = "help2" value = "<?php echo $_GET["compZ"]; ?>" required readonly> 
            </form>
    </div>

<body>

    <?php

        // obtains variable information from previous page and squashes it to variables that the DB "knows"
       $compname = $_GET["compZ"];   
       $by = $_GET["filter"];   
        if($by == "GPA")
        {
            $by = "gpa";
        } 
        if($by == "SAT")
        {
            $by = "sat";
        }
        if($by == "TIME")
        {
            $by = "time";
        } 
        if($by == "POINTS")
        {
            $by = "points";
        }
        if($by == "SCORE")
        {
            $by = "score";
        } 
        if($by == "WEIGHTED SCORE")
        {
            $by = "weightedscore";
        }

       $job = $_GET["pos"];
       $limit = $_GET["toList"]; 


        // will use to provide weights for DB variables
        $gpaWe = $_GET["gpaW"];
        $satWe = $_GET["satW"];
        $pointsWe = $_GET["pointsW"];
        $timeWe = $_GET["timeW"];
    ?>
    
    <?php
                $db_conn = mysql_connect("localhost", "root", "");

                if (!$db_conn)
                    die("Unable to connect: " . mysql_error());

                if( !mysql_select_db("dbase", $db_conn) )
                    die("Database doesn't exist: " . mysql_error());


            // we essentially want to filter in Ascending order if we filter by time versus any other category
            if($by == "time")   
            {
                $records = mysql_query("SELECT *, $by AS gpar FROM applicants WHERE company= '$compname' AND job= '$job' ORDER BY gpar ASC limit $limit ;");
            }
            // this is for adding weights to each variables from the php variables declarations above
            else if($by == "weightedscore")
            {
                $records = mysql_query("SELECT *, (($gpaWe*gpa) + ($satWe*sat) + ($pointsWe*points) + ((1/($timeWe*time))*100)) AS gpar FROM applicants WHERE company= '$compname' AND job= '$job'  ORDER BY gpar DESC limit $limit ;");
            }

            else
            {
                $records = mysql_query("SELECT *, $by AS gpar FROM applicants WHERE company= '$compname' AND job= '$job' ORDER BY gpar DESC limit $limit ;");
            }
           
            // creates table headers for visual feedback to company -- actualy filtered table data goes under this
			echo( "\t\t<table> <tr> <td>USERNAME</td> <td>POSITION</td> <td>GPA</td> <td>SAT</td> <td>TIME</td> <td>SCORE</td> <td>POINTS</td> <td>WEIGHTED SCORE</td><td>EMAIL</td></tr>" . PHP_EOL  );	

            // outputs table data after filtering is done in the manner we want it to - under specific headers
			while($row = mysql_fetch_array($records))                
				echo( "\t\t\t<tr> <td class= 'oneCol'>" . $row['username'] . "</td> <td class = 'twoCol'>" . $row['job'] . "</td> <td class= 'threeCol'>" .
                $row['gpa'] . "</td> <td class= 'fourCol'>" . $row['sat'] . "</td> <td class = 'fiveCol'>" . $row['time'] . "</td> <td class= 'sixCol'>" . $row['score'] . "</td> <td class= 'sevenCol'>" . $row['points'] . "</td> <td class='eightCol'>" .number_format((float)(($gpaWe*$row['gpa']) + ($satWe*$row['sat']) + ($pointsWe*$row['points']) + ((1/($timeWe*$row['time']))*100)), 2, '.', '')  . "</td><td class= 'oneCol'>" . $row['email'] . "</td></tr>" . PHP_EOL );				
			echo("\t\t</table>");
            ?>  
    
</center></body>

</html>