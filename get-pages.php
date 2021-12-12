<?php 

    include 'defines.php';

    $endpointFormat = ENDPOINT_BASE . 'me/accounts?access_token={access-token}';
    $pagesEndpoint = ENDPOINT_BASE . 'me/accounts';

    $pagesParams = array(
        'access_token' => $accessToken
    );

    $pagesEndpoint .= '?' . http_build_query($pagesParams);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $pagesEndpoint);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    $responseArray = json_decode($response, true);
    unset($responseArray['data'][0]['access_token']);

    echo '<pre>';
    print_r($responseArray);
    die();