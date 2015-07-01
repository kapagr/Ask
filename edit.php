<html>
     <head>
	 <title>Update News</title>
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
            <div class="address"><a href="index.php"> Home </a> &nbsp > &nbsp <a href="admin.php">Admin Login </a> &nbsp > &nbsp <a href="adpanel.php">Panel</a> &nbsp>&nbsp&nbsp Update News</div>
               <div class="right"><?php echo '(Hello !!&nbsp&nbsp'.$_SESSION["User_name"].')'?></div>
        </div>
            <?php
             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select * from news where nid='$id' ";
		    $result=mysqli_query($dbc,$query);
		    if(mysqli_num_rows($result)==1)
		    {
			while($row=mysqli_fetch_array($result))
			{
				$id=$row['nid'];
				$fname=$row['nfname'];
			}
		    }
		     else
		     {
			echo 'No records available';
			}
                                
		mysqli_close($dbc);
		?>
                 <?php $myfile=fopen("$fname","r") or die("unable to open the file");
                   $heading='';
                    $shdesc='';
                    $londesc='';
                    $line=fgetc($myfile);
                    while($line!='^')
                    {
                        $heading=$heading.$line;
                        $line=fgetc($myfile);
                    }
                    $line=fgetc($myfile);
                    while($line!='#')   
                    {
                        $shdesc=$shdesc.$line;
                        $line=fgetc($myfile);
                    }
                    while(!feof($myfile))
                    {
                        $line=fgets($myfile)."<br/>";
                        $londesc=$londesc.$line;
                    }       
		    fclose($myfile);
                    ?>
                      <?php
                         if(isset($_POST['update']))
                        {   
                            $a=$_POST['a'];
                            $b=$_POST['b'];
                            $c=$_POST['c'];
                            $myfile=fopen("$fname","w") or die("unable to open the file");
                            fputs($myfile,$a);
                                fputs($myfile,'^'.$b);
                            fputs($myfile,'#'.$c);
                            fclose($myfile);
                            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                            $query="update news set PostDate=NOW() where nid='$id' ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                            mysqli_close($dbc);
                           echo '<script>alert("News is Updated Successfully");location.href="adpanel.php";</script>';
                        }
                        ?>
                <div class="news-header">
                    <form  action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <table cellpadding="20" cellspacing="10" align="center" class="news-table">
                             <tr>
                                <td colspan="2" class="update-form-heading">Update or Write New News </td>
                             </tr>
                             <tr>
                                 <td colspan="2" style="width : 50% ;">News Heading*</td>
                             </tr>
                             <tr>
                                 <td colspan="2" style="width : 50% ;"><textarea rows="3" id="p" cols="100" name="a" maxlength="200" wrap="hard" required><?php echo $heading;?></textarea></td>
                             </tr>
                             <tr>
                                 <td colspan="2"> Brief Description* </td>
                             </tr>
                             <tr>
                                 <td colspan="2"><textarea rows="5" cols="100" maxlength="600" id="q" name="b" wrap="hard" required><?php echo $shdesc ;?></textarea></td>
                             </tr>
                              <tr>
                                 <td colspan="2">Complete Description* </td>
                              </tr>
                              <tr>
                                 <td colspan="2"><textarea rows="5" cols="103" maxlength="2000" id="r" name="c" wrap="hard" required><?php echo strip_tags($londesc) ;?></textarea></td>
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