  <?php session_start();
  if(!isset($_SESSION["User_name"]))
{	 $getreq="admin.php";
    header('Location:'.$getreq);
   }?>
<html>
     <head>
	 <title>Admin Panel</title>
        <title>Login | Ask QueryUs</title>
        <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
               <script>
                   function check1()
                     {
                         
                         var a=document.getElementById('ab').value;
                         if(a!='all')
                         {
                              
                              document.getElementById('ab2').disabled=false;
                         }
                         else
                         {
                              
                              document.getElementById('ab2').disabled=true;
                         }
                     }
                     function logout()
                    {
                         location.href="admin-logout.php";
                     }
                     function searchstd()
                     {
                         location.href="search-std.php";
                     }
                       function searchfac()
                     {
                         location.href="search-fac.php";
                     }
                     function change()
                     {
                         location.href="change.php";
                     }
               </script>
        
        <style>
         .header1
            {
                padding :  1% ;
                background-color :  black;
                border-bottom  :solid ;
                border-bottom-color : orange ;
            }
        .login-header
        {
          padding : 1.5% ;
        opacity : 10;
        }
        .address
        { 
          margin-left : 0.5% ;
          margin-top  : -0.5% ;
        }
        .table-left
        {
          color : black ;
          font-size : 1em ;
          background-color : brown ;
          text-align : center ;
          margin-left : 2.3% ;
        }
        .right
        {
               text-align : right ;
		color : white ;
		margin-right : 1%;
		margin-top :-1%;
        }
        .button
        {
    		width : 112% ;
		height : 270% ;
		background-color :  #fffabb ;
		color : black;
                margin-left: -6% ;
                margin-right : 6%;
                transition-duration:0.4s;
         }
	    .button:hover
	    {
		background-color : green ;
                color : white ;
	    }
          .button:active
          {
               background-color : blue ;
          }
          .news-header
         {
            padding :  1% ;
            background-color : white ;
             margin-left : 75% ;
            margin-right :  -234% ;
         }
          .news-header3
         {
            padding :  1% ;
            background-color : Maroon ;
             margin-left : 75% ;
            margin-right :  -234% ;
         }
         .news-no
         {
		font-size : 1em ;
		background-color : red;
		color : white;
		font-family : "Arial","Times" ;
		border:1px solid red;
         }
         .req
         {
               text-align:  center ;
               font-family:  'Mistral';
               font-size :  30px ;
               color : #2a78f6 ;
         }
         .news
         {
            margin-top : 1% ;
            font-family : "Times","Arial" ;
            color : green ;
            font-size : 1em; 
            text-align : left ;
            margin-bottom:  1% ;
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
           .edit
        {
            text-align : center ;
            font-size : 1em ;
            background-color : brown ;
            border-bottom: solid ;
            border-bottom-color : blue ;
            color : green ;
        }
         .edit:hover
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
            .caption
            {
               padding : 1%;
               background-color : #808080 ;
            }
            .company
            {
               color : Green;
               font-size:  1.1em;
               font-family:  'cooper black';
            }
            .company:hover
            {
               color : black;
               
            }
             .company
        {
            text-align : center ;
            font-size : 1em ;
            background-color : #808080 ;
            color : green ;
        }
         .company:focus
         {
            background-color : brown ;
         }
         .table
         {
          text-align : center ;
          width : 90% ;
          height : 10% ;
          background-color : brown;
          border: medium ;
          color : white ;
         }
         .table1
         {
          text-align : center ;
          width : 70% ;
          height : 10% ;
          background-color : brown;
          border: medium ;
          color : white ;
         }
         .drop
         {
          width: 50% ;
          height: 60% ;
          margin-top: 5% ;
         }
          .buttom
          { background: #4b8df9;
          display: inline-block;
          padding: 5px 10px 6px; color: #fbf7f7;
          text-decoration: none;
          font-weight: bold;
          line-height: 1;
          -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 1px 3px #999; -webkit-box-shadow: 0 1px 3px #999; box-shadow: 0 1px 3px #999; text-shadow: 0 -1px 1px #222; border: none; position: relative; cursor: pointer; font-size: 14px; font-family:Verdana, Geneva, sans-serif;}
        .buttom:hover
        {
          background-color: #2a78f6;
          }

        </style>
        <script src="jquery.js"></script>
        <script>
          $(function(){$('#upev').click(function(){$('#ajax-content').load('test.php')})})
          $(function(){$('#upnv').click(function(){$('#ajax-content').load('test1.php')})})
          $(function(){$('#uplace').click(function(){$('#ajax-content').load('update_placement.php')})})
          $(function(){$('#vplace').click(function(){$('#ajax-content').load('visited_company.php')})})
          $(function(){$('#club').click(function(){$('#ajax-content').load('admin_clubs.php')})})
          $(function(){$('#event').click(function(){$('#ajax-content').load('admin_events.php')})})
          $(function(){$('#contact').click(function(){$('#ajax-content').load('admin_contact.php')})})
          $(function(){$('#std-rec').click(function(){$('#ajax-content').load('std-rec.php')})})
          $(function(){$('#fac-rec').click(function(){$('#ajax-content').load('fac-rec.php')})})
        </script>
        </head>
    <body>
          <?php
	     require_once('check.php');
             require_once('connectvars.php');
	    ?>    
        <div class="login-header">
            <div class="address"><a href="index.php"> Home </a> &nbsp > &nbsp <a href="admin.php">Admin Login </a> &nbsp > &nbsp <a href="adpanel.php">Panel</a></div>
               <div class="right"><?php echo '(Hello !!&nbsp&nbsp'.$_SESSION["User_name"].')'?></div>
        </div>
        <div  style="float : left ;width : 20% ;">
          <table cellpadding="15" class="table-left" cellspacing="3" border="1">
               <tr>
                    <td><input type="button" class="button" value="Update News" id="upnv" /></td>
               </tr>
               <tr>
                    <td><input type="button" class="button" value="Update Events" id='upev'/></td>
               </tr>
               <tr>
                    <td><input type="button" class="button" value="Upcoming Companies" id="uplace"/></td>
               </tr>
               <tr>
                    <td><input type="button" class="button" value="Visited Companies" id="vplace"/></td>
               </tr>
               <tr>
                    <td><input type="button" class="button" value="Participate in Club Activities" id="club"/></td>
               </tr>
               <tr>
                    <td><input type="button" class="button" value="Participate in Event Activities" id="event"/></td>
               </tr>
                <tr>
                    <td><input type="button" class="button" value="Answer the Enquired Question" id="contact"/></td>
               </tr>
               <tr>
                    <td><input type="button" class="button" value="Find Students Records" id="std-rec"/></td>
               </tr>
               <tr>
                    <td><input type="button" class="button" value="Find Faculty Records" id="fac-rec"/></td>
               </tr>
               <tr>
                    <td><input type="button" class="button" value="Search Student by University Roll No" id="search-std" onclick="searchstd()" /></td>
               </tr>
               <tr>
                    <td><input type="button" class="button" value="Search Faculty by Faculty ID" id="search-fac" onclick="searchfac()" /></td>
               </tr>
                 <tr>
                    <td><input type="button" class="button" value="Change Password" onclick="change()" /></td>
               </tr>
                 <tr>
                    <td><input type="button" class="button" value="Log Out" onclick="logout()" /></td>
               </tr>
              
          </table>
        </div>
    <?php
	     require_once('test1.php');
	    ?>
    </body>
</html>
