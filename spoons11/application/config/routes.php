<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'landing_controller';
$route['user-register'] = 'home/user_register';
$route['login'] = 'home/login';
$route['logout'] = 'home/logout';
$route['check-r-email'] = 'home/check_r_email';
//---------------------------------------------------------------

$route['prime-membership-plan'] = 'landing_controller/prime_membership_plan';
$route['purchase-prime-membership-plan'] = 'Add_cart_item/payment_prime_membership';
$route['prime-membership-payment-status'] = 'Add_cart_item/prime_membership_payment_status';
$route['PaytmResponse'] = 'Add_cart_item/PaytmResponse';

//-----------------------------------------------------------------
$route['check-username'] = 'home/check_username';
$route['refferal-code'] = 'home/refferal_code';
$route['demo'] = 'home/demo';
$route['Fb_login'] = 'landing_controller/process_facebook_login';
$route['g_login'] = 'Login/google_login';
$route['t_login'] = 'Twitter/auth';
$route['callback'] = 'Twitter/callback';
$route['post'] = 'Twitter/post';
$route['callback'] = 'Twitter/callback';
$route['forget-password'] = 'landing_controller/forget_password';
$route['reset-password'] = 'landing_controller/reset_password';
// $route['restaurant-profile'] = 'home/restaurant_profile';
$route['profile'] = 'home/profile';
$route['user-profile'] = 'home/user_profile';
$route['restaurant-registration-request'] = 'landing_controller/restaurant_registration_request';
$route['restaurant-registration-request-add'] = 'landing_controller/restaurant_registration_request_add';
$route['restaurant-registration'] = 'landing_controller/restaurant_registration';
$route['register-restaurant-package'] = 'landing_controller/register_restaurant_package';
$route['register-restaurant-payment'] = 'landing_controller/register_restaurant_payment';
$route['checkout'] = 'landing_controller/checkout';
$route['thanks-activation'] = 'landing_controller/thanks_activation';
$route['check-r-name'] = 'landing_controller/check_r_name';
$route['check-user'] = 'landing_controller/check_user';
$route['fetch-country'] = 'landing_controller/fetch_country';
$route['get-state'] = 'landing_controller/get_state';
$route['get-state2'] = 'landing_controller/get_state2';
$route['get-city'] = 'landing_controller/get_city';
$route['restaurant-registration-add'] = 'landing_controller/restaurant_registration_add';
$route['check-mobile'] = 'landing_controller/check_mobile';
// $route['restaurant-list'] = 'landing_controller/restaurant_list';
$route['restaurant-list/(:any)']         = "landing_controller/restaurant_list/$1";

$route['order-list'] = 'landing_controller/order_list';
$route['category-list'] = 'landing_controller/category_list';
$route['restaurant-menu'] = 'landing_controller/restaurant_menu';
$route['restaurant-offer'] = 'landing_controller/restaurant_offer';
$route['offer-add'] = 'landing_controller/offer_add';
$route['offer-add1'] = 'landing_controller/restaurant_offer_add';
$route['dashboard'] = 'landing_controller/dashboard';
$route['user-order'] = 'landing_controller/user_order';
$route['saved-address'] = 'landing_controller/saved_address';
$route['coupon-price'] = 'landing_controller/coupon_price';
$route['user-payment'] = 'landing_controller/user_payment';
$route['change-password'] = 'landing_controller/change_password';
$route['update-password'] = 'landing_controller/update_password';
$route['update-mobile'] = 'landing_controller/update_mobile';
$route['offers-and-coupon'] = 'landing_controller/offers_and_coupon';
$route['menu-add'] = 'landing_controller/restaurant_menu_addf';
$route['menu-del'] = 'landing_controller/restaurant_menu_del';
$route['order-del'] = 'landing_controller/restaurant_order_del';
$route['offer-del'] = 'landing_controller/restaurant_offer_del';
$route['add-menu-addf'] = 'landing_controller/add_menu_addf';
$route['change-order-status'] = 'landing_controller/change_order_status';
$route['change-budget-status'] = 'landing_controller/change_budget_status';
$route['saved-address-addf'] = 'landing_controller/saved_address_addf';
$route['delete-address'] = 'landing_controller/delete_address';
$route['vieworder-detail'] = 'landing_controller/vieworder_detail';
$route['update-profile'] = 'landing_controller/update_profile';
$route['restaurant-vender-list'] = 'landing_controller/restaurant_vender_list';
$route['restaurant-vender-addf'] = 'landing_controller/restaurant_vender_addf';
$route['restaurant-time-list'] = 'landing_controller/restaurant_time_list';
$route['restaurant-time-addf'] = 'landing_controller/restaurant_time_addf';
$route['update-time'] = 'landing_controller/update_time';
$route['restaurant-review-list'] = 'landing_controller/restaurant_review_list';
$route['restaurant-booking-list'] = 'landing_controller/restaurant_booking_list';
//$route['restaurant-detail'] = 'landing_controller/restaurant-detail';

$route['restaurant-detail/(:any)']         = "landing_controller/restaurant_detail/$1";


$route['filter-res-cuisine'] = 'landing_controller/filter_res_cuisine';
$route['filter-search'] = 'landing_controller/filter_search';
$route['filter-new-search'] = 'landing_controller/filter_new_search';
$route['user-table-booking-list'] = 'landing_controller/user_table_booking_list';
$route['vender-table-booking-list'] = 'landing_controller/vender_table_booking_list';
$route['book-table'] = 'landing_controller/book_table';
$route['get-table'] = 'landing_controller/get_table';
$route['save-table'] = 'landing_controller/save_table';
$route['cancel-booking'] = 'landing_controller/cancel_booking';
$route['boking-table'] = 'landing_controller/boking_table';

//Internal Pages
$route['about-us'] = 'landing_controller/about_us';
$route['our-team'] = 'landing_controller/our_team';
$route['career-with-us'] = 'landing_controller/careers';
$route['help-and-support'] = 'landing_controller/help_and_support';
$route['refunds-policy'] = 'landing_controller/refunds_policy';
$route['privacy'] = 'landing_controller/pricacy_policy';
$route['blog'] = 'landing_controller/about_us';
$route['contact-us'] = 'landing_controller/contact';
$route['contact'] = 'landing_controller/contact_us';
$route['membership-payu-success'] = 'landing_controller/membership_payu_success';

$route['search-res'] = 'landing_controller/search_res';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/*add cart item*/
$route['add_cart'] = 'Add_cart_item/add_cart';
$route['update-cart'] = 'Add_cart_item/update_cart';
$route['customer-payment-checkout'] = 'Add_cart_item/customer_payment_checkout';
$route['apply-copon'] = 'Add_cart_item/apply_copon';
// $route['paypal-form'] = 'Add_cart_item/paypal_form';
$route['ccavenue-Form'] = 'Add_cart_item/ccavenue_Form';
$route['payumoney-Form'] = 'Add_cart_item/payumoney_Form';
$route['payu-success'] = 'Add_cart_item/payu_success';
$route['payu-res-success'] = 'Add_cart_item/payu_res_success';
$route['payu-failure'] = 'Add_cart_item/payu_failure';
$route['payment-order'] = 'Add_cart_item/payment_order';
$route['case-on-delivery'] = 'Add_cart_item/case_on_delivery';
$route['wallet-blnc'] = 'Add_cart_item/wallet_blnc';
$route['restaurant-rating'] = 'Add_cart_item/restaurant_rating';
$route['calculate-distance'] = 'Add_cart_item/calculate_distance';
$route['get-total'] = 'Add_cart_item/get_total_distance';
$route['demo2'] = 'Add_cart_item/demo';
$route['get-delivery-boy-Location'] = 'Add_cart_item/get_delivery_boy_Location';

$route['get-delivery-boy-status'] = 'Add_cart_item/get_delivery_boy_status';