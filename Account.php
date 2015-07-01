<html>
    <head>
	 <title>Create Account | QueryUs </title>
        <style>
        body
        {
            background-image : url('acc1.png');
            background-size : cover ;
        }
        .title
        {
            font-family : 'Mistral' ;
            font-size : 3em;
            color  : #480000 ;
            text-align : center ;
            margin-top : -2% ;
        }
        .sub
        {
            font-family : 'Cooper Black';
             font-size : 2.3em;
            color  : Maroon ;
            text-align : center ;
            margin-top : -1% ;
        }
        .b
        {
            background-color : #F3E5AB ;
            width  : 50% ;
            height : 7% ;
            text-align : center ;
            font-family : 'Mistral';
            font-size :0.5em;
            border : 1px solid #F3E5AB ;
        }
        .b:hover
        {
            background-color : #FFF380;
        }
        .r
        {
            width : 600% ;
            
        }
        </style>
    </head>
    <body>
         <?php
                         if(isset($_POST['go']))
                        {
                            $s=$_POST['select'];
                            if($s=='student')
                            {
                                    header('Location:student1.php');
                            }
                            if($s=='faculty')
                            {
                                header('Location:faculty1.php');
                            }
                        }   
      ?>
          
        <div class="sub"><br>QueryUs.in</div>
        <div class="title"><br>Ask Your Query : Learning Is Social      
        <div style="color : #7E3517 ; font-size : 0.9em;font-family : 'Cooper black';margin-top : 1% ; ">Register as a volunteer and Ask Your Query :)</div>
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       <div style="text-align : center ;font-size : 1em; padding : 2% ;background-color : brown ; font-family : 'Mistral'; margin-left :35% ;margin-right : 35% ; margin-top : 3% ;">
       <input type='button' class="b" value="Choose any One"/>
       <table cellpadding="10" cellspacing="10" style="font-size : 0.8em; color : white ;">

        <tr>
       <td colspan="2"><input type="radio" class="r" name="select" id="select" value="student" tabindex="1" required/></td>
        <td><label for="select"> Student</label></td>
        </tr>
       <tr>
        <td colspan="2"><input type="radio" class="r" name="select" id="select1" value="faculty" tabindex="1" required/></td>
        <td><label for="select1"> Faculty</label></td>
       </tr>
       </table>
       
       <input type='reset' class="b" value="Cancel"><input type="Submit" class="b" value="Go" name="go">
     
       </div>
       </form>
        </div>
    
    </body>
</html>