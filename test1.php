 <div id="ajax-content">
         <div style="float : center; width : 30% ;">
	<?php require_once('connectvars.php'); ?>
          <div class="news-header">
                <div class="news">
                    <form action="add.php">
           <div style="text-align: right;margin-top : -1% ;margin-right : 1% ;">
               <input type="submit" id="search-op" value="Add News"></div>
          </form>
                    <?php
          $count=1;
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
                     <div style="text-align: right ;color : brown;">
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
			 <td class="readmore"><a href="admin-newsmore.php?id=<?php echo $row['nid'];?>">Read More</a></td>
		    </tr>
		     </table>
                      <table align="right" cellpadding="8" style="margin-top : 2% ;" cellspacing=="4" border="1" bgcolor="white" width="135" height="10">
		    <tr>
                         <td class="edit"><a href="edit.php?id=<?php echo $row['nid'];?>">Update</a></td>
		    </tr>
                      </table>
                      <table align="right" cellpadding="8" style="margin-top : 2% ;" cellspacing=="4" border="1" bgcolor="white" width="135" height="10">
                     <tr>
                         <td class="edit"><a href="delete.php?id=<?php echo $row['nid'];?>">Delete</a></td>
		    </tr>
		     </table>
                     <hr>
               
          
                    
                    <?php
                    
          }
          mysqli_close($dbc);
                    ?>
                </div>
     

          </div>
         </div>
       </div>