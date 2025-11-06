<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-cog"></i> Page Settings</h2>
    </div>
    <div class="card-body">
        <form action="/admin/settings" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="header_image" class="form-label">
                            <i class="fas fa-image"></i> Header Image
                        </label>
                        <?php if (!empty($page['header_image'])): ?>
                            <div class="mb-3">
                                <img src="/<?= $page['header_image'] ?>" alt="Current Header" style="max-width: 100%; max-height: 200px; border-radius: 10px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control form-control-file" id="header_image" name="header_image" accept="image/*" data-preview="headerPreview">
                        <img id="headerPreview" style="display: none; max-width: 100%; max-height: 200px; margin-top: 10px; border-radius: 10px;">
                        <small class="text-muted">Recommended size: 800x400px</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="background_image" class="form-label">
                            <i class="fas fa-image"></i> Background Image
                        </label>
                        <?php if (!empty($page['background_value']) && $page['background_type'] == 'image'): ?>
                            <div class="mb-3">
                                <img src="/<?= $page['background_value'] ?>" alt="Current Background" style="max-width: 100%; max-height: 200px; border-radius: 10px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control form-control-file" id="background_image" name="background_image" accept="image/*" data-preview="backgroundPreview">
                        <img id="backgroundPreview" style="display: none; max-width: 100%; max-height: 200px; margin-top: 10px; border-radius: 10px;">
                        <small class="text-muted">This will replace the entire landing page background</small>
                    </div>
                    
                    <?php if (!empty($page['background_value']) && $page['background_type'] == 'image'): ?>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger" id="removeBackgroundBtn">
                                <i class="fas fa-trash"></i> Remove Current Background Image
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subtitle_1" class="form-label">
                            <i class="fas fa-heading"></i> Subtitle 1
                        </label>
                        <input type="text" class="form-control" id="subtitle_1" name="subtitle_1" value="<?= $page['subtitle_1'] ?? '' ?>" placeholder="Enter subtitle 1">
                    </div>
                    
                    <div class="form-group">
                        <label for="subtitle_2" class="form-label">
                            <i class="fas fa-heading"></i> Subtitle 2
                        </label>
                        <input type="text" class="form-control" id="subtitle_2" name="subtitle_2" value="<?= $page['subtitle_2'] ?? '' ?>" placeholder="Enter subtitle 2">
                    </div>
                    
                    <div class="form-group">
                        <label for="subtitle_3" class="form-label">
                            <i class="fas fa-heading"></i> Subtitle 3
                        </label>
                        <input type="text" class="form-control" id="subtitle_3" name="subtitle_3" value="<?= $page['subtitle_3'] ?? '' ?>" placeholder="Enter subtitle 3">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="share_enabled" name="share_enabled" value="1" <?= ($page['share_enabled'] ?? 1) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="share_enabled">
                        <i class="fas fa-share"></i> Enable Share Button
                    </label>
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="qr_enabled" name="qr_enabled" value="1" <?= ($page['qr_enabled'] ?? 1) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="qr_enabled">
                        <i class="fas fa-qrcode"></i> Enable QR Code Button
                    </label>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Settings
                </button>
                <a href="/admin" class="btn btn-secondary ms-2">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

