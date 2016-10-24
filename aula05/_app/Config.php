<?php

session_start();
require_once 'Facebook/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '1749977245264591',
    'app_secret' => 'd2586ad2a80121c36f2e6dea340f80ff',
    'default_graph_version' => 'v2.7',
        ]);

