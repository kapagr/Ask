        <?php
	require_once('connectvars.php');
	$id=$_GET['id'];
             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
               $query="select * from eventpart where eno='$id'";
		    $result=mysqli_query($dbc,$query);
                    $row=mysqli_fetch_array($result);
		    $cname=$row['eventname'];
                    $fname=$row['Descrip'];
		    $img=$row['image'];
                    $query="delete from eventpart where eno='".$id."'";
                    mysqli_query($dbc,$query);
                            $query="drop table `$cname` ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                             mysqli_close($dbc);
            unlink($fname);
	    unlink('event/'.$img);
            header('location:adpanel.php');
        ?>
