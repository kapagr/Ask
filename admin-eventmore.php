<html>
    <head>
	 <title>Events </title>
         <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
         <style>
        .header1
            {
                padding :  1% ;
                background-color :  black;
                border-bottom  :solid ;
                border-bottom-color : orange ;
            }
        .right
        {
               text-align : right ;
		color : white ;
		margin-right : 1%;
		margin-top :-1%;
        }
         </style>
    </head>
    <body>
           <?php
	     require_once('check.php');
	     require_once('connectvars.php');
	    ?>
            <?php session_start();?>
            <?php
	     $id=$_GET['id'];?>
        <div class="login-header">
            <div class="address"><a href="index.php"> Home </a> &nbsp > &nbsp <a href="admin.php">Admin Login </a> &nbsp > &nbsp <a href="adpanel.php">Panel</a> &nbsp>&nbsp&nbspEvent</div>
               <div class="right"><?php echo '(Hello !!&nbsp&nbsp'.$_SESSION["User_name"].')'?></div>
        </div>
        <?php
	 $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select * from events where nid='$id' ";
		    $result=mysqli_query($dbc,$query);
		    if(mysqli_num_rows($result)==1)
		    {
			while($row=mysqli_fetch_array($result))
			{
				$id=$row['nid'];
				$fname=$row['ename'];
			}
		    }
		     else
		     {
			echo 'No records available';
			}		
		mysqli_close($dbc);
		?>
		<div class="news-header">
		    <div class="news">
                    <input class="news-no" type="button" value="1.">
                    <?php $myfile=fopen("$fname","r") or die("unable to open the file");
                  $heading='';
                    $shdesc='';
                    $londesc='';
                    $line=fgetc($myfile);
                    while($line!='^')
                    {
                        $heading=$heading.$line;
                        $line=fgetc($myfile);
                    }
                    echo $heading;
                    ?>
                    <div style="color : black ; text-align : justify ;font-size : 1.1em ;">
                        <?php 
                    echo '<br><br>';
                    $line=fgetc($myfile);
                    while($line!='#')
                    {
                        $shdesc=$shdesc.$line;
                        $line=fgetc($myfile);
                    }
                    echo $shdesc  ;
                    echo '<br><br>';
                    while(!feof($myfile))
                    {
                        $line=fgets($myfile)."<br/>";
                        $londesc=$londesc.$line;
                    }
                    echo $londesc ;
                    fclose($myfile);
                    ?>
                    </div>
                     <form action="adpanel.php">
		    <div style="text-align : center ;"><input type="submit" id="search-op" value="Back"></div>
		    </form>
		     <hr class="divider1">
                <p style="color : black;text-align: center;margin-bottom: 2% ;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> 
                </p>
                </div>
                    </div>
                </div>
    </body>
</html>