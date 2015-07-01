<html>
    <head>
	 <title>Faculty Records </title>
         <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
        <style>
        body
        {
            background-image : url('acc1.png');
            background-size : cover ;
        }
        .area
        {
            padding : 2% ;
            background-color : brown;
            
        }
	 .buttom
          { background: #4b8df9;
          display: inline-block;
          padding: 5px 10px 6px; color: #fbf7f7;
          text-decoration: none;
          font-weight: bold;
          line-height: 1;
          -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 1px 3px #999; -webkit-box-shadow: 0 1px 3px #999; box-shadow: 0 1px 3px #999; text-shadow: 0 -1px 1px #222; border: none; position: relative; cursor: pointer; font-size: 14px; font-family:Verdana, Geneva, sans-serif;}
        .buttom:hover
        {
          background-color: #2a78f6;
          }
        </style>
    </head>
    <body>
        <div class="container">
			
            <div class="freshdesignweb-top">
                <a href="adpanel.php">Home</a>
                <span class="right">
                    <a href="adpanel.php">
                        <strong>Back to Previous page</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div>
	    <?php require_once('connectvars.php');
	     if(isset($_POST['dept']))
            {
	     $dept=$_POST['dept'];
	     }
	     if(isset($_POST['find']))
	    {   $out=true;
	        if(!isset($_POST['change']))
	       {
	              echo '<script>alert("At least one area of interest should be selected");</script>';
	              $out=false;
	              return false;
		 }
		     if($out)
		     {
		    $ids=implode(',',$_POST['change']);
		    $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error in connection');
		    $query="delete from logins where fid in ( $ids )";
		    mysqli_query($dbc,$query) or die('Error in querying');
		       $query="update faculty set del='1'  where fno in ( $ids )";
                   mysqli_query($dbc,$query) or die('Error in querying');
		    echo '<script>alert("Faculty Records are deleted successfully");location.href="adpanel.php";</script>';
		    }	
		}
	     
	     ?>
			<header>
				<h1 style="font-size : 2.3em;"><span>QueryUs.in</span><br>Faculty Records :)</h1>
            </header>
	      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table align="center" style="text-align : center ;width : 95% ;height : 10% ;background-color : brown ; color : white ;" cellpadding=20" border="1" cellspacing="10">
            <tr>
                <td>F.No.</td>
                <td>Faculty Name</td>
                <td>Email</td>
                <td>Faculty ID</td>
		<td>Department</td>
                <td>Date of Birth </td>
                <td>Gender</td>
                <td>Mobile No</td>
                <td>Address</td>
                <td>Areas</td>
                <td>Action</td>
                
            </tr>
                                  <?php
				 
                                 
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
            if($dept=='all')
            {
            $query="select * from faculty " ;
            }
            else
            {
                 $query="select * from faculty where Department='$dept' " ;
            }
            
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
                ?>
                <tr>
                  <?php  
                    $fno =$row['fno'];
                    $name=$row['name'];
                    $email=$row['email'];
                     $fid=$row['fid'];
                    $dept1=$row['Department'];
                     $dob=$row['dob'];
                     $gen=$row['gender'];
                    $phone=$row['phone'];
                    $add=$row['address'];
                    $area=$row['area'];
                   $del=$row['del'];
                    ?>
                    <td><?php echo $fno;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $fid;?></td>
                    <td><?php echo $dept1;?></td>
                    <td><?php echo $dob;?></td>
                    <td><?php echo $gen;?></td>
                    <td><?php echo $phone;?></td>
                    <td><?php echo $add;?></td>
                    <td><?php echo $area;?></td>
		      <?php if($del=='0')
                    {?>
		     <td> <input type="checkbox" name="change[]" value="<?php echo $fno ;?>"> </td>
		     <?php }
                    else
                    {?>
                    <td>Deleted</td>
                    <?php }?>
                </tr>
                <?php
               }
                  mysqli_close($dbc);

               ?>
	       <tr>
                            <td colspan="14">
                                <div style="text-align: center;margin-top: 1% ;">
			<input class="buttom" name="find" id="submit" tabindex="5" value="Delete Records" type="submit">
	    </div>
                            </td>
                          </tr>
          
            </table>
	      </form>
	    
        </div>
    </body>
</html>