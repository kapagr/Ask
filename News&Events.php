<html>
    <head>
	 <title>College News</title>
         <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
	 <script type='text/javascript' src="jquery.js"></script>
         <style>
         .news-header
         {
            padding :  2% ;
            background-color : white ;
            margin-left : 15% ;
            margin-right :  15% ;
         }
         .news-no
         {
		font-size : 1em ;
		background-color : red;
		color : white;
		font-family : "Arial","Times" ;
		border:1px solid red;
         }
         .news
         {
            margin-top : 1% ;
            margin-left : 1% ;
            font-family : "Times","Arial" ;
            color : green ;
            font-size : 1em; 
            text-align : left ;
         }
         .descrip
         {
            margin-left : 2%;
            margin-top : 3% ;
            color : black ;
            text-align : justify ;
         }
          .readmore
        {
            text-align : center ;
            font-size : 1em ;
            background-color : brown ;
            border-bottom: solid ;
            border-bottom-color : blue ;
            color : green ;
        }
         .readmore:hover
         {
            background-color : red ;
         }
         hr
         {
                margin-top : 8% ;
		background-color : green ;
		width : 100%;
		height : 0.3%;
         }
	 .privacy1
	    {
		text-align : center ;
		color : black ;
		margin-top : 2% ;
	    }
	    .privacy1 a
	    {
		color : red ;
	    }
	    .button
	    {
		
	    }
	    
	 
         </style>
    </head>
    <body>
        <?php
	     require_once('check.php');
	            require_once('connectvars.php');
	    ?>
            <div class="news-header">
                <div class="news">
                    <?php
          $count=1;
            require_once('connectvars.php');
	 $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
            $query='select * from news order by PostDate desc';
            $result=mysqli_query($dbc,$query);
               while($row=mysqli_fetch_array($result))
               {
                    $filename=$row['nfname'];
                    $id=$row['nid'];
                    $dt=$row['PostDate'];
                    $n=$id.".";
               ?>
                    <input class="news-no" type="button" value="<?php echo "$count."; ?>">
                    
                    <?php
                    $count++;
                    $heading=NULL;
                    $shdesc=NULL;
                    $myfile=fopen("$filename","r") or die("unable to open the file");
                    $line=fgetc($myfile);
                    while($line!='^')
                    {
                        $heading=$heading.$line;
                         $line=fgetc($myfile);
                     }
                     echo $heading;
                     ?>
                     <div style="text-align: right ;">
                    <?php
                     echo '<br>Post Date & Time :-'. $dt;
                     ?>
                     </div>
                     
                     <div style="color : black ;">
                     
                         <?php
                         
                   echo '<br><br>';
                    $line=fgetc($myfile);
                    while($line!='#')
                    {
                             $shdesc=$shdesc.$line;
                             $line=fgetc($myfile);
                    }
                    echo $shdesc ;
                    fclose($myfile);
                    
                    ?>
                     </div>
		    <table align="right" cellpadding="8" style="margin-top : 2% ;background-color : white ;" cellspacing=="4" border="1" width="135" height="10">
		    <tr>
			 <td class="readmore"><a href="newsmore.php?id=<?php echo $row['nid'];?>">Read More</a></td>
		    </tr>
		     </table>
                     <hr>
               
          
                    
                    <?php
                    
          }
          mysqli_close($dbc);
                    ?>
                 </div>
		<p style="color : black;text-align:  center;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a> </p>
                </div>
            </div>
    </body>
</html>