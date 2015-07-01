
<div id='ajax-content'>
    <div style="float : center; width : 30% ;">
     <?php require_once('connectvars.php'); ?>
          <div class="news-header">
                <div class="news">
                    <div class="req">
                        Faculty Records :)
                    </div>
                    <br/>
                    <form name='form' action="find-faculty.php" method="post">
                    <table align="center" cellpadding="10" class="table1"  cellspacing="8">
                        <tr>
                               <td>Branch</td>
                                <td>
                                     <select class="drop" name="dept" required>
            <option value="">Enter Department</option>
			<option value="Mechanical Engineering">Mechanical Engineering</option>
			<option value="Civil Engineering">Civil Engineering</option>
			<option value="Electrical Engineering">Electrical Engineering</option>
			<option value="Electrical & Electronics Engineering">Electrical & Electronics Engineering</option>
			<option value="Computer Science Engineering">Computer Science Engineering</option>
			<option value="Information Technology">Information Technology</option>
            <option value="other">Other</option>
            <option value="all">All</option>
            </select><br><br><br>
                                </td>
                        </tr>
                        
                          <tr>
                            <td colspan="2">
                                <div style="text-align: center;margin-top: 1% ;">
			<input class="buttom" name="student" id="submit" tabindex="5" value="Find Faculty" type="submit">
	    </div>
                            </td>
                          </tr>
                    </table>
                    </form>
                </div>
          </div>
          
    </div>
          
</div>
