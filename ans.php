<?php
session_start();
require_once('connectvars.php');
if(isset($_POST['subans']))
{
    $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error Connecting');
    $encrqid=$_POST['encrqid'];
    $query="select * from ask where encr_qid='$encrqid'";
    $result=mysqli_query($dbc,$query)  or die('Error Querying');
    echo $encrqid;
    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_array($result);
        $qid=$row['qid'];
    }
    else
    {
        echo '<h1>Error</h1>';
        header("refresh:1; url=profile.php");
    }
    $userid=$_SESSION['lid'];
    $ans=$_POST['answer'];
    $ans= str_replace("'", "&apos;", $ans);
    $ahead=substr($ans,0,100);
    $query="insert into ans(ahead,ans_on,qid,";
    if($_SESSION['status']=='faculty')
        $query.="fid) values('$ahead',NOW(),'$qid','$userid') ";
    else if($_SESSION['status']=='student')
          $query.="uid) values('$ahead',NOW(),'$qid','$userid')";
    mysqli_query($dbc,$query) or die('ERROR');
    $query="select aid from ans where qid='$qid' and ahead='$ahead' and ";
    if($_SESSION['status']=='faculty')
        $query.="fid='$userid'";
    else if($_SESSION['status']=='student')
          $query.="uid='$userid'";
    $res=mysqli_query($dbc,$query) or die('Error Querying');
    if(mysqli_num_rows($res)==1)
    {
        $rowf=mysqli_fetch_array($res);
        $aid=$rowf['aid'];
        $filename=$aid.'.txt';
        $fpath='ans/'.$filename;
        $postp=fopen($fpath,"w") or die("Error in opening file");
        fputs($postp,$ans);
        fclose($postp);
        $query="update ans set afile='$filename' where aid='$aid'";
        mysqli_query($dbc,$query) or die('Error Q45');
    }
    if($_POST['frompage']==0)
      header('Location: profile.php');
    else if($_POST['frompage']==1)
      header('Location: timeline.php');
}
else
{
    echo '<h1>UNAUTHORIZED ACCESS</h1>';
    header("refresh:2; url=profile.php");
}
?>
