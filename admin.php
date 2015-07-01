<?php session_start();
if(isset($_SESSION["User_name"]))
{
    $getreq="adpanel.php";
    header('Location:'.$getreq);
}
?>
<html>
     <head>
        <title>Admin | QueryUs.in</title>
        <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
                <link href="abc2.css" rel="stylesheet" type="text/css" media="all" />
        <style>
        .login-header
        {
          padding : 2% ;
          background-color : black ;
        }
        .address
        {
          margin-left : 0.5% ;
          margin-top  : -0.5% ;
        }
        </style>
        </head>
    <body>
            <?php
	     require_once('check.php');
             require_once('connectvars.php');
	    ?>
             <?php
               if(isset($_POST['submit']))
                {
                    $user=$_POST['user'];
                    $pass=$_POST['pass'];
                     $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select * from admin where user='$user' and pass='$pass' ";
		    $result=mysqli_query($dbc,$query);
		    if($row=mysqli_fetch_array($result)>0)
		    {
                               $query="select * from admin where user='$user' and pass='$pass' ";
                               $result=mysqli_query($dbc,$query);
                               $row=mysqli_fetch_array($result);
                              $user1=$row['user'];
                              $_SESSION["User_name"]=$user1 ;
                              header('location:adpanel.php');
                    }
                    else
                    {
                          echo '<script>alert("Details Incorrect");location.href="admin.php";</script>';
                    }
                    mysqli_close($dbc);
                }
                ?>
                <section class="login">
	<div class="titulo">Admin Login</div>
	<form action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="application/x-www-form-urlencoded">
    	<input type="text" required title="Username required" maxlength="10" name="user" placeholder="Username" data-icon="U"> &nbsp&nbsp
        <input type="password" required title="Password required" maxlength="10" name="pass"  placeholder="Password" data-icon="x">
	<input type="Submit" name="submit" value="Submit" class="enviar">
    </form>
</section>
	<div class="copy">
	<p style="color : white ;text-align: center;margin-bottom: 2% ;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> 
                </p>
		</div>
	</div>
       
    </body>
</html>