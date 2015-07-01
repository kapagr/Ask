<?php session_start();
if(!isset($_SESSION['lid']))
   {

	 $getreq="index.php";
    header('Location:'.$getreq);
   }
   ?>
   <?php require_once('connectvars.php'); ?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->

	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	  <link href="asktime.css" rel="stylesheet"/>
	<title> About </title>
	<style>
	.pics1
        {
            width:120px;
	    height : 80px;
	    border-radius: 50%;
	    margin-top: 1% ;
        }
	.abc
	{
		font-size: 1.2em;
		font-family: 'Droid Serif';
		color : white ;
		text-align: center ;
	}
	.pics2
	{
		width: 35px;
	    height : 30px;
	    border-radius: 50%;
	    margin-top:  -2% ;
	    margin-bottom:  -0.6% ;
	}
        .area
        {
            text-align: center;
            padding :2% ;
           margin-left: 20% ;
           margin-right:  20% ;
            background-color : maroon;
        }
        .table
        {
            font-family:  'Mistral' ;
            font-size:  1.3em ;
            color : white ;
            padding  : 10% ;
            opacity: 10 ;
        }
        td
        {
           padding : 4% ;
            opacity: 10 ;
            width : 10% ;

        }
        .buttom{ background: #4b8df9; display: inline-block; padding: 5px 10px 6px; color: #fbf7f7; text-decoration: none; font-weight: bold; line-height: 1; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 1px 3px #999; -webkit-box-shadow: 0 1px 3px #999; box-shadow: 0 1px 3px #999; text-shadow: 0 -1px 1px #222; border: none; position: relative; cursor: pointer; font-size: 14px; font-family:Verdana, Geneva, sans-serif;}
        .buttom:hover	{ background-color: #2a78f6; }

	</style>

</head>
<body>
    <?php
    $id=$_SESSION['lid'];
    $status=$_SESSION['status'];
    $user=$_SESSION['user'];
     $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
    if($status=='student')
    {
        $query="select * from student where sno='$id' ";
        $result=mysqli_query($dbc,$query) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
        $sno=$row['sno'];
        $name=$row['name'];
        $email=$row['email'];
        $username=$row['username'];
        $password=$row['password'];
        $univrollno=$row['univrollno'];
	 $profile=$row['profile'];
    }
    else
    {
         $query="select * from faculty where fno='$id' ";
        $result=mysqli_query($dbc,$query) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
         $fno=$row['fno'];
        $name=$row['name'];
        $email=$row['email'];
        $username=$row['username'];
        $password=$row['password'];
        $fid=$row['fid'];
	 $profile=$row['profile'];
    }
    ?>

        <?php $image='profile/'.$profile;
       require_once('same.php');
	?>
</body>
</html>
