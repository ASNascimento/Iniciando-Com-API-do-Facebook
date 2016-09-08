<?php

session_start();
require_once 'Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '{ID do Aplicativo}',
  'app_secret' => '{Chave Secreta do Aplicativo}',
  'default_graph_version' => 'v2.5',
]);