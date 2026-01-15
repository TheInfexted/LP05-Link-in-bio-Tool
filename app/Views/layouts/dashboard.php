<?= $this->extend('layouts/base') ?>

<?= $this->section('meta') ?>
    <title><?= isset($title) ? $title . ' - ' : '' ?>LP Universe CMS</title>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="/assets/css/dashboard.css?v=<?= time() ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-link"></i> LP Universe</h3>
            </div>
            <div class="sidebar-menu">
                <a href="/admin/dashboard" class="menu-item <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/settings" class="menu-item <?= (uri_string() == 'admin/settings') ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i>
                    <span>Page Settings</span>
                </a>
                <a href="/admin/links" class="menu-item <?= (uri_string() == 'admin/links') ? 'active' : '' ?>">
                    <i class="fas fa-link"></i>
                    <span>Manage Links</span>
                </a>
                <a href="/admin/carousel" class="menu-item <?= (uri_string() == 'admin/carousel') ? 'active' : '' ?>">
                    <i class="fas fa-images"></i>
                    <span>Carousel</span>
                </a>
                <a href="/admin/social" class="menu-item <?= (uri_string() == 'admin/social') ? 'active' : '' ?>">
                    <i class="fas fa-share-alt"></i>
                    <span>Social Links</span>
                </a>
                <a href="/admin/user" class="menu-item <?= (uri_string() == 'admin/user') ? 'active' : '' ?>">
                    <i class="fas fa-user-cog"></i>
                    <span>User Settings</span>
                </a>
                <a href="/" class="menu-item" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>View Page</span>
                </a>
                <a href="/admin/logout" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div>
                    <h1 class="page-title"><?= $title ?? 'Dashboard' ?></h1>
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <?= strtoupper(substr(session()->get('email'), 0, 1)) ?>
                    </div>
                    <span><?= session()->get('email') ?></span>
                    <a href="/admin/logout" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Alerts -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <?= $this->renderSection('content') ?>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="/assets/js/dashboard.js?v=<?= time() ?>"></script>
<?= $this->endSection() ?>

