<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
    <title>重新設定密碼</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    require 'header.php';
    ?>

    <div class="container">
        <form id="loginForm" method="post" action="#">
            <label for="verificationCode">驗證碼</label>
            <input type="text" id="verificationCode" name="verificationCode" required>
            <label for="newPassword">新密碼</label>
            <input type="password" id="newPassword" name="newPassword" required>
            <button type="submit">重設密碼</button> 
            <p><a href="forget.php">重新寄送驗證碼</a></p>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verificationCode']) && isset($_POST['newPassword'])) {
        $enteredCode = $_POST['verificationCode'];
        $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT); // Use password hashing
        $currentTime = date("Y-m-d H:i:s");

        // 確保在 forget.php 中已經設置了 $_SESSION['reset_email']
        if (isset($_SESSION['reset_email'])) {
            $sMail = $_SESSION['reset_email'];

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

            // Fetch the stored code and timestamp
            $stmt = $link->prepare("SELECT verification_code, code_timestamp FROM suser WHERE email = ?");
            $stmt->bind_param("s", $sMail);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                $storedCode = $row['verification_code'];
                $storedTimestamp = $row['code_timestamp'];
                $expiryTime = strtotime($storedTimestamp) + (5 * 60);

                if ($storedCode === $enteredCode && strtotime($currentTime) <= $expiryTime) {
                    // Verification code is valid, proceed with password reset
                    $stmt = $link->prepare("UPDATE suser SET password = ? WHERE email = ?");
                    $stmt->bind_param("ss", $newPassword, $sMail);
                    if ($stmt->execute()) {
                        echo '<script type="text/javascript">',
                        'alert("密碼已成功更新");',
                        'window.location.href = "login.php";',
                        '</script>';
                    } else {
                        echo '<script type="text/javascript">',
                        'alert("密碼更新失敗，請稍後再試");',
                        '</script>';
                    }
                } else {
                    // Verification code is invalid or expired
                    echo '<script type="text/javascript">',
                    'alert("驗證碼無效或已過期");',
                    '</script>';
                }
            } else {
                echo '<script type="text/javascript">',
                'alert("無法找到用戶信息");',
                '</script>';
            }
        } else {
            echo '<script type="text/javascript">',
            'alert("無效的請求");',
            '</script>';
        }
    }
    ?>

    <?php
    require 'footer.html';
    ?>
</body>
</html>
