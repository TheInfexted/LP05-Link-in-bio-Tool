// Landing Page JavaScript - LP Universe

document.addEventListener('DOMContentLoaded', function() {
    
    // Share Modal
    const shareBtn = document.getElementById('shareBtn');
    const shareModal = document.getElementById('shareModal');
    const shareClose = document.querySelectorAll('.modal-close')[0];
    const shareUrlInput = document.getElementById('shareUrl');
    const copyBtn = document.getElementById('copyBtn');
    
    if (shareBtn) {
        shareBtn.addEventListener('click', function() {
            shareModal.style.display = 'block';
            shareUrlInput.value = window.location.href;
        });
    }
    
    if (shareClose) {
        shareClose.addEventListener('click', function() {
            shareModal.style.display = 'none';
        });
    }
    
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            shareUrlInput.select();
            shareUrlInput.setSelectionRange(0, 99999);
            
            // Modern clipboard API with fallback
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(shareUrlInput.value).then(function() {
                    copyBtn.classList.add('copied');
                    copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(function() {
                        copyBtn.classList.remove('copied');
                        copyBtn.innerHTML = '<i class="fas fa-copy"></i>';
                    }, 2000);
                });
            } else {
                // Fallback for older browsers
                document.execCommand('copy');
                copyBtn.classList.add('copied');
                copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(function() {
                    copyBtn.classList.remove('copied');
                    copyBtn.innerHTML = '<i class="fas fa-copy"></i>';
                }, 2000);
            }
        });
    }
    
    // Share Options Handlers
    const shareQRCode = document.getElementById('shareQRCode');
    const shareFacebook = document.getElementById('shareFacebook');
    const shareTelegram = document.getElementById('shareTelegram');
    const shareTwitter = document.getElementById('shareTwitter');
    const shareLinkedIn = document.getElementById('shareLinkedIn');
    const shareEmail = document.getElementById('shareEmail');
    
    const pageUrl = encodeURIComponent(window.location.href);
    const pageTitle = encodeURIComponent(document.title);
    
    if (shareQRCode) {
        shareQRCode.addEventListener('click', function() {
            shareModal.style.display = 'none';
            const qrModal = document.getElementById('qrModal');
            if (qrModal) {
                qrModal.style.display = 'block';
                generateQRCode();
            }
        });
    }
    
    if (shareFacebook) {
        shareFacebook.addEventListener('click', function() {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + pageUrl, '_blank', 'width=600,height=400');
        });
    }
    
    if (shareTelegram) {
        shareTelegram.addEventListener('click', function() {
            window.open('https://t.me/share/url?url=' + pageUrl + '&text=' + pageTitle, '_blank', 'width=600,height=400');
        });
    }
    
    if (shareTwitter) {
        shareTwitter.addEventListener('click', function() {
            window.open('https://twitter.com/intent/tweet?url=' + pageUrl + '&text=' + pageTitle, '_blank', 'width=600,height=400');
        });
    }
    
    if (shareLinkedIn) {
        shareLinkedIn.addEventListener('click', function() {
            window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + pageUrl, '_blank', 'width=600,height=400');
        });
    }
    
    if (shareEmail) {
        shareEmail.addEventListener('click', function() {
            window.location.href = 'mailto:?subject=' + pageTitle + '&body=Check out this page: ' + pageUrl;
        });
    }
    
    // QR Code Modal
    const qrBtn = document.getElementById('qrBtn');
    const qrModal = document.getElementById('qrModal');
    const qrClose = document.querySelectorAll('.modal-close')[1];
    
    if (qrBtn) {
        qrBtn.addEventListener('click', function() {
            qrModal.style.display = 'block';
            generateQRCode();
        });
    }
    
    if (qrClose) {
        qrClose.addEventListener('click', function() {
            qrModal.style.display = 'none';
        });
    }
    
    // Generate QR Code
    function generateQRCode() {
        const qrContainer = document.getElementById('qrcode');
        qrContainer.innerHTML = '';
        
        if (typeof QRCode !== 'undefined') {
            new QRCode(qrContainer, {
                text: window.location.href,
                width: 256,
                height: 256,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    }
    
    // Link Share Modal Functionality
    const linkShareModal = document.getElementById('linkShareModal');
    const linkShareClose = document.getElementById('linkShareClose');
    const linkShareUrlInput = document.getElementById('linkShareUrl');
    const linkCopyBtn = document.getElementById('linkCopyBtn');
    const linkShareButtons = document.querySelectorAll('.link-share-btn');
    
    let currentLinkUrl = '';
    let currentLinkTitle = '';
    
    // Attach click handlers to all link share buttons
    linkShareButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            currentLinkUrl = this.getAttribute('data-link-url');
            currentLinkTitle = this.getAttribute('data-link-title');
            
            linkShareModal.style.display = 'block';
            linkShareUrlInput.value = currentLinkUrl;
        });
    });
    
    // Close link share modal
    if (linkShareClose) {
        linkShareClose.addEventListener('click', function() {
            linkShareModal.style.display = 'none';
        });
    }
    
    // Copy link URL
    if (linkCopyBtn) {
        linkCopyBtn.addEventListener('click', function() {
            linkShareUrlInput.select();
            linkShareUrlInput.setSelectionRange(0, 99999);
            
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(linkShareUrlInput.value).then(function() {
                    linkCopyBtn.classList.add('copied');
                    linkCopyBtn.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(function() {
                        linkCopyBtn.classList.remove('copied');
                        linkCopyBtn.innerHTML = '<i class="fas fa-copy"></i>';
                    }, 2000);
                });
            } else {
                document.execCommand('copy');
                linkCopyBtn.classList.add('copied');
                linkCopyBtn.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(function() {
                    linkCopyBtn.classList.remove('copied');
                    linkCopyBtn.innerHTML = '<i class="fas fa-copy"></i>';
                }, 2000);
            }
        });
    }
    
    // Link Share Options
    const linkShareQRCode = document.getElementById('linkShareQRCode');
    const linkShareFacebook = document.getElementById('linkShareFacebook');
    const linkShareTelegram = document.getElementById('linkShareTelegram');
    const linkShareTwitter = document.getElementById('linkShareTwitter');
    const linkShareLinkedIn = document.getElementById('linkShareLinkedIn');
    const linkShareEmail = document.getElementById('linkShareEmail');
    
    if (linkShareQRCode) {
        linkShareQRCode.addEventListener('click', function() {
            linkShareModal.style.display = 'none';
            const linkQrModal = document.getElementById('linkQrModal');
            if (linkQrModal) {
                linkQrModal.style.display = 'block';
                generateLinkQRCode();
            }
        });
    }
    
    if (linkShareFacebook) {
        linkShareFacebook.addEventListener('click', function() {
            const encodedUrl = encodeURIComponent(currentLinkUrl);
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodedUrl, '_blank', 'width=600,height=400');
        });
    }
    
    if (linkShareTelegram) {
        linkShareTelegram.addEventListener('click', function() {
            const encodedUrl = encodeURIComponent(currentLinkUrl);
            const encodedTitle = encodeURIComponent(currentLinkTitle);
            window.open('https://t.me/share/url?url=' + encodedUrl + '&text=' + encodedTitle, '_blank', 'width=600,height=400');
        });
    }
    
    if (linkShareTwitter) {
        linkShareTwitter.addEventListener('click', function() {
            const encodedUrl = encodeURIComponent(currentLinkUrl);
            const encodedTitle = encodeURIComponent(currentLinkTitle);
            window.open('https://twitter.com/intent/tweet?url=' + encodedUrl + '&text=' + encodedTitle, '_blank', 'width=600,height=400');
        });
    }
    
    if (linkShareLinkedIn) {
        linkShareLinkedIn.addEventListener('click', function() {
            const encodedUrl = encodeURIComponent(currentLinkUrl);
            window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + encodedUrl, '_blank', 'width=600,height=400');
        });
    }
    
    if (linkShareEmail) {
        linkShareEmail.addEventListener('click', function() {
            const encodedTitle = encodeURIComponent(currentLinkTitle);
            const encodedUrl = encodeURIComponent(currentLinkUrl);
            window.location.href = 'mailto:?subject=' + encodedTitle + '&body=Check out this link: ' + encodedUrl;
        });
    }
    
    // Link QR Code Modal
    const linkQrModal = document.getElementById('linkQrModal');
    const linkQrClose = document.getElementById('linkQrClose');
    
    if (linkQrClose) {
        linkQrClose.addEventListener('click', function() {
            linkQrModal.style.display = 'none';
        });
    }
    
    // Generate QR Code for Link
    function generateLinkQRCode() {
        const qrContainer = document.getElementById('linkQrcode');
        qrContainer.innerHTML = '';
        
        if (typeof QRCode !== 'undefined') {
            new QRCode(qrContainer, {
                text: currentLinkUrl,
                width: 256,
                height: 256,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    }
    
    // Close modals when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target == shareModal) {
            shareModal.style.display = 'none';
        }
        if (event.target == qrModal) {
            qrModal.style.display = 'none';
        }
        if (event.target == linkShareModal) {
            linkShareModal.style.display = 'none';
        }
        if (event.target == linkQrModal) {
            linkQrModal.style.display = 'none';
        }
    });
    
    // Link Click Tracking
    const trackLinks = document.querySelectorAll('.track-link');
    trackLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Check if the click target is the share button or its child
            if (e.target.closest('.link-share-btn')) {
                return; // Don't track or navigate if clicking share button
            }
            
            e.preventDefault();
            const linkId = this.getAttribute('data-link-id');
            const url = this.getAttribute('href');
            
            // Track click
            fetch('/track/' + linkId)
                .then(function() {
                    window.open(url, '_blank');
                })
                .catch(function() {
                    window.open(url, '_blank');
                });
        });
    });
    
    // Smooth scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.link-item-wrapper, .social-link').forEach(function(el) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
});

