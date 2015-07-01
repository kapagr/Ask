<html>
	<head>
	 <title>Password Recovery</title>
		 <link href="abc1.css" rel="stylesheet" type="text/css" media="all" />
		 <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
	<style>
		 .copy
            {
                margin-top: 2%;
            }
	    .copyright-link
	    {
		text-align:  center ;
		font-family:  'Mistral';
		font-size:  2em;
		color:  brown ;
	    }
	</style>
	</head>
<body>
	<div class="container">
			<!-- freshdesignweb top bar -->
            <div class="freshdesignweb-top">
                <a href="index.php" title="Home">Home</a>
                <span class="right">
                    <a href="login.php" title="Login">
                        <strong>Sign-IN</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ freshdesignweb top bar -->
			<header>
				<h1><span>QueryUs.in</span><br><br>Ask Your Query - Learning is Social :)</h1>
            </header>
			<?php require_once('connectvars.php');?>
			
	<?php
		 if(isset($_POST['submit']))
                {
			$name=$_POST['name'];
			$email=$_POST['email'];
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
            $query="select * from student where name='$name' and email='$email' ";
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
              		if($row=mysqli_fetch_array($result)!=0)
                        {
                             $query="select * from student where name='$name' and email='$email' ";
                             $result=mysqli_query($dbc,$query) or die(mysqli_error());
                             $row=mysqli_fetch_array($result);
                            $uid=$row['sno'];
                            $user=$row['username'];
                            define('CAPTCHA_NUMCHARS', 10);
                            $pass_phrase = "";
                            for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++)
                            {
                                $pass_phrase .= chr(rand(97, 122));
                            }
                	    $code=$pass_phrase ;
                             $to=$email;
                            $subject="Your New Password :- Queryus.in (Ask Your Query - Learning Is Social) ";
                            $from="FROM:Admin<prashant@queryus.in>\r\n";
                            $style='<br><br>Dear'.'&nbsp'.$name.','.'<br><br>Your New Password is :-&nbsp'.$code.'<br><br><br>With thanks,<br>Queryus Team';
                            $body=$style ;
                            mail($to,$subject,$body,$from);
                            $query="update student set password='$code' where sno='$uid' ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                             $query="update logins set password='$code' where uid='$uid' ";
                                mysqli_query($dbc,$query) or die('Error in querying');
                             echo '<script>alert("Please Check Your Mail Where you can find your new Password");location.href="login.php";</script>';
                             return false;
                        }
                          $query="select * from faculty where name='$name' and email='$email' ";
                            $result=mysqli_query($dbc,$query) or die(mysqli_error());
                           if($row=mysqli_fetch_array($result)!=0)
                            {
                                $query="select * from faculty where name='$name' and email='$email' ";
                                $result=mysqli_query($dbc,$query) or die(mysqli_error());
                                    $row=mysqli_fetch_array($result);
                                $fid=$row['fno'];
                                $user=$row['username'];
                                 define('CAPTCHA_NUMCHARS', 10);
                                $pass_phrase = "";
                                for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++)
                                {
                                    $pass_phrase .= chr(rand(97, 122));
                                }
                                $code=$pass_phrase ;
                                 $to=$email;
                                $subject="Your New Password :- Queryus.in (Ask Your Query - Learning Is Social) ";
                                $from="FROM:Admin<prashant@queryus.in>\r\n";
                                $style='<br><br>Dear'.'&nbsp'.$name.','.'<br><br>Your New Password is :-&nbsp'.$code.'<br><br><br>With thanks,<br>Queryus Team';
                                 $style = str_replace('<br/>','\n',$style);
			    $style=htmlspecialchars($style);
				$body=$style ;
                                mail($to,$subject,$body,$from);
                                $query="update faculty set password='$code' where fno='$fid' ";
                                mysqli_query($dbc,$query) or die('Error in querying');
                                $query="update logins set password='$code' where fid='$fid' ";
                                mysqli_query($dbc,$query) or die('Error in querying');
                                 echo '<script>alert("Please Check Your Mail Where you can find your new Password");location.href="login.php";</script>';
                                 return false ;
                            }
                            else 
                            {
                                     echo '<script>alert("Please Check Your Entered Details");location.href="forgot.php";</script>';
                                     return false;
                                    
                            }
                             mysqli_close($dbc);
                        }
		?>
        <section class="login">
	<div class="titulo">Password Recovery </div>
	<form action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="application/x-www-form-urlencoded">
    	<input type="text" required title="Full Name required" name="name" placeholder="Full Name" data-icon="U">&nbsp&nbsp
        <input type="text" required title="Email required"  name="email" placeholder="Email" data-icon="x">
	<input type="Submit" name="submit" value="Submit" class="enviar">
    </form>
</section>
	<div class="copy">
	<p class="copyright-link">&copy All Rights Reserved by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> 
                </p>
		</div>
	</div>
	</body>
</html>