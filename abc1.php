<?php
$a=$_POST['a'];
$b=$_POST['b'];
$c=$_POST['c'];
$myfile=fopen("pv1.txt","w") or die("unable to open the file");
fputs($myfile,$a);
fputs($myfile,'^'.$b);
fputs($myfile,'#'.$c);
fclose($myfile);
require_once('pr.php');
echo $heading.'<br/>'.$shdesc.'<br/>'.$londesc;
?>