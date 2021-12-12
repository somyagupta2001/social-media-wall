<?php 
    include 'defines.php';

    require_once __DIR__ . '/vendor/autoload.php' ;

    $creds = array(
        'app_id' => FACEBOOK_APP_ID,
        'app_secret' => FACEBOOK_APP_SECRET,
        'default_graph_version' => 'v3.2',
        'persistent_data_handler' => 'session'
    );

    $facebook = new Facebook\Facebook($creds);

    $helper = $facebook->getRedirectLoginHelper();
    $oAuth2Client = $facebook->getOAuth2Client();

    if(isset($_GET['code'])) {
        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) { //graph error
            echo 'graph returned an error ' . $e->getMessage();
        } catch (Facebook\Exceptions\FacebookSDKException $e) { //graph error
            echo 'Facebook SDK returned an error ' . $e->getMessage();
        }

        if(!$accessToken->isLongLived()) {
            try{
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Error getting long-lived token' . $e->getMessage();
            }
        }

        echo '<pre>';
        var_dump($accessToken);

        $accessToken = (string)$accessToken;

        echo '<h1>Long Lived Access Token</h1>';
        print_r($accessToken);

    } else {
        $permissions = ['public_profile', 'instagram_basic', 'pages_show_list'];
        $loginUrl = $helper->getLoginUrl(FACEBOOK_REDIRECT_URI, $permissions);
        echo '<a href="'.$loginUrl.'">
                LOGIN WITH FACEBOOK
            </a>';
    }