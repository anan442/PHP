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
            if($_SESSION["check"] == "Chair"){
                echo "Chair您好，歡迎進入論文評論網頁！";
            }else{
                header("Refresh:0;url=fail.php");
            }
        }else{
            header("Refresh:0;url=fail.php");
        }
        if (isset($_GET["logout"])) {
            header("Location:logout.php");
        }
    ?>

    <form method = "get">
    <input type="submit" name="logout" value="Logout">
    </form>
</html>