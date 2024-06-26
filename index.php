<?php
// Include router class
include('Route.php');

// Add base route (startpage)
Route::add('/', function () {
    echo 'Welcome :-)';
});
Route::add('', function () {
    echo 'Welcome :-)';
});

// Simple test route that simulates static html file
Route::add('/cte_to_pdf', function () {
    require __DIR__ . '/api/cte/dacte.php';
}, 'post');

Route::add('/nfe_to_pdf', function () {
    require __DIR__ . '/api/nfe/danfe.php';
}, 'post');

Route::add('/mdfe_to_pdf', function () {
    require __DIR__ . '/api/mdfe/damdfe.php';
}, 'post');

Route::run('/sped-da/api/v1');
