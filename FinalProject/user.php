<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
    <title>用戶中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require 'header.php';
require 'user_center.php';

$link = @mysqli_connect('127.0.0.1', 'root', '', 'final_client_data');
if (!$link) {
    die("資料庫連線失敗: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM suser WHERE userId = '$user_id'";
$result = mysqli_query($link, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $db_password = $row['password'];
} else {
    echo "未找到用戶資料";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_account = $_POST['account'];
    $new_email = $_POST['email'];
    $original_password = $_POST['password'];
    $new_password = $_POST['newpassword'];

    // 調試信息
    //echo "輸入的原始密碼: " . $original_password . "<br>";
    //echo "資料庫中的密碼: " . $db_password . "<br>";

    if (password_verify($original_password, $db_password)) {
        $update_query = "UPDATE suser SET
                            account='$new_account',
                            username='$new_username',  
                            email='$new_email'";

        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query .= ", password='$hashed_password'";
        }

        $update_query .= " WHERE userId='$user_id'";

        if (mysqli_query($link, $update_query)) {
            echo '<script type="text/javascript">',
                    'document.getElementById("success_message").textContent = "資料更新成功";',
                    '</script>';
            $_SESSION['username'] = $new_username;
            $_SESSION['account'] = $new_account;
            $_SESSION['email'] = $new_email;
        } else {
            echo '<script type="text/javascript">',
                    'document.getElementById("fail_message").textContent = "資料更新失敗";',
                    '</script>' . mysqli_error($link);
        }
    } else {
        echo '<script type="text/javascript">',
                'document.getElementById("fail_message").textContent = "原始密碼不正確";',
                '</script>';
    }
}
?>

<?php
require 'footer.html';
?>
</body>
</html>
