<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* 模態視窗的背景 */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 100px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4);
        }

        /* 模態視窗的內容 */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 80%;
            max-height: 80%;  /* 設置最大高度 */
            overflow-y: auto;  /* 添加垂直滾動條 */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            animation-name: animatetop;
            animation-duration: 0.4s;
        }

        /* 添加動畫效果 */
        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }

        /* 關閉按鈕 */
        .close {
            color: white;
            float: right;
            font-size: 40px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #007bff;
            color: white;
            
        }

        .modal-body {
            padding: 2px 16px;
            flex: 1;  /* 使模態視窗的內容區域擴展以填充可用空間 */
        }

        .modal-footer {
            position: relative; /* 讓按鈕可以相對於 modal-footer 定位 */
            padding: 2px 16px;
            background-color: #007bff;
            color: white;
        }

        /* 新增一個 class 來定義按鈕的樣式 */
        .footer-button {
            position: absolute; /* 使用絕對定位 */
            right: 0; /* 將按鈕固定在右側 */
        }
    </style>
</head>
<body>
    <h1>商家總覽</h1>
    <div class="search-container">
        <form action="/search" method="get">
        <input type="text" placeholder="搜尋商家..." name="search" id="search" onkeyup="searchFunction()">
        </form>
    </div>

    <!-- 模態視窗 -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2 id="modalTitle"></h2>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Image">
                <p id="modalDetail"></p>
                <p id="modalAddress"></p>
                <p id="modalbusinessMode"></p>
                <p id="modalopeningHours"></p>
                <p id="modalprice"></p>
                <a id="modalhref" href ="#" target="_blank">
                <img id ="social_icon" src="icon/facebook.png" alt="Facework">
            </a>&nbsp;
            <a id="modalhref_ig" href ="#" target="_blank">
                <img id ="social_icon" src="icon/instagram.jpg" alt="Facework">
            </a>&nbsp;
            </div>
            <div class="modal-footer">
                <h3>COSPORT.COM</h3>
                <button id="favoriteButton" class="footer-button" onclick="addToFavorites()">收藏</button>
                <button id="unfavoriteButton" class="footer-button" onclick="removeFromFavorites()">取消收藏</button>
            </div>
        </div>
    </div>

</body>
</html>
