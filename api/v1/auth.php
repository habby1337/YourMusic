<?php
    require $_SERVER["DOCUMENT_ROOT"]."/include/config.php";
    require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

    $session = new SpotifyWebAPI\Session(
        $spotify_client_id,
        $spotify_client_secret,
        $spotify_redirect_uri
    );

    $options = [
        'scope' => [
            'ugc-image-upload',
            'user-follow-read',
            'user-follow-modify',
            'user-read-recently-played',
            'user-top-read',
            'user-read-playback-position',
            'user-library-read',
            'user-library-modify',
            'user-read-playback-state',
            'user-read-currently-playing',
            'user-modify-playback-state',
            'playlist-read-collaborative',
            'playlist-modify-private',
            'playlist-modify-public',
            'playlist-read-private',
            'streaming',
            'app-remote-control',
            'user-read-email',
            'user-read-private',
        ],
    ];

    $api = new SpotifyWebAPI\SpotifyWebAPI($options, $session);
    
    header('Location: ' . $session->getAuthorizeUrl($options));
    die();