<html>
<body>
    <?php
        require_once('pr.php');
  
?>
    <form action="abc1.php" method="post">
    <table>
            <tr>
                 <td> heading * </td>
                     <td><textarea rows="3" cols="50" name="a" wrap="hard"><?php echo $heading;?></textarea></td>
            </tr>
            <tr>
                <td>brief Description*</td>
                <td><textarea rows="3" cols="50" name="b" wrap="hard"><?php echo $shdesc;?></textarea></td>
            </tr>
            <tr>
                <td>Complete Description*</td>
                <td><textarea rows="3" cols="50" name="c" wrap="hard"><?php echo strip_tags($londesc);?></textarea></td>
            </tr>
            <tr>
                <td><input type="submit"></td>
            </tr>
    </table>
    </form>
</body>
</html>