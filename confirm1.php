<?php
session_start();
require_once('connectvars.php'); 
if(!isset($_SESSION['code']))
   {
   header('Location:index.php');
   }
?>
<html>
    <head>
	 <title>Confirmation</title>
        <style>
        body
        {
            background-image : url('acc1.png');
            background-size : cover ;
        }
        .title
        {
            font-family : 'Mistral' ;
            font-size : 3em;
            color  : #480000 ;
            text-align : center ;
            margin-top : -2% ;
        }
          #text
	    {
		font-size : 0.7em ;
		font-family : "Times","Arial" ;
		width : 220px;
		height : 35px;
	    }
        .sub
        {
            font-family : 'Cooper Black';
             font-size : 2.3em;
            color  : Maroon ;
            text-align : center ;
            margin-top : -1% ;
        }
        .b
        {
            background-color : #F3E5AB ;
            width  : 50% ;
            height : 7% ;
            text-align : center ;
            font-family : 'Mistral';
            font-size :1.5em;
            border : 1px solid #F3E5AB ;
        }
        .b:hover
        {
            background-color : #FFF380;
        }
        .r
        {
            width : 600% ;
            
        }
        </style>
    </head>
    <body>
         <?php
	 $form=true;
	 if(isset($_GET['id']))  // through register form
	 {
	    
	    $id=$_GET['id'];
	    $login=1;
	 }
	 if(isset($_GET['lid']))  // through login form
	    {
		    $id=$_GET['lid'];
		    $login=0;
		}
	
		
	require_once('connectvars.php');
	 $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                         if(isset($_POST['go']))
                        {
			     
			     if(isset($_POST['cofid'])) // through wrong code 
			     {
				$id=$_POST['cofid'];
			     }
			     
			     if(isset($_POST['login'])) // through wrong code 
			     {
				$login=$_POST['login'];
			     }
		    $query="select * from regcode where fid='$id'";
		    $result=mysqli_query($dbc,$query) or die($query);
		    if(mysqli_num_rows($result)==1)
		   {
		    $row=mysqli_fetch_array($result);
		    $code=$row['code'];
		
		    $cid=$row['cid'];
		   }
		   $code1=$_POST['code'];
                           
                           if($code1==$code)
                            {
				$form=false;
                         $query="delete from regcode where cid='$cid'";

                            mysqli_query($dbc,$query) or die('Error in delete querying1');
                         if($login==1){
			      echo '<script>alert("Sign-Up Process is Completed :)");location.href="login.php";</script>';
			}
else{
	$getreq="kk1.php?id=$id";
     header('Location:'.$getreq);

					
}
			      $_SESSION['code']='';
			      session_destroy();
			      
                            }
			    else
			    {
				
				 echo '<script>alert("Wrong Confirmation Code");</script>';
				 $form=true;
			    }
                        
                        }
			if($form){
                        ?>
        <div class="sub"><br>QueryUs.in</div>
        <div class="title"><br>Ask Your Query : Learning Is Social     </div>
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       <div style="text-align : center ;font-size : 1em; padding : 2% ;background-color : brown ; font-family : 'Mistral'; margin-left :30% ;margin-right : 30% ; margin-top : 3% ;">
       <input type='button' class="b" value="Confirm Your Identity"/>
       <table cellpadding="10" cellspacing="10" style="font-size : 1.1em; color : white ;">
        
         <tr>
            <td colspan="3" style="font-family: 'Halvetica';text-align: center;"> Note :- A confirmation code which is sent to your email account paste it in the block given blow for ensuring the registration successfully :) </td>
        </tr>
         <tr>
            <td> Confirmation Code*</td>
       <td colspan="2"><input type="text" id="text" name="code" maxlength="10"  required/></td>
        
        </tr>
       </table>
       
       <input type='reset' class="b" value="Cancel"><input type="Submit" class="b" value="Go" name="go">
	<input type="hidden" value="<?php if(isset($id)) echo $id;?>" name="cofid"/>
	<input type="hidden" value="<?php if(isset($login)) echo $login;?>" name="login"/>
       </div>
       </form>
    
	<?php } ?>
    </body>
</html>