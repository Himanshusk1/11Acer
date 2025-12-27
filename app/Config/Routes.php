<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Home::index');
// Public post-property landing page; redirects logged-in users to the dashboard workflow
$routes->get('/post-property', 'UserController::postProperty');
// Authenticated flow for adding properties
$routes->get('/post-your-property', 'UserController::postYourProperty', ['filter' => 'auth']);
$routes->get('/properties', 'Home::properties');
$routes->get('/property', 'Home::property');

$routes->get('/commercial', 'Home::commercial');
$routes->get('/residential', 'Home::residential');
$routes->get('/services', 'Home::services'); // Services page ke liye
$routes->post('/services/enquiry', 'Home::submitServiceEnquiry');
$routes->get('/about', 'AboutController::index');
$routes->get('/contact', 'ContactController::index');
$routes->post('/contact/send', 'ContactController::sendMessage');
$routes->get('/agents', 'Home::agents'); // Agents page ke liye
$routes->get('/agents/profile', 'Agents::profile');
// app/Config/Routes.php file mein yeh add karein

$routes->get('agents/login', 'Agents::login', ['filter' => 'auth:guest']);
$routes->get('agents/register', 'Agents::register', ['filter' => 'auth:guest']);

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth:disallow-admin']);
$routes->get('/user/dashboard', 'Dashboard::index', ['filter' => 'auth:disallow-admin']);

// Admin dashboard and management endpoints
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('', 'Admin::index');
    $routes->get('stats', 'Admin::stats');
    $routes->get('users/create', 'Admin::createUser');
    $routes->post('users', 'Admin::storeUser');
    $routes->get('users/export', 'Admin::exportUsers');
    $routes->get('properties/export', 'Admin::exportProperties');
    $routes->get('payments/export', 'Admin::exportPayments');
    $routes->post('user/(:num)/delete', 'Admin::deleteUser/$1');
    $routes->post('user/(:num)/make-admin', 'Admin::promoteToAdmin/$1');
    $routes->post('post/(:num)/delete', 'Admin::deletePost/$1');
    $routes->get('properties', 'Admin::properties');
    $routes->get('payments', 'Admin::payments');
    $routes->get('referrals', 'Admin::referrals');
    $routes->get('service-enquiries', 'Admin::serviceEnquiries');
    $routes->get('residential-leads', 'Admin\ResidentialLeadsController::index');
    $routes->post('residential-leads/(:num)/status', 'Admin\ResidentialLeadsController::updateStatus/$1');
    $routes->post('residential-leads/(:num)/delete', 'Admin\ResidentialLeadsController::delete/$1');
    $routes->get('commercial-visits', 'Admin\CommercialVisitsController::index');
    $routes->post('commercial-visits/(:num)/status', 'Admin\CommercialVisitsController::updateStatus/$1');
    $routes->post('commercial-visits/(:num)/delete', 'Admin\CommercialVisitsController::delete/$1');
    $routes->get('contact-requests', 'Admin\ContactRequestsController::index');
    $routes->post('contact-requests/(:num)/status', 'Admin\ContactRequestsController::updateStatus/$1');
    $routes->post('contact-requests/(:num)/delete', 'Admin\ContactRequestsController::delete/$1');
    $routes->post('payments', 'Admin::payments');
    $routes->get('appointments', 'Admin\AppointmentsController::index');
    $routes->post('appointments/forward/(:num)', 'Admin\AppointmentsController::forward/$1');
    $routes->post('appointments/decline/(:num)', 'Admin\AppointmentsController::decline/$1');
    $routes->post('appointments/auto-forward', 'Admin\AppointmentsController::toggleAutoForward');
    $routes->get('appointments/view/(:num)', 'Admin\AppointmentsController::view/$1');
    $routes->get('feedback/export', 'Admin\FeedbackController::export');
    $routes->get('feedback', 'Admin\FeedbackController::index');
    $routes->post('subscriptions/create', 'Admin::createSubscription');
    $routes->post('subscriptions/(:num)/delete', 'Admin::deleteSubscription/$1');
    $routes->delete('subscriptions/(:num)', 'Admin::deleteSubscription/$1');
    $routes->get('settings', 'AdminSettingsController::index');
    $routes->post('settings/profile', 'AdminSettingsController::updateProfile');
    $routes->post('settings/app', 'AdminSettingsController::updateAppSettings');
});


// API routes
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {

        // $routes->post('property/create', 'Api\PropertyController::create');
    // 🔹 Auth Routes
    // $routes->post('auth/register', 'AuthController::register');
    // $routes->post('auth/login', 'AuthController::login');
    // $routes->post('auth/logout', 'AuthController::logout');

    $routes->post('auth/register', 'AuthController::register');
    $routes->post('auth/login', 'AuthController::login');
    $routes->post('auth/logout', 'AuthController::logout');
    $routes->get('auth/logout', 'AuthController::logout');
    $routes->post('auth/verify-otp', 'AuthController::verifyOtp');

    $routes->post('services/enquiry', 'ServiceEnquiry::submit');
    $routes->post('appointments/request', 'AppointmentRequest::submit');
    $routes->post('residential/lead', 'ResidentialLead::submit');
    $routes->post('commercial/visit', 'CommercialVisit::submit');
    $routes->post('contact/request', 'ContactRequest::submit');
    

    // 🔹 User Routes
    $routes->get('user/profile', 'UserController::profile');
    $routes->put('user/update', 'UserController::update');  
    // agar PUT ka issue aaye to post bhi use kar sakte ho
    // $routes->post('user/update', 'UserController::update');

    // Profile (frontend Account Settings) - user-specific profile and uploads
    $routes->get('profile', 'UserProfileController::getProfile');
    $routes->post('profile', 'UserProfileController::updateProfile');
    $routes->post('profile/delete-photo', 'UserProfileController::deletePhoto');

    // Subscriptions: list, subscribe, check status for current user
    $routes->get('subscriptions', 'Subscriptions::index');
    $routes->post('subscriptions/order', 'Subscriptions::createOrder');
    $routes->post('subscriptions/subscribe', 'Subscriptions::subscribe');
    $routes->get('subscriptions/status', 'Subscriptions::status');

    $routes->get('invoices', 'Invoices::index');
    $routes->post('invoices/generate', 'Invoices::generate');
    $routes->get('invoices/(:num)', 'Invoices::show/$1');
    $routes->get('invoices/(:num)/pdf', 'Invoices::download/$1');

    // 🔹 Post Routes
    $routes->get('posts', 'PostController::index');         // sabhi posts
    $routes->get('posts/(:num)', 'PostController::show/$1'); // single post
    $routes->post('posts', 'PostController::create');       // naya post
    $routes->put('posts/(:num)', 'PostController::update/$1'); // update post
    $routes->delete('posts/(:num)', 'PostController::delete/$1'); // delete post
});


$routes->group('api/property', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->post('create-full', 'PropertyController::createFullProperty');
    $routes->get('all', 'PropertyController::getAllProperties');
    $routes->get('my', 'PropertyController::getMyProperties');
    $routes->put('(:num)', 'PropertyController::update/$1');
    $routes->delete('(:num)', 'PropertyController::delete/$1');

});

$routes->group('api/admin', ['namespace' => 'App\Controllers\Api', 'filter' => 'admin'], static function($routes) {
    $routes->get('subscriptions', 'AdminSubscriptions::index');
    $routes->post('subscriptions', 'AdminSubscriptions::store');
    $routes->delete('subscriptions/(:num)', 'AdminSubscriptions::destroy/$1');
});

$routes->group('api/agent', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('all', 'AgentController::all');
    $routes->get('(:num)', 'AgentController::show/$1');
    $routes->post('feedback', 'AgentFeedbackController::submit');
});