<?php

switch ($titlePage) {
    case 'Trang chủ':
        require_once 'app/views/ct_shop/inc/headerV1.php';
        
        if (file_exists($contentPath)) {
            require_once $contentPath;
        } else {
            echo 'Không tồn tại tệp giao diện';
        }
        
        require_once 'app/views/ct_shop/inc/footerV1.php';
        break;
        
    case 'shop':
        print_r(__FUNCTION__);
        require_once 'app/views/ct_shop/inc/headerV3.php';
        
        if (file_exists($contentPath)) {
            require_once $contentPath;
        } else {
            echo 'Không tồn tại tệp giao diện';
        }
        
        require_once 'app/views/ct_shop/inc/footerV3.php';
        break;
        
    default:
        require_once 'app/views/ct_shop/inc/headerV2.php';
        
        if (file_exists($contentPath)) {
            require_once $contentPath;
        } else {
            echo 'Không tồn tại tệp giao diện';
        }
        
        require_once 'app/views/ct_shop/inc/footerV2.php';
        break;
}

?>