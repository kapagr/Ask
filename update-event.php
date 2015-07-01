<html>
     <head>
	 <title>Update College Club </title>
         <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
         <script>
            function erase()
            {
                document.getElementById('p').value='';
                document.getElementById('q').value='';
                document.getElementById('r').value='';
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
    
         </style>
    </head>
    <body>
         <?php
	     require_once('check.php');
	     require_once('connectvars.php');
	    ?>
            <?php session_start();?>
            <?php
	     $id=$_GET['id'];?>
        <div class="login-header">
            <div class="address"><a href="index.php"> Home </a> &nbsp > &nbsp <a href="admin.php">Admin Login </a> &nbsp > &nbsp <a href="adpanel.php">Panel</a> &nbsp>&nbsp&nbsp Update Events </div>
               <div class="right"><?php echo '(Hello !!&nbsp&nbsp'.$_SESSION["User_name"].')'?></div>
        </div>
            <?php
	     $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select * from eventpart where eno='$id' ";
		    $result=mysqli_query($dbc,$query);
		    if(mysqli_num_rows($result)==1)
		    {
			while($row=mysqli_fetch_array($result))
			{
				$id=$row['eno'];
				$cname=$row['eventname'];
                                $image=$row['image'];
                                $des=$row['Descrip'];
                        }
		    }
		     else
		     {
			echo 'No records available';
			}
                                
		mysqli_close($dbc);
		?>
                 <?php $myfile=fopen("$des","r") or die("unable to open the file");
                   $heading='';
                    $line=fgetc($myfile);
                    while($line!='^')
                    {
                        $heading=$heading.$line;
                        $line=fgetc($myfile);
                    }     
		    fclose($myfile);
                    ?>
                      <?php
                         if(isset($_POST['update']))
                        {  
                            $a=$_POST['b'];
                            $b=$_POST['e'];
                             $upimage=$_FILES['image']['name'];
                              $size=$_FILES['image']['size'];
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
			
			 unlink("event/".$image);
			 $upload='img'.$id.'.'.$make;
			 $target='event/'.$upload;
			 move_uploaded_file($_FILES['image']['tmp_name'],$target);
                            $myfile=fopen("$des","w") or die("unable to open the file");
                            fputs($myfile,$b);
                                fputs($myfile,'^');
                            fclose($myfile);
                            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                            $query="update eventpart set eventname='$a',image='$upload',post=NOW() where eno='$id' ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                            $query="drop table `$cname` ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                            $query="create table `$a`(no int(5) primary Key Auto_Increment,name varchar(50),clubname varchar(50),course varchar(50),branch varchar(50),year varchar(20),mobileno varchar(20),email varchar(90),univrollno varchar(15))"; 
                            mysqli_query($dbc,$query) or die('Error in querying');
                            mysqli_close($dbc);
                           echo '<script>alert("Event is Updated Successfully");location.href="adpanel.php";</script>';
                        }
                        ?>
                <div class="news-header">
                    <form  action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <table cellpadding="20" cellspacing="10" align="center" class="news-table">
                             <tr>
                                <td colspan="2" class="update-form-heading">Update Events </td>
                             </tr>
                            <tr>
                                 <td style="width : 50% ;">Event Name*</td>
				 <td><input type='text' id="text" placeholder="Enter Club Name"  readonly="readonly"  name='b' value="<?php echo $cname ;?>" required/></td>
                             </tr>
                             <tr>
                                 <td>Upload Event Image* </td>
                                 <td><input type='file' id="text" name="image" required/></td>
                             </tr>
			       <tr>
                                 <td colspan="2"> Brief Description about Event* </td>
                             </tr>
                             <tr>
                                 <td colspan="2"><textarea rows="3" cols="70" maxlength="200" id="q" name="e" wrap="hard" required><?php echo $heading ;?></textarea></td>
                             </tr>
                        </table>
                        <div class="center">
                            <input type="button" id="search-op"  value="Cancel" onclick="erase()">&nbsp&nbsp&nbsp&nbsp
                            <input type="submit" id="search-op"  value="Update" name="update">
                        </div>
                    </form>
                     <hr class="divider1">
                       <p style="color : black;text-align: center;margin-bottom: 2% ;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> 
                </p>
                </div>
    </body>
</html>