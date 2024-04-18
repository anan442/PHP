<html>
    <head>
        <meta charset="utf-8">
    </head>

    <?php
        echo"非法登入<br>三秒鐘後返回登入頁面";
        header("Refresh:3;url=index.php");
    ?>
</html>