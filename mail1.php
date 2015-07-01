<?php
                         $name=$_POST['b'];
                            $email=$_POST['email'];
                            $q=$_POST['q'];
                            $a=$_POST['a'];
                             $to=$email;
                            $subject="Queryus.in (Ask Your Query - Learning Is Social) ";
                            $from="FROM:Admin<prashant@queryus.in>\r\n";
                            $style='<br><br>Dear'.'&nbsp'.$name.','.'<br><br>'.'Question :- '.$q.'<br><br>'.'Answer :- '.$a.'<br><br><br>With thanks,<br>Queryus Team';
                            $body=$style ;
                            mail($to,$subject,$body,$from);
                             $dbc=mysqli_connect('localhost','root','root','qus')or die("unable to open the file");
               $query="select * from clubpart where no='$id'";
		    $result=mysqli_query($dbc,$query);
                    $row=mysqli_fetch_array($result);
		    $cname=$row['clubname'];
                    $fname=$row['Descrip'];
		    $img=$row['image'];
                    $query="delete from clubpart where no='".$id."'";
                    mysqli_query($dbc,$query);
                    mysqli_close($dbc);
                            
                            echo '<script>alert("Send");</script>';
                            
                        
                        ?>