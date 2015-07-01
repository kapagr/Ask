<div id='ajax-content'>
     <div style="float : center; width : 30% ;">
     <?php require_once('connectvars.php');?>
          <div class="news-header">
                <div class="news">
                    <form action="add-event.php">
           <div style="text-align: right;margin-top : -1% ;margin-right : 1% ;">
               <input type="submit" id="search-op" value="Add event"></div>
          </form>
                      <?php
          $count=1;
             $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
            $query='select * from eventpart order by post desc';
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
                    $filename=$row['eventname'];
                    $id=$row['eno'];
                    $dt=$row['post'];
                    $brief=$row['Descrip']
                    
               ?>
                    <input class="news-no" type="button" value="<?php echo "$count."; ?>">
                      <?php
                    $count++;
                  echo $filename;?>
                  <br>
                  
                     <div style="text-align: right ; margin-top:  0% ;color : brown;">
                     Post Date & Time :-<?php echo '<font color="black">'.$dt.'</font>' ;?>
                     </div>
                     <br>
                     <div style="color : purple ;">
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
                     </div>
        
                       <table align="right" cellpadding="8" style="margin-top : 2% ;background-color : white ;" cellspacing=="4" width="135" height="10">
		    <tr>
			 <td class="readmore"><a href="update-event.php?id=<?php echo $row['eno'];?>">Update</a></td>
		    </tr>
		     </table>
                      <table align="right" cellpadding="8" style="margin-top : 2% ;" cellspacing=="4" bgcolor="white" width="135" height="10">
		    <tr>
                         <td class="edit"><a href="delete-event.php?id=<?php echo $row['eno'];?>">Delete</a></td>
		    </tr>
                      </table>
                       <table align="right" cellpadding="8" style="margin-top : 2% ;" cellspacing=="4" bgcolor="white" width="135" height="10">
		    <tr>
                         <td class="edit"><a href="list-event.php?id=<?php echo $row['eno'];?>">Participation List</a></td>
		    </tr>
                      </table>
                       </table>
                       <table align="right" cellpadding="8" style="margin-top : 2% ;" cellspacing=="4" bgcolor="white" width="135" height="10">
		    <tr>
                         <td class="edit"><a href="delpart-event.php?id=<?php echo $row['eno'];?>">Delete Records</a></td>
		    </tr>
                      </table>
		    <hr>
                 <?php
                    
          }
          mysqli_close($dbc);
                    ?>
                </div>
          </div></div></div>