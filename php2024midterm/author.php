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
            if($_SESSION["check"] == "Author"){
                echo "<h1>Author您好，歡迎進入論文評論網頁</h1>";
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

    <form action = "showpaper.php" method = "get">
        論文標題：
        <input tpye = "text" name = "sTitle" value = "" required><br>
        作者姓名：
        <input tpye = "text" name = "sName" value = "" required><br>
        作者Email：
        <input type = "email" name = "sEmail" value = "" required><br>
        論文摘要：
        <textarea row = 30 col = 30 name = "comment"></textarea>
        <input type="submit">
        <input type="submit" name="logout" value="登出">
    </form>
</html>
