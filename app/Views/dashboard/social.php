<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-share-alt"></i> Social Media Links</h2>
            </div>
            <div class="card-body">
                <?php if (empty($socialLinks)): ?>
                    <div class="empty-state">
                        <i class="fas fa-share-alt"></i>
                        <h3>No Social Links Yet</h3>
                        <p>Add your first social media link using the form on the right</p>
                    </div>
                <?php else: ?>
                    <div class="sortable-social" id="sortable-social">
                        <?php foreach ($socialLinks as $social): ?>
                            <div class="link-preview draggable-social" data-social-id="<?= $social['id'] ?>">
                                <div class="drag-handle">
                                    <i class="fas fa-grip-vertical"></i>
                                </div>
                                <div class="link-preview-info">
                                    <div class="link-preview-title">
                                        <i class="fab fa-<?= strtolower($social['platform']) ?>"></i>
                                        <?= esc($social['platform']) ?>
                                    </div>
                                    <div class="link-preview-url">
                                        <?= esc($social['url']) ?>
                                    </div>
                                </div>
                                <div class="link-preview-actions">
                                    <a href="<?= esc($social['url']) ?>" class="btn btn-info btn-sm" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="/admin/social/delete/<?= $social['id'] ?>" class="btn btn-danger btn-sm delete-link">
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
                <h2 class="card-title"><i class="fas fa-plus"></i> Add Social Link</h2>
            </div>
            <div class="card-body">
                <form action="/admin/social/add" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="platform" class="form-label">Platform *</label>
                        <select class="form-control" id="platform" name="platform" required>
                            <option value="">Select Platform</option>
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="twitter">Twitter / X</option>
                            <option value="telegram">Telegram</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="youtube">YouTube</option>
                            <option value="tiktok">TikTok</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="github">GitHub</option>
                            <option value="discord">Discord</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="url" class="form-label">URL *</label>
                        <input type="url" class="form-control" id="url" name="url" required placeholder="https://facebook.com/yourpage">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-plus"></i> Add Social Link
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

