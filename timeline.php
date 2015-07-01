<?php
require_once('connectvars.php');
session_start();
if(!isset($_SESSION['lid']))
{
    $getreq="index.php";
    header('Location:'.$getreq);
}
$id=$_SESSION['lid']; // from student table or faculty table
$status=$_SESSION['status']; // student or faculty
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error in connecting database');
if($status=='student')
{
    $query="select * from student where sno='$id' ";
    $result=mysqli_query($dbc,$query) or die(mysqli_error());
    $row=mysqli_fetch_array($result);
    $name=$row['name'];
    $profile=$row['profile'];
    $userarea=$row['area'];
    $userdept=$row['branch'];
    $usersem=$row['sem'];
}
else
{
    $query="select * from faculty where fno='$id' ";
    $result=mysqli_query($dbc,$query) or die(mysqli_error());
    $row=mysqli_fetch_array($result);
    $name=$row['name'];
    $profile=$row['profile'];
    $userarea=$row['area'];
    $userdept=$row['Department'];
}
$_SESSION['user']=$name;
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" href="css/reset.css"/> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"/> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  <script src="jquery.js" type="text/javascript"></script>
  	  <link href="asktime.css" rel="stylesheet"/>
	<title>News Feed </title>
	<style>
		header
		{
			background: url('img4.JPG') no-repeat center center  fixed;
			background-size:  cover ;
		}
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
    $image='profile/'.$profile;
    require_once('same.php'); // header
?>
<center>
  <img alt="" src="<?php echo $image ;?>" class="pics1"/></center>
    <br/>
    <div class="abc">
        <?php echo $_SESSION['user'];?>
    </div>
<?php
    $area_arr=array();
    $area_arr=explode(',',$userarea);
    for($i=0;$i<count($area_arr);$i++)
    {
      $area_arr[$i]='\''.$area_arr[$i].'\'';
    }
    $uarea=implode(',',$area_arr);
    $query="select asked_on as atime,quest,qid,uid,fid,encr_qid from ask";
    if($status=='student')
    {
        $query.=" where ask.area in ($uarea) or qid in (select qid from ask where ask.sem='$usersem' and ask.yr <> 'all') or qid in (select qid from ask where ask.yr='all') order by asked_on desc";
    }
    else
    {
        $query.=" where ask.area in ($uarea) or branch = '$userdept' order by asked_on desc";
    }

    $result=mysqli_query($dbc,$query) or die($query);
    if(mysqli_num_rows($result)>0)
    {
        $left=true;
?>

    <section id="cd-timeline" class="cd-container">
 <?php
     while($row=mysqli_fetch_array($result))
    {
        $qid=$row['qid'];
        if(empty($row['uid']))
        {
          $faculty_id=$row['fid'];
          $fetch_fac="select * from faculty where fno='$faculty_id'";
          $result_fac=mysqli_query($dbc,$fetch_fac) or die('Error in query');
          $row_fac=mysqli_fetch_array($result_fac);
          $key=0;
          $name=$row_fac['name'];
          $profile=$row_fac['profile'];
        }
        else if(empty($row['fid']))
        {
          $key=1;
          $student_id=$row['uid'];
          $fetch_stu="select * from student where sno='$student_id'";
          $result_stu=mysqli_query($dbc,$fetch_stu) or die('Error in query');
          $row_stu=mysqli_fetch_array($result_stu);
          $name=$row_stu['name'];
          $profile=$row_stu['profile'];
        }
        $query1="select * from ans where qid='$qid'";
        $result1=mysqli_query($dbc,$query1) or die($query1);
        if(mysqli_num_rows($result1)>0)
        {
            $ans=true;
            $aarray=array();
            while($row1=mysqli_fetch_array($result1))
            {
                array_push($aarray,$row1);
            }
        }
        else
            $ans=false;
        if($left)
        {
?>
            <div class="cd-timeline-block">
			 <div class="cd-timeline-img cd-picture">
				<img src="profile/<?php echo $profile; ?>" alt="Picture">
			 </div> <!-- cd-timeline-img -->
			 <div class="cd-timeline-content">
             	<h2><?php echo $row['quest']; ?></h2>
				<p>
                <?php
              $lnk= 'Asked By:';
              $lnk.= '<a href="profile.php?';
              if($key==0)
              {
                $lnk.='fid='.$faculty_id;
              }
              else if($key==1)
              {
                $lnk.='sid='.$student_id;
              }
              $lnk.='">'.$name.'</a>';
              echo $lnk;
              ?>
              </p>

                <div id="<?php echo $qid;?>">
                <?php
                if($ans)
                {


                    echo '<div class="cd-read-more" id="answer">';
                    foreach($aarray as $answer)
                    {
                        if(empty($answer['uid']))
                        {
                            $fac_id=$answer['fid'];
                            $fac_query="select * from faculty where fno='$fac_id'";
                            $fac_res=mysqli_query($dbc,$fac_query) or die('Error fetching data1');
                            if(mysqli_num_rows($fac_res)==1)
                            {
                                $fac_row=mysqli_fetch_array($fac_res);
                            }
                            else
                            {
                                header('Location:profile.php');
                            }
                        }
                        else if(empty($answer['fid']))
                        {
                            $fac_id=$answer['uid'];
                            $fac_query="select * from student where sno='$fac_id'";
                            $fac_res=mysqli_query($dbc,$fac_query) or die('Error fetching data2');
                            if(mysqli_num_rows($fac_res)==1)
                            {
                                $fac_row=mysqli_fetch_array($fac_res);
                            }
                            else
                            {
                                header('Location:profile.php');
                            }
                        }
                        echo '<p title = "Click to View More" class = "viewans" id="'.$answer['aid'].'"><img src="profile/'.$fac_row['profile'].'" height="40" width="40"><span class="fname">'.$fac_row['name'].'</span><br/><br/>'.$answer['ahead'].'<div>'.$answer['ans_on'].'</div></p><hr/>';
                ?>
                <script>
            $(function()
            {
              $('#<?php echo $answer['aid']?>').click(
                function(){$('#<?php echo $qid;?>').load('getans.php?aid=<?php echo $answer['aid']?>')})
            })
        </script>

                <?php

                    }

                    echo '</div>';
                }
               else
               {
                echo 'No Answers Available yet';
               }
                ?>


                </div>
                <div>
                        <form action="ans.php" method="post">
                <textarea name="answer"  placeholder="Start Writing here.." cols="65" required="Please Answer"></textarea>
                </div>
				<input type="submit" class="cd-read-more" name="subans" value="Answer"/>
                <input type="hidden" name="encrqid" value="<?php echo $row['encr_qid'];?>"/>
                <input type="hidden" name="frompage" value="1"/>
                </form>
                <script src="js/ansajax.js"></script>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
				<span class="cd-date" id="kapil"><?php echo $row['atime'];?></span>
			 </div> <!-- cd-timeline-content -->
            </div> <!-- cd-timeline-block -->
<?php
            $left=false;
        }
        else
        {
?>
            <div class="cd-timeline-block">
	  	        <div class="cd-timeline-img cd-movie">
				   <img src="profile/<?php echo $profile; ?>" alt="Picture">
                </div> <!-- cd-timeline-img -->
                <div class="cd-timeline-content">
				   	<h2><?php echo $row['quest']; ?></h2>
				    <p><?php echo 'Asked By: '.$name; ?></p>

               <div id="<?php echo $qid;?>">
                <?php
                if($ans)
                {


                    echo '<div class="cd-read-more" id="answer">';
                    foreach($aarray as $answer)
                    {
                        if(empty($answer['uid']))
                        {
                            $fac_id=$answer['fid'];
                            $fac_query="select * from faculty where fno='$fac_id'";
                            $fac_res=mysqli_query($dbc,$fac_query) or die('Error fetching data1');
                            if(mysqli_num_rows($fac_res)==1)
                            {
                                $fac_row=mysqli_fetch_array($fac_res);
                            }
                            else
                            {
                                header('Location:profile.php');
                            }
                        }
                        else if(empty($answer['fid']))
                        {
                            $fac_id=$answer['uid'];
                            $fac_query="select * from student where sno='$fac_id'";
                            $fac_res=mysqli_query($dbc,$fac_query) or die('Error fetching data2');
                            if(mysqli_num_rows($fac_res)==1)
                            {
                                $fac_row=mysqli_fetch_array($fac_res);
                            }
                            else
                            {
                                header('Location:profile.php');
                            }
                        }
                        echo '<p title = "Click to View More" class = "viewans" id="'.$answer['aid'].'"><img src="profile/'.$fac_row['profile'].'" height="40" width="40"><span class="fname">'.$fac_row['name'].'</span><br/><br/>'.$answer['ahead'].'<div>'.$answer['ans_on'].'</div></p><hr/>';
                ?>
                <script>
            $(function()
            {
              $('#<?php echo $answer['aid']?>').click(
                function(){$('#<?php echo $qid;?>').load('getans.php?aid=<?php echo $answer['aid']?>')})
            })
        </script>

                <?php

                    }

                    echo '</div>';
                }
               else
               {
                echo 'No Answers Available yet';
               }
                ?>


                </div>
                    <div>
                        <form action="ans.php" method="post">
                <textarea name="answer"  placeholder="Start Writing here.." cols="65" required="Please Answer"></textarea>
                </div>
				<input type="submit" class="cd-read-more" name="subans" value="Answer"/>
                <input type="hidden" name="encrqid" value="<?php echo $row['encr_qid'];?>"/>
                <input type="hidden" name="frompage" value="1"/>
                </form>
				    <span class="cd-date" id="kapil"><?php echo $row['atime'];?></span>
                </div> <!-- cd-timeline-content -->
		  </div> <!-- cd-timeline-block -->
<?php
            $left=true;
        }
    }
?>
	</section> <!-- cd-timeline -->
</center>
<?php
}
else
{
  echo '';
}
?>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script src='jquery.min.js'></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>
