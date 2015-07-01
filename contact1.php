<html>
    <head>
        <title>Contact Us </title>
        <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
	<style>
	    .text
	    {
		font-size : 1em ;
		font-family : "Times","Arial" ;
		width : 220px;
		height : 35px;
	    }
	</style>
	<script>
	     function name_validator(id)
    {
        switch(id)
        {
            case 1:
                name=document.getElementById("text").value;
                if (name!="")
                if(/[^a-zA-Z ]/.test(name))
                {    
                    document.getElementById("text").value="";
                    document.getElementById("text").placeholder="Alphabets ONLY!";                    
                }    
                break;
            
            case 2:
                name=document.getElementById("lnameid").value;
                if (name!="")
                if(/[^a-zA-Z ]/.test(name))
                {
                    document.getElementById("lnameid").value="";
                    document.getElementById("lnameid").placeholder="Alphabets ONLY!";                    
                }
                break;
        }       
    }
    
    function email_validator()
    {
        email=document.getElementById("email").value;
       var filter =/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            
        if (!filter.test(email))
        {
            document.getElementById("email").value="";
            document.getElementById("email").placeholder="Invalid Email ID!";                    
        }
    }
	</script>
        </head>
    <body>
	     <?php
	     require_once('check.php');
	    ?>
	    <table class="t1" cellpadding="20" cellspacing="50" >
                         <tr>
                              <td  bgcolor="red" class="pumpkin">REACH US</td>
                              <td bgcolor="green" class="pumpkin"> GENERAL</td>
                              <td bgcolor="brown" class="pumpkin">MAIL US</div></td>
                         </tr>
                         <tr>
                              <td class="t11"><h3 style="color:#643200">Dear all,</h3>Please use the form on the right side if u have any questions or request concerning our services.<br><br><br> We will respond to your message within 24 hours.</td>
                              <td class="t11"><h3 style="color:#643200">Address:</h3>17km Stone, NH-2,Mathura-Delhi Road P.O. Chaumuhan, Mathura-281 406 (U.P.)INDIA <br><br>Tel.:+91-5662-250900, 250908/909 <br><br>Mobile.: 8937099911, 22, 33 <br><br>Fax: +91-5662-241687</td>
                              <td>
				<form action="save.php" method="post">
                                   <table cellpadding="20" cellspacing="5" class="t112" >
					<tr>
                                             <td><h4>Full Name</h4></td>
                                             <td><input id="text" type="text" name="fname" placeholder="Enter Full Name" class="field" style=" width:250px"  onblur="name_validator(1)" required></td>
                                        </tr>
                                        <tr>
                                             <td><h4>Email</h4></td>
                                             <td><input class="text" id="email" type="text" name="mail" class="field" placeholder="Enter Email" style=" width:250px" onblur="email_validator()"  required></td>
                                        </tr>
                                        <tr>
                                             <td><h4>Message</h4></td>
                                             <td><textarea rows="3" cols="33" maxlength="600" class="field" placeholder="Write Your Query" wrap="hard" name="msg" required="enter your questyion"></textarea></td>
                                        </tr>
                                        <tr align="center" class="field">
                                             <td><input class="next" type="Reset" value="Cancel"/></td>
					     <td><input class="next" type="Submit" value="Submit"/></td>
                                        </tr> 
                                   </table>
				</form>
                              </td>
                         </tr>
                    </table>
                     <hr class="divider1">
               <p style="color : white;text-align:  center;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> </p> 
    </body>
</html>