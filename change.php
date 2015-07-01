<?php session_start();
if(!isset($_SESSION["User_name"]))
{	 $getreq="admin.php";
    header('Location:'.$getreq);
   }
?>
<html>
    <head>
	 <title>Change Password </title>
         <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
    <script>
     function repasswordvalid()
    {
         username=document.getElementById("re-new").value;
        username1=document.getElementById("new").value;
        var filter = username.length;
        if(username1!=username)
        {
             document.getElementById("re-new").value="";
            document.getElementById("re-new").placeholder="Password Not Match!";
        }
    }
    </script>
        <style>
        body
        {
            background-image : url('acc1.png');
            background-size : cover ;
        }
        .area
        {
            padding : 2% ;
            background-color : brown;
        }
        .text
        {
            height: 30px ;
            width: 200px ;
        }
          .buttom
          { background: #4b8df9;
          display: inline-block;
          padding: 5px 10px 6px; color: #fbf7f7;
          text-decoration: none;
          font-weight: bold;
          line-height: 1;
          -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 1px 3px #999; -webkit-box-shadow: 0 1px 3px #999; box-shadow: 0 1px 3px #999; text-shadow: 0 -1px 1px #222; border: none; position: relative; cursor: pointer; font-size: 14px; font-family:Verdana, Geneva, sans-serif;}
        .buttom:hover
        {
          background-color: #2a78f6;
          }
        </style>
    </head>
    <body>
        <div class="container">
			
            <div class="freshdesignweb-top">
                <a href="adpanel.php">Home</a>
                <span class="right">
                    <a href="adpanel.php">
                        <strong>Back to Previous page</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div>
	    <?php require_once('connectvars.php');
                    if(isset($_POST['change']))
                        {   $out=true;
                            $user=$_SESSION["User_name"];
                            $current=$_POST['current'];
                             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                             $query="select * from admin where user='$user' " ;
                              $result=mysqli_query($dbc,$query);
                              $row=mysqli_fetch_array($result);
                              $pass=$row['pass'];
                              if($current!=$pass)
                              {
                                echo '<script>alert("Please check Your Current Password");</script>';
                                $out=false;
                                echo '<script>location.href="change.php";</script>';
                              }
                              if($out)
                              {
                                $new=$_POST['new'];
                                 $query="update admin set pass='$new' where user='$user' " ;
                                  mysqli_query($dbc,$query) or die('Code query error');
                                  mysqli_close($dbc);
                                   echo '<script>alert("Password is changed successfully so you have to login again :)");</script>';
                                   session_destroy();
                                echo '<script>location.href="admin.php";</script>';
                              }
                              
                        }
            ?>
            
			<header>
				<h1 style="font-size : 2.3em;"><span>QueryUs.in</span><br>Change Password :)</h1>
            </header>
            <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table align="center" style="text-align : center ;width: 50%;height : 45% ;background-color : brown ; color : white ;" cellpadding="20" border="1" cellspacing="10">
            <tr>
                <td><label for="current">Current Password*</label></td>
                <td><input class="text" id="current" type="password" name="current" placeholder="Enter Current Password" required/></td>
            </tr>
            <tr>
                <td><label for="new">New Password*</label></td>
                <td><input class="text" id="new" type="password" name="new" placeholder="Enter New Password" required/></td>
            </tr>
            <tr>
                <td><label for="re-new">Re-Enter New Password*</label></td>
                <td><input class="text" id="re-new" type="password" name="re-new" placeholder="Re-Enter New Password" onblur="repasswordvalid()" required/></td>
            </tr>
            <tr>
                       <td colspan="2">  <div style="text-align: center;margin-top: 1% ;">
			<input class="buttom" name="change" id="submit" tabindex="5" value="Find Students" type="submit">  </div></td>
            </tr>
        </table>
            </form>
        </div>
    </body>
</html>