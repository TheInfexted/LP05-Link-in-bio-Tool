<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon primary">
            <i class="fas fa-eye"></i>
        </div>
        <div class="stat-content">
            <h3><?= number_format($analytics['total_views']) ?></h3>
            <p>Total Views</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon success">
            <i class="fas fa-mouse-pointer"></i>
        </div>
        <div class="stat-content">
            <h3><?= number_format($analytics['total_clicks']) ?></h3>
            <p>Total Clicks</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon warning">
            <i class="fas fa-link"></i>
        </div>
        <div class="stat-content">
            <h3><?= number_format($analytics['active_links']) ?></h3>
            <p>Active Links</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon info">
            <i class="fas fa-share-alt"></i>
        </div>
        <div class="stat-content">
            <h3><?= number_format($analytics['social_links']) ?></h3>
            <p>Social Links</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

