<html>
     <head>
	 <title>Add News | QueryUs </title>
         <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
         <script>
            function erase()
            {
                document.getElementById('p').value='';
                document.getElementById('q').value='';
                document.getElementById('r').value='';
            }
         </script>
         <style>
        .right
        {
               text-align : right ;
		color : white ;
		margin-right : 1%;
		margin-top :-1%;
        }
        .news-table
        { 
            text-align : center ;
            background-color : #fffabb ;
            color : green ;
               font-family : "cooper black" ;
            font-size : 1.1em ;
        }
        .center
        {
            text-align : center ;
            margin-top : 1% ;
        }
        .update-form-heading
        {
            color  : brown;
            font-family : "cooper black" ;
            font-size : 1.5em ;
            
        }
    
         </style>
    </head>
    <body>
         <?php
	     require_once('check.php');
             require_once('connectvars.php');
	    ?>
            <?php session_start();?>
            
        <div class="login-header">
            <div class="address"><a href="index.php"> Home </a> &nbsp > &nbsp <a href="admin.php">Admin Login </a> &nbsp > &nbsp <a href="adpanel.php">Panel</a> &nbsp > &nbspAdd News </div>
               <div class="right"><?php echo '(Hello !!&nbsp&nbsp'.$_SESSION["User_name"].')'?></div>
        </div>
				 
 
            
                  <?php
                         if(isset($_POST['add']))
                        {
                            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select MAX(nid) from news";
		    $result=mysqli_query($dbc,$query);
		   $row=mysqli_fetch_array($result);
		    $a=$row[0];
		mysqli_close($dbc);
                $a++;
                $name='news'.$a.'.txt';
                $mysqli=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                if($mysqli==false) die('Error: could not connect to db');
                
                $sql="INSERT INTO news(nid,nfname) values('".$a."','".$name."')";
                
                if(!$mysqli->query($sql))
                    echo "could not execute query";
                $mysqli->close();
                            $ab=$_POST['a'];
                            $b=$_POST['b'];
                            $c=$_POST['c'];
                            $myfile=fopen("$name","w") or die("unable to open the file");
                            fputs($myfile,$ab);
                                fputs($myfile,'^'.$b);
                            fputs($myfile,'#'.$c);
                            fclose($myfile);
                             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
                            $query="update news set PostDate=NOW() where nid='$a' ";
                            mysqli_query($dbc,$query) or die('Error in querying');
                            mysqli_close($dbc);
                           echo '<script>alert("News is created Successfully");location.href="adpanel.php";</script>';
                        }
                        ?>
                 <div class="news-header">
                    <form  action=""<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <table cellpadding="20" cellspacing="10" align="center" class="news-table">
                             <tr>
                                <td colspan="2" class="update-form-heading">Add News </td>
                             </tr>
                             <tr>
                                 <td colspan="2" style="width : 50% ;">News Heading*</td>
                             </tr>
                             <tr>
                                 <td colspan="2" style="width : 50% ;"><textarea rows="3" id="p" cols="100" name="a" maxlength="200" wrap="hard" required></textarea></td>
                             </tr>
                             <tr>
                                 <td colspan="2"> Brief Description* </td>
                             </tr>
                             <tr>
                                 <td colspan="2"><textarea rows="5" cols="100" maxlength="600" id="q" name="b" wrap="hard" required></textarea></td>
                             </tr>
                              <tr>
                                 <td colspan="2">Complete Description* </td>
                              </tr>
                              <tr>
                                 <td colspan="2"><textarea rows="5" cols="103" maxlength="2000" id="r" name="c" wrap="hard" required></textarea></td>
                             </tr>
                        </table>
                        <div class="center">
                            <input type="button" id="search-op"  value="Cancel" onclick="erase()">&nbsp&nbsp&nbsp&nbsp
                            <input type="submit" id="search-op"  value="Add News" name="add">
                        </div>
                    </form>
                     <hr class="divider1">
                       <p style="color : black;text-align: center;margin-bottom: 2% ;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> 
                </p>
                </div>
    </body>
</html>