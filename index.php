<?php

$controller = $_GET['c']?? 'Home';
$method     = $_GET['m']?? 'index';

require_once "controller/Controller.class.php";
require_once "controller/$controller.class.php";

//run!
$c = new $controller;
$c->$method();