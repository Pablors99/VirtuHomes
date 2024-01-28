<?php include './includes/session_closed.php'; ?>
<section id="bienvenida" class="d-flex flex-column gap-4 flex-content-center align-items-center text-center text-white">
    <h1 class="text-uppercase text-center text-white my-3"><span class="text-primary-emphasis">VirtuHomes</span> - <?= $titulo ?></h1>
    <div class="d-flex flex-lg-row flex-column bg-filter text-dark text-center p-3 rounded gap-2 my-2">
        <div class="border border-primary-subtle rounded p-1">
            <a href="./?user=settings" class="btn btn-primary w-100 text-white"><i class="fa-solid fa-gear"></i> Account settings</a>
        </div>
        <div class="border border-primary-subtle rounded p-1">
            <a href="./?user=apartment" class="btn btn-primary w-100 text-white"><i class="fa-solid fa-circle-plus"></i> Add apartment</a>
        </div>
        <div class="border border-primary-subtle rounded p-1">
            <a href="./?user=archived" class="btn btn-primary w-100 text-white"><i class="fa-solid fa-box-archive"></i> View archived apartments</a>
        </div>
        <div class="border border-primary-subtle rounded p-1">
            <a href="./?user=sold" class="btn btn-primary w-100 text-white"><i class="fa-solid fa-handshake"></i> View sold apartments</a>
        </div>
        <div class="border border-primary-subtle rounded p-1">
            <a href="./?user=purchased" class="btn btn-primary w-100 text-white"><i class="fa-solid fa-handshake"></i> View purchased apartments</a>
        </div>
    </div>
    <?php include './includes/show_alert.php'; showAlert(); ?>
</section>
<main class="flex-grow-1 flex-shrink-1">
<section id="inicio" class="d-flex flex-column justify-content-center align-items-center mx-5 gap-2">
<?php
$userPage = $_GET['user'];

switch ($userPage) {
    case 'dashboard':
        include './views/apartments/user_apartments.php';
        break;
    case 'settings':
        include './views/users/settings_user.php';
        break;
    case 'apartment':
        include './views/users/add_apartment_user.php';
        break;
    case 'aupdate':
        include './views/apartments/update_apartment.php';
        break;
    case 'archived':
        include './views/apartments/retired_apartments.php';
        break;
    case 'sold':
        include './views/apartments/sold_apartments.php';
        break;
    case 'purchased':
        include './views/apartments/purchased_apartments.php';
        break;
}
?>
</section>
</main>
