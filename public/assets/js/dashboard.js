// Dashboard CMS JavaScript - LP Universe

document.addEventListener('DOMContentLoaded', function() {
    
    // Delete Confirmation
    const deleteLinks = document.querySelectorAll('.delete-link');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });
    
    // Remove Background Image Confirmation
    const removeBackgroundBtn = document.getElementById('removeBackgroundBtn');
    if (removeBackgroundBtn) {
        removeBackgroundBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove the current background image?\n\nThis will revert to the default gradient background.')) {
                // Send AJAX request to remove background
                fetch('/admin/settings/remove-background', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reload the page to show updated settings
                        window.location.reload();
                    } else {
                        alert('Failed to remove background image. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        });
    }
    
    // Image Preview
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const previewId = input.getAttribute('data-preview');
                    if (previewId) {
                        const preview = document.getElementById(previewId);
                        if (preview) {
                            preview.src = event.target.result;
                            preview.style.display = 'block';
                        }
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    });
    
    // Form Validation
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#ef4444';
                } else {
                    field.style.borderColor = '#e5e7eb';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    });
    
    // User Settings Form Validation
    const userSettingsForm = document.getElementById('userSettingsForm');
    if (userSettingsForm) {
        userSettingsForm.addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const currentPassword = document.getElementById('current_password').value;
            
            // If new password is entered, validate
            if (newPassword) {
                if (!currentPassword) {
                    e.preventDefault();
                    alert('Current password is required to change password!');
                    return;
                }
                
                if (newPassword.length < 8) {
                    e.preventDefault();
                    alert('New password must be at least 8 characters!');
                    return;
                }
                
                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert('New passwords do not match!');
                    return;
                }
            }
        });
    }
    
    // Auto-hide alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 300);
        }, 5000);
    });
    
    // Mobile Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }
    
    // Drag and Drop for Links
    const sortableLinks = document.getElementById('sortable-links');
    if (sortableLinks && typeof Sortable !== 'undefined') {
        Sortable.create(sortableLinks, {
            animation: 150,
            handle: '.drag-handle',
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                const linkIds = [];
                const links = sortableLinks.querySelectorAll('.draggable-link');
                links.forEach(function(link) {
                    linkIds.push(link.getAttribute('data-link-id'));
                });
                
                fetch('/admin/links/reorder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ order: linkIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Link order updated successfully');
                    } else {
                        console.error('Failed to update link order');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    }
    
    // Drag and Drop for Carousel
    const sortableCarousel = document.getElementById('sortable-carousel');
    if (sortableCarousel && typeof Sortable !== 'undefined') {
        Sortable.create(sortableCarousel, {
            animation: 150,
            handle: '.drag-handle-carousel',
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                const carouselIds = [];
                const items = sortableCarousel.querySelectorAll('.draggable-carousel-item');
                items.forEach(function(item) {
                    carouselIds.push(item.getAttribute('data-carousel-id'));
                });
                
                fetch('/admin/carousel/reorder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ order: carouselIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Carousel order updated successfully');
                    } else {
                        console.error('Failed to update carousel order');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    }
    
    // Drag and Drop for Social Links
    const sortableSocial = document.getElementById('sortable-social');
    if (sortableSocial && typeof Sortable !== 'undefined') {
        Sortable.create(sortableSocial, {
            animation: 150,
            handle: '.drag-handle',
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                const socialIds = [];
                const items = sortableSocial.querySelectorAll('.draggable-social');
                items.forEach(function(item) {
                    socialIds.push(item.getAttribute('data-social-id'));
                });
                
                fetch('/admin/social/reorder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ order: socialIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Social links order updated successfully');
                    } else {
                        console.error('Failed to update social links order');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    }
});

