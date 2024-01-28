<?php

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    session_destroy();
    header("Location: ./?admin=login");
    exit();
}

if (isset($_SESSION['user'])) {
    header("Location: ./?user=dashboard");
    exit();
}

if ($_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_destroy();
    header("Location: ./?admin=login");
    exit();
}

?>
