<?= $this->extend('layouts/landing') ?>

<?= $this->section('landing_content') ?>
        <!-- Share Buttons -->
        <?php if ($page['share_enabled'] || $page['qr_enabled']): ?>
            <div class="share-buttons">
                <?php if ($page['qr_enabled']): ?>
                    <button class="share-btn" id="qrBtn" title="QR Code">
                        <i class="fas fa-qrcode"></i>
                    </button>
                <?php endif; ?>
                
                <?php if ($page['share_enabled']): ?>
                    <button class="share-btn" id="shareBtn" title="Share Page">
                        <i class="fas fa-share-alt"></i>
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <!-- Header Image -->
        <?php if (!empty($page['header_image'])): ?>
            <div class="header-image-container">
                <img src="/<?= $page['header_image'] ?>" alt="Header" class="header-image">
            </div>
        <?php endif; ?>
        
        <!-- Subtitles -->
        <?php if (!empty($page['subtitle_1']) || !empty($page['subtitle_2']) || !empty($page['subtitle_3'])): ?>
            <div class="subtitles">
                <?php if (!empty($page['subtitle_1'])): ?>
                    <div class="subtitle"><?= esc($page['subtitle_1']) ?></div>
                <?php endif; ?>
                
                <?php if (!empty($page['subtitle_2'])): ?>
                    <div class="subtitle"><?= esc($page['subtitle_2']) ?></div>
                <?php endif; ?>
                
                <?php if (!empty($page['subtitle_3'])): ?>
                    <div class="subtitle"><?= esc($page['subtitle_3']) ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <!-- Links Section -->
        <?php if (!empty($links)): ?>
            <div class="links-section">
                <?php foreach ($links as $link): ?>
                    <div class="link-item-wrapper">
                        <a href="<?= esc($link['url']) ?>" 
                           class="link-item track-link" 
                           data-link-id="<?= $link['id'] ?>"
                           data-link-url="<?= esc($link['url']) ?>"
                           target="_blank"
                           rel="noopener noreferrer">
                            <span class="link-content">
                                <?= esc($link['title']) ?>
                            </span>
                            <button class="link-share-btn" 
                                    data-link-url="<?= esc($link['url']) ?>"
                                    data-link-title="<?= esc($link['title']) ?>"
                                    onclick="event.preventDefault(); event.stopPropagation();">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- App Store Links Section -->
        <?php if (!empty($page['ios_app_url']) || !empty($page['android_app_url'])): ?>
            <div class="app-store-section">
                <?php if (!empty($page['ios_app_url'])): ?>
                    <div class="app-store-item-wrapper">
                        <div class="app-logo-container">
                            <?php if (!empty($page['ios_app_image'])): ?>
                                <div class="lozad link-image ios" 
                                     data-background-image="/<?= $page['ios_app_image'] ?>"></div>
                            <?php else: ?>
                                <i class="fab fa-apple"></i>
                            <?php endif; ?>
                        </div>
                        <a href="<?= esc($page['ios_app_url']) ?>" 
                           class="app-store-item ios-app" 
                           target="_blank"
                           rel="noopener noreferrer">
                            <span class="app-store-text">My iOS App</span>
                        </a>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($page['android_app_url'])): ?>
                    <div class="app-store-item-wrapper">
                        <div class="app-logo-container">
                            <?php if (!empty($page['android_app_image'])): ?>
                                <div class="lozad link-image android" 
                                     data-background-image="/<?= $page['android_app_image'] ?>"></div>
                            <?php else: ?>
                                <i class="fab fa-google-play"></i>
                            <?php endif; ?>
                        </div>
                        <a href="<?= esc($page['android_app_url']) ?>" 
                           class="app-store-item android-app" 
                           target="_blank"
                           rel="noopener noreferrer">
                            <span class="app-store-text">My Android App</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <!-- Carousel Section -->
        <?php if (!empty($carouselImages)): ?>
            <div class="carousel-section">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($carouselImages as $image): ?>
                            <div class="swiper-slide">
                                <img src="/<?= $image['image_path'] ?>" alt="<?= esc($image['caption'] ?? '') ?>">
                                <?php if (!empty($image['caption'])): ?>
                                    <div class="carousel-caption">
                                        <?= esc($image['caption']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Social Media Section -->
        <?php if (!empty($socialLinks)): ?>
            <div class="social-section">
                <div class="social-links">
                    <?php foreach ($socialLinks as $social): ?>
                        <a href="<?= esc($social['url']) ?>" 
                           class="social-link <?= strtolower($social['platform']) ?>"
                           target="_blank"
                           rel="noopener noreferrer">
                            <i class="fab fa-<?= strtolower($social['platform']) ?>"></i>
                            <span><?= ucfirst($social['platform']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Share Modal -->
    <?php if ($page['share_enabled']): ?>
        <div id="shareModal" class="modal">
            <div class="modal-content share-modal-content">
                <span class="modal-close">&times;</span>
                
                <!-- Modal Header -->
                <div class="share-modal-header">
                    <?php if (!empty($page['header_image'])): ?>
                        <img src="/<?= $page['header_image'] ?>" alt="Logo" class="share-modal-logo">
                    <?php endif; ?>
                    <h2 class="share-modal-title">Share Page</h2>
                </div>
                
                <!-- URL Field with Copy -->
                <div class="share-url-container">
                    <input type="text" class="share-url-input" id="shareUrl" readonly>
                    <button class="share-copy-icon" id="copyBtn" title="Copy Link">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                
                <!-- Sharing Options -->
                <div class="share-options">
                    <div class="share-option" id="shareQRCode">
                        <div class="share-option-icon">
                            <i class="fas fa-qrcode"></i>
                        </div>
                        <div class="share-option-text">Download & Share QR Code</div>
                        <div class="share-option-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    
                    <div class="share-option" id="shareFacebook">
                        <div class="share-option-icon facebook-icon">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <div class="share-option-text">Share on Facebook</div>
                        <div class="share-option-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    
                    <div class="share-option" id="shareTelegram">
                        <div class="share-option-icon telegram-icon">
                            <i class="fab fa-telegram-plane"></i>
                        </div>
                        <div class="share-option-text">Share via Telegram</div>
                        <div class="share-option-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    
                    <div class="share-option" id="shareTwitter">
                        <div class="share-option-icon twitter-icon">
                            <i class="fab fa-twitter"></i>
                        </div>
                        <div class="share-option-text">Share on Twitter</div>
                        <div class="share-option-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    
                    <div class="share-option" id="shareLinkedIn">
                        <div class="share-option-icon linkedin-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </div>
                        <div class="share-option-text">Share on LinkedIn</div>
                        <div class="share-option-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    
                    <div class="share-option" id="shareEmail">
                        <div class="share-option-icon email-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="share-option-text">Share via Email</div>
                        <div class="share-option-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- QR Code Modal -->
    <?php if ($page['qr_enabled']): ?>
        <div id="qrModal" class="modal">
            <div class="modal-content">
                <span class="modal-close">&times;</span>
                <h2 style="margin-bottom: 20px; color: #2c3e50; text-align: center;">
                    <i class="fas fa-qrcode"></i> Scan QR Code
                </h2>
                <div id="qrcode"></div>
                <p style="text-align: center; margin-top: 15px; color: #6b7280;">
                    Scan this QR code to visit this page on your mobile device
                </p>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Link Share Modal -->
    <div id="linkShareModal" class="modal">
        <div class="modal-content share-modal-content">
            <span class="modal-close" id="linkShareClose">&times;</span>
            
            <!-- Modal Header -->
            <div class="share-modal-header">
                <?php if (!empty($page['header_image'])): ?>
                    <img src="/<?= $page['header_image'] ?>" alt="Logo" class="share-modal-logo">
                <?php endif; ?>
                <h2 class="share-modal-title">Share Link</h2>
            </div>
            
            <!-- URL Field with Copy -->
            <div class="share-url-container">
                <input type="text" class="share-url-input" id="linkShareUrl" readonly>
                <button class="share-copy-icon" id="linkCopyBtn" title="Copy Link">
                    <i class="fas fa-copy"></i>
                </button>
            </div>
            
            <!-- Sharing Options -->
            <div class="share-options">
                <div class="share-option" id="linkShareQRCode">
                    <div class="share-option-icon">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div class="share-option-text">Download & Share QR Code</div>
                    <div class="share-option-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                
                <div class="share-option" id="linkShareFacebook">
                    <div class="share-option-icon facebook-icon">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="share-option-text">Share on Facebook</div>
                    <div class="share-option-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                
                <div class="share-option" id="linkShareTelegram">
                    <div class="share-option-icon telegram-icon">
                        <i class="fab fa-telegram-plane"></i>
                    </div>
                    <div class="share-option-text">Share via Telegram</div>
                    <div class="share-option-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                
                <div class="share-option" id="linkShareTwitter">
                    <div class="share-option-icon twitter-icon">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="share-option-text">Share on Twitter</div>
                    <div class="share-option-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                
                <div class="share-option" id="linkShareLinkedIn">
                    <div class="share-option-icon linkedin-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                    <div class="share-option-text">Share on LinkedIn</div>
                    <div class="share-option-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                
                <div class="share-option" id="linkShareEmail">
                    <div class="share-option-icon email-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="share-option-text">Share via Email</div>
                    <div class="share-option-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Link QR Code Modal -->
    <div id="linkQrModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" id="linkQrClose">&times;</span>
            <h2 style="margin-bottom: 20px; color: #2c3e50; text-align: center;">
                <i class="fas fa-qrcode"></i> Scan QR Code
            </h2>
            <div id="linkQrcode"></div>
            <p style="text-align: center; margin-top: 15px; color: #6b7280;">
                Scan this QR code to visit this link
            </p>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('landing_scripts') ?>
    <!-- QR Code Generator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    
    <!-- Lozad (Lazy Loading) -->
    <script src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    
    <!-- Custom JS -->
    <script src="/assets/js/landing.js?v=<?= time() ?>"></script>
    
    <!-- Initialize Lozad for background images -->
    <script>
        if (typeof lozad !== 'undefined') {
            const observer = lozad('.lozad', {
                loaded: function(el) {
                    el.classList.add('loaded');
                    // Set background image when loaded
                    const bgImage = el.getAttribute('data-background-image');
                    if (bgImage) {
                        el.style.backgroundImage = 'url(' + bgImage + ')';
                        el.style.display = 'block';
                    }
                }
            });
            observer.observe();
            
            // Also load images immediately if they're already in viewport
            document.querySelectorAll('.lozad').forEach(function(el) {
                const bgImage = el.getAttribute('data-background-image');
                if (bgImage) {
                    el.style.backgroundImage = 'url(' + bgImage + ')';
                    el.style.display = 'block';
                    el.classList.add('loaded');
                }
            });
        }
    </script>
    
    <!-- Initialize Swiper -->
    <?php if (!empty($carouselImages)): ?>
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        </script>
    <?php endif; ?>
<?= $this->endSection() ?>

