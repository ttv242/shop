<?php

require_once 'app/views/dashboard/inc/header.php';
require_once 'app/views/dashboard/inc/navbar/top.php';
require_once 'app/views/dashboard/inc/sidebar/left.php';
require_once 'app/views/dashboard/inc/sidebar/right.php';

switch ($titlePage) {
    case 'Dashboard':
        
        if (file_exists($contentPath)) {
            require_once $contentPath;
        } else {
            echo 'Không tồn tại tệp giao diện';
        }
        
        break;
        
    case 'shop':
        // print_r(__FUNCTION__);
        require_once 'app/views/dashboard/inc/headerV3.php';
        
        if (file_exists($contentPath)) {
            require_once $contentPath;
        } else {
            echo 'Không tồn tại tệp giao diện';
        }
        
        require_once 'app/views/dashboard/inc/footerV3.php';
        break;
        
    default:        
        if (file_exists($contentPath)) {
            require_once $contentPath;
        } else {
            echo 'Không tồn tại tệp giao diện';
        }
        
        break;
    }
    
    require_once 'app/views/dashboard/inc/footer.php';
?>