        <?php
	require_once('connectvars.php');
	$id=$_GET['id'];
             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
               $query="select * from clubpart where no='$id'";
		    $result=mysqli_query($dbc,$query);
                    $row=mysqli_fetch_array($result);
		    $cname=$row['clubname'];
                    $fname=$row['Descrip'];
		    $img=$row['image'];
                    $query="delete from clubpart where no='".$id."'";
                    mysqli_query($dbc,$query);
                            $query="drop table `$cname` ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                             mysqli_close($dbc);
            unlink($fname);
	    unlink('club/'.$img);
            header('location:adpanel.php');
            ?>
