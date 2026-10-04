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
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */


/*
|--------------------------------------------------------------------------
| URI ROUTING
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

/** @var object $router **/


// ========================================
// STUDENT ROUTES
// ========================================

$router->get(
    '/student',
    'StudentController::index'
);

$router->get(
    '/student/profile',
    'StudentController::profile'
)->middleware('student_auth');


// ========================================
// USERS ROUTE
// ========================================

$router->get(
    '/users',
    'UsersController::index'
);


// ========================================
// OLD LOGIN / AUTHENTICATION
// LAB 5
// ========================================

$router->get(
    '/login',
    'LoginController::index'
);

$router->post(
    '/login/authenticate',
    'LoginController::authenticate'
);

$router->get(
    '/logout',
    'LoginController::logout'
);


// ========================================
// OLD PRODUCT CRUD
// LAB 5
// ========================================

$router->get(
    '/products',
    'ProductController::index'
)->middleware('product_auth');


$router->any(
    '/products/store',
    'ProductController::store'
)->middleware('product_auth');


$router->any(
    '/products/update/{id}',
    'ProductController::update'
)->middleware('product_auth');


$router->any(
    '/products/delete/{id}',
    'ProductController::delete'
)->middleware('product_auth');


// ========================================
// MIGRATION ROUTES
// ========================================

//$router->get(
   // 'create-migration/{migration_class}',
    //'MigrationController::create_migration'
//);

//$router->get(
//    'migrate',
//    'MigrationController::migrate'
//);

//$router->get(
 //   'rollback',
 //   'MigrationController::rollback'
//);

//$router->get(
//    'rollback-all',
//    'MigrationController::rollback_all'
//);

//$router->get(
 //   'refresh',
 //   'MigrationController::refresh'
//);

//$router->get(
 //   'status',
 //   'MigrationController::status'
//);


// ========================================
// LAB 6 AUTH API ROUTES
// ========================================


// LOGIN
// Normal POST request
$router->post(
    '/api/login',
    'AuthController::login'
);

// Handles browser OPTIONS preflight
$router->any(
    '/api/login',
    'AuthController::login'
);


// REFRESH TOKEN
$router->post(
    '/api/refresh',
    'AuthController::refresh'
);

$router->any(
    '/api/refresh',
    'AuthController::refresh'
);


// LOGOUT
$router->post(
    '/api/logout',
    'AuthController::logout'
);

$router->any(
    '/api/logout',
    'AuthController::logout'
);


// ========================================
// LAB 6 PRODUCT API ROUTES
// ========================================


// ----------------------------------------
// GET PRODUCTS
// GET /api/products
// ----------------------------------------

$router->get(
    '/api/products',
    'ProductApiController::index'
);


// ----------------------------------------
// ADD PRODUCT
// POST /api/products
// ----------------------------------------

$router->post(
    '/api/products',
    'ProductApiController::store'
);


// ----------------------------------------
// OPTIONS FALLBACK
// Handles CORS preflight for
// GET and POST /api/products
// ----------------------------------------

$router->any(
    '/api/products',
    'ProductApiController::index'
);


// ----------------------------------------
// UPDATE PRODUCT
// PUT /api/products/{id}
// ----------------------------------------

$router->put(
    '/api/products/{id}',
    'ProductApiController::update'
);


// ----------------------------------------
// DELETE PRODUCT
// DELETE /api/products/{id}
// ----------------------------------------

$router->delete(
    '/api/products/{id}',
    'ProductApiController::delete'
);


// ----------------------------------------
// OPTIONS FALLBACK
// Handles CORS preflight for
// PUT and DELETE
// ----------------------------------------

$router->any(
    '/api/products/{id}',
    'ProductApiController::update'
);

// ========================================
// PRODUCT IMAGE UPLOAD
// ========================================

$router->post(
    '/api/products/{id}/image',
    'ProductApiController::uploadImage'
);

$router->any(
    '/api/products/{id}/image',
    'ProductApiController::uploadImage'
);