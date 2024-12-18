<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title><?php isset($pageTitle) ? $pageTitle : 'Toko Kita' ?></title>

    <!-- Site favicon -->
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="/backend/vendors/images/apple-touch-icon.png"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="/backend/vendors/images/favicon-32x32.png"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="/backend/vendors/images/favicon-16x16.png"
    />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/style.css" />

    <?php $this->renderSection('stylesheets') ?>
    <style>
        /* CSS untuk menyesuaikan tampilan teks Toko Kita */
        .brand-logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }
        .brand-logo a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="<?= route_to('/') ?>">
                    <!-- Menampilkan teks Toko Kita -->
                    Toko Kita
                </a>
            </div>
            <div class="login-menu">
                <!-- Bisa menambahkan menu lainnya di sini -->
            </div>
        </div>
    </div>

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="/backend/vendors/images/login-page-img.png" alt="Login Page Image" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <?php $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

    <script src="/backend/vendors/scripts/core.js"></script>
    <script src="/backend/vendors/scripts/script.min.js"></script>
    <script src="/backend/vendors/scripts/process.js"></script>
    <script src="/backend/vendors/scripts/layout-settings.js"></script>
    <?php $this->renderSection('scripts') ?>
</body>
</html>
