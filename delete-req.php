 <?php
require_once('connectvars.php'); 
 $id=$_GET['id'];
             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                    $query="delete from contact where no='".$id."'";
                    mysqli_query($dbc,$query);
                    mysqli_close($dbc);
                    echo '<script>location.href="adpanel.php";</script>';
                    ?>
