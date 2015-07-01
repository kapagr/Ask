<?php
require_once('connectvars.php');
$id=$_GET['aid'];
$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error in Connection');
$query="select qid from ans where aid='$id'";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result);
$qid=$row['qid'];

$fpath='ans/'.$id.'.txt';
$postp=fopen($fpath,"r") or die("Error in opening file");
echo '<div class="viewans">';
while(!feof($postp))
	echo fgets($postp);
echo '</div>';
echo '<br/><p id="lol">CLick to View All Answers</p>';
fclose($postp);
?>
<script>
				$(function()
				{
					$('#lol').click(
						function(){$('#<?php echo $qid;?>').load('allans.php?qid=<?php echo $qid; ?>')})
				})
		</script>
