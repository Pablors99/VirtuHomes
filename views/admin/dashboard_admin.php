<?php include './includes/session_closed_admin.php'; ?>
<section id="bienvenida" class="d-flex flex-column gap-4 flex-content-center align-items-center text-center text-white">
    <h1 class="text-uppercase text-center text-white my-3"><span class="text-primary-emphasis">VirtuHomes</span> - <?= $titulo ?></h1>
    <div class="d-flex bg-filter text-dark text-center p-3 rounded gap-2 my-2">
        <div class="border border-primary-subtle rounded p-1">
            <a href="./?admin=settings" class="btn btn-primary btn-block text-white"><i class="fa-solid fa-gear"></i> Config settings</a>
        </div>
        <div class="border border-primary-subtle rounded p-1">
            <a href="./?admin=account" class="btn btn-primary btn-block text-white"><i class="fa-solid fa-circle-plus"></i> Account settings</a>
        </div>
        <div class="border border-primary-subtle rounded p-1">
            <a href="./?admin=archived" class="btn btn-primary btn-block text-white"><i class="fa-solid fa-box-archive"></i> Total archived apartments</a>
        </div>
        <div class="border border-primary-subtle rounded p-1">
            <a href="./?admin=sold" class="btn btn-primary btn-block text-white"><i class="fa-solid fa-handshake"></i> Total sold apartments</a>
        </div>
    </div>
    <?php include './includes/show_alert.php'; showAlert(); ?>
</section>
<main class="flex-grow-1 flex-shrink-1">
<section id="inicio" class="d-flex flex-column justify-content-center align-items-center mx-5 gap-2">
<?php
$adminPage = $_GET['admin'];

switch ($adminPage) {
    case 'settings':
        include './views/admin/settings_admin.php';
        break;
    case 'account':
        include './views/admin/account_admin.php';
        break;
    case 'archived':
        include './views/apartments/retired_apartments.php';
        break;
    case 'sold':
        include './views/apartments/sold_apartments.php';
        break;
}
?>
</section>
</main>
