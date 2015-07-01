
<div id='ajax-content'>
    <div style="float : center; width : 30% ;">
     <?php require_once('connectvars.php'); ?>
          <div class="news-header">
                <div class="news">
                    <div class="req">
                        Student Records :)
                    </div>
                    <br/>
                    <form name='form' action="find-student.php" method="post">
                    <table align="center" cellpadding="10" class="table1"  cellspacing="8">
                        <tr>
                                <td>Course</td>
                                <td>
                                     <select name="Course" class="drop" required>
                                     <option value="">Enter Course</option>
                                     <option value="BTech">BTech</option>
                        		<option value="Mtech">Mtech</option>
                        		<option value="phD">phD</option>
                            		<option value="BBA">BBA</option>
                        		<option value="MBA">MBA</option>
                        		<option value="BSc">BSc</option>
                        		<option value="MSc">MSc</option>
                                     </select><br><br><br>
                                </td>
                        </tr>
                        <tr>
                               <td>Branch</td>
                                <td>
                                     <select class="drop" name="Branch" required>
            <option value="">Enter Branch</option>
			<option value="Mechanical Engineering">Mechanical Engineering</option>
			<option value="Civil Engineering">Civil Engineering</option>
			<option value="Electrical Engineering">Electrical Engineering</option>
			<option value="Electrical & Electronics Engineering">Electrical & Electronics Engineering</option>
			<option value="Computer Science Engineering">Computer Science Engineering</option>
			<option value="Information Technology">Information Technology</option>
                        <option value="none">None</option>
            </select><br><br><br>
                                </td>
                        </tr>
                         <tr>
                               <td>Year</td>
                                <td>
                                     <select class="drop"  id="ab" required name="Year" onchange="check1()">
            <option value="">Enter Year</option>
			<option value="Ist Year">Ist Year</option>
			<option value="IInd year">IInd year</option>
			<option value="IIIrd year">IIIrd year</option>
			<option value="IVth year">IVth year</option>
            <option value="all">All</option>
            </select><br><br><br>

                                </td>
                        </tr>
                          <tr>
                               <td>Semester</td>
                                <td>
                                   <select class="drop"  required  id="ab2" disabled name="sem">
            <option value="">Enter Semester</option>
			<option value="Ist">Ist</option>
			<option value="IInd">IInd</option>
			<option value="IIIrd">IIIrd</option>
			<option value="IVth">IVth</option>
			<option value="Vth">Vth</option>
			<option value="VIth">VIth</option>
			<option value="VIIth">VIIth</option>
			<option value="VIIIth">VIIIth</option>
                        <option value="other">Other</option>
            </select><br><br><br>
                                </td>
                        </tr>
                          <tr>
                            <td colspan="2">
                                <div style="text-align: center;margin-top: 1% ;">
			<input class="buttom" name="student" id="submit" tabindex="5" value="Find Students" type="submit">
	    </div>
                            </td>
                          </tr>
                    </table>
                    </form>
                </div>
          </div>

    </div>

</div>
