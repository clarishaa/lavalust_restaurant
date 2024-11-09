<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 * 
 * Copyright (c) 2020 Ronald M. Marasigan
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @copyright Copyright 2020 (https://ronmarasigan.github.io)
 * @since Version 1
 * @link https://lavalust.pinoywap.org
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

$router->get('/', 'Welcome::index');
$router->get('admin', 'Welcome::admin');
$router->get('getCategories', 'Welcome::getCategories');
$router->get('manage-menu', 'Welcome::menum');
$router->get('about', 'Welcome::about');
$router->get('book', 'Welcome::book');
$router->get('menu', 'Welcome::menu');
$router->get('register', 'Welcome::register');
$router->post('signup', 'Welcome::insert');
$router->post('signin', 'Welcome::signin');
$router->get('login', 'Welcome::login');
$router->get('verification', 'Welcome::verification');
$router->get('verify', 'Welcome::verify_email');
$router->post('send', 'Welcome::send');
$router->post('cart', 'Welcome::cart');
$router->get('mycart', 'Welcome::mycart');
$router->post('decquantity/(:num)', 'Welcome::decQuantity');
$router->post('incquantity/(:num)', 'Welcome::incQuantity');
$router->get('delete/(:num)', 'Welcome::delete');
$router->get('item-edit/(:num)', 'Welcome::itemedit');
$router->get('item-delete/(:num)', 'Welcome::itemdelete');
$router->post('item-update/(:num)?', 'Welcome::itemupdate');
$router->post('add-item', 'Welcome::addItem');
$router->get('manage-staff', 'StaffController::staff');
$router->get('staff-edit/(:num)', 'StaffController::staffedit');
$router->get('staff-delete/(:num)', 'StaffController::staffdelete');
$router->post('staff-update/(:num)?', 'StaffController::staffupdate');
$router->post('add-staff', 'StaffController::addstaff');
$router->get('manage-customer', 'CustomerController::customer');
$router->get('customer-edit/(:num)', 'CustomerController::customeredit');
$router->get('customer-delete/(:num)', 'CustomerController::customerdelete');
$router->post('customer-update/(:num)?', 'CustomerController::customerupdate');
$router->post('add-customer', 'CustomerController::addcustomer');
$router->post('book/(:num)', 'BookingController::book');
$router->post('checkout', 'CheckoutController::checkout');
$router->get('invoice', 'CheckoutController::invoice');
$router->post('poscart', 'SalesController::poscart');
$router->get('pos', 'SalesController::myPosCart');
$router->get('deletepos/(:num)', 'SalesController::deletepos');
$router->post('checkoutpos', 'SalesController::checkoutpos');
$router->post('posdel', 'SalesController::posdel');
$router->post('pay', 'SalesController::pay');
$router->get('bookings', 'BookingController::bookings');
$router->get('book-cancel/(:num)', 'BookingController::bookcancel');
$router->get('book-payed/(:num)', 'BookingController::bookpay');
$router->get('tables', 'TableController::tables');
$router->post('table-update/(:num)?', 'TableController::tableupdate');
$router->post('table-add/', 'TableController::tableadd');
$router->get('table-delete/(:num)?', 'TableController::tabledelete');
$router->get('logout', 'Welcome::logout');
