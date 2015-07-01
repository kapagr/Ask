<html>
    <head>
	 <title>Paricipation List </title>
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
        </style>
    </head>
    <body>
        <div class="container">
			
            <div class="freshdesignweb-top">
                <a href="index.php">Home</a>
                <span class="right">
                    <a href="adpanel.php">
                        <strong>Back to Previous page</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div>
	    <?php require_once('connectvars.php'); ?>
            <?php
                $id=$_GET['id'];
                $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
            $query="select * from clubpart where no='$id'" ;
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
                    $name=$row['clubname'];
               }
            mysqli_close($dbc);
               ?>
			<header>
				<h1 style="font-size : 2.3em;"><span>QueryUs.in</span><br>Participate list of student in <?php echo $name ;?> :)</h1>
            </header>       
            <table align="center" style="text-align : center ;width : 80% ;height : 10% ;background-color : brown ; color : white ;" cellpadding="20" border="1" cellspacing="10">
            <tr>
                <td>S.No.</td>
                <td>Student Name</td>
                <td>Club Name</td>
                <td>Course</td>
                <td>Branch</td>
                <td>Year</td>
                <td>Mobile No</td>
                <td>Email</td>
                <td>University Roll No</td>
            </tr>
                                  <?php
                                  $count=0;
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
            $query="select * from `$name`";
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
                    $count++;
                ?>
                <tr>
                  <?php  
                    $no=$row['no'];
                    $name=$row['name'];
                    $clubname=$row['clubname'];
                    $course=$row['course'];
                    $branch=$row['branch'];
                    $year=$row['year'];
                    $mobileno=$row['mobileno'];
                    $email=$row['email'];
                    $rollno=$row['univrollno'];
                    ?>
                    <td><?php echo $count;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $clubname;?></td>
                    <td><?php echo $course;?></td>
                    <td><?php echo $branch;?></td>
                    <td><?php echo $year;?></td>
                    <td><?php echo $mobileno;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $rollno;?></td>
                </tr>
                <?php
               }
                  mysqli_close($dbc);

               ?>
          
            </table>  
        </div>
    </body>
</html>