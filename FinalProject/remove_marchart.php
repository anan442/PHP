<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
    <title>Admin - 刪除商家</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    require 'header.php';
    ?>

    <div class="container">
        <form id="loginForm" method="post" action="#">
            <h2>刪除商家</h2>
            <label for="marchartId">選擇商家編號</label>
            <select name="marchartId" id="marchartId" required>
                <?php
                // 連接到資料庫
                $link = @mysqli_connect(
                    '127.0.0.1',    // MySQL主機名稱
                    'root',         // 使用者名稱
                    '',             // 密碼
                    'final_client_data'  // 預設使用的資料庫名稱
                );

                if (!$link) {
                    die("資料庫連線失敗: " . mysqli_connect_error());
                }

                // 獲取所有商家的 marchartId
                $query = "SELECT marchartId, marchartName FROM marchart";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['marchartId'] . "'>" . $row['marchartId'] . " - " . $row['marchartName'] . "</option>";
                }

                mysqli_close($link);
                ?>
            </select>
            <button type="submit">刪除</button>
            <p><a href="admin.php">回上頁</a></p>
            <div id="fail_message"></div>
            <div id="success_message"></div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['marchartId'])) {
            $marchartId = htmlspecialchars($_POST["marchartId"]);

            $link = @mysqli_connect(
                '127.0.0.1',    // MySQL主機名稱
                'root',         // 使用者名稱
                '',             // 密碼
                'final_client_data'  // 預設使用的資料庫名稱
            );

            if (!$link) {
                die("資料庫連線失敗: " . mysqli_connect_error());
            }

            // 檢查是否有相應的商家資料
            $check_query = "SELECT * FROM marchart WHERE marchartId = ?";
            $stmt = mysqli_prepare($link, $check_query);
            mysqli_stmt_bind_param($stmt, 's', $marchartId);
            mysqli_stmt_execute($stmt);
            $check_result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($check_result) > 0) {
                // 刪除商家資料
                $delete_query = "DELETE FROM marchart WHERE marchartId = ?";
                $stmt = mysqli_prepare($link, $delete_query);
                mysqli_stmt_bind_param($stmt, 's', $marchartId);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script type="text/javascript">',
                    'document.getElementById("success_message").textContent = "刪除成功";',
                    '</script>';
                } else {
                    echo '<script type="text/javascript">',
                    'document.getElementById("fail_message").textContent = "刪除失敗，請再試一次";',
                    '</script>';
                }
            } else {
                echo '<script type="text/javascript">',
                'document.getElementById("fail_message").textContent = "找不到指定的商家";',
                '</script>';
            }

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
