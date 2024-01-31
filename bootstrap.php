<?php
define('_DIR_ROOT', __DIR__);

//Xử lý http root
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
    $web_root = 'https://'.$_SERVER['HTTP_HOST'];
}else{
    $web_root = 'http://'.$_SERVER['HTTP_HOST'];
}

$dirRoot = str_replace('\\', '/', _DIR_ROOT);

$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);

$folder = str_replace(strtolower($documentRoot), '', strtolower($dirRoot));

$web_root = $web_root.$folder;

define('_WEB_ROOT', $web_root);


/*
 * Tự động load configs
 *
 * */
$configs_dir = scandir('configs');
if (!empty($configs_dir)){
    foreach ($configs_dir as $item){
        if ($item!='.' && $item!='..' && file_exists('configs/'.$item)){
            require_once 'configs/'.$item;
            // echo 'configs/'.$item;
        }
    }
}

//Load all services
// if (!empty($config['app']['service'])){
//     $allServices = $config['app']['service'];
//     if (!empty($allServices)){
//         foreach ($allServices as $serviceName){
//             if (file_exists('app/core/'.$serviceName.'.php')){
//                 require_once 'app/core/'.$serviceName.'.php';
//             }
//         }
//     }
// }

//Kiểm tra config và load Database
if (!empty($config['database'])){
    $db_config = array_filter($config['database']);

    // if (!empty($db_config)){
    //     require_once 'core/Connection.php';
    //     require_once 'core/QueryBuilder.php';
    //     require_once 'core/Database.php';
    //     require_once 'core/DB.php';
    // }
}



//Load all heplers
$allHelpers = scandir('app/helpers');
if (!empty($allHelpers)){
    foreach ($allHelpers as $item){
        if ($item!='.' && $item!='..' && file_exists('app/helpers/'.$item)){
            require_once 'app/helpers/'.$item;
        }
    }
}


