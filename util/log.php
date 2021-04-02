<?php
require_once(__DIR__ . '/../vendor/autoload.php');
use \Katzgrau\KLogger\Logger;

function get_logger() {
    return new Logger(__DIR__. '/../logs/');
}
