<?php
$API_KEY = "API_KEY_CỦA_BẠN";

if (!isset($_FILES['image'])) {
    die("Không có file");
}

$tmp = $_FILES['image']['tmp_name'];

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => "https://freeimage.host/api/1/upload?key=$API_KEY",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        'source' => new CURLFile($tmp),
        'format' => 'json'
    ]
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if (!isset($data['image']['url'])) {
    die("Upload thất bại");
}

$link = $data['image']['url'];

header("Location: index.html?link=" . urlencode($link));
