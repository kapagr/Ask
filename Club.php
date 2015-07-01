<html>
    <head>
	 <title>Clubs & Events</title>
        <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
	
	<style>
	
	.div1
	{
	    display: inline;
	    width: 50%;
	    float: left;
	    margin-top: 2%;
	}
	.div2
	{
	    display: inline;
	    width: 50%;
	    float: right;
	    margin-top: 2%;
	}
        .maindiv
        {
            padding: 0%;
	    background-image: url(back.jpg);
        }
        .pics1
        {
            width:33%;
            height:33%;
	    border-radius: 50%;
	    border: 2px solid black;
        }
        h4
        {
            margin-left: 30%;
            color: #2a78f6 ;
            font-size: 1.5em;
            font-family : "Arial","Times" ;
	    margin-top: -2%;
        } 
        p
        {
            font-size: 1em;
	    margin-left: 3%;
	    margin-right: 5%;
	    text-align: justify;
            color: white;
            line-height: 1.5em;
            font-family: Comic Sans MS;
        }
       
	.button
	{
	    width: 120px;
	    height: 42px;
	    background-color :brown ;
	    color : white;
	    font-family : "Arial","Times" ;
	    font-size: 1em;
	    margin-left: 3%;
	    border: solid 1px brown;
	    
	
	}
	.button:hover
	{
	    background-color:#D2691E;
	}
	.pumpkin
	{
	  font-family : "mistral" ;
	  font-size : 1.8em ;
	  color :  white ;
	  width : 50% ;
	}
	.t1
	{
	  width : 100% ;
	  height: 10%;
	  font-size: 1.5em;
	  text-align: center;
	  margin-top: 0%;
	  color:#000080;
	}
	hr
	{
	    background-color: green;
	    margin-top:1%;
	    width: 99%;
	    margin-left: 1%;
	}
	 .readmore
        {
            text-align : center ;
            font-size : 1em ;
            background-color : brown ;
            color : green ;
	    border : solid 1px brown ;
        }
         .readmore:hover
         {
            background-color : #D2691E ;
         }
        </style>
    </head>
    <body>
        <?php
	     require_once('check.php');
	     require_once('connectvars.php');
	    ?>
       	    <table class="t1" >
                         <tr>
                              <td bgcolor="brown" class="pumpkin">Club Activities</td>
                              <td bgcolor="brown" class="pumpkin">Events</td>
			 </tr>
	    </table>
	
	<div class="maindiv">
	    <div class="div1">
		<?php
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
            $query='select * from clubpart order by post desc';
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
		$file=$row['Descrip'];
		$image='club/'.$row['image'];
		?>
		<img alt="" src="<?php echo $image;?>" class="pics1">
			<h4><?php echo $row['clubname'];?></h4>
			<p>
			    <?php $heading=NULL;
                      $myfile=fopen("$file","r") or die("unable to open the file");
                  $line=fgetc($myfile);
                    while($line!='^')
                    {
                        $heading=$heading.$line;
                         $line=fgetc($myfile);
                     }
                     echo $heading;
                    fclose($myfile);?>  
			</p>
			 <table align="right" cellpadding="8" style="margin-top : -2% ;background-color : white ;" cellspacing=="4" width="135" height="10">
		    <tr>
			 <td class="readmore"><a href="clubreg.php?id=<?php echo $row['no'];?>">Register</a></td>
		    </tr>
		     </table>
		 <div style="margin-top : 8% ;">
		    <hr><br>
		    </div>
		    <?php    
		}
		mysqli_close($dbc);
                    ?>
	    </div>
	    <div class="div2">
		<?php
	     $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");            
                $query='select * from eventpart order by post desc';
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
		$file=$row['Descrip'];
		$image='event/'.$row['image'];
		?>
		<img alt="" src="<?php echo $image;?>" class="pics1">
			<h4><?php echo $row['eventname'];?></h4>
			<p>
			       <?php $heading=NULL;
                      $myfile=fopen("$file","r") or die("unable to open the file");
                  $line=fgetc($myfile);
                    while($line!='^')
                    {
                        $heading=$heading.$line;
                         $line=fgetc($myfile);
                     }
                     echo $heading;
                    fclose($myfile);?>  
			</p>
			<table align="right" cellpadding="8" style="margin-top : -2% ;background-color : white ;" cellspacing=="4" width="135" height="10">
		    <tr>
			 <td class="readmore"><a href="eventreg.php?id=<?php echo $row['eno'];?>">Register</a></td>
		    </tr>
		     </table>
			<div style="margin-top : 8% ;">
		    <hr><br></div>
		     <?php    
		}
		mysqli_close($dbc);
                    ?>
	    </div>
	</div>
    </body>
</html>