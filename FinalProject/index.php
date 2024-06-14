<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
    <title>商家總覽</title>

</head>
<body>
<?php
        require 'header.php';
        require 'marchart.php';

        $link = @mysqli_connect(
            '127.0.0.1',    // MySQL主機名稱
            'root',         // 使用者名稱
            '',             // 密碼
            'final_client_data'  // 預設使用的資料庫名稱
        );

        if (!$link) {
            die("資料庫連線失敗: " . mysqli_connect_error());
        }

        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

        $check_query = "SELECT marchart.*, 
                        CASE WHEN user_favorites.user_id IS NOT NULL THEN 1 ELSE 0 END AS is_favorite
                        FROM marchart
                        LEFT JOIN user_favorites 
                        ON marchart.marchartName = user_favorites.marchart_name
                        AND user_favorites.user_id = '" . $userId . "'";
        $check_result = mysqli_query($link, $check_query);

        echo '<div class="container container1">';  // 將所有的卡片放在同一個容器中

        while ($row = mysqli_fetch_assoc($check_result)) {
            echo '<div class="card">';
            echo '<img src="' . $row['imagePath'] . '" alt="' . $row['imageName'] . '">';
            echo '<h2>' . $row['marchartName'] . '</h2><hr>';
            echo '<p>' . $row['phone'] . '</p>';
            echo '<p>' . $row['address'] . '</p>';
            echo '<button onclick="openModal(\'' . $row['marchartName'] . '\', \'電話：' . $row['phone'] . '\', \'' . $row['imagePath'] . '\', \'地址：' . $row['address'] . '\', \'收費模式：' . $row['businessMode'] . '\', \'營業時間：' . $row['openingHours'] . '\', \'收費：' . $row['price'] . '\', \'' . $row['social_href'] . '\', \'' . $row['social_href_ig'] . '\', ' . $row['is_favorite'] . ')" class="btn">查看更多</button>';
            echo '</div>';
        }
        echo '</div>';  // 結束容器

        mysqli_free_result($check_result);
    ?>

<script>
    var modal = document.getElementById("myModal");
    var currentMarchart;

    function openModal(title, phone, imagePath, address, businessMode, openingHours, price, social_href, social_href_ig, isFavorite) {
        currentMarchart = {
            marchartName: title,
            phone: phone,
            imagePath: imagePath,
            address: address,
            businessMode: businessMode,
            openingHours: openingHours,
            price: price,
            social_href: social_href,
            social_href_ig: social_href_ig
        };

        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDetail').innerText = phone;
        document.getElementById('modalImage').src = imagePath;
        document.getElementById('modalAddress').innerText = address;
        document.getElementById('modalbusinessMode').innerText = businessMode;
        document.getElementById('modalopeningHours').innerText = openingHours;
        document.getElementById('modalprice').innerText = price;
        document.getElementById('modalhref').href = social_href;
        document.getElementById('modalhref_ig').href = social_href_ig;

        var favoriteButton = document.getElementById('favoriteButton');
        var unfavoriteButton = document.getElementById('unfavoriteButton');

        if (isFavorite) {
            favoriteButton.style.display = 'none';
            unfavoriteButton.style.display = 'block';
        } else {
            favoriteButton.style.display = 'block';
            unfavoriteButton.style.display = 'none';
        }

        modal.style.display = "block";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
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

    function addToFavorites() {
        var userId = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;
    
        if (userId === null) {
            window.location.href = 'login.php';
            return;
        }

        var data = {
            user_id: userId,
            marchart_name: currentMarchart.marchartName,
            phone: currentMarchart.phone,
            address: currentMarchart.address,
            image_path: currentMarchart.imagePath,
            business_mode: currentMarchart.businessMode,
            opening_hours: currentMarchart.openingHours,
            price: currentMarchart.price,
            social_href: currentMarchart.social_href,
            social_href_ig: currentMarchart.social_href_ig
        };

        fetch('add_favorite.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('收藏成功');
                document.getElementById('favoriteButton').style.display = 'none';
                document.getElementById('unfavoriteButton').style.display = 'block';
            } else {
                alert('此店家已經在收藏項目！');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function removeFromFavorites() {
        var userId = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;
    
        if (userId === null) {
            window.location.href = 'login.php';
            return;
        }

        var data = {
            user_id: userId,
            marchart_name: currentMarchart.marchartName
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
                document.getElementById('favoriteButton').style.display = 'block';
                document.getElementById('unfavoriteButton').style.display = 'none';
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