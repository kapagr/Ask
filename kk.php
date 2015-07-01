 <?php session_start();
    $id=$_GET['id'];
    $_SESSION['lid']=$id;
    $_SESSION['status']='student';
    $getreq="timeline.php";
    header('Location:'.$getreq);
     ?>