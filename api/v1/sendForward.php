<?php
    require $_SERVER["DOCUMENT_ROOT"]."/include/config.php";
    require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

    $session = new SpotifyWebAPI\Session(
        $spotify_client_id,
        $spotify_client_secret,
    );


    // Create connection
    $conn = new mysqli($mysql_ip, $mysql_username, $mysql_password, $mysql_dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT refresh_token, token FROM opzioni";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $accessToken = $row["token"];
        $refreshToken = $row["refresh_token"];
    }
    } else {
    echo "0 results";
    }
    $conn->close();


    // Use previously requested tokens fetched from somewhere. A database for example.
    if ($accessToken) {
        $session->setAccessToken($accessToken);
        $session->setRefreshToken($refreshToken);
    } else {
        // Or request a new access token
        $session->refreshAccessToken($refreshToken);
    }

    $options = [
        'auto_refresh' => true,
    ];



    $api = new SpotifyWebAPI\SpotifyWebAPI($options, $session);

    // Fetch the saved access token from somewhere. A database for example.
    
    // hot hits italia playlist
    var_dump($api->next());