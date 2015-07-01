<?php require_once('connectvars.php'); ?>
<?php
session_start();
if(isset($_SESSION['code']))
{
    $a=$_SESSION['code'];
    $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
    $query="select * from regcode where code='$a' ";
    $result=mysqli_query($dbc,$query) or die('error querrying');
    $row=mysqli_fetch_array($result);
    $uid=$row['uid'];
    mysqli_close($dbc);
    $getreq="confirm.php?id=$uid";
    header('Location:'.$getreq);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Register</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
	<link rel="stylesheet" type="text/css" href="style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
	<script src='js_validate.js'></script>
</head>
<body>
    <?php
                  if(isset($_POST['submit']))
                        {
			    $out=true;
                          $name=$_POST['name'];
                          $email=$_POST['email'];
                          $username=$_POST['username'];
                          $password=$_POST['password'];
                          $repass=$_POST['repassword'];
			  $rollno=$_POST['rollno'];
			    $phone=$_POST['phone'];
			    
                        $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
			$query="select * from student where email='$email'";
			$query1="select * from faculty where email='$email'";
			$result=mysqli_query($dbc,$query) or die($query);
			$result1=mysqli_query($dbc,$query1) or die($query1);
			if(mysqli_num_rows($result)>0 || mysqli_num_rows($result1)>0)
			{
			    echo '<script>alert("Email is Already Registered");</script>';
			    $out=false;
			    echo '<script>location.href="student1.php";</script>';
			}
			$query="select * from student where username='$username'";
			$query1="select * from faculty where username='$username'";
			$result=mysqli_query($dbc,$query) or die($query);
			$result1=mysqli_query($dbc,$query1) or die($query1);
			if(mysqli_num_rows($result)>0 || mysqli_num_rows($result1)>0)
			{
			    echo '<script>alert("Username is Already Registered");</script>';
			    $out=false;
			    echo '<script>location.href="student1.php";</script>';
			}
			$query="select * from student where password='$password'";
			$query1="select * from faculty where password='$password'";
			$result=mysqli_query($dbc,$query) or die($query);
			$result1=mysqli_query($dbc,$query1) or die($query1);
			if(mysqli_num_rows($result)>0 || mysqli_num_rows($result1)>0)
			{
			    echo '<script>alert("Password is Already Registered");</script>';
			    $out=false;
			    echo '<script>location.href="student1.php";</script>';
			}
			$query="select * from student where phone='$phone'";
			$query1="select * from faculty where phone='$phone'";
			$result=mysqli_query($dbc,$query) or die($query);
			$result1=mysqli_query($dbc,$query1) or die($query1);
			if(mysqli_num_rows($result)>0 || mysqli_num_rows($result1)>0)
			{
			    echo '<script>alert("Contact Number is Already Registered");</script>';
			    $out=false;
			    echo '<script>location.href="student1.php";</script>';
			}
			$query="select * from student where univrollno='$rollno'";
			$result=mysqli_query($dbc,$query) or die($query);
			if(mysqli_num_rows($result)>0)
			{
			    echo '<script>alert("University Rollno is Already Registered");</script>';
			    $out=false;
			    echo '<script>location.href="student1.php";</script>';
			}
                          $course=$_POST['Course'];
                          $branch=$_POST['Branch'];
                          $year=$_POST['Year'];
                          $sem=$_POST['Semester'];
                          $dob=$_POST['dob'];
                          $gender=$_POST['gender'];
                        
                        define('CAPTCHA_NUMCHARS',10);
                        $pass_phrase = "";
                        for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++)
                        {
                            $pass_phrase .= chr(rand(97, 122));
                        }
                	    $code=$pass_phrase ;
                            if($out){
                             $to=$email;
                            
                            $subject="Confirmation Code :- Queryus.in (Ask Your Query - Learning Is Social) ";
                            $from="FROM:Admin<prashant@queryus.in>\r\n";
                            $style="Dear"."&nbsp".$name.","."<br><br>The confirm ation Code is :-&nbsp".$code."<br><br><br>With thanks,<br>Queryus Team";
			   
			    
                            $body=$style ;
                            mail($to,$subject,$body,$from);
                         $query="insert into student(name,email,username,password,univrollno,course,branch,year,sem,dob,gender,phone) values('$name','$email','$username','$password','$rollno','$course','$branch','$year','$sem','$dob','$gender','$phone')";

                            mysqli_query($dbc,$query) or die('Error in querying');
                            $query="select * from student where email='$email'";
			    $result=mysqli_query($dbc,$query) or die('Error ');
                            if(mysqli_num_rows($result))
                            {
                                $row=mysqli_fetch_array($result);
                                $uid=$row['sno'];
                            }
                             $query="insert into logins(username,password,uid,status) values('$username','$password','$uid','student')";
                            mysqli_query($dbc,$query) or die('Error in querying');
                            $query="insert into regcode(code,uid) values('$code','$uid')" or die('Error in code query');
                            mysqli_query($dbc,$query) or die('Code query error');
                            $_SESSION['code']=$code;
                            mysqli_close($dbc);
                            $uid=trim($uid);
                            $getreq="confirm.php?id=$uid";
                            header('Location:'.$getreq);
			    }
                        }
                        ?>
<div class="container">
			<!-- freshdesignweb top bar -->
            <div class="freshdesignweb-top">
                <a href="index.php">Home</a>
                <span class="right">
                    <a href="Account.php">
                        <strong>Back to Previous page</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ freshdesignweb top bar -->
			<header>
				<h1><span>QueryUs.in</span><br>Register as a volunteer and Ask Your Query :)</h1>
            </header>       
      <div  class="form">
    		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
    			<p class="contact"><label for="name">Name</label></p> 
    			<input id="name" name="name" placeholder="First and last name" required="" title="ALPHABETS ONLY" tabindex="1" type="text" onblur="name_validator(1)"> 
    			 
    			<p class="contact"><label for="email">Email</label></p> 
    			<input id="email" name="email" placeholder="example@domain.com" required="" type="email" onblur="email_validator()"> 
                
                <p class="contact"><label for="username">Create a username</label></p> 
    			<input id="username" name="username" maxlength="10" placeholder="username" required="" title="Exactly 10 Characters" tabindex="2" type="text" onblur="usernamevalid()"> 
    			 
                <p class="contact"><label for="password">Create a password</label></p> 
    			<input type="password" id="password" maxlength="10" title="Exactly 10 Characters" name="password" required="" onblur="passwordvalid()"> 
                <p class="contact"><label for="repassword">Confirm your password</label></p> 
    			<input type="password" id="repassword" maxlength="10" title="Exactly 10 Characters" name="repassword" required="" onblur="repasswordvalid()">
						<p class="contact"><label for="rollno">University Roll No</label></p> 
    			<input id="rollno" name="rollno" placeholder="Enter University Roll No" maxlength="9" title="Exactly Numbers" required="" tabindex="1" type="text" onblur="rollnovalidator()">
        <select class="select-style gender" required  name="Course">
            <option value="">Enter Course</option>
	    <option value="BTech">BTech</option>
			<option value="Mtech">Mtech</option>
			<option value="phD">phD</option>
			<option value="BBA">BBA</option>
			<option value="MBA">MBA</option>
			<option value="BSc">BSc</option>
			<option value="MSc">MSc</option>
            </select><br><br>
	     <select class="select-style gender" required name="Branch">
            <option value="">Enter Branch</option>
			<option value="Mechanical Engineering">Mechanical Engineering</option>
			<option value="Civil Engineering">Civil Engineering</option>
			<option value="Electrical Engineering">Electrical Engineering</option>
			<option value="Electrical & Electronics Engineering">Electrical & Electronics Engineering</option>
			<option value="Computer Science Engineering">Computer Science Engineering</option>
			<option value="Information Technology">Information Technology</option>
            <option value="none">None</option>
            </select><br><br>
	      <select class="select-style gender" required name="Year">
            <option value="">Enter Year</option>
			<option value="Ist Year">Ist Year</option>
			<option value="IInd year">IInd year</option>
			<option value="IIIrd year">IIIrd year</option>
			<option value="IVth year">IVth year</option>
            <option value="other">Other</option>
            </select><br><br>
	      <select class="select-style gender" required name="Semester">
            <option value="">Enter Semester</option>
			<option value="Ist">Ist</option>
			<option value="IInd">IInd</option>
			<option value="IIIrd">IIIrd</option>
			<option value="IVth">IVth</option>
			<option value="Vth">Vth</option>
			<option value="VIth">VIth</option>
			<option value="VIIth">VIIth</option>
			<option value="VIIIth">VIIIth</option>
            <option value="other">Other</option>
            </select><br><br>
               <fieldset>
		<?php $da=date("Y-m-d");?>
                 <label>Date Of Birth </label>
                <label><input type="date"  name="dob" max="<?php echo $da;?>" required=""></label>
              </fieldset>
                       
            <p class="contact"><label for="phone">Mobile phone</label></p> 
            <input id="phone" name="phone" placeholder="phone number" maxlength="10" required="" title="ONLY NUMBERS" type="text" onblur="contact_validator()"> <br>
             <select class="select-style gender" required name="gender">
            <option value="">i am..</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="others">Other</option>
            </select><br><br>

            <div style="text-align: center;">
			<input class="buttom" name="reset" id="submit" tabindex="5" value="Cancel All!" type="reset">
			<input class="buttom" name="submit" id="submit" tabindex="5" value="Sign me up!" type="submit">
	    </div>
   </form> 
</div>      
</div>

</body>
</html>
