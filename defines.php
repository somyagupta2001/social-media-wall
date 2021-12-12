<?php

    session_start();
    define('FACEBOOK_APP_ID', '599556944588972');
    define('FACEBOOK_APP_SECRET','b29884cd52e206b4c62634325385a93e');
    define('FACEBOOK_REDIRECT_URI','http://localhost:3000/fb-login.php');
    define('ENDPOINT_BASE', 'https://graph.facebook.com/v5.0/');

    $accessToken = 'EAAIhSzq0cKwBAFN5dEnObOwiX2WD9J0484SbFoR6qIAuuSTm9UifIFM4eZC1NoK5sOV4Qgt5zQIwrZCLT1hcwgpoiZAZBZA7HWB8dD59CpER1X8FCUnK4LD6klmvz6WwFBPbvpKPYnP7j56X3TaLlnzIUsPhzNgyViqRqvQbPK3IXDVYfvwN5';

    $pageId = '101323832415215';

    $instagramAccountId = '17841450738833960';