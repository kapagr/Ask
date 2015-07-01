
<html>
    <head>
        <title>Home | QueryUs</title>
        <link href="camera.css" rel="stylesheet" type="text/css" media="all" />
	<!--<link href="ask.css" rel="stylesheet"/> -->
        <link href="Ask&Learn.css" rel="stylesheet" type="text/css" media="all" />
        <script type='text/javascript' src="jquery.min.js"></script>
        <script type='text/javascript' src="jquery.mobile.customized.min.js"></script>
        <script type='text/javascript' src="jquery.easing.1.3.js"></script>
        <script type='text/javascript' src="camera.min.js"></script>
        <script>
	    jQuery(function(){
                jQuery('#camera_wrap_4').camera({
                    height: 'auto',
                    loader: 'bar',
         	    pagination: false,
                    thumbnails: true,
		    hover: false,
                    opacityOnGrid: false,
		    imagePath: '../images/'
		    });
                });
	</script>
    </head>
    <body>
	<?php
	     require_once('check.php');
	    ?>
         <div class="fluid_container">
            <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">
                <div data-src="images/1.jpg"> </div>
                <div data-src="images/2.jpg"> </div>
                <div  data-src="images/4.jpg"> </div>
                <div  data-src="images/5.jpg"> </div>
                <div  data-src="images/6.jpg"> </div>
                <div  data-src="images/10.jpg"> </div>
                <div  data-src="images/11.jpg"> </div>
                <div  data-src="images/13.jpg"> </div>
                <div  data-src="images/14.jpg"> </div>
            </div>
        </div>
        <h2 class="main_text1">A place of light, of liberty, and learning</h2>
        <h3 class="main_text2">we provide leading interactive Environment </h3>
        <div class="main">
            <div class="grid_1 images_1">
                <h4>"Anyone who stops learning is old, whether at twenty or eighty.Anyone who keeps learning stays young."
                <div class="writer"> - Henry Ford </div> </h4>
                <p class="para">From time immemorial it has been observed that there is large communication gap between students and teachers in order to convey information. The project college blog  is not only limited to attracting and encouraging students to take work at College but it also aims to provide information about institute keeping in mind that the person visiting this website wants a basic knowledge of the college. Website is aimed toward students who are perusing their studies. This project is developed in PHP programming language. The main aim of this project is to develop a website that covers all the area of interactions among the students. The proposed website will also reduce the cumbersome paper work, manual labor as well as communication cost. This project is to share information of the college among the students. The various modules in the project provides platform where students can share their study materials, assignments, achievements and ideas. The senior students can even share their projects and experience. This project involves faculty members too who can guide the students in their work. Thus the project would result in a healthy interaction system where circulation of information would be easier, faster and beneficial.         The Project is useful for effective communication among students and lessens the gap between students and faculty members as well as the gap between seniors and juniors too. </p>
                <form action="about.php">
                        <input id="button-style1" type="Submit" value="View More"/>
                </form>
	    </div>
            <div class="grid_1 images_1 img_style">
                <img src="images1/7.jpg" alt="">
	    </div>
	    <div class="clear"></div>
        </div>
        <div class="footer">
		<div class="social-icons">
	   	    <ul>
			      <li class="icon_1"><a href="#" target="_blank"> </a></li>
			      <li class="icon_2"><a href="#" target="_blank"> </a></li>
			      <li class="icon_3"><a href="#" target="_blank"> </a></li>
			      <li class="icon_4"><a href="#" target="_blank"> </a></li>
			      <div class="clear"></div>
		    </ul>
	   	</div>
		<div class="copy">
			<p style="color : white ;text-align: center;margin-bottom: 4% ;font-family: 'Mistral';font-size: 1.3em;">&copy All Rights Reserved | Design by&nbsp; <a href="https://www.facebook.com/prashant.verma.71653" title="Prashant Verma"> Prashant Verma</a> & <a href="https://www.facebook.com/priya.soni.549668?ref=br_rs" title="Priya Soni"> Priya Soni </a>
                </p>
		</div>
	</div>
    </body>
</html>
