<header class="header">

    <div>
        <h3>Dashboard</h3>
    </div>

    <div class="header-user">

        <span>
            <?= $_SESSION['user']['name']; ?>
        </span>
        <span>
            <?= $_SESSION['user']['role']; ?>
        </span>

        <a href="<?= BASE_URL ?>/logout">
            Logout
        </a>

    </div>

</header>