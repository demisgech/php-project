<nav class="navbar navbar-expand-lg bg-body-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $_SERVER['REQUEST_URI'] === "/" ? "bg-dark text-white rounded-2" : "" ?>"
                       aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $_SERVER['REQUEST_URI'] === "/about" ? "bg-dark text-white rounded-2" : "" ?>"
                       href="/about">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $_SERVER['REQUEST_URI'] === "/contact" ? "bg-dark text-white rounded-2" : "" ?>"
                       href="/contact">Contact</a>
                </li>
                <?php if ($_SESSION['user'] ?? false): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === "/notes" ? "bg-dark text-white rounded-2" : "" ?>"
                           href="/notes">Notes</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item me-2">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2 w-100" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </li>
                <?php if ($_SESSION['user'] ?? false): ?>
                    <li class="nav-item">
                        <a href="/dashboard"
                           class="p-2 mx-3 nav-link <?= $_SERVER['REQUEST_URI'] === "/dashboard" ? "bg-dark text-white rounded-2" : "" ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form action="/session" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-outline-danger">Logout</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === "/login" ? "bg-dark text-white rounded-2" : "" ?>"
                           href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === "/register" ? "bg-dark text-white rounded-2" : "" ?>"
                           href="/register">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>