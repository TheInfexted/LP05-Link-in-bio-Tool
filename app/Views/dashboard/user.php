<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-user-cog"></i> User Settings</h2>
    </div>
    <div class="card-body">
        <form action="/admin/user" method="POST" id="userSettingsForm">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= esc($user['username']) ?>" required>
                        <small class="text-muted">Your unique username</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                        <small class="text-muted">Your login email address</small>
                    </div>

                    <div class="settings-info-box">
                        <i class="fas fa-info-circle"></i>
                        <strong>Password Change</strong>
                        <p class="mb-0" style="margin-top: 8px;">Leave password fields empty if you don't want to change your password.</p>
                    </div>
                </div>
                
                <div class="col-md-6">                    
                    <div class="form-group">
                        <label for="current_password" class="form-label">
                            <i class="fas fa-lock"></i> Current Password
                        </label>
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
                        <small class="text-muted">Required to change password</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password" class="form-label">
                            <i class="fas fa-key"></i> New Password
                        </label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
                        <small class="text-muted">Minimum 8 characters</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password" class="form-label">
                            <i class="fas fa-key"></i> Confirm New Password
                        </label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
                        <small class="text-muted">Re-enter your new password</small>
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Settings
                </button>
                <a href="/admin/dashboard" class="btn btn-secondary ms-2">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

