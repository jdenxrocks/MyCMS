<?php
error_reporting(E_ALL);
require('MyCMS/main.php');
require("MyCMS/engine.php");
$engine = new Template("templates/index.tpl");
$mycms = new MyCMS();
//var_dump($engine);
$engine->set("title", "MyCMS");
$engine->set("post->1->title", $mycms->getPost(1)['title']);
$engine->set("post->1->content", $mycms->getPost(1)['content']);
$engine->set("post->2->title", $mycms->getPost(2)['title']);
$engine->set("post->2->content", $mycms->getPost(2)['content']);
$engine->output(1);