<?php
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Chair</title>
    </head>

    <?php
        if(isset($_SESSION["check"])){
            if($_SESSION["check"] == "Reviewer"){
                echo "<h1>Reviewer您好，歡迎進入論文評論網頁</h1>";
            }else{
                header("Refresh:0;url=fail.php");
            }
        }else{
            header("Refresh:0;url=fail.php");
        }
        if (isset($_GET["logout"])) {
            header("Location:logout.php");
        }

        if(isset($_GET["comment"])){
            echo addslashes(nl2br($_POST["comment"]));
        }
    ?>

    <form action = "showreview.php" method = "get">
    論文評審決定：
        <input type = "radio" name = "sSelect" value = "accept" checked>Accept
        <input type = "radio" name = "sSelect" value = "minor revision">Minor Revision
        <input type = "radio" name = "sSelect" value = "major revision">Major Revision
        <input type = "radio" name = "sSelect" value = "reject">Reject<br><br>
    論文評論評語：<br>
    <textarea name = "comment" value = "" rows = "30" cols = "30"></textarea><br><br>
    <input type="submit">
    <input type="submit" name="logout" value="登出">
    </form>
</html>
