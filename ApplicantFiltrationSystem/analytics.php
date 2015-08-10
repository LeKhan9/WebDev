<html>
    
<head>
	<title>Applicant Rankings</title>
    <link rel="stylesheet" href="applicant.css"> 
    
        <div6><a href="documentation.html">Documentation Page</a> | <a href="index.php">Main Page</a></div6>

</head>

    <!--Creates main title block of page and fills COMPANY name dynamically using the GET from URL-->

        <div><center>
            <h1>Company Analytics Portal</h1>
            <form action="analytics.php" method="get">
                <h1> - APPLICANT ANALYTICS -</h1>

                <h2>
                Here you can filter applicants of your job roles by different categories. </br>
                You can also set weights for each category and then filter by "Weighted Score".</br>
                </h2>
            
                COMPANY:   <input type="text" name="compZ" id = "help2" value = "<?php echo $_GET["companyN"]; ?>" required readonly> 
            </form>
    </div></center>

<body>

    <?php
        // will keep track of user points, two created because one will have more added to it but both go into DB
       $scored = 0;     
       $points =0;
    ?>

    <div><center><form action="analytics2.php" method="get" target="_blank">
        
            </br>
                <h2>
                    If sorting by "Weighted Score", change assigned number weights below for each category. 
                    Ideally, keep weights less than or equal to 5 for optimal analysis. </br>
                </h2>
        
                
            GPA Weight:<input type="number" name="gpaW" min = "1" max = "5" value = "1" step = ".1" required></br>
            SAT Weight:<input type="number" name="satW" min = "1" max = "5" value = "1" step = ".1" required></br> 
            Time Weight:<input type="number" name="timeW" min = "1" max = "5" value = "1" step = ".1" required></br> 
            Points Weight:<input type="number" name="pointsW" min = "1" max = "5" value = "1" step = ".1" required></br> </br> 


    <!--Creates our drop down menus to choose position, applicants to list, and category to filter from-->

                    CHOOSE INTERN POSITION FROM DROP DOWN MENU: 
                <select type="submit" name="pos" id="selectImg">
                              <option >Web Development Intern</option>
                              <option >Software Engineer Intern</option>
            </select> </br></br>

            
                CHOOSE FILTER FROM DROP DOWN MENU: 
                <select type="submit" name="filter" id="selectImg">
                              <option >GPA</option>
                              <option >SAT</option>
                              <option >TIME</option>
                              <option >POINTS</option>
                              <option >SCORE</option>
                              <option >WEIGHTED SCORE</option>

            </select> </br></br>
                HOW MANY APPLICANTS TO LIST: 
                <select type="submit" name="toList" id="selectImg">
                              <option >3</option>
                              <option >5</option>
                              <option >10</option>
                              <option >15</option>
                              <option >20</option>
                              <option >25</option>
            </select> </br></br>
    
                <!--Use hidden input type just to pass information to URL bar of next page, could have used SessionStorage also-->

              <input type="hidden" name="compZ" id = "help2" value = "<?php echo $_GET["companyN"]; ?>" required readonly> 
    
                <h2>
                    For ease in viewing multiple filters together - the filtered list opens in a new tab. </br>
                </h2>

            Click <input type="submit" name="button"  value="FILTER"  /> to show filtered list.

    </form></center>

</body>

</html>