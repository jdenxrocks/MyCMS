<?php
error_reporting(E_ALL);
require('MyCMS/engine.php');
$engine = new Template("templates/index.tpl");
//var_dump($engine);
$engine->set("title", "test");
$engine->set("trail", "and I also want to say this");
$engine->output(1);