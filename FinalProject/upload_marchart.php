<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    require 'header.php';
    ?>
    <div class="container">
        <form id="loginForm" method="post" action="#" enctype="multipart/form-data">
            <h2>新增商家</h2>
            <input type="text" name="marchartId" placeholder="marchart Id" required><br>
            <input type="text" name="marchartName" placeholder="marchart Name" required><br>
            <input type="text" name="phone" placeholder="phone" required><br>
            <input type="text" name="address" placeholder="address" required><br>
            <input type="text" name="businessMode" placeholder="business Mode" required><br>
            <input type="text" name="openingHours" placeholder="opening Hours" required><br>
            <input type="text" name="price" placeholder="price" required><br>
            <input type="text" name="social_href" placeholder="social Href 1" required><br>
            <input type="text" name="social_href_ig" placeholder="social Href 2" required><br>
            <button type="submit">新增</button><br>
            <p><a href="img.php">新增商家照片</a></p>
            <p><a href="admin.php">回上頁</a></p>
            <div id="fail_message"></div>
            <div id="success_message"></div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $marchartId = htmlspecialchars($_POST["marchartId"]);
            $marchartName = htmlspecialchars($_POST["marchartName"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $address = htmlspecialchars($_POST["address"]);
            $businessMode = htmlspecialchars($_POST["businessMode"]);
            $openingHours = htmlspecialchars($_POST["openingHours"]);
            $price = htmlspecialchars($_POST["price"]);
            $social_href = htmlspecialchars($_POST["social_href"]);
            $social_href_ig = htmlspecialchars($_POST["social_href_ig"]);

            $link = @mysqli_connect(
                '127.0.0.1',    // MySQL主機名稱
                'root',         // 使用者名稱
                '',             // 密碼
                'final_client_data'  // 預設使用的資料庫名稱
            );

            if (!$link) {
                die("資料庫連線失敗: " . mysqli_connect_error());
            }

            // 檢查是否已有相同的 marchartId
            $check_query_mId = "SELECT * FROM marchart WHERE marchartId = ?";
            $stmt = mysqli_prepare($link, $check_query_mId);
            mysqli_stmt_bind_param($stmt, 's', $marchartId);
            mysqli_stmt_execute($stmt);
            $check_result_mId = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($check_result_mId) > 0) {
                echo '<script type="text/javascript">',
                'document.getElementById("fail_message").textContent = "該商家編號已經存在";',
                '</script>';
            } else {
                // 插入新商家資料
                $SQL = "INSERT INTO marchart (marchartId, marchartName, phone, address, businessMode, openingHours, price, social_href, social_href_ig) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($link, $SQL);
                mysqli_stmt_bind_param($stmt, 'sssssssss', $marchartId, $marchartName, $phone, $address, $businessMode, $openingHours, $price, $social_href, $social_href_ig);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script type="text/javascript">',
                    'document.getElementById("success_message").textContent = "新增成功";',
                    '</script>';
                } else {
                    echo '<script type="text/javascript">',
                    'document.getElementById("fail_message").textContent = "新增失敗，請再試一次";',
                    '</script>';
                }

                mysqli_stmt_close($stmt);
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
