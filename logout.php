<?php

session_start();
session_destroy();

require_once 'classes/Config.php';
$logout=new Config;

$logout->redirect('login.php');

