<?php
spl_autoload_register(function ($class) {
    require "app/controllers/" . $class . ".php";
});

$baseDir = "/ct_shop/";
const ROOT_URL = "/ct_shop/";
const PUBLIC_URL = ROOT_URL."public/";


$router = [
    'GET' => [
        '' => ['PagesController', 'home'],
        'about' => ['PagesController', 'about'],
        'shop' => ['PagesController', 'shop'],
        'shop/{param1}' => ['PagesController', 'catDetail'],
        'shop/{param1}/{param2}' => ['PagesController', 'proDetail'],
        'news' => ['PagesController', 'news'],
        'news/{param1}' => ['PagesController', 'newsDetail'],
        'contact' => ['PagesController', 'contact'],
        
        'dashboard' => ['DashboardController', 'dashboard'],

        'dashboard/categories/list' => ['DashboardController', 'listCat'],
        'dashboard/brands/list' => ['DashboardController', 'listBrands'],
        'dashboard/products/list' => ['ProductController', 'listProduct'],
    ],

        'POST' => [
        'dashboard/categories/list' => ['DashboardController', 'listCat'],

        'dashboard/products/list' => ['ProductController', 'listProduct'],

        'dashboard/brands/list' => ['DashboardController', 'listBrands'],
    ]
];

$path = substr($_SERVER['REQUEST_URI'], strlen($baseDir));
$arr = explode("?", $path);
$route = strtolower(trim($arr[0], '/'));

if (count($arr) >= 2) {
    parse_str($arr[1], $query);
    $params = array_merge($_GET, $query);
} else {
    $params = $_GET;
}

$method = $_SERVER['REQUEST_METHOD'];

if (!array_key_exists($method, $router)) {
    die("Method không phù hợp: " . $method);
}

$matchedRoute = null;
$tempParams = []; // Biến tạm thời để lưu trữ giá trị tham số
foreach ($router[$method] as $key => $value) {
    $pattern = str_replace('/', '\/', $key);
    $pattern = preg_replace('/\{[^\}]+\}/', '([^\/]+)', $pattern);
    $pattern = '/^' . $pattern . '$/';
    if (preg_match($pattern, $route, $matches) && count($matches) > 0) {
        $matchedRoute = $key;
        array_shift($matches); // Remove the first item (full match)
        $paramKeys = [];
        preg_match_all('/\{([^\}]+)\}/', $key, $paramKeys);
        $paramKeys = $paramKeys[1];
        
        foreach ($paramKeys as $index => $paramKey) {
            $paramValue = isset($matches[$index]) ? urldecode($matches[$index]) : null;
            $tempParams[$paramKey] = $paramValue;
        }
        break;
    }
}

$params = $tempParams; // Gán lại giá trị vào biến $params

if ($matchedRoute === null) {
    // Xử lý khi không tìm thấy route (404 Not Found)
    die("404 Not Found");
}

$action = $router[$method][$matchedRoute];
$controllerName = $action[0];
$methodName = $action[1];

$controller = new $controllerName();
if (method_exists($controller, $methodName)) {
    $reflectionMethod = new ReflectionMethod($controller, $methodName);
    $parameters = $reflectionMethod->getParameters();
    $arguments = [];
    foreach ($parameters as $parameter) {
        $parameterName = $parameter->getName();
        if (array_key_exists($parameterName, $params)) {
            $arguments[] = $params[$parameterName];
        } else {
            // Xử lý khi thiếu giá trị tham số hoặc đặt giá trị mặc định
            // Trong ví dụ này, chúng ta đặt giá trị mặc định là null
            $arguments[] = null;
        }
    }

    // Gọi phương thức trong controller với các đối số tương ứng
    call_user_func_array([$controller, $methodName], $arguments);
} else {
    // Xử lý khi không tìm thấy phương thức trong controller
    die("404 Not Found");
}

?>