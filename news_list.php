<!DOCTYPE html>
<html>
<head>
    <title>News' List</title>
    <script src="js/jquery.js"></script>
    <script>
        //the script for making the ajax call
        function read_more(id)
        {
            //sending news ID to PHP script for retrieving full content of news
            $.post("fetch_news.php",{id:id},function (data){window.location("fetch_news.php");});
        }
    </script>
</head>

<body>
    <div class="news_item">
        <div class="heading">This is news heading</div>
        <div class="short_desc">
            This is where the short description of the news will come...<br>
            <span id="news1" onclick="read_more(1)">Read more...</span>
        </div>
    </div>
</body>
</html>