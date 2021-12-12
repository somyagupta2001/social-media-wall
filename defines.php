<?php

    session_start();
    define('FACEBOOK_APP_ID', '599556944588972');
    define('FACEBOOK_APP_SECRET','b29884cd52e206b4c62634325385a93e');
    define('FACEBOOK_REDIRECT_URI','http://localhost:3000/fb-login.php');
    define('ENDPOINT_BASE', 'https://graph.facebook.com/v5.0/');

    $accessToken = 'EAAIhSzq0cKwBANVybLQJquwbEKj6xNqwe0ELwdEf4mgipiAf7uhtC7zpfyP4TR7uHDHR6p4yNqWZBPkXd3Q5ZCk9AMLXQNFm0exhiT1KMaVZCtSUHNgpIqP3axnx4pEzUZBQKuN1GwtutTX8EOkToPNKZCznWB7fZBPhp4d2b8v4nS7ERxTLgyFhidWGN0jIk0Ns65AbW5zWD5y0tWTpihzXEBgoOKbt0akdB4rjVKb7PVZAZBakrsrK';

    $pageId = '101323832415215';

    $instagramAccountId = '17841450738833960';