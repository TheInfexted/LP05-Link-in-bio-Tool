<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?= $this->renderSection('meta') ?>
    
    <!-- Favicons and Apple Touch Icons -->
    <link rel="apple-touch-icon" sizes="192x192" href="<?=base_url('assets/img/logo/app_icon/192x192.png');?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/img/logo/app_icon/180x180.png');?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=base_url('assets/img/logo/app_icon/152x152.png');?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=base_url('assets/img/logo/app_icon/144x144.png');?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=base_url('assets/img/logo/app_icon/120x120.png');?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('assets/img/logo/app_icon/114x114.png');?>">
    <link rel="apple-touch-icon" sizes="96x96" href="<?=base_url('assets/img/logo/app_icon/96x96.png');?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url('assets/img/logo/app_icon/76x76.png');?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('assets/img/logo/app_icon/72x72.png');?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=base_url('assets/img/logo/app_icon/60x60.png');?>">
    <link rel="apple-touch-icon" sizes="57x57" href="<?=base_url('assets/img/logo/app_icon/57x57.png');?>">
    <link rel="apple-touch-icon" sizes="32x32" href="<?=base_url('assets/img/logo/app_icon/32x32.png');?>">
    <link rel="apple-touch-icon" sizes="16x16" href="<?=base_url('assets/img/logo/app_icon/16x16.png');?>">
    
    <!-- Apple Touch Startup Images -->
    <link href="<?=base_url('assets/img/logo/app_icon/1024x1024.png');?>" media="(device-width: 320px)" rel="apple-touch-startup-image">
    <link href="<?=base_url('assets/img/logo/app_icon/1024x1024.png');?>" media="(device-width: 320px) and (device-height: 460px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
    <link href="<?=base_url('assets/img/logo/app_icon/1024x1024.png');?>" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
    <link href="<?=base_url('assets/img/logo/app_icon/1024x1024.png');?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" rel="apple-touch-startup-image" />
    <link href="<?=base_url('assets/img/logo/app_icon/1024x1024.png');?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" rel="apple-touch-startup-image" />
    <link href="<?=base_url('assets/img/logo/app_icon/1024x1024.png');?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait) and (-webkit-min-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="<?=base_url('assets/img/logo/app_icon/1024x1024.png');?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    
    <!-- Favicons -->
    <link rel="icon" sizes="192x192" href="<?=base_url('assets/img/logo/favicon.ico');?>">
    <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/logo/favicon.ico');?>">
    
    <?= $this->renderSection('styles') ?>
    
    <?= $this->renderSection('scripts_head') ?>
</head>
<body>
    <?= $this->renderSection('content') ?>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>

