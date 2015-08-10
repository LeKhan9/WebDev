<html>
    
<head>
	<title>Applicant Information</title>
    <link rel="stylesheet" href="applicant.css"> 
    <div6><a href="documentation.html">Documentation Page</a> | <a href="index.php">Main Page</a></div6>
    
    <script>
        
        // using the tips file this will populate the screen with a tip, and with user interaction of 
        // buttons allow to move through the various tips - both forwards and backwards
        xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","tips.xml",false);
        xmlhttp.send();
        xmlDoc=xmlhttp.responseXML; 
        x=xmlDoc.getElementsByTagName("TEXT");
        i=0;

        // actually displays the text onto the screen dynamically by getting from the headers in the XML file
        function displayText()
        {
            topic=(x[i].getElementsByTagName("TIP")[0].childNodes[0].nodeValue);
            tip=(x[i].getElementsByTagName("TOPIC")[0].childNodes[0].nodeValue);
            source=(x[i].getElementsByTagName("SOURCE")[0].childNodes[0].nodeValue);
            txt="<b>Topic:</b></br> " + tip + "</br><br><b>Tip:</b></br> " + topic + "</br><br><b>Source:</b></br> "+ source;
            document.getElementById("showText").innerHTML=txt;
        }

        // increments variable i and prints text
        function forward()
        {
        if (i<x.length-1)
          {
              i++;
              displayText();
          }
        }

        // decrements variable i and prints text
        function back()
        {
        if (i>0)
          {
              i--;
              displayText();
          }
        }
    </script>
</head>

    <!--In the body the text of the XML/ Javascript will be displayed for the user.-->    
<body onload="displayText()">
        <div><center>
            <h1>Applicant Analytics Portal</h1>
            
            <form >
                <h1>STUDENT DEBRIEF PAGE</h1>
                <h2>
                If you are seeing this page, it means that you have reached the end of the application. </br>
                Since this website is a vendor for the company you applied to, you will be <b>contacted by that same company</b> in regards to furthering your application.</br> </br></br></h2>
            </form>

            <form >
                <h6>
                Meanwhile please consider the tips provided below to assist you in your job search process. This information is vital for preparation and interview success.</h6>
                
                <h5> Useful Tips for Preparation!</h5></br>
                
    
<!--Once the body portion of the HTML loads this is populated dynamically with the XML data-->

                <div id='showText'></div><br>
                    <input type="button" onclick="back()" id = "rot" value="Previous Tip" />
                    <input type="button" onclick="forward()" id = "rot" value="Next Tip" />
            </form></div></center>

</body>

</html>