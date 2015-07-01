<html>
    <head>
	 <title>News</title>
         <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
	<?php
	     require_once('check.php');
	     require_once('connectvars.php');
	    ?>
	    <?php
	     $id=$_GET['id'];?>
	
		   <?php $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
		    $query="select * from news where nid='$id' ";
		    $result=mysqli_query($dbc,$query);
		    if(mysqli_num_rows($result)==1)
		    {
			while($row=mysqli_fetch_array($result))
			{
				$id=$row['nid'];
				$fname=$row['nfname'];
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
		    </div>
		    <form action="News&Events.php">
		    <div style="text-align : center ;"><input type="submit" id="search-op" value="Back"></div>
		    </form>
		     <hr class="divider1">
               <p style="color : black;text-align:  center;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> </p>
		</div>
    </body>
</html>