<html>
<head>
    <title>Applicant Analytics HomePage</title>
    <link rel="stylesheet" href="applicant.css"> 

     <!--Link to documentation page provided in every page, most pages have link to main page also-->

    <div6><a href="documentation.html">Documentation Page</a></div6>
</head>
    
    <!--Title block of page-->

    <div><center>
            <form >
            <h1>Cloud Blue Applicant Analytics Platform</h1>

                <h2>
                 If you are a company recruiter, please sign in below.</br>
                If you are an applicant, please follow the corresponding link.</br></h2>
            </form>
    </div></center>
<body>

    <div><center>
            <form>
                <h11>  WHY CLOUD BLUE? </h11></br></br>

                <h22>
                 We go through the preliminary headaches so you do not need to!</br></h22>
                <h2> Hover your cursor over applicants in the picture below to see what we are talking about.</br>
</h2>
    <div3>
    <img src="apps.jpg"  style="width:304px;height:228px;"></div3></br></br>

<h22>BUT SERIOUSLY.</h22></br></br>This is the start of <div3><b>ƃuᴉddᴉlɟ</b></div3> the application process on its head.</br></br>
<h23><b>Our mission:  "to do the number crunching in order to save time for both applicants and companies and thereby allowing
    more preparation time for later stage interviews on the applicant end and finding even more talent faster on the company end - all with a single, simple platform extension to any site."</b></br>
</h23></br>

<h7>Through our lightening fast filtration system we rank applicants by several categories: GPA, SAT, Aptitude Test Scores, Test Times, and Overall Holistic Scores. We even have the option to create <b>Weighted Scores</b> where companies can weigh each category differently and produce a ranking through weighted equations - optimal for uniqueness.</h7></br></br>

            </form>
    </div></center>

    <!--Form to take user input for COMPANY and PASSWORD, will use GET method on this to extract info-->

   <center><div><form action="index.php" method="get">
       
            
            COMPANY:   <input type="text" name="companyN" pattern="[A-Z][a-z]+" 
                                title="Company name starting with UPPER case letter" placeholder="Google, Microsoft, Oracle" required> 
       
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       
            PASSWORD: <input type="password" name="passN" title="Company Password as provided." required> </br></br>
    

    <div5>
        Click <input type="submit" id = "cyan" name="button"  value="Submit"  /> to proceed.</div5></br>

    
       <?php
        

        // This is a validation sequence to see if the username and password match up, if not - the user is notified.
        if( isset($_GET["button"]) )
        {
            if( $_GET["button"] == "Submit" )
            {

                if($_GET["companyN"] == "Google" && $_GET["passN"] == "Googlepass3")
                {
                       header("Location: analytics.php?companyN=Google");

                }
                if($_GET["companyN"] == "Microsoft" && $_GET["passN"] == "Microsoftpass3")
                {
                       header("Location: analytics.php?companyN=Microsoft");
                }
                if($_GET["companyN"] == "Oracle" && $_GET["passN"] == "Oraclepass3")
                {
                       header("Location: analytics.php?companyN=Oracle");
                }
                else
                {
                    echo "<h6><b>Log in is Wrong! Try Again!</b></h6>";
                }            
            }   
        }
?>
    </form></div></center>


    <!--Button links directly to student application portal-->

    <center><div><form action = "student.php" >
        <div4><input type="submit" id = "test" name="press"  value="ENTER APPLICANT PORTAL"  /> </div4>
    </form></div></center>

	<div>
		<?php
            $db_conn = mysql_connect("localhost", "root", "");
            if (!$db_conn)
                die("Unable to connect: " . mysql_error()); 
            
            if (mysql_query("CREATE DATABASE dbase;", $db_conn))
                echo "";
            
            mysql_select_db("dbase", $db_conn);
            
            // creating applicants list and defining variables
            $cmd = "CREATE TABLE applicants(
                        username varchar(60) NOT NULL PRIMARY KEY,
                        email varchar(30),
                        gpa float(3,2),
                        sat int(4),
                        job varchar(30),
                        company varchar(30),
                        q1 int(6),
                        q2 int(6),
                        q3 int(6),
                        q4 int(6),
                        q5 int(6),
                        q6 varchar(30),
                        time int(3),
                        score float(11,3),
                        points float(11,2),
                        decision varchar(30)
                    );";
            
            mysql_query($cmd, $db_conn);

            // creating companies list and defining variables
            $cmd = "CREATE TABLE companies(
                        company varchar(60) NOT NULL PRIMARY KEY,
                        password varchar(30)
                        );";
            
            mysql_query($cmd, $db_conn);

                // this inputs example users into the DB to see how the filtration process works
             $cmd = "INSERT INTO applicants (username, gpa, sat, email, job, company, time, score, points)
                                VALUES 
                                ( 'ABE_A','3.8', '2200', 'a@b.com', 'Software Engineer Intern', 'Google', '11','2500', '518'),
                                ( 'ABE_B','3.4', '2320', 'a@b.com', 'Software Engineer Intern', 'Oracle', '10','2600', '422'),
                                ( 'ABE_C','3.2', '2000', 'a@b.com', 'Software Engineer Intern', 'Microsoft', '13','2200', '190'),
                                ( 'ABE_D','3.1', '1900', 'a@b.com', 'Web Development Intern', 'Google', '9','2000', '110'),
                                ( 'ABE_E','3.1', '1800', 'a@b.com', 'Web Development Intern', 'Google', '6','4000', '320'),
                                ( 'ABE_F','3.5', '2000', 'a@b.com', 'Web Development Intern', 'Google', '8','3000', '120'),
                                ( 'ABE_G','3.9', '2230', 'a@b.com', 'Software Engineer Intern', 'Google', '11','2520', '230'),
                                ( 'ABE_H','3.85', '2250', 'a@b.com', 'Software Engineer Intern', 'Oracle', '14','2290', '120'),
                                ( 'ABE_I','3.82', '2290', 'a@b.com', 'Software Engineer Intern', 'Oracle', '21','2520', '301'),
                                ( 'ABE_J','3.28', '1680', 'a@b.com', 'Web Development Intern', 'Microsoft', '22','2510', '111'),
                                ( 'ABE_K','3.18', '900', 'a@b.com', 'Web Development Intern', 'Google', '22','2900', '100'),
                                ( 'ABE_L','3.38', '2090', 'a@b.com', 'Web Development Intern', 'Google', '40','3900', '110'),
                                ( 'ABE_M','3.85', '2400', 'a@b.com', 'Software Engineer Intern', 'Oracle', '42','3500', '190'),
                                ( 'ABE_N','3.80', '2100', 'a@b.com', 'Software Engineer Intern', 'Oracle', '49','3520', '201'),
                                ( 'ABE_O','2.8', '1930', 'a@b.com', 'Web Development Intern', 'Oracle', '51','3590', '230'),
                                ( 'ABE_P','2.18', '1300', 'a@b.com', 'Web Development Intern', 'Microsoft', '52','2590', '270'),
                                ( 'ABE_Q','3.38', '1590', 'a@b.com', 'Web Development Intern', 'Microsoft', '7','1990', '390'),
                                ( 'ABE_R','1.8', '2300', 'a@b.com', 'Software Engineer Intern', 'Microsoft', '6','3000', '280'),
                                ( 'ABE_S','4.0', '2100', 'a@b.com', 'Software Engineer Intern', 'Microsoft', '61','3500', '230'),
                                ( 'ABE_T','3.28', '2310', 'a@b.com', 'Web Development Intern', 'Oracle', '9','3590', '370'),
                                ( 'ABE_U','2.38', '2390', 'a@b.com', 'Web Development Intern', 'Oracle', '88','3880', '390'),
                                ( 'ABE_V','4.0', '2400', 'a@b.com', 'Web Development Intern', 'Google', '13','3590', '380'),
                                ( 'ABE_W','3.18', '1900', 'a@b.com', 'Web Development Intern', 'Google', '33','3500', '360'),
                                ( 'ABE_X','3.98', '1700', 'a@b.com', 'Web Development Intern', 'Oracle', '77','4500', '510'),
                                ( 'ABE_Y','2.9', '2400', 'a@b.com', 'Web Development Intern', 'Oracle', '55','3900', '520'),
                                ( 'ABE_aa','2.8', '2310', 'a@b.com', 'Software Engineer Intern', 'Oracle', '15','4900', '500'),
                                ( 'ABE_bb','2.18', '1200', 'a@b.com', 'Software Engineer Intern', 'Microsoft', '51','4010', '490'),
                                ( 'ABE_cc','3.08', '600', 'a@b.com', 'Web Development Intern', 'Microsoft', '12','2530', '300'),
                                ( 'ABE_dd','1.08', '2090', 'a@b.com', 'Web Development Intern', 'Microsoft', '33','3530', '400'),
                                ( 'ABE_ee','3.68', '2290', 'a@b.com', 'Software Engineer Intern', 'Microsoft', '8','3590', '390'),
                                ( 'ABE_ff','3.58', '2220', 'a@b.com', 'Software Engineer Intern', 'Google', '9','4200', '330'),
                                ( 'ABE_gg','3.48', '2310', 'a@b.com', 'Web Development Intern', 'Google', '12','4400', '309'),
                                ( 'ABE_hh','2.38', '1290', 'a@b.com', 'Software Engineer Intern', 'Oracle', '18','4100', '305'),
                                ( 'ABE_ii','2.68', '1210', 'a@b.com', 'Software Engineer Intern', 'Google', '17','3590', '350'),
                                ( 'ABE_jj','4.0', '2400', 'a@b.com', 'Web Development Intern', 'Google', '19','5000', '390'),
                                ( 'ABE_kk','3.91', '2390', 'a@b.com', 'Software Engineer Intern', 'Google', '7','2900', '330'),
                                ( 'ABE_ll','3.87', '2310', 'a@b.com', 'Web Development Intern', 'Oracle', '71','2550', '360'),
                                ( 'ABE_mm','3.89', '2230', 'a@b.com', 'Web Development Intern', 'Oracle', '61','2582', '370'),
                                ( 'ABE_nn','3.88', '2330', 'a@b.com', 'Web Development Intern', 'Oracle', '31','2502', '350'),
                                ( 'ABE_oo','2.89', '1870', 'a@b.com', 'Web Development Intern', 'Microsoft', '51','2202', '210'),
                                ( 'ABE_pp','2.9', '1900', 'a@b.com', 'Software Engineer Intern', 'Google', '41','2002', '220'),
                                ( 'ABE_qq','2.69', '900', 'a@b.com', 'Software Engineer Intern', 'Microsoft', '44','2802', '200'),
                                ( 'ABE_rr','3.48', '1400', 'a@b.com', 'Software Engineer Intern', 'Google', '8','3502', '360'),
                                ( 'ABE_ss','3.38', '1900', 'a@b.com', 'Web Development Intern', 'Google', '66','4502', '330')
                                
                                ;";

            mysql_query($cmd, $db_conn);	
                
            // inputting password and username into the DB for companies
            $cmd = "INSERT INTO companies (company, password)
                                VALUES ('Google', 'Googlepass3'),
                                       ('Microsoft','Microsoftpass3'),
                                       ('Oracle', 'Oraclepass3');";

            mysql_query($cmd, $db_conn);	     
            mysql_close($db_conn);
        ?>     
    </div>
    
</body>