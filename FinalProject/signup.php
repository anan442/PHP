<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
    <title>COSPORT 註冊</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="styles.css">
</head>
<body class="header">
    <?php
        require 'header.php';
    ?>
</body>

<body class="is-preload">
    <!-- Header -->
    
    <!-- Signup Form -->
    <div class="container" >
        <form id="loginForm" method="post" action="#">
            <h1>COSPORT</h1>
            <h2>註冊</h2>
            <input type="text" name="uID" placeholder="Account" required><br>
            <input type="email" name="email" id="email" placeholder="Email Address" required /><br>
            <input type="text" name="uName" placeholder="Username" required><br>
            <input type="password" name="uPwd" placeholder="Password" required><br>
            <input type="password" name="uCPwd" placeholder="Check Password" required><br>
            <input type="text" name="uAge" placeholder="Your Age" required><br>
            <button type="submit">註冊</button><br>
            <p>已經有帳號？<a href="login.php">登入</a></p>
            <div id="fail_message"></div>
            <div id="success_message"></div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sMail = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
            $sUid = htmlspecialchars($_POST["uID"]);
            $sName = htmlspecialchars($_POST["uName"]);
            $sPwd = htmlspecialchars($_POST["uPwd"]);
            $sCPwd = htmlspecialchars($_POST["uCPwd"]);
            $sAge = htmlspecialchars($_POST["uAge"]);
            $sRole = "user";

            $link = @mysqli_connect(
                '127.0.0.1',    // MySQL主機名稱
                'root',         // 使用者名稱
                '',             // 密碼
                'final_client_data'  // 預設使用的資料庫名稱
            );

            if (!$link) {
                die("資料庫連線失敗: " . mysqli_connect_error());
            }

            // 檢查資料庫中是否已存在該電子郵件地址
            $check_query_mail = "SELECT * FROM suser WHERE email = '$sMail'";
            $check_query_uid = "SELECT * FROM suser WHERE account = '$sUid'";
            $check_result_mail = mysqli_query($link, $check_query_mail);
            $check_result_uid = mysqli_query($link, $check_query_uid);

            if (mysqli_num_rows($check_result_mail) > 0) {
                if (mysqli_num_rows($check_result_uid) > 0) {
                    echo '<script type="text/javascript">',
                    'document.getElementById("fail_message").textContent = "該電子郵件地址及帳號名稱已被註冊";',
                    '</script>';
                }else{
                    echo '<script type="text/javascript">',
                    'document.getElementById("fail_message").textContent = "該電子郵件地址已被註冊";',
                    '</script>';
                }
            } else if (mysqli_num_rows($check_result_uid) > 0) {
                if (mysqli_num_rows($check_result_mail) > 0) {
                    echo '<script type="text/javascript">',
                    'document.getElementById("fail_message").textContent = "該電子郵件地址及帳號名稱已被註冊";',
                    '</script>';
                }else{
                    echo '<script type="text/javascript">',
                    'document.getElementById("fail_message").textContent = "該帳號名稱已被註冊";',
                    '</script>';
                }
            } else {
                if($sPwd != $sCPwd){
                    echo '<script type="text/javascript">',
                    'document.getElementById("fail_message").textContent = "密碼與確認密碼不一致";',
                    '</script>';
                }else{
                    // 使用 password_hash 函數加密密碼
                    $hashed_password = password_hash($sPwd, PASSWORD_DEFAULT);
                    // SQL語法
                    $SQL = "INSERT INTO suser(email, password, account, username, age, uRole) VALUES(?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($link, $SQL);
                    mysqli_stmt_bind_param($stmt, 'ssssss', $sMail, $hashed_password, $sUid, $sName, $sAge, $sRole);

                    // 送出查詢
                    if (mysqli_stmt_execute($stmt)) {
                        echo '<script type="text/javascript">',
                        'document.getElementById("success_message").textContent = "註冊成功";',
                        '</script>';
                    } else {
                        echo '<script type="text/javascript">',
                        'document.getElementById("fail_message").textContent = "註冊失敗";',
                        '</script>';
                    }
                    mysqli_stmt_close($stmt);
                }
            }

            mysqli_close($link);
        }
        ?>
    </div>
    <?php
        require 'footer.html';
    ?>
</body>
</html>
