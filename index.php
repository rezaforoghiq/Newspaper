<?php

use database\Dataase;
use Admin\Category;

//session start
session_start();

define('BASE_PATH',__DIR__);

define('CURRENT_DOMAIN', currentDomain() . '/project/');

define('DISPLAY_ERRORS', true);

// Database properties
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'project');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// for connect to the database ==> please uncomment the above database properties



// routing system

function uri($reservedUrl, $class, $method, $requestMethod = "GET"){
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

    for ($key = 0; $key < sizeof($currentUrlArrar); $key++){
        if ($reservedUrlArray[$key][0] == "{" && $reservedUrlArray[$key][strlen($reservedUrlArray[$key]) - 1] == "}"){
            array_push($parametres, $currentUrlArrar[$key]);
        }
        elseif($currentUrlArrar[$key] !== $reservedUrlArray[$key]){
            $match = false;
            break;
        }

        if(methodFiled() == "POST"){
            $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
            $parametres = array_merge([$request], $parametres);
        }
    }

    if($match){
        $object = new $class;
        call_user_func_array(array($object, $method), $parametres);
        return true;
    }

    return false;
}

// reserved routing system


// helpers
function protocol(){
    if (stripos($_SERVER["SERVER_PROTOCOL"], "https") === true){
        return "https://";
    }else{
        return "http://";
    }
}

function currentDomain(){
    return protocol() . $_SERVER["HTTP_HOST"];
}

function dd($var){
    echo "<pre>";
    var_dump($var);
    exit;
}

function asset($src){
    $domain = trim(CURRENT_DOMAIN, '/');
    $result = $domain . "/" . $src;
    return $result;
}

function url($url){
    $domain = trim(CURRENT_DOMAIN, '/');
    $result = $domain . "/" . $url;
    return $result;
}

function currentUrl(){
    return currentDomain() . $_SERVER["REQUEST_URI"];
}

function displayError($displayError){
    if($displayError === true){
        ini_set("display_errors", 1);
        ini_set("display_startup_errors", 1);
        error_reporting(E_ALL);
    }else{
        ini_set("display_errors", 0);
        ini_set("display_startup_errors", 0);
        error_reporting(0);
    }
}

global $flashMessage;
if(isset($_SESSION["flash_message"])){
    $flashMessage = $_SESSION["flash_message"];
    unset($_SESSION["flash_message"]);
}

function flash($name, $value = null){
    if($value === null){
        global $flashMessage;
        $message = $flashMessage[$name];
        return $message;
    }else{
        $_SESSION["flash_message"][$name] = $value;
    }
}

function methodFiled(){
    $method = $_SERVER["REQUEST_METHOD"];
    return $method;
}


$routes = [
    //Your can here reserving url
];

if(!in_array(true, $routes)){
    echo "404 Not Found";
}
