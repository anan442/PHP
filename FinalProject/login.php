<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
    <title>COSPORT 登入</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    require 'header.php';
    ?>
    <div class="container">
        <form id="loginForm" method="post" action="#">
            <h2>登入</h2>
            <label for="username">帳號</label>
            <input type="text" id="account" name="uID" required>
            <label for="password">密碼</label>
            <input type="password" id="password" name="uPwd" required>
            <button type="submit">登入</button>
            <p>沒有帳號嗎？ <a href="signup.php">立即註冊</a></p>
            <p><a href="forget.php">忘記密碼</a></p>
            <div id="fail_message"></div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sUid = filter_input(INPUT_POST, "uID", FILTER_SANITIZE_STRING);
            $sPwd = $_POST["uPwd"]; // 密碼不需要過濾

            $link = @mysqli_connect(
                '127.0.0.1',    // MySQL主機名稱
                'root',         // 使用者名稱
                '',             // 密碼
                'final_client_data'  // 預設使用的資料庫名稱
            );

            if (!$link) {
                die("資料庫連線失敗: " . mysqli_connect_error());
            }

            mysqli_set_charset($link, 'utf8');

            // 查詢資料庫中是否存在該用戶
            $query = "SELECT userId, password, uRole FROM suser WHERE account = ?";
            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, 's', $sUid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);


            if ($result) {
                $row = mysqli_fetch_assoc($result);
                if ($row && password_verify($sPwd, $row['password'])) {
                    $_SESSION['check'] = 'Yes';
                    $_SESSION['user_id'] = $row['userId'];
                    $_SESSION['user_name'] = $sUid;
                    if($row['uRole'] == "admin"){
                        $_SESSION['admin'] = 'Yes';
                    }
                    header('Location: index.php');
                    exit(); // 確保重定向後停止執行腳本
                } else {
                    $_SESSION['check'] = 'No';
                    echo '<script type="text/javascript">',
                    'document.getElementById("fail_message").textContent = "帳號或密碼錯誤";',
                    '</script>';
                }
            } else {
                echo '<script type="text/javascript">',
                'document.getElementById("fail_message").textContent = "查詢失敗，請稍後再試";',
                '</script>';
            }

            mysqli_free_result($result);
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
        ?>
    </div>
    <?php
    require 'footer.html';
    ?>
</body>
</html>
