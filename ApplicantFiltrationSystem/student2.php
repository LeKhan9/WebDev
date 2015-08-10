<html>
    
<head>
	<title>Applicant Information</title>
    <link rel="stylesheet" href="applicant.css">
    <div6><a href="documentation.html">Documentation Page</a> | <a href="index.php">Main Page</a></div6>
</head>
        
        <!--Creates main title block of page and fills USER name dynamically using the GET from URL-->
	<div><center>
    	<h1>Applicant Analytics Portal</h1>
        <form action="student3.php" method="get">
            <h1>TECHNICAL APTITUDE ASSESSMENT</h1>
            
            <h2>
            You must provide answers to each of the 6 questions below. </br>
            You will be scored based on your time and the accuracy of your answers.</br>
            There is a timer. You must click Start to begin the assessment. Finish by clicking Stop.</br></br></h2>
            USER NAME:   <input type="text" name="userN" id = "help" value = "<?php echo $_GET["firstN"]; ?>" required readonly> 
        </form>
    </div></center>

<script>
    
        // Adopted from Timer of W3Schools. 
        // Here we apply it to get numerical data on speed of applicant 
        // in answering questions. The value of the form we have is then input into our database. 
    
        var c = 0;
        var t;
        var timer_on = 0;

        function timedCount() {
            document.getElementById('txt').value = c;
            c = c+1;
            
            // although I am calling each tick a second on the user screen - 
            // here I assigned it as 2 seconds to make the penalty less
            // for time spent on the screen - other factors will weigh more inherently.
            t = setTimeout(function(){timedCount()}, 2000); 
        }

        function time() {
            if (!timer_on) {
                timer_on = 1;
                timedCount();
            }
        }

        function stop() {
            clearTimeout(t);
            timer_on = 0;
        }
</script>

<body>
    
        <!--Start button for Timer -->
            <center><div>
                <form >
                    <input type="button" value="Start Timer!" required onclick="time()"></br></br>
                    <h2>SEE ELAPSED TIME BELOW NEXT TO THE STOP BUTTON.</h2>
            </form></div></center>
    
    <!--Creates main skeleton of the Aptitude Test and passes this information to be validated on next web page and to calculate score-->

        <div><center><form action="student3.php" method="get">
       
            </br></br></br></br>
            <b>1. </b> (2+6) + (2x6) =  &nbsp; <input type="number" name="q1" required> </br></br></br></br>

        
            <b>2. </b> (120/6) + 5 =  &nbsp; <input type="number" name="q2" required> </br></br></br></br>

        
            <b>3. </b> (0%7) + (7%2) =  &nbsp; <input type="number" name="q3" required> </br></br></br></br>
        
                                        
            <b>4. </b> (((2+3)*5) + 10) % 3 =  &nbsp; <input type="number" name="q4" required> </br></br></br></br>

            <h2>
            Below will test your visual acuity along with decision making.</br>    
            Examine the image and answer the question afterwards in field 5.</br></br></h2>

            <!--puts image on canvas to be visualized as a test question-->

               <img id="square" width="675" height="466" src="squares.jpg" alt="SQUARES">
                <canvas id="myCanvas" width="20" height="20" >
                            Your browser does not support the canvas element.
                </canvas>
            
            <!--loads the image onto the canvas with JS when the windows opens-->

                <script>
                    window.onload = function() {
                    var c = document.getElementById("myCanvas");
                    var ctx = c.getContext("2d");
                    var img = document.getElementById("scream");
                    ctx.drawImage(img, 10, 10);
                }
                </script>
            </br></br>

            <b>5. </b> Number of Squares =  &nbsp; <input type="number" name="q5"  required> </br></br></br></br>

            <h2>
            Below will test your auditory acuity along with decision making.</br>
            Examine <b>Morse Code</b> symbols for each word. Then, choose the word from the audio.</br></br></h2>

            COMPUTER = &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-.-. --- -- .--. ..- - . .-. </br></br>
            APPLE = &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.- .--. .--. .-.. .</br></br>
            TESTING =  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-. ... - .. -. --.</br></br>
            SILLY =  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;... .. .-.. .-.. -.--</br></br></br>

            <!--Puts audio player onto the screen for user interaction and as a test question-->

                <audio controls>
                  <source src="morsecode.wav" type="audio/wav">
                  Your browser does not support the audio tag.
                </audio></br></br>
            <h2>
     
         <!--Gives warning to user because the drop down menu will rotate with a transformation-->
     
            Be careful when choosing from the blue drop down menu. Patience is key here. </br></br></h2>
            <div3>            <b>6. </b>CHOOSE WORD FROM DROP DOWN MENU: <select type="submit" name="q6" id="selectImg">
                              <option >APPLE</option>
                              <option >TESTING</option>
                              <option >COMPUTER</option>
                              <option >SILLY</option>
            </select> </br></br></div3>


        <!--Stop timer button and shows elapsed time, this goes into DB also -->

            <center><input type="button" value="Stop Timer!" required onclick="stop()"> 
                    <h4>Your Current Elapsed Time:  </h4><input type="text" name = "time" id="txt" size = "2" required readonly /> seconds</br>             </br></br>
                
    <!--Several hidden fields that are passed to next page through URL-->

            <input type="hidden" name="userN" value = "<?php echo $_GET["firstN"]; ?>"  readonly> 
            <input type="hidden" name="gpa1" value = "<?php echo $_GET["gpa"]; ?>"  readonly> 
            <input type="hidden" name="sat1" value = "<?php echo $_GET["sat"]; ?>"  readonly> 
            <input type="hidden" name="firstN1" value = "<?php echo $_GET["firstN"]; ?>"  readonly> 
            <input type="hidden" name="passW1" value = "<?php echo $_GET["passW"]; ?>"  readonly> 
            <input type="hidden" name="companyL1" value = "<?php echo $_GET["companyL"]; ?>"  readonly> 
            <input type="hidden" name="jobL1" value = "<?php echo $_GET["jobL"]; ?>"  readonly> 
            Click <input type="submit" name="button"  value="add"  /> to proceed to next section. </center></form></div></center> 
</body>

</html>