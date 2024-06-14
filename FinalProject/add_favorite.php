<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $link = @mysqli_connect(
        '127.0.0.1',    // MySQL主機名稱
        'root',         // 使用者名稱
        '',             // 密碼
        'final_client_data'  // 預設使用的資料庫名稱
    );

    if (!$link) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed']);
        exit();
    }

    $userId = $_SESSION['user_id'];
    $marchartName = mysqli_real_escape_string($link, $data['marchart_name']);
    $phone = mysqli_real_escape_string($link, $data['phone']);
    $address = mysqli_real_escape_string($link, $data['address']);
    $imagePath = mysqli_real_escape_string($link, $data['image_path']);
    $businessMode = mysqli_real_escape_string($link, $data['business_mode']);
    $openingHours = mysqli_real_escape_string($link, $data['opening_hours']);
    $price = mysqli_real_escape_string($link, $data['price']);
    $socialhref = mysqli_real_escape_string($link, $data['social_href']);
    $socialhref_ig = mysqli_real_escape_string($link, $data['social_href_ig']);

    // 檢查該項目是否已經被當前用戶收藏
    $check_query = "SELECT * FROM user_favorites WHERE user_id = '$userId' AND marchart_name = '$marchartName'";
    $check_result = mysqli_query($link, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo json_encode(['success' => false, 'message' => 'This item has already been added to favorites']);
        exit();
    }
    
    $query = "INSERT INTO user_favorites (user_id, marchart_name, phone, address, image_path, business_mode, opening_hours, price, social_href, social_href_ig) VALUES ('$userId', '$marchartName', '$phone', '$address', '$imagePath', '$businessMode', '$openingHours', '$price', '$socialhref', '$socialhref_ig')";

    if (mysqli_query($link, $query)) {
        echo json_encode(['success' => true, 'message' => 'Added to favorites']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add to favorites']);
    }

    mysqli_close($link);
} else {
    echo json_encode(['success' => false, 'message' => 'No data received']);
}
?>
