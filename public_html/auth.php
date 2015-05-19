<?php
require_once("MyCMS/login/index.php");
$auth = new OneFileLoginApplication();
switch ($_GET['action']) {
    case "register":
        $register = $auth->createNewUser();
        break;
    case "login":
        
        break;
    case "forgotpassword":
        
        break;
}