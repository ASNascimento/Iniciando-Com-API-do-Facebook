<?php

require_once '_app/Config.php';

$Login = $fb->getRedirectLoginHelper();
$permissions = ['email', 'publish_actions'];

try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $Login->getAccessToken();
    }
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
if (isset($accessToken)) {
    if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        $oAuth2Client = $fb->getOAuth2Client();
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    $code = filter_input(INPUT_GET, 'code', FILTER_DEFAULT);
    if (isset($code)) {
        header('Location: ./');
    }
    try {
        $posts_request = $fb->get('/me/posts?fields=name,link,type,status_type&limit=2');
        $posts = $posts_request->getGraphEdge()->asArray();

        $post = [
            "message" => "Comece hoje mesmo a fazer integração com facebook em seu site Vlw",
            "link" => "http://alexnascimento.com.br",
            "picture" => "http://globoesporte.globo.com/platb/files/166/2013/04/Hulk1.jpg",
        ];

        //$enviar_post = $fb->post('/me/feed', $post);
        //$response = $enviar_post->getGraphNode()->asArray();

        //var_dump($response);
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }


    var_dump($posts);

    $logoff = filter_input(INPUT_GET, 'sair', FILTER_DEFAULT);
    if (isset($logoff) && $logoff == 'true'):
        session_destroy();
        header("Location: ./");
    endif;

    echo '<a href="?sair=true">Sair</a>';
}else {
    $Login = $fb->getRedirectLoginHelper();
    $loginUrl = $Login->getLoginUrl('http://localhost/html/fb/aula07/', $permissions);
    echo '<a href="' . $loginUrl . '">Entrar com facebook</a>';
    var_dump($_SESSION);
}
