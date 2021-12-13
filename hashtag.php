<?php

    include 'defines.php';

    function makeApiCall($endpoint, $type, $params){   
        $ch = curl_init();

        if('POST'==$type) {
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_POST, 1);
        } elseif('GET'==$type) {
            curl_setopt($ch, CURLOPT_URL, $endpoint . '?' . http_build_query($params));
        }
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    $hashtag = 'icecream';
    $hashtagId = '17843841292045246';

    $hashtagSearchEndpointFormat = ENDPOINT_BASE . 'ig_hashtag_search?user_id={user-id}&q={hashtag-name}&fields=id,name';
    $hashtagDataEndpointFormat = ENDPOINT_BASE . '{hashtag-id}?fields=id,name';
    $hashtagTopMediaEndpointFormat = ENDPOINT_BASE . '{ig-hashtag-id}/top_media?user_id={user-id}&fields=id,caption,children,comments_count,like_count,media_type,media_url,permalink';
	$hashtagRecentEndpointFormat = ENDPOINT_BASE . '{ig-hashtag-id}/recent_media?user_id={user-id}&fields=id,caption,children,comments_count,like_count,media_type,media_url,permalink';
    $hashtagSearchEndpoint = ENDPOINT_BASE . 'ig_hashtag_search';
    $hashtagSearchParams = array(
        'user_id' => $instagramAccountId,
        'fields'=> 'id,name',
        'q' => $hashtag,
        'access_token' => $accessToken
    );

    //$hashtagSearch = makeApiCall($hashtagSearchEndpoint, 'GET', $hashtagSearchParams);

    $hashtagDataEndpoint = ENDPOINT_BASE . $hashtagId;
    $hashtagDataParams = array(
        'fields' => 'id,name',
        'access_token' => $accessToken
    );

    //$hashtagData = makeApiCall($hashtagDataEndpoint, 'GET', $hashtagDataParams);

    $hashtagTopMediaEndpoint = ENDPOINT_BASE . $hashtagId . '/top_media';
	$hashtagTopMediaParams = array(
		'user_id' => $instagramAccountId,
		'fields' => 'id,caption,children{media_type,media_url},comments_count,like_count,media_type,media_url,permalink',
		'access_token' => $accessToken
	);
	//$hashtagTopMedia = makeApiCall( $hashtagTopMediaEndpoint, 'GET', $hashtagTopMediaParams );

    $hashtagRecentEndpoint = ENDPOINT_BASE . $hashtagId . '/recent_media';
	$hashtagRecentParams = array(
		'user_id' => $instagramAccountId,
		'fields' => 'id,caption,children{media_type,media_url},comments_count,like_count,media_type,media_url,permalink',
		'access_token' => $accessToken
	);
	$hashtagPosts = makeApiCall( $hashtagRecentEndpoint, 'GET', $hashtagRecentParams );

    // echo '<pre>';
    // print_r($hashtagPosts);

    

    function displayPost($postData){
        if($postData['media_type']=='IMAGE') {
            echo '<div style="display: flex; flex-direction: column; margin: 2rem; padding: 1rem; border: 2px solid black; width: 35rem;">';
            echo '<img src="' . $postData['media_url'] . '" alt="" style="width:10rem;height:10rem; margin: 1rem;">';
            echo '<span style="margin: 1rem; margin-top: 0; word-wrap: break-word;">' . $postData['caption'] . '</span></div>';
        }
        elseif($postData['media_type']=='VIDEO') {
            echo '<div style="display: flex; flex-direction: column; margin: 2rem; padding: 1rem; border: 2px solid black; width: 35rem;">';
            echo '<video width="100" height="100" autoplay muted>
            <source src="' . $postData['media_url'] . '" movie.mp4" type="video/mp4">
            Your browser does not support the video tag.
            </video>';
            echo '<span style="margin: 1rem; margin-top: 0; word-wrap: break-word;">' . $postData['caption'] . '</span></div>';
        }
        elseif($postData['media_type']=='CAROUSEL_ALBUM') {
            echo '<div style="display: flex; flex-direction: column; margin: 2rem; padding: 1rem; border: 2px solid black; width: 35rem;"><div style="display: flex; flex-direction: column; margin: 2rem;">';
            array_map('carouselDisplay',$postData['children']['data']);
            echo '</div><span style="margin: 1rem; margin-top: 0; word-wrap: break-word;">' . $postData['caption'] . '</span></div>';
        }
    }

    function carouselDisplay($childData){
        if($childData['media_type']=='IMAGE') {
            echo '<img src="' . $childData['media_url'] . '" alt="" style="width:10rem;height:10rem; margin: 1rem;">';
        }
        elseif($childData['media_type']=='VIDEO') {
            echo '<video width="100" height="100" autoplay muted>
            <source src="' . $childData['media_url'] . '" movie.mp4" type="video/mp4">
            Your browser does not support the video tag.
            </video>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hashtag Search</title>
</head>
<body>
    <h1>Top Media for #<?php echo $hashtag ?></h1> 
    <div style='display: flex; flex-direction: row; flex-wrap: wrap;'>
        <?php array_map('displayPost',$hashtagPosts['data']) ?>
    </div>
</body>
</html>