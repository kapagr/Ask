<?php session_start();?>
<html>
     <head>
	 <title>Add Events | QueryUs </title>
         <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
        <script>
	   function name_validator()
	       {
		    name=document.getElementById("text").value;
		    if (name!="")
		    if(/[^a-zA-Z ]/.test(name))
		    {    
		        document.getElementById("text").value="";
		        document.getElementById("text").placeholder="Alphabets ONLY!";                    
		    }    
		    
	       }
	</script>
         <style>
        .right
        {
               text-align : right ;
		color : white ;
		margin-right : 1%;
		margin-top :-1%;
        }
        .news-table
        {	
	     
            text-align : center ;
            background-color : #fffabb ;
            color : green ;
               font-family : "cooper black" ;
            font-size : 1.1em ;
        }
        .center
        {
            text-align : center ;
            margin-top : 1% ;
        }
        .update-form-heading
        {
            color  : brown;
            font-family : "cooper black" ;
            font-size : 1.5em ;
            
        }
	 .news-header1
         {
            padding :  2% ;
            background-color : white ;
            margin-left : 14% ;
            margin-right :  14% ;
         }
    
         </style>
    </head>
    <body>
         <?php
	     require_once('check.php');
	     require_once('connectvars.php');
	    ?>
        <div class="login-header">
            <div class="address"><a href="index.php"> Home </a> &nbsp > &nbsp <a href="admin.php">Admin Login </a> &nbsp > &nbsp <a href="adpanel.php">Panel</a> &nbsp > &nbsp Add Event  </div>
               <div class="right"><?php echo '(Hello !!&nbsp&nbsp'.$_SESSION["User_name"].')'?></div>
        </div>
            <?php
                         if(isset($_POST['add']))
                        {
                            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select MAX(eno) from eventpart";
		    $result=mysqli_query($dbc,$query);
		   $row=mysqli_fetch_array($result);
		    $a=$row[0];
		
                $a++;
                $name=$_POST['b'];
		$query="select * from eventpart where eventname='$name' ";
		 $result=mysqli_query($dbc,$query);
		   while($row=mysqli_fetch_array($result))
		   {
		     echo '<script>alert("Event is already added");</script>';
		     return false;
		   }
		   mysqli_close($dbc);
                 $upimage=$_FILES['img']['name'];
                  $size=$_FILES['img']['size'];
                    if($size>=1048576)
                    {
                         echo '<script>alert("Size of uploaded file is < 1MB so try again");</script>';
                     return false ;
                    }
            
		$make=end(explode('.',$upimage));
                $allowed=array('jpg','gif','png','JPG','PNG','GIF');
                if(!in_array ($make,$allowed))
                {
                     echo '<script>alert("uploaded image format is not correct ( only jpg,gif,png ) so try again");</script>';
                     return false ;
                }
		$upload='img'.$a.'.'.$make;
		$target='event/'.$upload;
		move_uploaded_file($_FILES['img']['tmp_name'],$target);
                $f=$_POST['e'];
                $descrip='eventpart'.$a.'.txt';
                $mysqli=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                if($mysqli==false) die('Error: could not connect to db');
                $sql="INSERT INTO eventpart(eno,eventname,image,Descrip) values('".$a."','".$name."','".$upload."','".$descrip."')";
                if(!$mysqli->query($sql))
                    echo "could not execute query";
                $mysqli->close();
                            $myfile=fopen("$descrip","w") or die("unable to open the file");
                            fputs($myfile,$f);
                                fputs($myfile,'^');
                            fclose($myfile);
                            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                            $query="update eventpart set post=NOW() where eno='$a' ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                            $query="create table `$name`(no int(5) primary Key Auto_Increment,name varchar(50),clubname varchar(50),course varchar(50),branch varchar(50),year varchar(20),mobileno varchar(20),email varchar(90),univrollno varchar(15))"; 
                            mysqli_query($dbc,$query) or die('Error in querying');
                            mysqli_close($dbc);
                           echo '<script>alert("event is created Successfully");location.href="adpanel.php";</script>';
                        }
                        ?>
	     <div class="news-header">
                    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <table cellpadding="20" cellspacing="10" align="center" class="news-table">
                             <tr>
                                <td colspan="2" class="update-form-heading">Add Event</td>
                             </tr>
                             <tr>
                                 <td style="width : 50% ;">Event Name*</td>
				 <td><input type='text' id="text" placeholder="Enter Event Name" onblur="name_validator()"  name='b' required/></td>
                             </tr>
                              <tr>
                                 <td>Upload Event Image* </td>
                                 <td><input type='file' id="text" name="img" required/></td>
                             </tr>
			       <tr>
                                 <td colspan="2"> Brief Description about Event* </td>
                             </tr>
                             <tr>
                                 <td colspan="2"><textarea rows="3" cols="70" maxlength="200" id="q" name="e" wrap="hard" required></textarea></td>
                             </tr>
                        </table>
                        <div class="center">
                            <input type="reset" id="search-op"  value="Cancel">&nbsp&nbsp&nbsp&nbsp
                            <input type="submit" id="search-op"  value="Add Event" name="add">
                        </div>
                    </form>
                     <hr class="divider1">
                        <p style="color : black;text-align: center;margin-bottom: 2% ;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> 
                </p>
                </div>
    </body>
</html>