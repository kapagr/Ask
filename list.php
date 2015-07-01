<html>
    <head>
	 <title> Placed Students</title>
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
                <a href="index.php">Home</a>
                <span class="right">
                    <a href="Placement.php">
                        <strong>Back to Previous page</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div>
	    <?php
                require_once('connectvars.php');
                $cno=$_GET['id'];
                 $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                 $query="select * from upcompany where Cno='$cno' " ;            
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
            $row=mysqli_fetch_array($result);
            $cname=$row['Company_Name'];
             mysqli_close($dbc);
             ?>
	    <header>
		<h1 style="font-size : 2.3em;"><span>QueryUs.in</span><br> <?php echo $cname;?> Placed Students :)</h1>
            </header>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table align="center" style="text-align : center ;width : 95% ;height : 10% ;background-color : brown ; color : white ;" cellpadding=20" border="1" cellspacing="10">
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
                <td>Snapshots</td>
                
            </tr>
                                  <?php
                                 
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                 $query="select * from student where cno='$cno' " ;            
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
                    $images=$row['profile'];
                    $snap='profile/'.$images;
                   
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
                     <td><img src="<?php echo $snap;?>" width="80px" height="60px"></td>
                </tr>
                <?php
               }
                  mysqli_close($dbc);

               ?>

            </table>
            </form>
        </div>
    </body>
</html>