<nav class="navbar navbar-expand-lg navbar-light bg-black p-2 px-4">
    <a class="navbar-brand text-white" href="/"><?php echo $_settings['TITLE']; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link text-white" aria-current="page" href="/models">Models</a>
            </li>
        </ul>
        <ul class="navbar-nav text-end">
            <?php if (\app\Auth\isAdmin()) require_once __DIR__ . '/AdminButton.php'; ?>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle text-white" id="navbarDropdownMenuLink" href="#" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?></a>
                <div class="dropdown-menu dropdown-menu-right bg-black border-white" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item text-white" href="/account">Account</a>
                <div class="dropdown-divider">Settings</div>
                <a class="dropdown-item text-white" href="/logout">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>