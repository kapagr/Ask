<?php session_start();
if(isset($_SESSION['user']))
{
    $getreq="timeline.php";
    header('Location:'.$getreq);
}
?>
<html>
	<head>
	 <title>Member Login</title>
		 <link href="abc.css" rel="stylesheet" type="text/css" media="all" />
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
			$username=$_POST['user'];
			$password=$_POST['pass'];
			 $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
            $query="select * from logins where username='$username' and password='$password' ";
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               if($row=mysqli_fetch_array($result)>0)
               {
			$query="select * from logins where username='$username' and password='$password' ";
			$result=mysqli_query($dbc,$query) or die(mysqli_error());
			$row=mysqli_fetch_array($result);
			 $s=$row['status'];
			 if($s=='student')
			 {
				$id=$row['uid'];
				$query="select * from regcode where uid='$id' ";
				 $result=mysqli_query($dbc,$query) or die(mysqli_error());
				 if($row=mysqli_fetch_array($result)>0)
				{
					$getreq="confirm.php?lid=$id";
					 header('Location:'.$getreq);
				}
				else
				{
					$_SESSION['lid']=$id;
					$_SESSION['status']='student';
					$getreq="timeline.php";
					 header('Location:'.$getreq);
					
				}
			 }
			 else
			 {
				$id=$row['fid'];
				$query="select * from regcode where fid='$id' ";
				 $result=mysqli_query($dbc,$query) or die(mysqli_error());
				 if($row=mysqli_fetch_array($result)>0)
				{
					$getreq="confirm1.php?lid=$id";
					 header('Location:'.$getreq);
				}
				else
				{
					$_SESSION['lid']=$id;
					$_SESSION['status']='faculty';
					$getreq="timeline.php";
					 header('Location:'.$getreq);
					 
				}
			 }
			
                }
		else
		{
			 echo '<script>alert("Details Are Incorrect so try again");</script>';
		
		}
		 mysqli_close($dbc);
		}
		?>
        <section class="login">
	<div class="titulo">Member Login</div>
	<form action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="application/x-www-form-urlencoded">
    	<input type="text" required title="Username required" maxlength="10" name="user" placeholder="Username" data-icon="U"> &nbsp&nbsp
        <input type="password" required title="Password required" maxlength="10" name="pass"  placeholder="Password" data-icon="x">
        <div class="olvido">
        	<div class="col"><a href="Account.php" title="Not a Member? Register">Register</a></div>
            <div class="col"><a href="forgot.php" title="Password Recovery">Forgot Password?</a></div><br>
        </div>
	<input type="Submit" name="submit" value="Submit" class="enviar">
    </form>
</section>
	<div class="copy">
	<p class="copyright-link">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> 
                </p>
		</div>
	</div>
	</body>
</html>