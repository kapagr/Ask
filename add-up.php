<?php session_start();?>
<html>
     <head>
	 <title>Add Company | QueryUs </title>
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
	        function name_validator2()
	       {
		    name=document.getElementById("post").value;
		    if (name!="")
		    if(/[^a-zA-Z ]/.test(name))
		    {    
		        document.getElementById("post").value="";
		        document.getElementById("post").placeholder="Alphabets ONLY!";                    
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
     .text
     {
	  font-size : 1em ;
		font-family : "Times","Arial" ;
		width : 220px;
		height : 35px;
     }
         </style>
    </head>
    <body>
          <?php
	     require_once('check.php');
	     require_once('connectvars.php');
	    ?>
        <div class="login-header">
            <div class="address"><a href="index.php"> Home </a> &nbsp > &nbsp <a href="admin.php">Admin Login </a> &nbsp > &nbsp <a href="adpanel.php">Panel</a> &nbsp > &nbsp Add Companies  </div>
               <div class="right"><?php echo '(Hello !!&nbsp&nbsp'.$_SESSION["User_name"].')'?></div>
        </div>
	<div style="color : white ;">
	   <?php
                         if(isset($_POST['add']))
                        {
			  $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select MAX(Cno) from upcompany";
		    $result=mysqli_query($dbc,$query);
		   $row=mysqli_fetch_array($result);
		    $a=$row[0];
                $a++;
		$cname=$_POST['b'];
		$query="select * from upcompany where Company_Name='$cname' ";
		 $result=mysqli_query($dbc,$query);
		   while($row=mysqli_fetch_array($result))
		   {
		     echo '<script>alert("Company is already added");</script>';
		     return false;
		   }
		   
			 $overname=$_FILES['over']['name'];
			 $size=$_FILES['over']['size'];
			 $critname=$_FILES['crit']['name'];
			 	 $size1=$_FILES['crit']['size'];
				 if(($size=='0') || ($size1=='0'))
				 {
				     echo '<script>alert("Empty file is not allowed");</script>';
				    return false ;
				 }
				 if(($size>=2097152) || ($size1>=2097152))
			      {
				   echo '<script>alert("Uploaded File must be < 1MB so try again");</script>';
				    return false ;
			      }
			 $make=end(explode('.',$overname));
			 $make1=end(explode('.',$critname));
			  $allowed=array('pdf','txt','doc','docx','DOCX','rtf','RTF','PDF','DOC','TXT');
                if((!in_array ($make,$allowed)) || (!in_array ($make1,$allowed)) )
                {
                     echo '<script>alert("uploaded file format is not correct ( only txt,pdf,doc,docx,rtf ) so try again");</script>';
                     return false ;
                }
			 $upload='over'.$a.'.'.$make;
			 $upload1='crit'.$a.'.'.$make1;
			 
			 $target1='Overview/'.$upload;
			 $target='Criteria/'.$upload1;
			 move_uploaded_file($_FILES['crit']['tmp_name'],$target);
			  move_uploaded_file($_FILES['over']['tmp_name'],$target1);
                $name='dis'.$a.'.txt';
		
		$date=$_POST['dob'];
		$post=$_POST['d'];
		$brief=$_POST['e'];
		  
                $query="INSERT INTO upcompany values('".$a."','".$cname."','".$date."','".$post."','".$upload."','".$upload1."','".$name."')";
                         mysqli_query($dbc,$query);
		         
                            $myfile=fopen("$name","w") or die("unable to open the file");
                            fputs($myfile,$brief.'^');
                            fclose($myfile);
			    mysqli_close($dbc);
                           echo '<script>alert("New Company is created Successfully");location.href="adpanel.php";</script>';
                        }
                        ?>
	</div>
	     <div class="news-header">
                    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <table cellpadding="20" cellspacing="10" align="center" class="news-table">
                             <tr>
                                <td colspan="2" class="update-form-heading">Add Companies </td>
                             </tr>
                             <tr>
                                 <td style="width : 50% ;">Company Name*</td>
				 <td><input type='text' id="text" placeholder="Enter Company Name"   name="b" onblur="name_validator()" required /></td>
                             </tr>
                             <tr>
                                 <td> Arriving Date* </td>
                           
                                 <td><input type="date" id="text" name="dob" required/></td>
                             </tr>
                              <tr>
                                 <td>Recruitment For Post* </td>
                                 <td><input type='text' class="text" id="post"  placeholder="Enter Company's Post" name="d" onblur="name_validator2()"  required/></td>
                             </tr>
			     <tr>
                                 <td>Upload Company's Overview* </td>
                                 <td><input type='file' id="text" name="over" required/></td>
                             </tr>
			      <tr>
                                 <td>Upload Company's Criteria* </td>
                                 <td><input type='file' id="text" name="crit" required/></td>
                             </tr>
			       <tr>
                                 <td colspan="2"> Brief Description about Company* </td>
                             </tr>
                             <tr>
                                 <td colspan="2"><textarea rows="3" cols="105" maxlength="350" id="q" name="e" wrap="hard" required></textarea></td>
                             </tr>
                        </table>
                        <div class="center">
                            <input type="reset" id="search-op"  value="Cancel">&nbsp&nbsp&nbsp&nbsp
                            <input type="submit" id="search-op"  value="Add Company" name="add">
                        </div>
                    </form>
                     <hr class="divider1">
                      <p style="color : black;text-align: center;margin-bottom: 2% ;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> 
                </p>
                </div>
    </body>
</html>