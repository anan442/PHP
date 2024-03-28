<html>
    <head>
        <meta charset = "utf-8">
        <title>資管系晚會報名表登入網頁</title>
    </head>

    <body>
        <center><h1>資管系晚會報名表</h1></center><hr>
    </body>

    <form action = "check.php" method = "get">
        accent: <input type="text" name="uID">
        password: <input type="password" name="uPwd">
        <input type="submit">
    </form>

    <?php
        date_default_timezone_set("Asia/Taipei");
        echo date("Y/M/d H:i:s");
    ?>
</html>