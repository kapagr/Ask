   <?php session_start();?>
<html>
     
     <head>
	 <title>Update Company</title>
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
         
            <?php
	     $id=$_GET['id'];?>
        <div class="login-header">
            <div class="address"><a href="index.php"> Home </a> &nbsp > &nbsp <a href="admin.php">Admin Login </a> &nbsp > &nbsp <a href="adpanel.php">Panel</a> &nbsp>&nbsp&nbsp Update Company</div>
               <div class="right"><?php echo '(Hello !!&nbsp&nbsp'.$_SESSION["User_name"].')'?></div>
        </div>
            <?php
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select * from upcompany where Cno='$id' ";
		    $result=mysqli_query($dbc,$query);
		    if(mysqli_num_rows($result)==1)
		    {
			while($row=mysqli_fetch_array($result))
			{
				$cn=$row['Cno'];
				$name=$row['Company_Name'];
                                $date=$row['Visting_date'];
                                $post=$row['Post'];
                                $over=$row['Overview'];
                                $crit=$row['Criteria'];
                                $des=$row['Brief'];
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
		    <div style="color : white ;">
		      <?php
		         if(isset($_POST['update']))
			 {
			     
                            $a=$_POST['n'];
                            $b=$_POST['dob'];
                            $c=$_POST['p'];
			    $f=$_POST['b'];
			   $overname=$_FILES['o']['name'];
			    $size=$_FILES['o']['size'];
			 $critname=$_FILES['c']['name'];
			  $size1=$_FILES['c']['size'];
			  	    if(($size=='0') || ($size1=='0'))
				 {
				     echo '<script>alert("Empty file is not allowed");</script>';
				    return false ;
				 }
			      if(($size>=1024000) || ($size1>=1024000))
			      {
				   echo '<script>alert("Uploaded File must be < 1MB so try again");</script>';
				    return false ;
			      }

			 $make=end(explode('.',$overname));
			 $make1=end(explode('.',$critname));
			  $allowed=array('pdf','txt','docx','rtf','RTF','PDF','DOCX','doc','DOC','TXT');
                if((!in_array ($make,$allowed)) || (!in_array ($make1,$allowed)) )
                {
                     echo '<script>alert("uploaded file format is not correct ( only txt,pdf,doc,docx,rtf ) so try again");</script>';
                     return false ;
                }
		 unlink("Criteria/".$crit);
			      unlink("Overview/".$over);
			 $upload='over'.$id.'.'.$make;
			 $upload1='crit'.$id.'.'.$make1;
			 $target1='Overview/'.$upload;
			 $target='Criteria/'.$upload1;
			 move_uploaded_file($_FILES['c']['tmp_name'],$target);
			  move_uploaded_file($_FILES['o']['tmp_name'],$target1);
                         $myfile=fopen("$des","w") or die("unable to open the file");
                         fputs($myfile,$f.'^');
                            fclose($myfile);
                            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                             $query="Update upcompany set Company_Name='$a',Visting_date='$b',Post='$c',Overview='$upload',Criteria='$upload1',Brief='$des' where Cno='$id' ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                            mysqli_close($dbc);
                           echo '<script>alert("Details are Updated Successfully");location.href="adpanel.php";</script>';
			 }
                        ?>
		    </div>
                <div class="news-header">
                    <form  action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <table cellpadding="20" cellspacing="10" align="center" class="news-table">
                             <tr>
                                <td colspan="2" class="update-form-heading">Update Company </td>
                             </tr>
                            <tr>
                                 <td style="width : 50% ;">Company Name*</td>
				 <td><input type='text' id="text" placeholder="Enter Company Name" name="n" readonly="readonly" value="<?php echo $name ;?>" required/></td>
                             </tr>
                             <tr>
                                 <td> Arriving Date* </td>
                           
                                 <td><input type="date" id="text" name="dob" value="<?php echo $date ;?>" required/></td>
                             </tr>
                              <tr>
                                 <td>Recruitment For Post* </td>
                                 <td><input type='text' id="text" placeholder="Enter Company's Post" name="p" value="<?php echo $post ;?>" required/></td>
                             </tr>
			     <tr>
                                 <td>Upload Company's Overview* </td>
                                 <td><input type='file' id="text" name="o" required/></td>
                             </tr>
			      <tr>
                                 <td>Upload Company's Criteria* </td>
                                 <td><input type='file' id="text" name="c"  required/></td>
                             </tr>
			       <tr>
                                 <td colspan="2"> Brief Description about Company* </td>
                             </tr>
                             <tr>
                                 <td colspan="2"><textarea rows="5" cols="105" maxlength="350" id="q" name="b" wrap="hard" required><?php echo $heading ;?></textarea></td>
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