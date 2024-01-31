<?php
function toSlug($str)
{
    return $str;
}

function getCurrentDateTimeInVietnam()
{
    // Đặt múi giờ cho Việt Nam
    $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');

    // Lấy ngày giờ hiện tại theo múi giờ Việt Nam
    $datetime = new DateTime('now', $timezone);

    // Format ngày giờ theo định dạng mong muốn
    $currentDateTime = $datetime->format('Y-m-d H:i:s');

    // Trả về giờ hiện tại ở Việt Nam
    return $currentDateTime;
}

function formatDateTimeInVietnam($dateTime) {
    // Định dạng ngày giờ theo chuẩn ở Việt Nam (VD: 18/12/2023 15:30:41)
    $formattedDateTime = date('H:i d/m/Y', strtotime($dateTime));

    // Trả về ngày giờ đã định dạng theo chuẩn ở Việt Nam
    return $formattedDateTime;
}

function goBack() {
    // Kiểm tra xem trang trước đó là trang nào
    $backUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

    // Chuyển hướng về trang trước đó
    header("Location: $backUrl");
    exit;
}


?>