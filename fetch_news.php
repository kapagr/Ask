<?php
error_reporting(0);
$id=$_REQUEST['id'];
echo $id;
echo "php";

$mysqli=new mysqli('localhost','root','root','qus');
if($mysqli===false)
    die ("ERROR : Could not connect : ".mysqli_connect_error());
	
$sql="select * from news where nid='".$id."'";
	
if($result=$mysqli->query($sql))
{
    if($result->num_rows>0)
    {
	while($row=$result->fetch_array())
        {
            $id=$row['nid'];
            $nfame=$row['nfname'];
	}	
	$result->close();
    }
    else
	echo "News content not found!";
}
else
    echo "ERROR : could not execute $sql".$mysqli->error;
    
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>News</title>
</head>
<body>
    <span class="news_heading"><?php echo $id; ?></span>
    <p class="news_data"><?php echo $nfname;?> </p>
</body>
</html> 