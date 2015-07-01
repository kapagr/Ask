<?php

  session_start();
  if(!isset($_SESSION['user']))
  {
    $getreq="timeline.php";
    header('Location:'.$getreq);
  }
  if(isset($_GET['sid']))
  {
    $id=$_GET['sid'];
    $status='student';
  }
  else if(isset($_GET['fid']))
  {
    $id=$_GET['fid'];
    $status='faculty';
  }
  else if(isset($_SESSION['lid']))
  {
    $id=$_SESSION['lid'];
    $status=$_SESSION['status'];
  }
  require_once('connectvars.php');
  $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error in Correction');
  if($status=='student')
  {
      $query="select * from student  where sno='$id' ";
      $result=mysqli_query($dbc,$query) or die(mysqli_error());
      $row=mysqli_fetch_array($result);
      $profile=$row['profile'];
      $cover=$row['cover'];
      $user=$row['name'];
  }
  else
  {
      $query="select * from faculty where fno='$id' ";
      $result=mysqli_query($dbc,$query) or die(mysqli_error());
      $row=mysqli_fetch_array($result);
      $profile=$row['profile'];
      $cover=$row['cover'];
      $user=$row['name'];
  }
  $image='profile/'.$profile;
  $image1='cover/'.$cover;

?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->

    <script src="jquery.js" type="text/javascript"></script>
  	  <link href="asktime.css" rel="stylesheet"/>
	<title> <?php echo $user;?></title>
	<style>
		header
		{
			background: url('<?php echo $image1 ;?>') no-repeat center center  fixed;
			background-size:  cover ;
		}
	.pics1
        {
            width:270px;
	    height : 180px;
	    border-radius: 50%;
	    border: 2px solid black;
	    margin-top: -7%;
        }
	.abc
	{	margin-left: 22%;
		margin-top: -5%;
		font-size: 1.5em;
		font-family: 'Droid Serif';
		color : white ;
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
	<?php require_once('same.php');
	?>

	<header>
	</header>
	<img alt="" src="<?php echo $image ;?>" class="pics1"/>
    <div class="abc">
      <?php echo $user; ?>
        <div style="text-align: right;margin-top: -2.5% ;margin-right:  1% ;">
          <ul>
            <a href="post.php"><li  class="lnk"> Post Your Question </li></a></ul>
        </div>
    </div>
	<?php
$query="select ask.quest, name, profile, ask.asked_on as atime, ";
    if($status=='student')
    {
        $query.="ask.uid as id,ask.encr_qid as encr_qid,ask.qid as qid, student.name as name from ask inner join student on student.sno=ask.uid where ask.uid='$id' order by atime desc";
    }
    else
    {
        $query.="ask.fid as id,ask.encr_qid as encr_qid,ask.qid as qid, faculty.name as name from ask inner join faculty on faculty.fno=ask.fid where ask.fid='$id' order by atime desc";
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
				<img src="profile/<?php echo $row['profile']; ?>" alt="Picture">
			 </div> <!-- cd-timeline-img -->
			 <div class="cd-timeline-content">
             	<h2><?php echo $row['quest']; ?></h2>
				<p><?php echo 'Asked By: '.$row['name']; ?></p>

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
                <input type="hidden" name="frompage" value="0"/>
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
				   <img src="profile/<?php echo $row['profile']; ?>" alt="Picture">
                </div> <!-- cd-timeline-img -->
                <div class="cd-timeline-content">
				   	<h2><?php echo $row['quest']; ?></h2>
				    <p><?php echo 'Asked By: '.$row['name']; ?></p>

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
                <input type="hidden" name="frompage" value="0"/>
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
