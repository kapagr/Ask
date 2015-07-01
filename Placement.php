<html>
    <head>
	 <title>Placement</title>
         <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
	 <style>
	    .pics
	    {
		width:25%;
		height:32%;
		border: 4px solid black;
	    }
	    .div1
	    {
		padding: 1%;
		width:72%;
		margin-left:auto;
		margin-right:auto;
		margin-top:1%;
		background-color: ivory;
		border: 2px solid black;
	    }
	    .divup
	    {
		
		padding: 1%;
	    }
	    
	    p
	    {
            font-size: 1em;
            color: green;
            text-align : justify ;
            font-family: Comic Sans MS;
	    
	    }
	    .mdiv
	    {
		margin-top: 1%;
	    }
	    .criteria:hover
	    {
		background-color : #D2691E  ;
	    }
	    .criteria
	    {
		background-color : brown;
		color : white;
		font-family : "Mistral";
		border:1px solid black;
		font-size: 1.2em;
		margin-left: 15%;
		width: 25%;
		height: 6%;
	    }
	    .voverview
	    {
		background-color : brown;
		color : white;
		font-family : "Mistral";
		border:1px solid black;
		font-size: 1.2em;
		margin-left: 4%;
		width: 28%;
		height: 5%;
	    }
            hr
	    {
		width: 102%;
		margin-left: -1%;
		height: .5%;
		background-color: black;
		
	    }
	    .ab
	    {
		font-size: 1.1em;
		font-family:"sans-serif";
		margin-left: 3%;
		float:left;
		color: blue;
	    }
	    h1
	    {
		font-family: "Mistral";
		color: brown;
		text-align: center;
		font-size: 3em;
	    }
	   .bc
	   {
		font-size: 1em;
		font-family:"sans-serif";
		color: blue;
		float: right;
		margin-right : 1% ;
	   }
	 </style>
    </head>
    <body>
         <?php
	     require_once('check.php');
	     require_once('connectvars.php');
	    ?>
	<div class="div1">
	    <h1>Upcoming Companies</h1><br>
	    <?php
          $count=1;
             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
	    $str=date("Y-m-d");
            $query="select * from upcompany where Visting_date>='$str' order by Visting_date" ;
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
                    $filename=$row['Company_Name'];
                    $id=$row['Cno'];
                    $dt=$row['Visting_date'];
                    $post=$row['Post'];
                    $n=$id.".";
                    $brief=$row['Brief'];
		    $over=$row['Overview'];
		    $crit=$row['Criteria'];
		     $upload='Overview/'.$over;
			 $upload1='Criteria/'.$crit;
               ?>
	    <div class="divup">
		<input class="news-no" type="button" value="<?php echo "$count.";  ?>">
		<?php
                    $count++;
                ?>
		  <b><font style="font-size:1.8em; margin-left: 3%; font-family: Mistral;"><?php echo $filename ;?></font></b><br><br>
		<div class="ab">Post: <?php echo $post ;?></div><div class="bc"> Arrival Date: <?php echo $dt ;?>  </div> 
		<br><p> <?php
                      $heading=NULL;
                      $myfile=fopen("$brief","r") or die("unable to open the file");
                  $line=fgetc($myfile);
                    while($line!='^')
                    {
                        $heading=$heading.$line;
                         $line=fgetc($myfile);
                     }
                     echo $heading;
                    fclose($myfile);
                     ?>
		     </p><br>
		     <input class="criteria" type="submit" value="Download Overview" onclick="window.open('<?php echo $upload ;?>')"></b>
		    <input class="criteria" type="submit" value="Download Criteria" onclick="window.open('<?php echo $upload1 ;?>')"></b>
	    </div><br><br>
	      <?php
                    
          }
          mysqli_close($dbc);
                    ?>
	    <hr>
		
	    <h1>Visited Companies</h1>
	     <?php
          $count=1;
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
	    $str=date("Y-m-d");
            $query="select * from upcompany where Visting_date<'$str' order by Visting_date" ;
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
                    $filename=$row['Company_Name'];
                    $id=$row['Cno'];
                    $dt=$row['Visting_date'];
                    $post=$row['Post'];
                    $n=$id.".";
                    $brief=$row['Brief'];
                     $over=$row['Overview'];
		    $crit=$row['Criteria'];
		     $upload='Overview/'.$over;
			 $upload1='Criteria/'.$crit;
               ?>
	     <div class="divup">
		<input class="news-no" type="button" value="<?php echo "$count.";  ?>">
		<?php
                    $count++;
                ?>
		<b><font style="font-size:1.8em; margin-left: 3%; font-family: Mistral;"><?php echo $filename ;?></font></b><br><br>
		<div class="ab">Post: <?php echo $post ;?></div><div class="bc"> Arrival Date: <?php echo $dt ;?>  </div>
		<br><p>
		    <?php
                      $heading=NULL;
                      $myfile=fopen("$brief","r") or die("unable to open the file");
                  $line=fgetc($myfile);
                    while($line!='^')
                    {
                        $heading=$heading.$line;
                         $line=fgetc($myfile);
                     }
                     echo $heading;
                    fclose($myfile);
                     ?>
		</p><br>
		<input class="voverview" type="submit" value="Download Overview" onclick="window.open('<?php echo $upload ;?>')"></b>
		<input class="voverview" type="submit" value="Download Criteria" onclick="window.open('<?php echo $upload1 ;?>')"></b>
		<input class="voverview" type="submit" value="List of Placed Students" onclick="window.open('list.php?id=<?php echo $id;?>')"></b>
	    </div><br><br>
	       <?php
                    
          }
          mysqli_close($dbc);
                    ?>
	</div>
	<div class="mdiv">
	<marquee direction="right" scrollamount="25">
	    <img alt="" src="Infosys.jpg" class="pics">
	    <img alt="" src="Wipro.png" class="pics">
	    <img alt="" src="TCS.jpg" class="pics">
	    <img alt="" src="accenture-logo.png" class="pics">
	    <img alt="" src="hcl.jpg" class="pics">
            <img alt="" src="jindal.jpg" class="pics">
	    <img alt="" src="lava.jpg" class="pics">
	    <img alt="" src="samsung.jpg" class="pics">
	    <img alt="" src="Bluestar.png" class="pics">
    	    <img alt="" src="shapoorji.jpg" class="pics">
	</marquee>
	</div>
    </body>
</html>