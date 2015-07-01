<div class="cd-read-more" id="answer">
<?php
    foreach($aarray as $answer)
    {
        echo '<p id="'.$answer['aid'].'">'.$qid.$answer['ahead'].'</p>';
?>
        <script>
            $(function()
            {
              $('#<?php echo $answer['aid']?>').click(
                function(){$('#<?php echo $qid;?>').load('getans.php?aid=<?php echo $answer['aid']?>')})
            })
        </script>
<?php
    }
    ?>
</div>
