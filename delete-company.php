
        <?php
	require_once('connectvars.php');
	$id=$_GET['id'];
             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
               $query="select * from upcompany where Cno='$id'";
		    $result=mysqli_query($dbc,$query);
                    $row=mysqli_fetch_array($result);
		    $fname=$row['Brief'];
		    $over=$row['Overview'];
		    $crit=$row['Criteria'];
                    $query="delete from upcompany where Cno='".$id."'";
                    mysqli_query($dbc,$query);
                    mysqli_close($dbc);
             
            unlink($fname);
	    unlink('Overview/'.$over);
	    unlink('Criteria/'.$crit);
            header('location:adpanel.php');
            ?>
