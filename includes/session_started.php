<?php
if (isset($_SESSION['user'])) {
    header("Location: ./?user=dashboard");
    exit();
}

if (isset($_SESSION['admin'])) {
    header("Location: ./?admin=dashboard");
    exit();
}
?>
