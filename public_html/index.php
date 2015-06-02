<?php
require('MyCMS/autoload.php');
//Everything beyond this line should be created by the projects developer
$engine = new Template("templates/index.tpl"); //Initiate template engine, using template templates/index.tpl
$mycms = new MyCMS(); //Load core MyCMS class
//var_dump($engine);
$engine->set("title", "MyCMS"); //Set variable in template. Variable is identified in tpl file as [@title]
function setPost($id, $place) {
    global $engine;
    global $mycms;
    $engine->set("post->" . (string) $place . "->title", $mycms->getPost($id)['title']);
    $engine->set("post->" . (string) $place . "->content", $mycms->getPost($id)['content']);
}
setPost(4, 1);
setPost(3, 2);
setPost(2, 3);
setPost(1, 4);
if ($_SESSION['user_is_logged_in']) { //Authenication session is provided
    $engine->set("username", $_SESSION['user_name']);
    $engine->set("action", "Log out");
    $engine->set("actionparms", "?action=logout");

}
else {
    $engine->set("username", "Not logged in");
    $engine->set("action", "Log in");
    $engine->set("actionparms", "");
}

$engine->output(1); //Echo out the new HTML