<?php
include('config/config.php');
include('Core/core.php');

$core = \Core\core::getInstance();
$core->init();
$core->run();
$core->done();


