<?php

function truncateString($string, $maxLength)
{
    if (strlen($string) > $maxLength) {
        $truncatedString = substr($string, 0, $maxLength);
        $truncatedString .= '...';
        return $truncatedString;
    }

    return $string;
}

function capitalizeString($string)
{
    return ucfirst(strtolower($string));
}

function reverseString($string)
{
    return strrev($string);
}

function countWords($string)
{
    $words = str_word_count($string);
    return $words;
}

function generateAlias($string) {
    // Chuyển đổi chuỗi thành chữ thường
    $cleanString = mb_strtolower($string, 'UTF-8');

    // Loại bỏ các dấu tiếng Việt
    $cleanString = removeVietnameseDiacritics($cleanString);

    // Thay thế các ký tự không phải chữ cái và số bằng dấu gạch ngang
    $cleanString = preg_replace("/[^a-z0-9]+/i", "-", $cleanString);

    // Loại bỏ các dấu gạch ngang liên tiếp
    $cleanString = preg_replace("/-+/", "-", $cleanString);

    // Loại bỏ ký tự gạch ngang ở đầu và cuối chuỗi
    $cleanString = trim($cleanString, "-");

    // Trả về chuỗi alias đã xử lý
    return $cleanString;
}

function removeVietnameseDiacritics($str) {
    $str = str_replace(
        array('á', 'à', 'ả', 'ã', 'ạ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ'),
        array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
        $str
    );

    $str = str_replace(
        array('đ'),
        array('d'),
        $str
    );

    $str = str_replace(
        array('é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ'),
        array('e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e'),
        $str
    );

    $str = str_replace(
        array('í', 'ì', 'ỉ', 'ĩ', 'ị'),
        array('i', 'i', 'i', 'i', 'i'),
        $str
    );

    $str = str_replace(
        array('ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ'),
        array('o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o'),
        $str
    );

    $str = str_replace(
        array('ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự'),
        array('u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u'),
        $str
    );

    $str = str_replace(
        array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'),
        array('y', 'y', 'y', 'y', 'y'),
        $str
    );

    return $str;
}


?>