<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-images"></i> Carousel Images</h2>
            </div>
            <div class="card-body">
                <?php if (empty($images)): ?>
                    <div class="empty-state">
                        <i class="fas fa-images"></i>
                        <h3>No Images Yet</h3>
                        <p>Add your first carousel image using the form on the right</p>
                    </div>
                <?php else: ?>
                    <div class="row sortable-carousel" id="sortable-carousel">
                        <?php foreach ($images as $image): ?>
                            <div class="col-md-6 mb-4 draggable-carousel-item" data-carousel-id="<?= $image['id'] ?>">
                                <div class="card">
                                    <div class="drag-handle-carousel">
                                        <i class="fas fa-grip-vertical"></i>
                                    </div>
                                    <img src="/<?= $image['image_path'] ?>" class="card-img-top" alt="Carousel Image" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <div class="mt-2">
                                            <a href="/admin/carousel/delete/<?= $image['id'] ?>" class="btn btn-danger btn-sm delete-link">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </div>
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
                <h2 class="card-title"><i class="fas fa-plus"></i> Add Carousel Image</h2>
            </div>
            <div class="card-body">
                <form action="/admin/carousel/add" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="image" class="form-label">Image *</label>
                        <input type="file" class="form-control form-control-file" id="image" name="image" accept="image/*" required data-preview="carouselPreview">
                        <small class="text-muted">Recommended size: 800x400px</small>
                    </div>
                    
                    <div class="form-group">
                        <img id="carouselPreview" style="display: none; max-width: 100%; max-height: 200px; margin-top: 10px; border-radius: 10px;">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-plus"></i> Add Image
                    </button>
                </form>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-body">
                <h5><i class="fas fa-info-circle"></i> Tips</h5>
                <ul class="mb-0">
                    <li>Upload high-quality images</li>
                    <li>Use consistent dimensions</li>
                    <li>Keep file sizes reasonable</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

