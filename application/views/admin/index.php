<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qitkif | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('public/css/admin.css') ?>" id="style">
    <link rel="stylesheet" href="<?= base_url('public/css/admin_dark.css') ?>" id="style">
</head>
<body class="">
    <div class="backdrop d-none" id="backdrop"></div>
    <div class="header">
        <div class="wrapper">
            <div class="_navbar">
                <div class="_navbar-logo">
                    <span role="button" class="menu-hamborger" onclick="toggleSidebar()">
                        <i class="fa-solid fa-bars"></i>
                    </span>
                    <img src="<?= base_url('public/images/logo.png') ?>" alt="logo" class="logo-img">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <span class="mode-menu" role="button" onclick="toggleMode(this)" data-light="true">
                        <i class="fa-solid fa-moon"></i>
                    </span>
                    <a class="msg-menu ms-3" role="button" href="<?= base_url('admin/messenger') ?>" onclick="openMessengerPage(event,this)">
                        <i class="fa-solid fa-envelope"></i>
                        <?php if((int)$unreadMessage) : ?>
                            <span class="_badge" id="unread-message-count"><?= $unreadMessage ?></span>
                        <?php else: ?>
                            <span class="_badge" id="unread-message-count"></span>
                        <?php endif; ?>
                    </a>
                    <div class="position-relative">
                        <span class="profil-menu ms-3" onclick="toggleUserMenu()">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <div class="user-menu-wrapper shadow shadow-sm py-2 d-none">
                            <a href="<?= base_url('admin/profil') ?>" class="user-menu-link sidebar-link"><i class="fa-solid fa-marker"></i><span class="ms-2">Modifier mon profil</span></a>
                            <a href="<?= base_url('admin/logout') ?>" class="user-menu-link"><i class="fa-solid fa-right-from-bracket"></i><span class="ms-2">Se deconnecter</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="message-success-wrapper" id="message-success">
            <div class="position-relative w-100 h-100 d-flex align-items-center px-3">
                <span class="message-success-close" role="button" onclick="hideSuccessAlert()">
                    <i class="fa-solid fa-xmark"></i>
                </span>
                <span class="message-success-icon">
                    <i class="fa-solid fa-check"></i>
                </span>
                <span class="message-success-text">Enregistrement effectué</span>
            </div>
        </div>
        <div class="wrapper">
            <div class="sidebar">
                <div class="pt-2">
                    <span class="sidebar-title">
                        <span>Pages</span>
                        <span class="line"></span>
                    </span>
                    <div class="pt-2">
                        <a href="<?= base_url('admin/header') ?>" class="sidebar-link active">
                            <span class="icon"><i class="fa-solid fa-house"></i></span>
                            <span class="ms-2">Entête</span>
                        </a>
                        <a href="<?= base_url('admin/description') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-rectangle-list"></i></span>
                            <span class="ms-2">Description</span>
                        </a>
                        <a href="<?= base_url('admin/functionality') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-rectangle-list"></i></span>
                            <span class="ms-2">A propos</span>
                        </a>
                        <a href="<?= base_url('admin/contact') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-address-book"></i></span>
                            <span class="ms-2">Contacts</span>
                        </a>
                        <a href="<?= base_url('admin/faq') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-address-book"></i></span>
                            <span class="ms-2">F.A.Q</span>
                        </a>
                    </div>
                </div>

                <div class="mt-4">
                    <span class="sidebar-title">
                        <span>Application</span>
                        <span class="line"></span>
                    </span>
                    <div class="pt-2">
                        <a href="<?= base_url('admin/categorie') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-grip-vertical"></i></span>
                            <span class="ms-2">Catégories</span>
                        </a>
                        <a href="<?= base_url('admin/operateur') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-phone"></i></span>
                            <span class="ms-2">Operateur téléphonique</span>
                        </a>
                        <a href="<?= base_url('admin/promotion') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-receipt"></i></span>
                            <span class="ms-2">Promotions</span>
                        </a>
                    </div>
                </div>

                <div class="mt-4">
                    <span class="sidebar-title">
                        <span>Service client</span>
                        <span class="line"></span>
                    </span>
                    <div class="pt-2">
                        <a href="<?= base_url('admin/litige') ?>" class="sidebar-link" id="litige-link">
                            <span class="icon"><i class="fa-solid fa-scale-balanced"></i></span>
                            <span class="ms-2">Litiges</span>
                        </a>
                        <a href="<?= base_url('admin/assistance') ?>" class="sidebar-link" id="assist-link">
                            <span class="icon"><i class="fa-solid fa-handshake-angle"></i></span>
                            <span class="ms-2">Assistances</span>
                        </a>
                        <a href="<?= base_url('admin/remboursement') ?>" class="sidebar-link" id="remboursement-link">
                            <span class="icon"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                            <span class="ms-2">Remboursement</span>
                        </a>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="sidebar-title">
                        <span>Utilisateurs</span>
                        <span class="line"></span>
                    </span>
                    <div class="pt-2">
                        <a href="<?= base_url('admin/user') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-list"></i></span>
                            <span class="ms-2">Listes</span>
                        </a>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="sidebar-title">
                        <span>Offre</span>
                        <span class="line"></span>
                    </span>
                    <div class="pt-2">
                        <a href="<?= base_url('admin/offre') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-list"></i></span>
                            <span class="ms-2">Listes</span>
                        </a>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="sidebar-title">
                        <span>Plateforme</span>
                        <span class="line"></span>
                    </span>
                    <div class="pt-2">
                        <a href="<?= base_url('admin/setting') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-gear"></i></span>
                            <span class="ms-2">Config paiement</span>
                        </a>
                        <a href="<?= base_url('admin/plateforme/compte') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-wallet"></i></span>
                            <span class="ms-2">Compte</span>
                        </a>
                        <a href="<?= base_url('admin/plateforme/numero') ?>" class="sidebar-link">
                            <span class="icon"><i class="fa-solid fa-mobile-screen-button"></i></span>
                            <span class="ms-2">Numéro de paiement</span>
                        </a>
                    </div>
                </div>
                
            </div>
            
            <main class="content-wrapper position-relative">
                <div class="content-loader d-none">
                    <span class="spinner-border spinner-border-sm content-spinner"></span><br>
                    <span>Chargement...</span>
                </div>
                <div class="content">
                    <?php include('header.php') ?>
                </div>
            </main>
            
            <div id="zoom-box" class="zoom-box d-none" onclick="zoomOut()">
                <div class="zoom-image-wrapper">
                    <img src="<?= base_url('public/images/profils/John-1672316769.jpg') ?>">
                </div>
            </div>
            <div class="messenger shadow rounded d-none"></div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="<?= base_url('public/js/helpers.js?v='. APP_VERSION) ?>"></script>
    <script src="<?= base_url('public/js/admin/interface.js?v='. APP_VERSION) ?>"></script>
    <script src="<?= base_url('public/js/admin/websocket.js?v='. APP_VERSION) ?>"></script>
    <script src="<?= base_url('public/js/admin/index.js') ?>"></script>
    <script src="<?= base_url('public/js/main.js?v='. APP_VERSION) ?>"></script>
</body>
</html>