<header class="user-select-none">
    <nav class="navbar navbar-expand-lg navbar-dark mb-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center m-0" href="./">
                <img class="d-inline-block align-text-top" src="./assets/img/logo.png" alt="Logo" width="64" height="64">
                <span class="ms-2 fs-5">VirtuHomes</span>
            </a>
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header text-white border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">VirtuHomes</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                    <ul class="navbar-nav justify-content-center align-items-center gap-3 fs-5 flex-grow-1 flex-shrink-1">
                        <li class="nav-item">
                            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/virtuhomes/') ? 'active neon-border-content' : '' ?>" href="./">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/?apartment=list') !== false ? 'active neon-border-content' : '' ?>" href="./?apartment=list">Apartamentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/?contact=info') !== false ? 'active neon-border-content' : '' ?>" href="./?contact=info">Contacto</a>
                        </li>
                    </ul>
                    <!-- Login / Sign up -->
                    <div class="d-flex justify-content-center align-items-center gap-3">
                    <?php session_start(); ?>
                    <?php if (isset($_SESSION['user'])): ?>
                        <a class="text-white fw-semibold" href="./?user=dashboard" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Ir al dashboard">
                            <?= $_SESSION['user']['nombre'] ?>
                        </a>
                        <a class="text-white text-decoration-none fw-semibold" href="./?user=shopcar" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Ver carrito de compras">
                            <i class="fa-solid fa-cart-shopping"></i> <?php echo count($_SESSION['shopcar']) ?>
                        </a>
                        <a class="text-white text-decoration-none px-3 py-1 bg-danger rounded" href="./?user=logoff">Log Off</a>
                    <?php elseif (isset($_SESSION['admin'])): ?>
                        <a class="text-danger fw-semibold" href="./?admin=settings">Dashboard</a>
                        <a class="text-white text-decoration-none px-3 py-1 bg-danger rounded" href="./?admin=logoff">Log Off</a>
                    <?php else: ?>
                        <?php session_destroy(); ?>
                        <a class="text-white" href="./?user=login">Login</a>
                        <a class="text-white text-decoration-none px-3 py-1 bg-primary rounded-4" href="./?user=signup">Sign Up</a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
