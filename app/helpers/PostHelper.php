<?php

// Hàm để lấy dữ liệu POST từ người dùng
function getPostData()
{
    $postData = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST as $key => $value) {
            $postData[$key] = $value;
        }
    }
    // var_dump($postData);
    return $postData;
}

function deleteKeyValuePairs(&$array, ...$keys) {
    foreach ($keys as $key) {
        if (array_key_exists($key, $array)) {
            unset($array[$key]);
        }
    }
    return $array;
}
?>