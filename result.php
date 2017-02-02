<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '1');

include(dirname(__FILE__).'/qGraphAPI.php');

$objQG = new qGraphAPI();
$res = $objQG->sendNotification('14517','6973', 'android', 'hi this is for testing');
print_r($res);