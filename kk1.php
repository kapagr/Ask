 <?php session_start();
    $id=$_GET['id'];
    $_SESSION['lid']=$id;
    $_SESSION['status']='faculty';
    $getreq="timeline.php";
    header('Location:'.$getreq);
     ?>