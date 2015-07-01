<!DOCTYPE html>
<html>
<head>
<title>Club Register</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style1.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo1.css" media="all" />
    <script>
			  function name_validator(id)
    {
        switch(id)
        {
            case 1:
                name=document.getElementById("name").value;
                if (name!="")
                if(/[^a-zA-Z ]/.test(name))
                {    
                    document.getElementById("name").value="";
                    document.getElementById("name").placeholder="Alphabets ONLY!";                    
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
    function contact_validator()
    {
        num=document.getElementById("phone").value;
        var length=num.length;
        if (isNaN(num))
        {
            document.getElementById("phone").value="";
            document.getElementById("phone").placeholder="Numbers ONLY!";                   
        }
        else if (length!=10)
        {
            document.getElementById("phone").value="";
            document.getElementById("phone").placeholder="Exactly 10 Digits";                    
        }
    }
    function rollnovalidator()
    {
        num=document.getElementById("rollno").value;
        var length=num.length;
        if (isNaN(num))
        {
            document.getElementById("rollno").value="";
            document.getElementById("rollno").placeholder="Numbers ONLY!";                    
        }
        else if (length!=9)
        {
            document.getElementById("rollno").value="";
            document.getElementById("rollno").placeholder="Exactly 10 Digits";                    
        }
    }
    </script>
</head>
<body>
			<?php require_once('connectvars.php');
			$id=$_GET['id'];
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select * from clubpart where no='$id' ";
		    $result=mysqli_query($dbc,$query);
		    if(mysqli_num_rows($result)==1)
		    {
			while($row=mysqli_fetch_array($result))
			{
				$id=$row['no'];
				$cname=$row['clubname'];
                        }
		    }
		     else
		     {
			echo 'No records available';
			}
                                
		mysqli_close($dbc);
			?>
			<?php
                         if(isset($_POST['submit']))
                        { 
			$name=$_POST['name'];
			$name1=$_POST['name1'];
			$rollno=$_POST['rollno'];
			$email=$_POST['email'];
			$Course=$_POST['Course'];
			$Branch=$_POST['Branch'];
			$Year=$_POST['Year'];
			$phone=$_POST['phone'];
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
			 $query="select * from `$cname` where univrollno='$rollno' or email='$email' or mobileno='$phone' ";
		 $result=mysqli_query($dbc,$query);
		   while($row=mysqli_fetch_array($result))
		   {
		     echo '<script>alert("Participation is already exist so try again");</script>';
			 echo '<script>location.href="Club.php";</script>';
		   }
                $query="INSERT INTO `$cname`(name,clubname,course,branch,year,mobileno,email,univrollno) values('$name','$name1','$Course','$Branch','$Year','$phone','$email','$rollno')";
                         mysqli_query($dbc,$query) or die('Error in querying');
		mysqli_close($dbc);
		echo '<script>alert("Registered Successfully");location.href="Club.php";</script>';
			}
			?>
<div class="container">
			<!-- freshdesignweb top bar -->
            <div class="freshdesignweb-top">
                <a href="index.php">Home</a>
                <span class="right">
                    <a href="Club.php">
                        <strong>Back to Previous page</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ freshdesignweb top bar -->
			<header>
				<h1><span>QueryUs.in</span><br>Registeration form :)</h1>
			</header>       
      <div  class="form">
    		<form id="contactform" action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
    			<p class="contact"><label for="name">Name</label></p> 
    			<input id="name" name="name" placeholder="First and last name" required="" tabindex="1" type="text" onblur="name_validator(1)">
			<p class="contact"><label for="clubname">Club Name</label></p> 
    			<input id="clubname" name="name1" tabindex="1" type="text" value="<?php echo $cname ;?>" readonly="readonly"  required /> 
    			<p class="contact"><label for="rollno">University Roll No</label></p> 
    			<input id="rollno" name="rollno" placeholder="Enter University Roll No" required="" tabindex="1" maxlength="9" onblur="rollnovalidator()" type="text">
			<p class="contact"><label for="emailid">Email Id</label></p> 
    			<input id="email" name="email" placeholder="Enter your email id" required="" tabindex="1" type="text" onblur="email_validator()">
        <p class="contact"><label for="phone">Mobile phone</label></p> 
            <input id="phone" name="phone" placeholder="phone number" required=""  maxlength="10" type="text" onblur="contact_validator()"> <br>
	<select class="select-style gender" name="Course">
            <option value="select">Enter Course</option>
	    <option value="BTech">BTech</option>
			<option value="Mtech">Mtech</option>
			<option value="phD">phD</option>
			<option value="BBA">BBA</option>
			<option value="MBA">MBA</option>
			<option value="BSc">BSc</option>
			<option value="MSc">MSc</option>
            </select><br><br>
	     <select class="select-style gender" name="Branch">
            <option value="select">Enter Branch</option>
			<option value="ME">Mechanical Engineering</option>
			<option value="CE">Civil Engineering</option>
			<option value="EE">Electrical Engineering</option>
			<option value="ECE">Electrical & Electronics Engineering</option>
			<option value="CSE">Computer Science Engineering</option>
			<option value="IT">Information Technology</option>
            <option value="none">None</option>
            </select><br><br>
	      <select class="select-style gender" name="Year">
            <option value="select">Enter Year</option>
			<option value="Ist Year">Ist Year</option>
			<option value="IInd year">IInd year</option>
			<option value="IIIrd year">IIIrd year</option>
			<option value="IVth year">IVth year</option>
            <option value="other">Other</option>
            </select><br><br>  
               
              </fieldset>
            
            <div style="margin-left: 20%;">
			<input class="buttom" name="submit" id="submit" tabindex="5" value="Cancel All!" type="reset">&nbsp&nbsp&nbsp&nbsp&nbsp
			<input class="buttom" name="submit" id="submit" tabindex="5" value="Sign me up!" type="submit">
	    </div>
	    <div>
		<br>
	    </div>
   </form> 
</div>      
</div>

</body>
</html>
