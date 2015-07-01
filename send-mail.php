<?php session_start();?>
<html>
     <head>
	 <title>Answer Enquired Questions</title>
         <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
        
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
            <div class="address"><a href="index.php"> Home </a> &nbsp > &nbsp <a href="admin.php">Admin Login </a> &nbsp > &nbsp <a href="adpanel.php">Panel</a> &nbsp > &nbsp Answer The Enquiring Questions  </div>
               <div class="right"><?php echo '(Hello !!&nbsp&nbsp'.$_SESSION["User_name"].')'?></div>
        </div>
	<div style="color : white ;">
            <?php $id=$_GET['id'];
             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select * from contact where no='$id' ";
		    $result=mysqli_query($dbc,$query);
		    if(mysqli_num_rows($result)==1)
		    {
			while($row=mysqli_fetch_array($result))
			{
				$id=$row['no'];
				$name=$row['name'];
                                $email=$row['email'];
                                $msg=$row['msg'];
                        }
		    }
		     else
		     {
			echo 'No records available';
			}
                                
		mysqli_close($dbc);
		?>
                <?php
                     if(isset($_POST['send']))
                        {
                         $name=$_POST['b'];
                            $email=$_POST['email'];
                            $q=$_POST['q'];
                            $a=$_POST['a'];
                             $to=$email;
                            $subject="Queryus.in (Ask Your Query - Learning Is Social) ";
                            $from="FROM:Admin<prashant@queryus.in>\r\n";
                            $style='<br><br>Dear'.'&nbsp'.$name.','.'<br><br>'.'Question :- '.$q.'<br><br>'.'Answer :- '.$a.'<br><br><br>With thanks,<br>Queryus Team';
                             $style = str_replace('<br/>','\n',$style);
			    $style=htmlspecialchars($style);
                            $body=$style ;
                            mail($to,$subject,$body,$from);
                             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                    $query="delete from contact where no='".$id."'";
                    mysqli_query($dbc,$query);
                    mysqli_close($dbc);
                            
                            echo '<script>alert("Answer is send successfully");location.href="adpanel.php";</script>';
                        }
                        ?>
                
	</div>
	     <div class="news-header">
                    <form  action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <table cellpadding="20" cellspacing="10" align="center" class="news-table">
                             <tr>
                                <td colspan="2" class="update-form-heading">Answer The Enquiring Questions </td>
                             </tr>
                             <tr>
                                 <td style="width : 50% ;">Full Name*</td>
				 <td><input type='text' id="text" placeholder="Enter Company Name"  value="<?php echo $name ;?>" readonly="readonly" name='b' required/></td>
                             </tr>
                             <tr>
                                 <td> Email* </td>
                           
                                 <td><input type="text" id="text" name="email" value="<?php echo $email ;?>" readonly="readonly" required/></td>
                             </tr>
			       <tr>
                                 <td colspan="2"> Enquired Question* </td>
                             </tr>
                             <tr>
                                 <td colspan="2"><textarea rows="3" cols="105" maxlength="600" id="q" name="q" wrap="hard" readonly="readonly" required><?php echo $msg ;?></textarea></td>
                             </tr>
                              <tr>
                                 <td colspan="2"> Answer* </td>
                             </tr>
                             <tr>
                                 <td colspan="2"><textarea rows="3" cols="105" maxlength="600" id="q" name="a" wrap="hard" required></textarea></td>
                             </tr>
                        </table>
                        <div class="center">
                            <input type="reset" id="search-op"  value="Cancel">&nbsp&nbsp&nbsp&nbsp
                            <input type="submit" id="search-op"  value="Send Answer" name="send">
                        </div>
                    </form>
                     <hr class="divider1">
                        <p style="color : black;text-align: center;margin-bottom: 2% ;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> 
                </p>
                </div>
    </body>
</html>