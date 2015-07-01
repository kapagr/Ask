<?php session_start();?>
<html>
    <head>
	 <title>Find Placed Students</title>
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
        <?php
            if(isset($_GET['id']))
            {
                $cn=$_GET['id'];
            }
        ?>
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
	    <?php
                require_once('connectvars.php');
                if(isset($_POST['placed']))
                {
                     $out=true;
                    if(!isset($_POST['pla-std']))
                    {                
                          echo '<script>alert("At least one area of interest should be selected");</script>';
                        $out=false;
                        return false;
                    }
                    if($out)
                    {
                    $cn=$_POST['cn'];
                    $abc=implode(',',$_POST['pla-std']);
                    $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                    $query="update student set placed='1',cno='$cn' where sno in ( $abc )";  
                    mysqli_query($dbc,$query) or die($query);
                    echo '<script>alert("Student is placed successfully :) ");</script>';
		    echo '<script>location.href="adpanel.php";</script>';
                    }
                }
            ?>
	    <header>
		<h1 style="font-size : 2.3em;"><span>QueryUs.in</span><br>Find Placed Students :)</h1>
            </header>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table align="center" style="text-align : center ;width : 95% ;height : 18% ;background-color : brown ; color : white ;" cellpadding=20" border="1" cellspacing="10">
            <tr>
                <td>S.No.</td>
                <td>Student Name</td>
                <td>Email</td>
                <td>University Roll No</td>
                <td>Course</td>
                <td>Branch</td>
                <td>Year</td>
                <td>Semester</td>
                <td>Date of Birth </td>
                <td>Gender</td>
                <td>Mobile No</td>
                <td>Address</td>
                <td>Areas</td>
                <td>Select</td>
                
            </tr>
                                  <?php
                                 
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                 $query="select * from student where year='IVth year' and placed='0' " ;            
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
                ?>
                <tr>
                  <?php  
                    $sno=$row['sno'];
                    $name=$row['name'];
                    $email=$row['email'];
                     $rollno=$row['univrollno'];
                    $course1=$row['course'];
                    $branch1=$row['branch'];
                    $year1=$row['year'];
                     $sem1=$row['sem'];
                     $dob=$row['dob'];
                     $gen=$row['gender'];
                    $phone=$row['phone'];
                    $add=$row['address'];
                    $area=$row['area'];
                   
                    ?>
                    <td><?php echo $sno;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $rollno;?></td>
                    <td><?php echo $course1;?></td>
                    <td><?php echo $branch1;?></td>
                    <td><?php echo $year1;?></td>
                    <td><?php echo $sem1;?></td>
                    <td><?php echo $dob;?></td>
                    <td><?php echo $gen;?></td>
                    <td><?php echo $phone;?></td>
                    <td><?php echo $add;?></td>
                    <td><?php echo $area;?></td>
                    <td><input type="checkbox" name="pla-std[]" value="<?php echo $sno ;?>"></td>
                </tr>
                <?php
               }
                  mysqli_close($dbc);

               ?>
            <tr>
                       <td colspan="14">  <div style="text-align: center;margin-top: 0.3% ; margin-bottom: 0.3% ;">
			<input class="buttom" name="placed" id="submit" tabindex="5" value="Click to Placed" type="submit">
                       <input type="hidden" name="cn" value="<?php echo $cn ;?>"></div></td>
            </tr>
          
            </table>
            </form>
        </div>
    </body>
</html>