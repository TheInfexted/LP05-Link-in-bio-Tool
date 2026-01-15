<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home Route - Show default admin landing page
$routes->get('/', 'PageController::view/admin');

// CMS Dashboard Routes (at /admin/*)
$routes->get('admin', 'AuthController::login');
$routes->post('admin', 'AuthController::loginProcess');
$routes->get('admin/logout', 'AuthController::logout');

$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('settings', 'DashboardController::settings');
    $routes->post('settings', 'DashboardController::updateSettings');
    $routes->post('settings/remove-background', 'DashboardController::removeBackground');
    $routes->get('links', 'DashboardController::links');
    $routes->post('links/add', 'DashboardController::addLink');
    $routes->post('links/reorder', 'DashboardController::reorderLinks');
    $routes->post('links/update-apps', 'DashboardController::updateAppLinks');
    $routes->get('links/delete/(:num)', 'DashboardController::deleteLink/$1');
    $routes->get('carousel', 'DashboardController::carousel');
    $routes->post('carousel/add', 'DashboardController::addCarouselImage');
    $routes->post('carousel/reorder', 'DashboardController::reorderCarousel');
    $routes->get('carousel/delete/(:num)', 'DashboardController::deleteCarouselImage/$1');
    $routes->get('social', 'DashboardController::social');
    $routes->post('social/add', 'DashboardController::addSocialLink');
    $routes->post('social/reorder', 'DashboardController::reorderSocial');
    $routes->get('social/delete/(:num)', 'DashboardController::deleteSocialLink/$1');
    $routes->get('user', 'DashboardController::userSettings');
    $routes->post('user', 'DashboardController::updateUserSettings');
});

// Click tracking
$routes->get('track/(:num)', 'PageController::trackClick/$1');

// QR Code generation
$routes->get('qr/(:any)', 'PageController::generateQR/$1');

// Public Landing Page Route (must be last)
$routes->get('(:any)', 'PageController::view/$1');
