<?php
require_once('connectvars.php');
 $name=$_POST['fname'];
 $mail=$_POST['mail'];
 $msg=$_POST['msg'];
  $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                 $query="INSERT INTO contact(name,email,msg) values('$name','$mail','$msg')";
                         mysqli_query($dbc,$query);
		    $query="select MAX(no) from contact";
		    $result=mysqli_query($dbc,$query);
		   $row=mysqli_fetch_array($result);
		    $a=$row[0];
                        $query="update contact set post=NOW() where no='$a' ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                            mysqli_close($dbc);
                 echo '<script>alert("Your Query will be answered within 24 Hours Please do not forget to check your mail");location.href="index.php";</script>';
                 ?>