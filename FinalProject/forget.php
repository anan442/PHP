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
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        //Load Composer's autoloader
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'header.php';

    ?>

    <div class="container">
        <form id="loginForm" method="post" action="#">
            <h3>傳送驗證碼至電子郵件</h3>
            <label for="email">電子郵件帳號</label>
            <input type="text" id="email" name="email" placeholder="xxx@xxx.com" required>
            <button type="submit">傳送</button>
            <p><a href="login.php">回到登入頁面</a></p> 
            <div id="fail_message"></div>
        </form>
    </div>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sMail = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

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
            $check_query = "SELECT * FROM suser WHERE email = '$sMail'";
            $check_result = mysqli_query($link, $check_query);

            $stmt = $link->prepare("SELECT * FROM suser WHERE email = ?");
            $stmt->bind_param("s", $sMail);
            $stmt->execute();
            $check_result = $stmt->get_result();

            if (mysqli_num_rows($check_result) == 0) {
                echo '<script type="text/javascript">',
                'document.getElementById("fail_message").textContent = "電子郵件不存在";',
                '</script>';
            }else{
                // 生成一個隨機的驗證碼
                $verificationCode = rand(100000, 999999);
                $timestamp = date("Y-m-d H:i:s");

                // Store the code and timestamp in the database
                $stmt = $link->prepare("UPDATE suser SET verification_code = ?, code_timestamp = ? WHERE email = ?");
                $stmt->bind_param("sss", $verificationCode, $timestamp, $sMail);
                $stmt->execute();

                // 將 email 存儲到 session 中
                $_SESSION['reset_email'] = $sMail;

                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'yaoan.lee5@gmail.com';
                    $mail->Password   = 'dkxo hvgs deto onmh';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    //Recipients
                    $mail->setFrom('yaoan.lee5@gmail.com', 'COSPORT');
                    $mail->addAddress($sMail);
                    $mail->addReplyTo('yaoan.lee5@gmail.com', 'Information');

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = "COSPORT Password Reset";
                    $mail->Body    = $sMail." 您好，您的COSPORT驗證碼是：$verificationCode";

                    $mail->send();
                    echo '<script type="text/javascript">',
                    'alert("驗證碼已發送到您的電子郵件地址");',
                    '</script>';
                    header('Location: resetpwd.php');
                    
                } catch (Exception $e) {
                    echo '<script type="text/javascript">',
                    'alert("電子郵件發送失敗: ' . $mail->ErrorInfo . '");',
                    '</script>';

                }
            }
        }
    ?>
    <?php
        require 'footer.html';
    ?>
</body>