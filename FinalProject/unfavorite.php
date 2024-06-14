<?php
session_start();
header('Content-Type: application/json');

$response = array();

if (!isset($_SESSION['user_id'])) {
    $response['success'] = false;
    $response['message'] = 'User not logged in';
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $user_id = $data['user_id'];
    $marchart_name = $data['marchart_name'];

    $link = @mysqli_connect('127.0.0.1', 'root', '', 'final_client_data');

    if (!$link) {
        $response['success'] = false;
        $response['message'] = 'Database connection failed: ' . mysqli_connect_error();
        echo json_encode($response);
        exit();
    }

    $query = "DELETE FROM user_favorites WHERE user_id = ? AND marchart_name = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'is', $user_id, $marchart_name);

    if (mysqli_stmt_execute($stmt)) {
        $response['success'] = true;
        $response['message'] = 'Favorite removed successfully';
    } else {
        $response['success'] = false;
        $response['message'] = 'Failed to remove favorite: ' . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
?>
