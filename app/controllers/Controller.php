<?php
require_once 'app/models/Model.php';
require_once 'app/helpers/Helper.php';

class Controller
{
    function __construct()
    {
    }
    public function view($contentPath, $data = [])
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
        $callingClass = isset($trace[1]['object']) ? get_class($trace[1]['object']) : null;

        if ($callingClass == 'DashboardController') {
            if (isset($contentPath) && !empty($contentPath)) {
                extract($data);
                require_once 'app/views/dashboard/layout.php';
            } else
                echo 'Không tồn tại đường dẫn tệp giao diện';
        } else if ($callingClass == 'ProductController') {
            if (isset($contentPath) && !empty($contentPath)) {
                extract($data);
                require_once 'app/views/dashboard/layout.php';
            } else
                echo 'Không tồn tại đường dẫn tệp giao diện';
        } else if ($callingClass == 'PagesController') {
            if (isset($contentPath) && !empty($contentPath)) {
                extract($data);
                require_once 'app/views/ct_shop/layout.php';
            } else
                echo 'Không tồn tại đường dẫn tệp giao diện';
        } else {
            echo 'Không tồn tại lớp phương thức';
        }
    }
}
