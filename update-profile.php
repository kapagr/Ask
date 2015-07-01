
<?php session_start();
if(!isset($_SESSION['lid']))
   {

	 $getreq="index.php";
    header('Location:'.$getreq);
   }
   ?>
   <?php require_once('connectvars.php'); ?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
        <link rel="stylesheet" type="text/css" href="style2.css" media="all" />
	<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
  	  <link href="asktime.css" rel="stylesheet"/>
          <script src="js_validate2.js"></script>
	<title> Update Timeline </title>
        <script>
             function erase()
            {
                document.getElementById('name').value='';
                document.getElementById('email').value='';
                document.getElementById('rollno').value='';
                document.getElementById('dob').value='';
                document.getElementById('add').value='';
                document.getElementById('about').value='';
                document.getElementById('phone').value='';
            }
        </script>
        <style>

            .pics1
        {
            width:120px;
	    height : 80px;
	    border-radius: 50%;
	    margin-top: 1% ;
        }
	.abc
	{
		font-size: 1.2em;
		font-family: 'Droid Serif';
		color : white ;
		text-align: center ;
	}
	.pics2
	{
		width: 35px;
	    height : 30px;
	    border-radius: 50%;
	    margin-top:  -2% ;
	    margin-bottom:  -0.6% ;
	}
        </style>

</head>
<body>

     <?php
     $id=$_SESSION['lid'];
    $status=$_SESSION['status'];
    $user=$_SESSION['user'];
     $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
    if($status=='student')
    {
        $query="select * from student where sno='$id' ";
        $result=mysqli_query($dbc,$query) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
        $sno=$row['sno'];
        $name=$row['name'];
        $univrollno=$row['univrollno'];
        $course=$row['course'];
        $branch=$row['branch'];
        $year=$row['year'];
        $sem=$row['sem'];
        $dob=$row['dob'];
        $gender=$row['gender'];
        $phone=$row['phone'];
        $pro1=$row['profile'];
        $cover1=$row['cover'];
        $address=$row['address'];
        $about=$row['about'];
        $dbar=$row['area'];
         $area=array();
        $area=explode(',',$dbar);
    }
    else
    {
         $query="select * from faculty where fno='$id' ";
        $result=mysqli_query($dbc,$query) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
         $sno=$row['fno'];
        $name=$row['name'];
        $fid=$row['fid'];
        $dept=$row['Department'];
        $dob=$row['dob'];
        $gender=$row['gender'];
        $phone=$row['phone'];
         $pro1=$row['profile'];
        $cover1=$row['cover'];
        $address=$row['address'];
        $about=$row['about'];
        $dbar=$row['area'];
        $area=array();
        $area=explode(',',$dbar);
    }
    mysqli_close($dbc);
    ?>

    <?php $image='profile/'.$pro1;
    require_once('same.php');
    ?>
      <?php
                         if(isset($_POST['student']))
                        {
                            $out=true;
                            if(!isset($_POST['ways']))
                            {
                                echo '<script>alert("At least one area of interest should be selected");</script>';
                                $out=false;
                                echo '<script>location.href="update-profile.php";</script>';
                            }
                            $profile=$_FILES['pro']['name'];
                            $cover=$_FILES['cover']['name'];
                            $sizepro=$_FILES['pro']['size'];
                            $sizecover=$_FILES['cover']['size'];
                            if(($sizepro>=1048576) || ($sizecover>=1048576))
			      {
                                   echo '<script>alert("Uploaded File must be < 1MB so try again");</script>';
                                   $out=false;
                                   echo '<script>location.href="update-profile.php";</script>';
			      }
                            $make=end(explode('.',$profile));
                            $make1=end(explode('.',$cover));
                            $allowed=array('jpg','gif','png','JPG','PNG','GIF');
                            if((!in_array ($make,$allowed)) || (!in_array ($make1,$allowed)) )
                            {
                                 echo '<script>alert("uploaded file format is not correct ( only gif,jpg and png ) so try again");</script>';
                                 $out=false;
                                 echo '<script>location.href="update-profile.php";</script>';
                            }
                            if($out)
                            {
                            if($pro1!='pro.jpg' && $cover1!='cover.png')
                            {
                                 unlink("profile/".$pro1);
                                 unlink("cover/".$cover1);
                            }
                    	    $upload='pros'.$sno.'.'.$make;
                            $upload1='covers'.$sno.'.'.$make1;
                            $target1='profile/'.$upload;
                            $target='cover/'.$upload1;
                            move_uploaded_file($_FILES['cover']['tmp_name'],$target);
                            move_uploaded_file($_FILES['pro']['tmp_name'],$target1);
                            $name=$_POST['name'];
                            $course=$_POST['Course'];
                            $branch=$_POST['Branch'];
                            $sem=$_POST['Semester'];
                            $year=$_POST['Year'];
                            $dob=$_POST['dob'];
                            $add=$_POST['add'];
                            $ab=$_POST['about'];
                            $gen=$_POST['gender'];
                            $check=implode(',',$_POST['ways']);
                             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                             $query="update student set name='$name',course='$course',branch='$branch',year='$year',sem='$sem',dob='$dob',gender='$gen',profile='$upload',cover='$upload1',address='$add',about='$ab',area='$check'  where sno='$sno' ";
                            mysqli_query($dbc,$query) or die(mysqli_error());
                            mysqli_close($dbc);
                            echo '<script>alert("Timeline is updated successfully !!");location.href="profile.php";</script>';
                            }
                        }
                            ?>
      <?php
                         if(isset($_POST['faculty']))
                        {
                            $out=true;
                            if(!isset($_POST['ways']))
                            {
                                echo '<script>alert("At least one area of interest should be selected");</script>';
                                $out=false;
                                echo '<script>location.href="update-profile.php";</script>';
                            }
                            $profile=$_FILES['pro']['name'];
                            $cover=$_FILES['cover']['name'];
                            $sizepro=$_FILES['pro']['size'];
                            $sizecover=$_FILES['cover']['size'];
                            if(($sizepro>=1048576) || ($sizecover>=1048576))
			      {
                                   echo '<script>alert("Uploaded File must be < 1MB so try again");</script>';
                                    $out=false;
                                   echo '<script>location.href="update-profile.php";</script>';
			      }
                            $make=end(explode('.',$profile));
                            $make1=end(explode('.',$cover));
                            $allowed=array('jpg','gif','png','JPG','PNG','GIF');
                            if((!in_array ($make,$allowed)) || (!in_array ($make1,$allowed)) )
                            {
                                 echo '<script>alert("uploaded file format is not correct ( only gif,jpg and png ) so try again");</script>';
                                 $out=false;
                                 echo '<script>location.href="update-profile.php";</script>';
                            }
                            if($out)
                            {
                            if($pro1!='pro.jpg' && $cover1!='cover.png')
                            {
                                 unlink("profile/".$pro1);
                                 unlink("cover/".$cover1);
                            }
                    	    $upload='prof'.$sno.'.'.$make;
                            $upload1='coverf'.$sno.'.'.$make1;
                            $target1='profile/'.$upload;
                            $target='cover/'.$upload1;
                            move_uploaded_file($_FILES['cover']['tmp_name'],$target);
                            move_uploaded_file($_FILES['pro']['tmp_name'],$target1);
                            $name=$_POST['name'];

                            $dept=$_POST['Department'];
                            $dob=$_POST['dob'];
                            $add=$_POST['add'];
                            $ab=$_POST['about'];
                            $gen=$_POST['gender'];
                            $check=implode(',',$_POST['ways']);
                             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                             $query="update faculty set name='$name',Department='$dept',dob='$dob',gender='$gen',profile='$upload',cover='$upload1',address='$add',about='$ab',area='$check' where fno='$sno' ";
                            mysqli_query($dbc,$query) or die(mysqli_error());
                            mysqli_close($dbc);
                            echo '<script>alert("Timeline is updated successfully !!");location.href="profile.php";</script>';
                        }
                        }
                            ?>
    <?php if($status=='student')
    {
    ?>
    <div class="container">
      <div  class="form">
    		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    			<p class="contact"><label for="name">Name</label></p>
    			<input id="name" name="name" placeholder="First and last name" value="<?php echo $name ;?>" required="" title="ALPHABETS ONLY" tabindex="1" type="text" onblur="name_validator()">
        <select class="select-style gender" required="" name="Course" >
            <option value="<?php echo $course ;?>"><?php echo $course ;?></option>
	    <option value="BTech">BTech</option>
			<option value="Mtech">Mtech</option>
			<option value="phD">phD</option>
			<option value="BBA">BBA</option>
			<option value="MBA">MBA</option>
			<option value="BSc">BSc</option>
			<option value="MSc">MSc</option>

            </select><br><br>
	     <select class="select-style gender" required="" name="Branch" >
            <option value="<?php echo $branch ;?>"><?php echo $branch ;?></option>
			<option value="Mechanical Engineering">Mechanical Engineering</option>
			<option value="Civil Engineering">Civil Engineering</option>
			<option value="Electrical Engineering">Electrical Engineering</option>
			<option value="Electrical & Electronics Engineering">Electrical & Electronics Engineering</option>
			<option value="Computer Science Engineering">Computer Science Engineering</option>
			<option value="Information Technology">Information Technology</option>
            <option value="none">None</option>
            </select><br><br>
	      <select class="select-style gender" required="" name="Year" >
            <option value="<?php echo $year ;?>"><?php echo $year ;?></option>
			<option value="Ist Year">Ist Year</option>
			<option value="IInd year">IInd year</option>
			<option value="IIIrd year">IIIrd year</option>
			<option value="IVth year">IVth year</option>
            <option value="other">Other</option>
            </select><br><br>
	      <select class="select-style gender" required="" name="Semester" >
            <option value="<?php echo $sem ;?>"><?php echo $sem ;?></option>
			<option value="Ist">Ist</option>
			<option value="IInd">IInd</option>
			<option value="IIIrd">IIIrd</option>
			<option value="IVth">IVth</option>
			<option value="Vth">Vth</option>
			<option value="VIth">VIth</option>
			<option value="VIIth">VIIth</option>
			<option value="VIIIth">VIIIth</option>
            <option value="other">Other</option>
            </select><br><br>
               <fieldset>
                <?php $da=date("Y-m-d");?>
                 <label>Date Of Birth </label>
                <label><input type="date" value="<?php echo $dob ;?>" max="<?php echo $da;?>" name="dob" id="dob" required=""></label>
              </fieldset>
                 <p class="contact"><label for="pro">Upload Profile Picture</label></p>
            <input id="pro" name="pro"  title="Only GIF,JPEG,PNG image formats are allowed" required type="file"><br>
              <p class="contact"><label for="cover">Upload Cover Photo</label></p>
            <input id="cover" name="cover"  title="Only GIF,JPEG,PNG image formats are allowed" required type="file"><br>
            <p class="contact"><label for="add">Address</label></p>
            <textarea rows="3" cols="60" maxlength="200" name="add" id="add" title="Address Required" wrap="hard" required="" ><?php echo $address ;?></textarea><br>
            <p class="contact"><label for="about">About You</label></p>
            <textarea rows="3" cols="60" maxlength="200" name="about" id="about" wrap="hard" ><?php echo $about ;?></textarea><br><br>

            <p class="contact"><label for="ways[]">Choose Your Area of Interests</label></p>
            <input type="checkbox" name="ways[]"  id="a" value="Academics" <?php if(in_array('Academics',$area)) echo 'checked="checked"';?> ><label for="a">Academics</label><br>
            <input type="checkbox" name="ways[]"  id="s" value="Social" <?php if(in_array('Social',$area)) echo 'checked="checked"';?>><label for="s">Social</label><br>
            <input type="checkbox" name="ways[]"  id="p" value="Politics" <?php if(in_array('Politics',$area)) echo 'checked="checked"';?>><label for="p">Politics</label><br>
            <input type="checkbox" name="ways[]" id="co" value="Co-Curriculum Activities" <?php if(in_array('Co-Curriculum Activities',$area)) echo 'checked="checked"';?>><label for="co">Co-Curriculum Activities</label><br>
            <input type="checkbox" name="ways[]"  id="pr" value="Programming Languages" <?php if(in_array('Programming Languages',$area)) echo 'checked="checked"';?>><label for="pr">Programming languages</label><br>
            <input type="checkbox" name="ways[]" id="N"  value="News & Events" <?php if(in_array('News & Events',$area)) echo 'checked="checked"';?>><label for="N">News & Events</label><br>
            <input type="checkbox" name="ways[]"  id="Mo" value="Movies & Shows" <?php if(in_array('Movies & Shows',$area)) echo 'checked="checked"';?>><label for="Mo">Movies & Shows</label><br>
            <input type="checkbox" name="ways[]" id="sports"  value="Sports" <?php if(in_array('Sports',$area)) echo 'checked="checked"';?>><label for="sports">Sports</label><br>
            <input type="checkbox" name="ways[]"  id="other" value="Other" <?php if(in_array('Other',$area)) echo 'checked="checked"';?>><label for="other">Other</label><br>

             <select class="select-style gender" required="" name="gender" >
            <option value="<?php echo $gender ;?>" ><?php echo $gender ;?></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="others">Other</option>
            </select><br><br>

            <div style="text-align: center;margin-top: 1% ;">
			<input class="buttom" name="student" id="submit" tabindex="5" value="Update" type="submit">
	    </div>
   </form>
</div>
</div>
    <?php
    }
    if($status=='faculty')
    {
        ?>
        <div class="container">
      <div  class="form">
    		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" >
    			<p class="contact"><label for="name">Faculty Name</label></p>
    			<input id="name" name="name" placeholder="First and last name" required="" value="<?php echo $name;?>" tabindex="1" type="text" onblur="name_validator()">

	     <select class="select-style gender" required="" name="Department">
            <option value="<?php echo $dept;?>"><?php echo $dept;?></option>
			<option value="Mechanical Engineering">Mechanical Engineering</option>
			<option value="Civil Engineering">Civil Engineering</option>
			<option value="Electrical Engineering">Electrical Engineering</option>
			<option value="Electrical & Electronics Engineering">Electrical & Electronics Engineering</option>
			<option value="Computer Science Engineering">Computer Science Engineering</option>
			<option value="Information Technology">Information Technology</option>
            <option value="other">Other</option>
            </select><br><br>
               <fieldset>
               <?php $da=date("Y-m-d");?>
                 <label>Date Of Birth </label>
                                 <label><input type="date" name="dob" placeholder="Year"  max="<?php echo $da;?>" value="<?php echo $dob ;?>"  required=""></label>
              </fieldset>
                <p class="contact"><label for="pro">Upload Profile Picture</label></p>
            <input id="pro" name="pro"  title="Only GIF,JPEG,PNG image formats are allowed" required type="file"><br>
              <p class="contact"><label for="cover">Upload Cover Photo</label></p>
            <input id="cover" name="cover"  title="Only GIF,JPEG,PNG image formats are allowed"  required type="file"><br>
            <p class="contact"><label for="add">Address</label></p>
            <textarea rows="3" cols="60" maxlength="200"  name="add" id="add" title="Address Required" wrap="hard" required><?php echo $address ;?></textarea><br>
            <p class="contact"><label for="about">About You</label></p>
            <textarea rows="3" cols="60" maxlength="200"  name="about" id="about" wrap="hard" ><?php echo $about ;?></textarea><br><br>

             <p class="contact"><label for="ways[]">Choose Your Area of Interests</label></p>
            <input type="checkbox" name="ways[]"  id="a" value="Academics" <?php if(in_array('Academics',$area)) echo 'checked="checked"';?> ><label for="a">Academics</label><br>
            <input type="checkbox" name="ways[]"  id="s" value="Social" <?php if(in_array('Social',$area)) echo 'checked="checked"';?>><label for="s">Social</label><br>
            <input type="checkbox" name="ways[]"  id="p" value="Politics" <?php if(in_array('Politics',$area)) echo 'checked="checked"';?>><label for="p">Politics</label><br>
            <input type="checkbox" name="ways[]" id="co" value="Co-Curriculum Activities" <?php if(in_array('Co-Curriculum Activities',$area)) echo 'checked="checked"';?>><label for="co">Co-Curriculum Activities</label><br>
            <input type="checkbox" name="ways[]"  id="pr" value="Programming Languages" <?php if(in_array('Programming Languages',$area)) echo 'checked="checked"';?>><label for="pr">Programming languages</label><br>
            <input type="checkbox" name="ways[]" id="N"  value="News & Events" <?php if(in_array('News & Events',$area)) echo 'checked="checked"';?>><label for="N">News & Events</label><br>
            <input type="checkbox" name="ways[]"  id="Mo" value="Movies & Shows" <?php if(in_array('Movies & Shows',$area)) echo 'checked="checked"';?>><label for="Mo">Movies & Shows</label><br>
            <input type="checkbox" name="ways[]" id="sports"  value="Sports" <?php if(in_array('Sports',$area)) echo 'checked="checked"';?>><label for="sports">Sports</label><br>
            <input type="checkbox" name="ways[]"  id="other" value="Other" <?php if(in_array('Other',$area)) echo 'checked="checked"';?>><label for="other">Other</label><br>

            <select class="select-style gender" name="gender">
            <option value="<?php echo $gender ;?>"><?php echo $gender ;?></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="others">Other</option>
            </select><br><br>
            <div style="text-align: center;">
			<input class="buttom" name="faculty" id="submit" tabindex="5" value="Update" type="submit">
	    </div>
   </form>
</div>
</div>
<?php
    }
    ?>
</body>
</html>
