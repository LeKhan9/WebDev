<!DOCTYPE html>
<html>
    
<head>
	<title>Applicant Information</title>
    <link rel="stylesheet" href="applicant.css"> 
    <div6><a href="documentation.html">Documentation Page</a> | <a href="index.php">Main Page</a></div6>
</head>
    
    <script>
            // obtains from the jobs file data which will populate the table of open job positions
            xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","jobs.xml",false);
            xmlhttp.send();
            xmlDoc=xmlhttp.responseXML; 
            x=xmlDoc.getElementsByTagName("JOB");
        
            // assigns variables which are used to create string of output data to be shown to user on click
            function display(i)
            {
                company=(x[i].getElementsByTagName("COMPANY")[0].childNodes[0].nodeValue);
                title=(x[i].getElementsByTagName("TITLE")[0].childNodes[0].nodeValue);
                place=(x[i].getElementsByTagName("LOCATION")[0].childNodes[0].nodeValue);
                pay=(x[i].getElementsByTagName("PAY")[0].childNodes[0].nodeValue);
                term=(x[i].getElementsByTagName("TERM")[0].childNodes[0].nodeValue);
                post=(x[i].getElementsByTagName("POSIT")[0].childNodes[0].nodeValue);    
                img=(x[i].getElementsByTagName("IMG")[0].childNodes[0].nodeValue);    
                txt="<b>Company</b>: "+company+ "<br><img src="+img+"></img> "+"<br><b>Title</b>: "+title +"<br><b>Term</b>: "+ term + "<br><b>Location</b>: "+ place +"<br><b>Pay</b>: "+ pay  ;
                document.getElementById("show").innerHTML=txt;
                jobL.value = title;
                companyL.value = company;
            }
    </script>
    
    <!--Form to obtain user information - GET will be used to display and pass information to server/ communicate with mySQL-->
	<div><center>
    	<h1>Applicant Analytics Portal</h1>
        
        <!--Will redirect to second student page with test on it - information will be populated there too using GET-->
        <form action="student2.php" method="get">
            <h1>ADD INFORMATION HERE TO BEGIN APPLICATION</h1>
            <h2>
           It is important for both you and the company that you apply to that your information is fully truthful. 
           This video was provided from our sponsoring company, Google.</h2>
            
                        <!--Places important video for user to see before creating application.-->

                        <video width="400" height="300" controls> 
                            Google Video
                            <source src="Google_Tips.mp4" type="video/mp4">
                          </video></br></br>
            <h2>
            All input fields are required without exception. </br>
            Hover over each input box to show required pattern for input.</br></br></h2>

            <!--For each input we set a pattern and give a title to guide user-->

            USER NAME:   <input type="text" name="firstN" pattern="[A-Z]+_[A-Z]+" 
                                title="UPPER case FIRST NAME followed by _ and UPPERCASE LAST NAME" placeholder="FIRSTNAME_LASTNAME" required> 
    
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
             GPA:  &nbsp; <input type="number" name="gpa" min="0" max="4" step=".01" 
                                 title="Cumulative GPA on a 4.0 scale - can use arrows to increment/decrement" placeholder="    _ . _ _"                                            required> 
             <br /> <br />

            EMAIL: <input type="email" name="passW" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}" 
                             title="Must be in lowercase email format -- x@y.z " placeholder="                   x@y.z"   required>


    
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
            SAT:    &nbsp;<input type="number" name="sat" min="0" max="2400" step="any" 
                                 title="best SAT on 2400 scale" placeholder="    _ _ _ _"   required></br></br>

            <h2>
            Fields below will be filled by clicking on one of the open positions below. </br>
            </br></h2>

            COMPANY:   <input type="text" name="companyL" id = "companyL" title="Company name to be filled by options below" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
            JOB TITLE:   <input type="text" name="jobL" id = "jobL" title="Job title to be filled by options below" required readonly> </br></br>


            <!--PHP validation waits for this button click to advance form-->

            Click <input type="submit"  name="button"  value="add"  /> to proceed to next section.

        </form>

    </div></center>

<!--This, in tandem with the XML/ Javascript above displays the table of possible open positions to apply to-->

        <center><div id='show'> <h3>Click on open sponsor positions in table below to show more information :</h3></div>
        <script>
            document.write("<table border='1'>");
            for (var i=0;i<x.length;i++)
              { 
                  document.write("<tr onclick='display(" + i + ")'>");
                  document.write("<td>");
                  document.write(x[i].getElementsByTagName("POSIT")[0].childNodes[0].nodeValue);
                  document.write("</td></tr>");
              }
            document.write("</table>");

        </script></center>
  
</body>

</html>