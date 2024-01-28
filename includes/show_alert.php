<?php
function showAlert() {
    if (isset($_GET['m']) && isset($_GET['t'])) {
        $message = $_GET['m'];
        $type = $_GET['t'];
        if ($message) {
            $decodedMessage = htmlspecialchars(base64_decode($message), ENT_QUOTES, 'UTF-8');
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    appendAlert("' . $decodedMessage . '", "' . $type . '");';
            echo '});';
            echo '</script>';
        }
    }
    echo '<div id="liveAlertPlaceholder"></div>';
}
?>
