<html>
    <head>
 <title>Delete Participation</title>
	<script>
	     function rollnovalidator()
    {
        num=document.getElementById("text").value;
        var length=num.length;
        if (isNaN(num))
        {
            document.getElementById("text").value="";
            document.getElementById("text").placeholder="Numbers ONLY!";                    
        }
        else if (length!=9)
        {
            document.getElementById("text").value="";
            document.getElementById("text").placeholder="Exactly 9 Digits";                    
        }
    }
	</script>
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
            font-size :0.4em;
            border : 1px solid #F3E5AB ;
        }
        .b:hover
        {
            background-color : #FFF380;
        }
         #text
    {
		font-size : 0.8em ;
		font-family : "Times","Arial" ;
		width : 220px;
		height : 35px;
	    }
        </style>
    </head>
    <body>
	<?php require_once('connectvars.php'); ?>
        <?php $id=$_GET['id'];?>
         <?php
                         if(isset($_POST['go']))
                        {
                              $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                            $query="select * from clubpart where no='$id'" ;
                            $result=mysqli_query($dbc,$query) or die(mysqli_error());
                           while($row=mysqli_fetch_array($result))
                           {
                                $name=$row['clubname'];
                           }
                            $roll=$_POST['rollno'];
                            
            $query="select univrollno from `$name` where univrollno='$roll' ";
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               if($row=mysqli_fetch_array($result)==0)
               {
                  
			 echo '<script>alert("Please Check Your University Roll No");</script>';
			 return false;
	
                }
		$query="delete from `$name` where univrollno='$roll' ";
                            mysqli_query($dbc,$query);
                    mysqli_close($dbc);
                    echo '<script>alert("Participation Of Student is cancelled Successfully");location.href="adpanel.php";</script>';
                        }   
      ?>
        <div class="sub"><br>QueryUs.in</div>
        <div class="title"><br>Ask Your Query : Learning Is Social      
        <div style="color : brown ; font-size : 1em;font-family : 'Mistral';margin-top : 4% ; ">Delete Student Participation :)</div>
       <form action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       <div style="text-align : center ;font-size : 1em; padding : 2% ;background-color : brown ; font-family : 'Mistral'; margin-left :30% ;margin-right : 30% ; margin-top : 5% ;">
       <input type='button' class="b"  value="Enter Student University Roll No"/>
       <table cellpadding="10" cellspacing="10" style="font-size : 0.4em; color : white ;" align="center">
        <tr>
       <td ><input type="text" id="text" name="rollno" maxlength="9" placeholder="Enter University RollNo" onblur="rollnovalidator()" required/></td>
        </tr>
       </table>
       
       <input type='reset' class="b" value="Cancel"><input type="Submit" class="b" value="Go" name="go">
     
       </div>
       </form>
        </div>
    
    </body>
</html>