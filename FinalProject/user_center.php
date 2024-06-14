<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // 連接資料庫
    $link = @mysqli_connect(
        '127.0.0.1',    // MySQL主機名稱
        'root',         // 使用者名稱
        '',             // 密碼
        'final_client_data'  // 預設使用的資料庫名稱
    );

    if (!$link) {
        die("資料庫連線失敗: " . mysqli_connect_error());
    }

    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM suser WHERE userId = '$user_id'";
    $result = mysqli_query($link, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $account = $row['account'];
        $email = $row['email'];
    } else {
        echo "未找到用戶資料";
        exit();
    }
    $_SESSION['username'] = $username;
    $_SESSION['account'] = $account;
    $_SESSION['email'] = $email;
?>
<div class="container">
            <form id="loginForm" method="post" action="user.php">
                <h2>用戶資訊</h2>
                <label for="username">帳號</label>
                <input type="text" id="account" name="account" value="<?php echo $account; ?>" required>
                <br>
                <label for="username">用戶名稱</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
                <br>
                <label for="email">信箱</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                <br>
                <label for="password">原始密碼</label>
                <input type="password" id="password" name="password">
                <br>
                <label for="password">新密碼</label>
                <input type="password" id="newpassword" name="newpassword">
                <br>
                <button type="submit">更新資料</button>
                <div id="fail_message"></div>
                <div id="success_message"></div>
            </form>
    </div>


</body>
</html>