<?php
declare(strict_types=1);

$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

if (is_dir(__DIR__ . '/../vendor/')) {
    $vendorRoot = __DIR__ . '/../vendor'; //this extension has its own vendor folder
} else {
    $vendorRoot = __DIR__ . '/../../..'; //this extension is part of a project vendor folder
}

require_once($vendorRoot . '/autoload.php');
