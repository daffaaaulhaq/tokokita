<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Landing Page'; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/frontend.css'); ?>">
</head>
<body>
    <header>
        <h1>Nama Toko</h1>
        <nav>
            <a href="<?= base_url('/'); ?>">Home</a>
            <a href="<?= base_url('/about'); ?>">About</a>
            <a href="<?= base_url('/contact'); ?>">Contact</a>
        </nav>
    </header>

    <main>
        <?= $this->renderSection('content'); ?>
    </main>

    <footer>
        <p>&copy; 2024 Nama Toko. All Rights Reserved.</p>
    </footer>
</body>
</html>
