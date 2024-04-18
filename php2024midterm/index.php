<html>
    <head>
        <meta charset="utf-8">
        <title>論文投稿系統</title>
    </head>

    <?php

    if (isset($_COOKIE["user"])) {
        $username = $_COOKIE["user"];
        echo "<p>歡迎 {$username} 再次回到網站！</p>";
    }
    else{
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["sUser"];
            $date = strtotime("+7 days", time());
            setcookie("user", $username, $date);
            echo "<p>歡迎 {$username} 開始使用網站！</p>";
        }
    }
?>

    <body>
        <h1>高大資管論文投稿系統</h1><hr>
    </body>

    <form action = "check.php" method = "get">
        請選擇您的角色：
        <select name = "sUser">
            <option value = "chair">Chair</option>
            <option value ="reviewer">Reviewer</option>
            <option value = "author">Author</option>
        </select><br><br>

        帳號: <input type="text" name="uID"><br>
        密碼: <input type="password" name="uPwd"><br>
        <input type="submit">
    </form>
</html>