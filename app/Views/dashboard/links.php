<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-link"></i> Your Links</h2>
            </div>
            <div class="card-body">
                <?php if (empty($links)): ?>
                    <div class="empty-state">
                        <i class="fas fa-link"></i>
                        <h3>No Links Yet</h3>
                        <p>Add your first link using the form on the right</p>
                    </div>
                <?php else: ?>
                    <div class="sortable-links" id="sortable-links">
                        <?php foreach ($links as $link): ?>
                            <div class="link-preview draggable-link" data-link-id="<?= $link['id'] ?>" style="background-color: <?= $link['background_color'] ?>; color: <?= $link['text_color'] ?>;">
                                <div class="drag-handle">
                                    <i class="fas fa-grip-vertical"></i>
                                </div>
                                <div class="link-preview-info">
                                    <div class="link-preview-title">
                                        <?= esc($link['title']) ?>
                                    </div>
                                    <div class="link-preview-url" style="color: <?= $link['text_color'] ?>; opacity: 0.7;">
                                        <?= esc($link['url']) ?>
                                    </div>
                                    <small style="color: <?= $link['text_color'] ?>; opacity: 0.6;">
                                        <i class="fas fa-mouse-pointer"></i> <?= $link['click_count'] ?> clicks
                                    </small>
                                </div>
                                <div class="link-preview-actions">
                                    <a href="/admin/links/delete/<?= $link['id'] ?>" class="btn btn-danger btn-sm delete-link">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-plus"></i> Add New Link</h2>
            </div>
            <div class="card-body">
                <form action="/admin/links/add" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" required placeholder="e.g., Visit My Website">
                    </div>
                    
                    <div class="form-group">
                        <label for="url" class="form-label">URL *</label>
                        <input type="url" class="form-control" id="url" name="url" required placeholder="https://example.com">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-plus"></i> Add Link
                    </button>
                </form>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-mobile-alt"></i> App Store Links</h2>
            </div>
            <div class="card-body">
                <form action="/admin/links/update-apps" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="ios_app_url" class="form-label">
                            <i class="fab fa-apple"></i> iOS App Store URL
                        </label>
                        <input type="url" class="form-control" id="ios_app_url" name="ios_app_url" 
                               value="<?= esc($page['ios_app_url'] ?? '') ?>" 
                               placeholder="https://apps.apple.com/app/your-app">
                        <small class="text-muted">Leave empty to hide the iOS app button</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="ios_app_image" class="form-label">
                            <i class="fas fa-image"></i> iOS App Button Image
                        </label>
                        <?php if (!empty($page['ios_app_image'])): ?>
                            <div class="mb-3">
                                <img src="/<?= $page['ios_app_image'] ?>" alt="iOS App Image" style="max-width: 100%; max-height: 100px; border-radius: 10px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control form-control-file" id="ios_app_image" name="ios_app_image" accept="image/*" data-preview="iosAppPreview">
                        <img id="iosAppPreview" style="display: none; max-width: 100%; max-height: 100px; margin-top: 10px; border-radius: 10px;">
                        <small class="text-muted">Optional: Upload a custom image for the iOS app button</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="android_app_url" class="form-label">
                            <i class="fab fa-google-play"></i> Google Play Store URL
                        </label>
                        <input type="url" class="form-control" id="android_app_url" name="android_app_url" 
                               value="<?= esc($page['android_app_url'] ?? '') ?>" 
                               placeholder="https://play.google.com/store/apps/details?id=your.app">
                        <small class="text-muted">Leave empty to hide the Android app button</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="android_app_image" class="form-label">
                            <i class="fas fa-image"></i> Android App Button Image
                        </label>
                        <?php if (!empty($page['android_app_image'])): ?>
                            <div class="mb-3">
                                <img src="/<?= $page['android_app_image'] ?>" alt="Android App Image" style="max-width: 100%; max-height: 100px; border-radius: 10px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control form-control-file" id="android_app_image" name="android_app_image" accept="image/*" data-preview="androidAppPreview">
                        <img id="androidAppPreview" style="display: none; max-width: 100%; max-height: 100px; margin-top: 10px; border-radius: 10px;">
                        <small class="text-muted">Optional: Upload a custom image for the Android app button</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Save App Links
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

