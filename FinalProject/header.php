<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-left">
                <h1><a href="index.php">COSPORT</a></h1>
            </div>
            <nav class="header-center">
                <ul>
                    <li><a href="index.php">商家總覽</a></li>
                    <li><a href="like.php">收藏店家</a></li>
                </ul>
            </nav>
            <div class="header-right">
                <ul>
                <?php
                    // 檢查 session 中是否存在 'check' 變數，並檢查它的值是否為 'Yes'
                    if(isset($_SESSION["check"])){
                        if($_SESSION["check"] == "Yes"){

                        if(isset($_SESSION["admin"])){
                            if($_SESSION["admin"] == "Yes"){
                                echo '<li><a href="admin.php">Admin</a></li>';
                            }
                        }
                            echo '<li><a href="user.php">' . $_SESSION['user_name'] . '</a></li>';
                            echo '<li><a href="logout.php">登出</a></li>';
                        }else {
                            echo '<li><a href="login.php">登入</a></li>';
                            echo '<li><a href="signup.php">註冊</a></li>';
                        } 
                    }else {
                        echo '<li><a href="login.php">登入</a></li>';
                        echo '<li><a href="signup.php">註冊</a></li>';
                    } 
                    ?>
                </ul>
            </div>
            <button class="toggle-button">☰</button> <!-- 新增的按鈕 -->
        </div>
    </header>

    <script>
        document.querySelector('.toggle-button').addEventListener('click', function() {
            document.querySelector('.header-center').classList.toggle('active');
            document.querySelector('.header-right').classList.toggle('active');
        });
    </script>

</body>
</html>
