<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'PhantomFrame' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>PhantomFrame</h1>
            <nav>
                <ul>
                    <li><a href="/">Main</a></li>
                    <li><a href="/users">Users</a></li>
                    <li><a href="/about">About us</a></li>
                    <li><a href="/contact">Contacts</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main class="container">
        <?php if (isset($content)): ?>
            <div class="content">
                <?= $content ?>
            </div>
        <?php else: ?>
            <?= $yield ?? '' ?>
        <?php endif; ?>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> PhantomFrame</p>
        </div>
    </footer>
    
    <script src="<?= BASE_URL ?>public/js/main.js"></script>
</body>
</html>