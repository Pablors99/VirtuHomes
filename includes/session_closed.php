<?php

if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    session_destroy();
    header("Location: ./?user=login");
    exit();
}


if (isset($_SESSION['admin'])) {
    header("Location: ./?admin=settings");
    exit();
}

if ($_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_destroy();
    header("Location: ./?user=login");
    exit();
}

?>
