<?php

    session_start();
    define('FACEBOOK_APP_ID', '599556944588972');
    define('FACEBOOK_APP_SECRET','b29884cd52e206b4c62634325385a93e');
    define('FACEBOOK_REDIRECT_URI','http://localhost:3000/fb-login.php');
    define('ENDPOINT_BASE', 'https://graph.facebook.com/v5.0/');

    $accessToken = 'EAAIhSzq0cKwBACx3dLhJzrHbfJ2X7nvuMMfWVWzsVNjEDwJgup3pauKNhPIVnlI9cPB7NbgqfeGoZCm1D8gziZCMZAh68covuY52jiczaAr44bA7oDsbFNK27lbV6qkyh27hBBOh6o20Ku94IXnbV8Ez9qyrs0siuAArQo8fNjttfo3TrjzBipww4V62w7NrTDdWgpGAt9JJJNkHOal1wdp4utECIZCyshPu8M4JnzOSfjdspxPk';

    $pageId = '101323832415215';

    $instagramAccountId = '17841450738833960';