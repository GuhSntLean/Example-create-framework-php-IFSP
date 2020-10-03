<?php

require_once ('autoload.php');

session_start();

use Source\Controller\Controller;
use Source\DB\Model;

$app = new Controller();

$app->run();