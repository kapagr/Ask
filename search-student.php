<html>
    <head>
	 <title>Student Records </title>
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
                    <a href="search-std.php">
                        <strong>Back to Previous page</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div>
	    <?php require_once('connectvars.php');
                    $rollno=$_GET['rollno'];
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                 $query="select * from student where univrollno='$rollno' " ;
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
            $row=mysqli_fetch_array($result);
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
			<header>
				<h1 style="font-size : 2.3em;"><span>QueryUs.in</span><br>Student Records :)</h1>
            </header>       
            <table align="center" style="text-align : center ;width: 50% ;height: 70% ;background-color : brown ; color : white ;" cellpadding="30" border="1" cellspacing="20">
                <tr>
                     <td>S.No.</td>
                    <td><?php echo $sno;?></td>
                </tr>
                <tr>
                     <td>Student Name</td>
                    <td><?php echo $name;?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $email;?></td>
                </tr>
                <tr>
                     <td>University Roll No</td>
                    <td><?php echo $rollno;?></td>
                </tr>
                <tr>
                     <td>Course</td>
                    <td><?php echo $course1;?></td>
                </tr>
                <tr>
                    <td>Branch</td>
                    <td><?php echo $branch1;?></td>
                </tr>
                <tr>
                     <td>Year</td>
                    <td><?php echo $year1;?></td>
                </tr>
                <tr>
                     <td>Semester</td>
                    <td><?php echo $sem1;?></td>
                </tr>
                <tr>
                     <td>Date of Birth </td>
                    <td><?php echo $dob;?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php echo $gen;?></td>
                </tr>
                <tr>
                      <td>Mobile No</td>
                    <td><?php echo $phone;?></td>
                </tr>
                <tr>
                     <td>Address</td>
                    <td><?php echo $add;?></td>
                </tr>
                <tr>
                     <td>Areas</td>
                    <td><?php echo $area;?></td>
                </tr>
            </table>
              <?php
                  mysqli_close($dbc);
               ?>
        </div>
    </body>
</html>