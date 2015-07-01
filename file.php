<html>
    <head>
        <style>
         body
        {
            background-color:darkred;
            color:white;
            font-family:’Brush Script MT’, script;
            font-size:20pt ;
        }
        </style>
    <body>
        <?php $myfile=fopen("abc.txt","r") or die("unable to open the file");
        $line=fgets($myfile);
        echo "<center><h1>$line</h1></center>";
        echo "<br><br>";
	while(!feof($myfile))
        { echo fgets($myfile)."<br>";
        }
        fclose($myfile);
    ?>
    </body>
</html>