<?php

session_start();
require_once 'Facebook/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '713557062134772',
    'app_secret' => '378c51abc0c1d4bff9e797737160c97a',
    'default_graph_version' => 'v2.5',
        ]);

