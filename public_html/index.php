<?php
session_start();
error_reporting(0);
require('MyCMS/main.php');
require("MyCMS/engine.php");
$engine = new Template("templates/index.tpl");
$mycms = new MyCMS();
//var_dump($engine);
$engine->set("title", "MyCMS");
function setPost($id, $place) {
    global $engine;
    global $mycms;
    $engine->set("post->" . (string) $place . "->title", $mycms->getPost($id)['title']);
    $engine->set("post->" . (string) $place . "->content", $mycms->getPost($id)['content']);
}
setPost(1, 1);
setPost(2, 2);
if ($_SESSION['user_is_logged_in']) {
    $engine->set("username", $_SESSION['user_name']);
}
else {
    $engine->set("username", "Not logged in");
}
$engine->output(1);