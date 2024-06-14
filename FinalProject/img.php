<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

    <?php
        require 'header.php';
    ?>
    <div class="container">
    <form id="loginForm" method="post" action="#" enctype="multipart/form-data">
    <h2>上傳照片</h2>
        <label for="myImage">選擇圖片</label>
        <input type="file" id="myImage" name="myImage">
        <label for="rowSelect">選擇資料列</label>
        <select name="rowSelect" id="rowSelect">
            <?php
            // 連接到資料庫
            $link = @mysqli_connect(
                '127.0.0.1',    // MySQL主機名稱
                'root',         // 使用者名稱
                '',             // 密碼
                'final_client_data'  // 預設使用的資料庫名稱
            );

            // 獲取所有的資料列
            $query = "SELECT marchartid FROM marchart";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['marchartid'] . "'>" . $row['marchartid'] . "</option>";
            }
            ?>
        </select>
        <button type="submit">上傳</button>
        <p><a href="admin.php">回上頁</a></p>
        <div id="fail_message"></div>
        <div id="success_message"></div>
    </form>

    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['myImage'])) {
    $imageName = $_FILES['myImage']['name'];
    $imageTmpName = $_FILES['myImage']['tmp_name'];
    $imageDestination = "pic/" . $imageName;



    // 將圖片路徑存儲到資料庫
    $id = $_POST['rowSelect'];  // 從表單獲取資料列的 ID
    $query = "SELECT imageName FROM marchart WHERE marchartid = $id";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['imageName']) {
            //echo "資料列已經有圖片，上傳失敗。";
            echo '<script type="text/javascript">',
                        'document.getElementById("fail_message").textContent = "資料列已經有圖片，上傳失敗。";',
                        '</script>';
        } else {
            // 將圖片移動到目標目錄
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                // 將圖片路徑存儲到資料庫的特定資料列
                $query = "UPDATE marchart SET imageName = '$imageName', imagePath = '$imageDestination' WHERE marchartid = $id";
                if (mysqli_query($link, $query)) {
                    //echo "圖片已成功上傳！";
                    echo '<script type="text/javascript">',
                        'document.getElementById("success_message").textContent = "圖片已成功上傳！";',
                        '</script>';
                } else {
                    //echo "上傳失敗，請再試一次。";
                    echo '<script type="text/javascript">',
                        'document.getElementById("fail_message").textContent = "上傳失敗，請再試一次。";',
                        '</script>';
                }
            }
        }
    } else {
        echo "找不到指定的資料列，請確認您選擇的 ID 是否正確。";
    }
}
?>
</div>
    <?php
        require 'footer.html';
    ?>

</html>
