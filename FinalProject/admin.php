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
    <style>
        .admin-button {
            width: 30%;
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 20px;
            margin-bottom: 20px; /* 添加下邊距 */

        }
        .admin-button:hover {
            background-color: #0056b3;
        }

        a{
            color: white !important;
        }
        @media (max-width: 768px) {
            .admin-button {
                width: 50%;

            }
        }
    </style>
</head>
<body>
    <?php
    require 'header.php';
    ?>

    <div class="container">
    <form id="loginForm" method="post" action="#">
        <h2>商家管理</h2>
        <a href="upload_marchart.php" class="admin-button">新增商家</a>
        <a href="img.php" class="admin-button">新增商家照片</a>
        <a href="remove_marchart.php" class="admin-button">刪除商家</a>
    </form>
    </div>

    <?php
    require 'footer.html';
    ?>
</body>
</html>
