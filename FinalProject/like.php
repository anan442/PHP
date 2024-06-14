<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
    <title>我的收藏</title>
</head>
<body>
    <?php
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        require 'header.php';
        require 'marchart.php';
    ?>
        <?php
            $link = @mysqli_connect(
                '127.0.0.1',    // MySQL主機名稱
                'root',         // 使用者名稱
                '',             // 密碼
                'final_client_data'  // 預設使用的資料庫名稱
            );

                if (!$link) {
                    die("資料庫連線失敗: " . mysqli_connect_error());
                }
            
            $userId = $_SESSION['user_id'];
            $check_query = "SELECT * FROM user_favorites WHERE user_id = '$userId'";
            $check_result = mysqli_query($link, $check_query);
        
    
            echo '<div class="container container1">';  // 將所有的卡片放在同一個容器中

                while ($row = mysqli_fetch_assoc($check_result)) {
                echo '<div class="card">';
                echo '<img src="' . $row['image_path'] . '" >';
                echo '<h2>' . $row['marchart_name'] . '</h2><hr>';
                echo '<p>' . $row['phone'] . '</p>';
                echo '<p>' . $row['address'] . '</p>';
                echo '<button onclick="openFavoriteModal(\'' . $row['marchart_name'] . '\', \'' .'電話：'. $row['phone'] . '\', \'' . $row['image_path'] . '\'
                ,\'' .'地址：'. $row['address'] . '\',\'' .'收費模式：'. $row['business_mode'] . '\',\'' .'營業時間：'. $row['opening_hours'] . '\'
                ,\'' .'價格：'. $row['price'] . '\', \'' . $row['social_href'] . '\', \'' . $row['social_href_ig'] . '\')" class="btn">查看更多</button>';
                echo '</div>';
            }
            echo '</div>';  // 結束容器

    
        mysqli_free_result($check_result);
        ?>
        <script>
        
            var favoritemodal = document.getElementById("myModal");

            function openFavoriteModal(title, detail, imagePath, address, businessMode, openingHours, price, social_href, social_href_ig) {

                currentMarchart = {
                    marchart_name: title,
                    phone: detail,
                    image_path: imagePath,
                    address: address,
                    business_mode: businessMode,
                    opening_hours: openingHours,
                    price: price,
                    social_href: social_href,
                    social_href_ig: social_href_ig
                };

                document.getElementById('modalTitle').innerText = title;
                document.getElementById('modalDetail').innerText = detail;
                document.getElementById('modalImage').src = imagePath;
                document.getElementById('modalAddress').innerText = address;
                document.getElementById('modalbusinessMode').innerText = businessMode;
                document.getElementById('modalopeningHours').innerText = openingHours;
                document.getElementById('modalprice').innerText = price;
                document.getElementById('modalhref').href = social_href;
                document.getElementById('modalhref_ig').href = social_href_ig;

                // 設定 "取消收藏" 按鈕的 onclick 事件
                document.getElementById('unfavoriteButton').onclick = function() {
                    removeFromFavorites();
                };


                favoritemodal.style.display = "block";
            }

            function closeModal() {
                favoritemodal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == favoritemodal) {
                    favoritemodal.style.display = "none";
                }
            }

            function searchFunction() {
                var input, filter, cards, cardContainer, h2, title, i;
                input = document.getElementById("search");
                filter = input.value.toUpperCase();
                cardContainer = document.getElementsByClassName("container1")[0];
                cards = cardContainer.getElementsByClassName("card");
                for (i = 0; i < cards.length; i++) {
                    title = cards[i].querySelector("h2");
                    if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                        cards[i].style.display = "";
                    } else {
                        cards[i].style.display = "none";
                    }
                }
            }

            function removeFromFavorites() {
                var userId = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;

                if (userId === null) {
                    window.location.href = 'login.php';
                    return;
                }

                var data = {
                    user_id: userId,
                    marchart_name: currentMarchart.marchart_name
                };

                fetch('unfavorite.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('已取消收藏');
                        closeModal();
                        location.reload(); // 重新加载页面，更新收藏状态
                    } else {
                        alert('取消收藏失敗');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        </script>
        <?php
        require 'footer.html';
        ?>
</body>
</html>
