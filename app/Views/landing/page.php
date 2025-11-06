<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page['subtitle_1'] ?? 'Landing Page') ?> - LP Universe</title>
    <meta name="description" content="<?= esc($page['subtitle_2'] ?? '') ?>">
    
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
</head>
<body>
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
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- QR Code Generator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    
    <!-- Custom JS -->
    <script src="/assets/js/landing.js?v=<?= time() ?>"></script>
    
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
</body>
</html>

