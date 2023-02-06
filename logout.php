<?php
    // include('include/config.php');
    session_start(); //to ensure you are using same session
    date_default_timezone_set('Asia/Kolkata');
    session_destroy(); //destroy the session
    $cookie_name = "userid";
    $userid = uniqid();
    setcookie($cookie_name, $userid, time() + 3600, '/'); // 86400 = 1 day
        echo "<script>window.location='https://doggtasticadventures.com/'</script>";
    exit();
?>