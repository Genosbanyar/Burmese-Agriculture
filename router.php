<?php
require "function.php";
$routes = [
    '' => "controller/indexController.php",
    'login' => "controller/loginController.php",
    'registration' => "controller/registrationController.php",
    'admin_login' => "controller/admin_loginController.php",
    'single' => "controller/singleController.php",
    'logout' => "controller/logoutController.php",
    'about' => "controller/aboutController.php",
    'favorite' => "controller/favoriteController.php",
    'dashboard' => "controller/dashboardController.php",
    'add' => "controller/addController.php",
    'admins_in' => "controller/adminsController.php",
    'show' => "controller/showController.php",
    'edit' => "controller/editController.php",
    'create_admin' => "controller/createAdminController.php"
];

$url=trim($_SERVER['REQUEST_URI'], "/");
// dd(explode("?","single"));
function pageController($urls,$routes){
    $route = explode("?",$urls)[0];
    if(array_key_exists($route, $routes)){
        require $routes[$route];
    }else{
        abort(404);
    }
}
pageController($url,$routes);