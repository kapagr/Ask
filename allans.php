<?php
  require_once('connectvars.php');
  $qid=$_GET['qid'];
  $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error in Connection');
  $query="select * from ans where qid='$qid'";
  $result=mysqli_query($dbc,$query) or die($query);
  if(mysqli_num_rows($result)>0)
  {
      $ans=true;
      $aarray=array();
      while($row=mysqli_fetch_array($result))
      {
        array_push($aarray,$row);
      }
  }
  else
    $ans=false;
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
