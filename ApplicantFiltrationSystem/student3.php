<html>
    
<head>
	<title>Applicant Information</title>
    <link rel="stylesheet" href="applicant.css"> 
    <div6><a href="documentation.html">Documentation Page</a> | <a href="index.php">Main Page</a></div6>
</head>

        <!--Creates main title block of page and fills USER name dynamically using the GET from URL-->

        <div><center>
            <h1>Applicant Analytics Portal</h1>
            <form action="student4.php" method="get">
                <h1> - APPLICANT SCORE -</h1>

                <h2>
                You have reached the end of the application. Your holistic score is listed below. </br>
                You can find your answers to each question below, along with the correct answer.</br></br>
                Correct answers are given different point values depending on the answer, while</br> 
                incorrect answers are given 0 points. GPA and SAT are added to cumulative score.</br>
                There is a bonus for time reward -- more points for less time spent.</br></h2>
                USER NAME:   <input type="text" name="user" id = "help" value = "<?php echo $_GET["userN"]; ?>" required readonly> 
            </form>
    </div></center>

<body>

    
    <?php
        // keeps track of both values to be fed into DB
       $scored = 0;     
       $points =0;
    ?>

     <!--The skeleton of the Aptitude Test is recreated here and it shows the user answers and what the correct answers are; points are shown-->

    <div><center><form action="student4.php" method="get">
       
            </br></br></br></br>

            <b>1. </b>   &nbsp; You answered: <input type="number" name="q11"  id = "help" value = "<?php echo $_GET["q1"]; ?>"  readonly> Correct Answer: &nbsp; <?php echo 20 ?> &nbsp; </br></br><h5><b>POINTS</b></h5>:&nbsp;
                <?php 
                    if($_GET["q1"] == 20) 
                    {
                        // adds the corresponding point amount and prints it to screen
                        $scored = $scored+10;
                        $points = $points+10;
                        echo "+10";
                    }   
                    else
                    {
                        echo "0";       
                    }
                     
                ?> </br></br></br></br>

        
            <b>2. </b>   &nbsp; You answered: <input type="number" name="q21"  id = "help" value = "<?php echo $_GET["q2"]; ?>"  readonly> Correct Answer:       &nbsp; <?php echo 25 ?> &nbsp; </br></br><h5><b>POINTS</b></h5>:&nbsp;
                <?php 
                    if($_GET["q2"] == 25) 
                    {
                        $scored = $scored+30; 
                        $points = $points+30;
                        echo "+30";
                    }   
                    else
                    {
                        echo "0";       
                    }
                     
                ?> </br></br></br></br>

             <b>3. </b>   &nbsp; You answered: <input type="number" name="q31"  id = "help" value = "<?php echo $_GET["q3"]; ?>"  readonly> Correct Answer:       &nbsp;<?php echo 1 ?>&nbsp; </br></br><h5><b>POINTS</b></h5>:&nbsp;
                <?php 
                    if($_GET["q3"] == 1) 
                    {
                        $scored = $scored+50;
                        $points = $points+50;
                        echo "+50";
                    }   
                    else
                    {
                        echo "0";       
                    }
                     
                ?> </br></br></br></br>  
        
                                        
            <b>4. </b>   &nbsp; You answered: <input type="number" name="q41"  id = "help" value = "<?php echo $_GET["q4"]; ?>"  readonly> Correct Answer:       &nbsp; <?php echo 2 ?> &nbsp; </br></br><h5><b>POINTS</b></h5>:&nbsp;
                <?php 
                    if($_GET["q4"] == 2) 
                    {
                        $scored = $scored+80;
                        $points = $points+80;
                        echo "+80";
                    }   
                    else
                    {
                        echo "0";       
                    }
                     
                ?> </br></br></br></br> 



           <b>5. </b>   &nbsp; You answered: <input type="number" name="q51"  id = "help" value = "<?php echo $_GET["q5"]; ?>"  readonly> Correct Answer:       &nbsp; <?php echo 40 ?>&nbsp; </br></br><h5><b>POINTS</b></h5>:&nbsp;
                <?php 
                    if($_GET["q5"] == 40) 
                    {
                        $scored = $scored+150;
                        $points = $points+150;
                        echo "+150";
                    }   
                    else
                    {
                        echo "0";       
                    }
                     
                ?> </br></br></br></br>  

    <b>6. </b>   &nbsp; You answered: <input type="text" name="q61"  id = "help" value = "<?php echo $_GET["q6"]; ?>"  readonly> Correct Answer:       &nbsp; <?php echo "COMPUTER" ?>  &nbsp; </br></br><h5><b>POINTS</b></h5>:&nbsp;
                    <?php 
                        if($_GET["q6"] == "COMPUTER") 
                        {
                            $scored = $scored+200;
                            $points = $points+200;
                            echo "+200";
                        }   
                        else
                        {
                            echo "0";       
                        }

                    ?> </br></br>

                <!--Prints the various parts of the user score and shows how the math works behind it-->

            Your Raw Points: <?php echo "<h5>" . $points. "</h5>" ?></br>
          
            Your GPA: <?php echo "<h5>" . $_GET["gpa1"] . "</h5>" ?></br>
            Your SAT: <?php echo "<h5>" . $_GET["sat1"] . "</h5>" ?></br>
            Your Time Bonus: <?php echo "<h5>" . $_GET["time"] . "</h5>" ?></br>


            <?php $scored = $scored +  $_GET["gpa1"] + $_GET["sat1"] + (1/$_GET["time"])*100; ?>

           <?php $scored = number_format((float)$scored, 3, '.', ''); ?>
            
            Your Total Score: <?php echo "<h5>" . $scored. "</h5>" ?></br></br>

            
            <?php 
                    
            // allows for pseudo-dynamic user feedback - just a small expert system to give feedback based on specific value ranges            
            if( $scored < 1900)
            {
                echo "BETTER LUCK NEXT TIME ON YOUR SCORE ";
            }
            if( $scored > 1901 && $scored < 2200 )
            {
                echo "GOOD OVERALL SCORE ";
            }
            if( $scored > 2201 && $scored < 2400 )
            {
                echo "GREAT OVERALL SCORE ";
            }
            if( $scored > 2401)
            {
                echo "EXCELLENT OVERALL SCORE ";
            }

            echo "AND ";
            
            
             if( $points < 11)
            {
                echo "BAD POINTS TOTAL " . $_GET["userN"] . "!</br></br> ";
            }
            if( $points >12 && $points < 100 )
            {
                echo "LOW POINTS TOTAL " . $_GET["userN"] . "!</br></br> ";
            }
            if( $points > 101 && $points < 300 )
            {
                echo "OKAY POINTS TOTAL " . $_GET["userN"] . "!</br></br>";
            }
            if( $points > 301 && $points < 450)
            {
                echo "GOOD POINTS TOTAL " . $_GET["userN"] . "!</br></br> ";
            }
            if( $points > 451 && $points< 519)
            {
                echo "GREAT POINTS TOTAL " . $_GET["userN"] . "!</br></br> ";
            }
            if( $points > 519 )
            {
                echo "EXCELLENT POINTS TOTAL " . $_GET["userN"] . "!</br></br> ";
            }


                ?>

    <!--Hidden just to transfer data to redirect webpage and then GET through URL on other side-->

            <input type="hidden" name="userNamer" value = "<?php echo $_GET["userN"]; ?>"  readonly> 

            Click <input type="submit" name="button"  value="add"  /> to proceed to debriefing page.

    </form></center>

            <?php
                $db_conn = mysql_connect("localhost", "root", "");

                if (!$db_conn)
                    die("Unable to connect: " . mysql_error());

                if( !mysql_select_db("dbase", $db_conn) )
                    die("Database doesn't exist: " . mysql_error());

                    // waits for validation of user click of add button to put into DB
                    if( isset($_GET["button"]) ){
                    if( $_GET["button"] == "add" )

                        // puts various user values into actual database
                        $cmd = "INSERT INTO applicants (username, gpa, sat, email, job, company, q1, q2, q3, q4, q5, q6, time, score, points, decision )
                                VALUES ( '" . $_GET["firstN1"] . "','" . $_GET["gpa1"] . "', '" . $_GET["sat1"] . 
                                        "', '" . $_GET["passW1"] .  "', '" . $_GET["jobL1"] .  "', '" . $_GET["companyL1"] .  "', '" . $_GET["q1"] .  "', '" . $_GET["q2"] .  "', '" . $_GET["q3"] .  "', '" . $_GET["q4"] .  "', '" . $_GET["q5"] .  "', '" . $_GET["q6"] .  "', '" . $_GET["time"] .  "', '" . $scored . "', '" . $points . "', '0');";

                    }
                    mysql_query($cmd, $db_conn);	
            ?>  
</body>

</html>