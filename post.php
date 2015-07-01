<?php session_start();
if(!isset($_SESSION['user']))
   {

	 $getreq="timeline.php";
    header('Location:'.$getreq);
   }
 ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
         <link rel="stylesheet" type="text/css" href="style2.css" media="all" />
	<link rel="stylesheet" type="text/css" href="demo.css" media="all" />
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	  <link href="asktime.css" rel="stylesheet"/>
          <script src="js_validate2.js"></script>
	<title> About </title>
  <script>
  function check()
  {
    var a=document.getElementById('ab').value;
    if(a!='all')
    {
      document.getElementById('ab2').disabled=false;
    }
    else
    {
      document.getElementById('ab2').disabled=true;
    }
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
        .area
        {
            text-align: center;
            padding :2% ;
           margin-left: 20% ;
           margin-right:  20% ;
            background-color : maroon;
        }
        .table
        {
            font-family:  'Mistral' ;
            font-size:  1.3em ;
            color : white ;
            padding  : 10% ;
            opacity: 10 ;
        }
        td
        {
           padding : 4% ;
            opacity: 10 ;
            width : 10% ;

        }
        .tag
        {
            text-align: center;
            font-family: 'Mistral';
            font-size:  2.5em;
            color : #2a78f6 ;
        }
        .buttom{ background: #4b8df9; display: inline-block; padding: 5px 10px 6px; color: #fbf7f7; text-decoration: none; font-weight: bold; line-height: 1; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 1px 3px #999; -webkit-box-shadow: 0 1px 3px #999; box-shadow: 0 1px 3px #999; text-shadow: 0 -1px 1px #222; border: none; position: relative; cursor: pointer; font-size: 14px; font-family:Verdana, Geneva, sans-serif;}
        .buttom:hover	{ background-color: #2a78f6; }

	</style>

</head>
<body>
    <?php
    $status=$_SESSION['status'];
    $user=$_SESSION['user'];
    $id=$_SESSION['lid'];
     $dbc=mysqli_connect('localhost','root','root','qus') or die('Error in connecting database');
    if($status=='student')
    {
        $query="select * from student where sno='$id' ";
        $result=mysqli_query($dbc,$query) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
	 $profile=$row['profile'];
}
else
{
    $query="select * from faculty where fno='$id' ";
    $result=mysqli_query($dbc,$query) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
    $profile=$row['profile'];
}
$image='profile/'.$profile;
require_once('same.php');
if($status=='student')
{
    if(isset($_POST['student']))
    {
        $course=$_POST['Course'];
        $year=$_POST['Year'];
        $sem=$_POST['Semester'];
        $area=$_POST['area'];
        $q=trim($_POST['q']);  //  trimming spaces
        $query="insert into ask(uorf,yr,uid,course,sem,area,quest,asked_on) values('1','$year','$id','$course','$sem','$area','$q',NOW())"; // entering uid if user's status is student
        mysqli_query($dbc,$query) or die("<script>alert('$query');</script>");
        $query="select qid from ask where quest='$q' and uid='$id'";
        $result=mysqli_query($dbc,$query) or die('Error in Querying');
        $row=mysqli_fetch_array($result);
        $qid=$row['qid'];
        $query="update ask set encr_qid=SHA('$qid') where qid='$qid'";
        mysqli_query($dbc,$query) or die('Error in connection');
        header('Location:timeline.php');
    }
?>
    <div class="container">
      <div  class="form">
    		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

            <div class="tag">Ask Your Query :)</div>  <br><br>
             <select class="select-style gender" name="Course"  required>
            <option value="">Enter Course</option>
	    <option value="BTech">BTech</option>
			<option value="Mtech">Mtech</option>
			<option value="PhD">phD</option>
			<option value="BBA">BBA</option>
			<option value="MBA">MBA</option>
			<option value="BSc">BSc</option>
			<option value="MSc">MSc</option>
            </select><br><br><br>
              <select class="select-style gender" required  id="ab" name="Year" onchange="check()">
            <option value="">Enter Year</option>
			<option value="Ist Year">Ist Year</option>
			<option value="IInd year">IInd year</option>
			<option value="IIIrd year">IIIrd year</option>
			<option value="IVth year">IVth year</option>
            <option value="all">All</option>
            </select><br><br><br>
            <select class="select-style gender" disabled required id="ab2" name="Semester">
            <option value="">Enter Semester</option>
			<option value="Ist">Ist</option>
			<option value="IInd">IInd</option>
			<option value="IIIrd">IIIrd</option>
			<option value="IVth">IVth</option>
			<option value="Vth">Vth</option>
			<option value="VIth">VIth</option>
			<option value="VIIth">VIIth</option>
			<option value="VIIIth">VIIIth</option>
            <option value="other">other</option>
            </select><br><br><br>
             <select class="select-style gender" required name="area">
            <option value="">Enter Type of Question</option>
			<option value="Academics">Academics</option>
			<option value="Social">Social</option>
			<option value="Politics">Politics</option>
			<option value="Co-Curriculum Activities">Co-Curriculum Activities</option>
			<option value="Programming Languages">Programming Languages</option>
			<option value="News & Events">News & Events</option>
			<option value="Movies & Shows">Movies & Shows</option>
			<option value="Sports">Sports</option>
            <option value="Other">Other</option>
            </select><br><br><br>
            <p class="contact"><label for="q">Add Question</label></p>
            <textarea rows="3" cols="56" maxlength="500" id="q" name="q" title="Question Required" wrap="hard" required ></textarea><br><br><br>
            <div style="text-align: center;margin-top: 1% ;">
			<input class="buttom" name="student" id="submit" tabindex="5" value="Add Question" type="submit">
	    </div>
   </form>
</div>
</div>
<?php
} // closing if status is student
if($status=='faculty')
{
    if(isset($_POST['faculty']))
    {
        $branch=$_POST['Branch'];
        $year=$_POST['Year'];
        $area=$_POST['area'];
        $q=trim($_POST['q']);  //  trimming spaces
        $query="insert into ask(uorf,yr,fid,branch,area,asked_on,quest) values('2','$year','$id','$branch','$area',NOW(),'$q')"; // entering uid if user's status is student
        mysqli_query($dbc,$query) or die($query);
        $query="select qid from ask where quest='$q' and fid='$id'";
        $result=mysqli_query($dbc,$query) or die('Error in Querying');
        $row=mysqli_fetch_array($result);
        $qid=$row['qid'];
        $query="update ask set encr_qid=SHA('$qid') where qid='$qid'";
        mysqli_query($dbc,$query) or die('Error in connection');
        header('Location:timeline.php');
        header('Location:timeline.php');
    }
?>
        <div class="container">
      <div  class="form">
    		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" >

                 <div class="tag">Ask Your Query :)</div>  <br><br>
            <select class="select-style gender" name="Branch" required>
            <option value="">Enter Branch</option>
			<option value="Mechanical Engineering">Mechanical Engineering</option>
			<option value="Civil Engineering">Civil Engineering</option>
			<option value="Electrical Engineering">Electrical Engineering</option>
			<option value="Electrical & Electronics Engineering">Electrical & Electronics Engineering</option>
			<option value="Computer Science Engineering">Computer Science Engineering</option>
			<option value="Information Technology">Information Technology</option>
            <option value="other">Other</option>
            </select><br><br><br>

              <select class="select-style gender" required name="Year">
            <option value="">Enter Year</option>
			<option value="Ist Year">Ist Year</option>
			<option value="IInd year">IInd year</option>
			<option value="IIIrd year">IIIrd year</option>
			<option value="IVth year">IVth year</option>
            <option value="all">All</option>
            </select><br><br><br>

             <select class="select-style gender" required name="area">
            <option value="">Enter Type of Question</option>
			<option value="Academics">Academics</option>
			<option value="Social">Social</option>
			<option value="Politics">Politics</option>
			<option value="Co-Curriculum Activities">Co-Curriculum Activities</option>
			<option value="Programming Languages">Programming Languages</option>
			<option value="News & Events">News & Events</option>
			<option value="Movies & Shows">Movies & Shows</option>
			<option value="Sports">Sports</option>
            <option value="Other">Other</option>
            </select><br><br><br>
            <p class="contact"><label for="q">Add Question</label></p>
            <textarea rows="3" cols="56" maxlength="500" id="q" name="q" title="Question Required" wrap="hard" required ></textarea><br><br><br>

            <div style="text-align: center;">
			<input class="buttom" name="faculty" id="submit" tabindex="5" value="Add Question!" type="submit">
	    </div>
   </form>
</div>
</div>
<?php
    }
    ?>
</body>
</html>
