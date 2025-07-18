<?php

use database\Dataase;
use Admin\Category;

//session start
session_start();

define('BASE_PATH', __DIR__);

define('CURRENT_DOMAIN', currentDomain() . '/project/');

define('DISPLAY_ERRORS', true);

// Database properties
define('DB_HOST', 'localhost');
define('DB_NAME', 'project');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
// for connect to the database ==> please uncomment the above database properties

//requier once
require_once("./database/DataBase.php");
require_once("./activities/Admin/Admin.php");
require_once("./activities/Admin/Category.php");
require_once("./activities/Admin/Post.php");
require_once("./activities/Admin/Banner.php");
require_once("./activities/Admin/User.php");
require_once("./activities/Admin/Comment.php");
require_once("./activities/Admin/Menu.php");
require_once("./activities/Admin/Setting.php");
require_once("./activities/Admin/Dashboard.php");




// routing system

function uri($reservedUrl, $class, $method, $requestMethod = "GET")
{
    // current Url array
    $currentUrl = explode("?", currentUrl())[0];
    $currentUrl = str_replace(CURRENT_DOMAIN, '', $currentUrl);
    $currentUrl = trim($currentUrl, '/');
    $currentUrlArrar = explode("/", $currentUrl);
    $currentUrlArrar = array_filter($currentUrlArrar);

    // reserved url array
    $reservedUrl = trim($reservedUrl, '/');
    $reservedUrlArray = explode("/", $reservedUrl);
    $reservedUrlArray = array_filter($reservedUrlArray);

    if (sizeof($currentUrlArrar) !== sizeof($reservedUrlArray) || methodFiled() !== $requestMethod) {
        return false;
    }

    $parametres = [];
    $match = true;

    for ($key = 0; $key < sizeof($currentUrlArrar); $key++) {
        if ($reservedUrlArray[$key][0] == "{" && $reservedUrlArray[$key][strlen($reservedUrlArray[$key]) - 1] == "}") {
            array_push($parametres, $currentUrlArrar[$key]);
        } elseif ($currentUrlArrar[$key] !== $reservedUrlArray[$key]) {
            $match = false;
            break;
        }
    }

    if ($match) {
        $object = new $class;
        if (methodFiled() == "POST") {
            $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
            array_unshift($parametres, $request);
        }
        call_user_func_array(array($object, $method), $parametres);
        return true;
    }

    return false;
}

// reserved routing system


// helpers

spl_autoload_register(function($className){

    $path = BASE_PATH . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR;
    include $path . $className . ".php";

});

function jdate($date){

    return \Parsidev\Jalali\jDate::forge($date)->format("datetime");

}



function protocol()
{
    if (stripos($_SERVER["SERVER_PROTOCOL"], "https") === true) {
        return "https://";
    } else {
        return "http://";
    }
}

function currentDomain()
{
    return protocol() . $_SERVER["HTTP_HOST"];
}

function dd($var)
{
    echo "<pre>";
    var_dump($var);
    exit;
}

function asset($src)
{
    $domain = trim(CURRENT_DOMAIN, '/');
    $result = $domain . "/" . $src;
    return $result;
}

function url($url)
{
    $domain = trim(CURRENT_DOMAIN, '/');
    $result = $domain . "/" . $url;
    return $result;
}

function currentUrl()
{
    return currentDomain() . $_SERVER["REQUEST_URI"];
}

function displayError($displayError)
{
    if ($displayError === true) {
        ini_set("display_errors", 1);
        ini_set("display_startup_errors", 1);
        error_reporting(E_ALL);
    } else {
        ini_set("display_errors", 0);
        ini_set("display_startup_errors", 0);
        error_reporting(0);
    }
}

global $flashMessage;
if (isset($_SESSION["flash_message"])) {
    $flashMessage = $_SESSION["flash_message"];
    unset($_SESSION["flash_message"]);
}

function flash($name, $value = null)
{
    if ($value === null) {
        global $flashMessage;
        $message = $flashMessage[$name];
        return $message;
    } else {
        $_SESSION["flash_message"][$name] = $value;
    }
}

function methodFiled()
{
    $method = $_SERVER["REQUEST_METHOD"];
    return $method;
}


$routes = [
    //Categories
    uri("admin/Category", "Admin\Category", "index"),
    uri("admin/Category/create", "Admin\Category", "create"),
    uri("admin/Category/store", "Admin\Category", "store", "POST"),
    uri("admin/Category/edit/{id}", "Admin\Category", "edit"),
    uri("admin/Category/update/{id}", "Admin\Category", "update", "POST"),
    uri("admin/Category/delete/{id}", "Admin\Category", "delete"),

    
    //Posts
    uri("admin/Post","Admin\Post", "index"),
    uri("admin/Post/create", "Admin\Post", "create"),
    uri("admin/Post/store", "Admin\Post", "store", "POST"),
    uri("admin/Post/edit/{id}", "Admin\Post", "edit"),
    uri("admin/Post/update/{id}", "Admin\Post", "update", "POST"),
    uri("admin/Post/delete/{id}", "Admin\Post", "delete"),
    uri("admin/Post/show/{id}", "Admin\Post", "show"),
    uri("admin/Post/selected/{id}", "Admin\Post", "selected"),
    uri("admin/Post/breaking-news/{id}", "Admin\Post", "breakingNews"),


    //Banners
    uri("admin/Banner", "Admin\Banner", "index"),
    uri("admin/Banner/create", "Admin\Banner", "create"),
    uri("admin/Banner/store", "Admin\Banner", "store", "POST"),
    uri("admin/Banner/edit/{id}", "Admin\Banner", "edit"),
    uri("admin/Banner/update/{id}", "Admin\Banner", "update", "POST"),
    uri("admin/Banner/delete/{id}", "Admin\Banner", "delete"),


    //Users
    uri("admin/User", "Admin\User", "index"),
    uri("admin/User/create", "Admin\User", "create"),
    uri("admin/User/store", "Admin\User", "store", "POST"),
    uri("admin/User/edit/{id}", "Admin\User", "edit"),
    uri("admin/User/update/{id}", "Admin\User", "update", "POST"),
    uri("admin/User/permission/{id}", "Admin\User", "permission"),
    uri("admin/User/delete/{id}", "Admin\User", "delete"),


    //Comments
    uri("admin/Comment", "Admin\Comment", "index"),
    uri("admin/Comment/status/{id}", "Admin\Comment", "status"),
    uri("admin/Comment/show/{id}", "Admin\Comment", "show"),
    uri("admin/Comment/redirect-back", "Admin\Comment", "rb"),


    //Menus
    uri("admin/Menu", "Admin\Menu", "index"),
    uri("admin/Menu/create", "Admin\Menu", "create"),
    uri("admin/Menu/store", "Admin\Menu", "store", "POST"),
    uri("admin/Menu/edit/{id}", "Admin\Menu", "edit"),
    uri("admin/Menu/update/{id}", "Admin\Menu", "update", "POST"),
    uri("admin/Menu/show/{id}", "Admin\Menu", "show"),
    uri("admin/Menu/delete/{id}", "Admin\Menu", "delete"),


    //Setting
    uri("admin/Setting", "Admin\Setting", "index"),
    uri("admin/Setting/edit/{id}", "Admin\Setting", "edit"),
    uri("admin/Setting/update/{id}", "Admin\Setting", "update", "POST"),


    //Dashboard
    uri("admin/Dashboard", "Admin\Dashboard", "index")




];

if (!in_array(true, $routes)) {
    echo "404 Not Found";
}
