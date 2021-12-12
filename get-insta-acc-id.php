<?php 

    include 'defines.php';

    $endpointFormat = ENDPOINT_BASE . '{page-id}?fields=instagram_business_account&access_token={access-token}';
    $instaAccountEndpoint = ENDPOINT_BASE . $pageId;

    $igParams = array(
        'fields' => 'instagram_business_account',
        'access_token' => $accessToken
    );

    $instaAccountEndpoint .= '?' . http_build_query($igParams);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $instaAccountEndpoint);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    $responseArray = json_decode($response, true);

    echo '<pre>';
    print_r($responseArray);
    die();