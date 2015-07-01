
        <?php
        require_once('connectvars.php');
        $id=$_GET['id'];
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
               $query="select * from news where nid='$id'";
		    $result=mysqli_query($dbc,$query);
                    $row=mysqli_fetch_array($result);
		    $fname=$row['nfname'];
                    $query="delete from events where nid='".$id."'";
                    mysqli_query($dbc,$query);
                    mysqli_close($dbc);
             
            unlink($fname);
            header('location:adpanel.php');
            ?>
