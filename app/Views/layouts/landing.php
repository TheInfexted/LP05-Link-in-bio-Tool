<?= $this->extend('layouts/base') ?>

<?= $this->section('meta') ?>
    <title><?= esc($page['subtitle_1'] ?? 'Landing Page') ?> - LP Universe</title>
    <meta name="description" content="<?= esc($page['subtitle_2'] ?? '') ?>">
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <!-- Custom CSS -->
    <link href="/assets/css/landing.css?v=<?= time() ?>" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Animated Background -->
    <?php if (!empty($page['background_value']) && $page['background_type'] == 'image'): ?>
        <div class="landing-background" style="background-image: url('/<?= $page['background_value'] ?>'); background-size: cover; background-position: center; background-attachment: fixed;"></div>
    <?php else: ?>
        <div class="landing-background tunnel-bg">
            <div class="tunnel-stars"></div>
        </div>
    <?php endif; ?>
    
    <!-- Main Container -->
    <div class="landing-container">
        <?= $this->renderSection('landing_content') ?>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <?= $this->renderSection('landing_scripts') ?>
<?= $this->endSection() ?>

