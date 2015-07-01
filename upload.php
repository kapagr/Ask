   <?php
    $sname=$_POST['sname'];
                    $dob=$_POST['dob'];
                    $age=$_POST['age'];
                    $gender=$_POST['gender'];
                    $country=$_POST['country'];
                    $state=$_POST['state'];
                    $city=$_POST['city'];
                    $phno=$_POST['phno'];
                    $address=$_POST['address'];
                    $about=$_POST['about'];
                    $name1=$_POST['userf'];
                    $name2=$_POST['user'];
                    $user=$name1.'-'.$name2;
                     $pass=$_POST['pass'];
                      $email=$_POST['email'];
                       $match=$_POST['matchpass'];
                        $univ=$_POST['univ'];
                         $course=$_POST['course'];
                          $branch=$_POST['branch'];
                           $year=$_POST['year'];
                            $sem=$_POST['sem'];
                            $area=$_POST['area[]'];
                                $hobbies=$_POST['hobbies'];
                                    $achieve=$_POST['achieve'];
                                    $sub=$_POST['sub'];
                                    $tech=$_POST['tech'];
                                    
                                 $dbc=mysqli_connect('localhost','root','root','qus')or die("unable to open the file");
		    $query="select MAX(Sno) from student";
		    $result=mysqli_query($dbc,$query);
		   $row=mysqli_fetch_array($result);
		    $a=$row[0];
		mysqli_close($dbc);
                $a++;
                ?>
                <div style="color : white ;">
                    
                <?php echo $a;?>
                </div>
                <?php 
                                $dbc=mysqli_connect('localhost','root','root','qus')or die("unable to open the file");
                $query="INSERT INTO student values('".$a."','".$sname."','".$dob."','".$age."','".$gender."','".$country."','".$state."','".$city."','".$phno."','".$address."','".$about."','".$$user."','".$pass."','".$email."','".$univ."','".$course."','".$branch."','".$year."','".$sem."','".$area."','".$hobbies."','".$achieve."','".$sub."','".$tech."')";
                         mysqli_query($dbc,$query);
		mysqli_close($dbc);
                        header('Location:Account.php');
                
                ?>