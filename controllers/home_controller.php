<?php
function render($titulo, $page) {
    echo '<!DOCTYPE html>';
    echo '<html lang="es">';
    includeHead($titulo);
    echo '<body class="d-flex flex-column min-vh-100 gap-2">';
    includeHeader();
    //print_r($_SESSION['shopcar']);
    $pageParam = key($_GET);
    $pageGet = !empty($_GET) ? $_GET[$pageParam] : '';
    $defaultPages = ['user' => 'dashboard', 'admin' => 'settings', 'apartment' => 'list', 'contact' => 'info'];
    if (!array_key_exists($pageParam, $defaultPages)) {
        include './includes/main.php';
    } else {
        renderPage($pageParam.'_controller', $pageGet, $defaultPages[$pageParam]);
    }
    includeFooter();
    includeScripts();
    echo '</body>';
    echo '</html>';
}

function includeHead($titulo) {
    include './includes/head.php';
}

function includeHeader() {
    include './includes/header.php';
}

function renderPage($controller, $page, $defaultPage) {
    include_once "$controller.php";
    $instance = new $controller();

    $method = $page;
    if (method_exists($instance, $method)) {
        $instance->$method();
    } else {
        header("Location: ./");
    }
}

function includeFooter() {
    include './includes/footer.php';
}

function includeScripts() {
    include './includes/scripts.php';
}
?>
