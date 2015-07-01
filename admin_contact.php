<div id='ajax-content'>
     <div style="float : center; width : 30% ;">
        <?php require_once('connectvars.php'); ?>
          <div class="news-header">
                <div class="news">
                    <div class="req">
                        List of Enquired Questions
                    </div>
                    <br/>
                    <table align="center" cellpadding="15" class="table" border="1"  cellspacing="10">
            <tr>
                <td>S.No.</td>
                <td>Full Name</td>
                <td>Email</td>
                <td>Enquired Question</td>
                <td>Send mail</td>
                <td>Delete Request</td>
         
            </tr>
            <?php
                                  $count=0;
            $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)or die("unable to connect to the database");
            $query="select * from contact order by post desc";
            $result=mysqli_query($dbc,$query) or die(mysqli_error());
               while($row=mysqli_fetch_array($result))
               {
                    $count++;
                ?>
                <tr>
                  <?php  
                    $no=$row['no'];
                    $name=$row['name'];
                    $email=$row['email'];
                    $msg=$row['msg'];
                    ?>
                    <td><?php echo $count;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $email;?></td>
                    <td><textarea rows="3" cols="33" maxlength="600" wrap="hard" class="field" placeholder="Write Your Query" name="msg" required="enter your questyion"><?php echo $msg;?></textarea></td>
                    <td><input type="submit" value="Send Answer" onclick="window.open('send-mail.php?id=<?php echo $no;?>')"></td>
                    <td><input type="submit" value="Delete Request" onclick="window.open('delete-req.php?id=<?php echo $no;?>')"></td>
                </tr>
                <?php
               }
                  mysqli_close($dbc);

               ?>
          
            </table>    
                </div>
          </div>
     </div>
</div>

