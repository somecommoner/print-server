<?php

//0 = not logged in
//1 = user
//2 = mod
//5 = admin

$App->get('/setup', 'App\DB\Setup');


$App->get('/', 'App\Controllers\Home\index', 1);
$App->get('/search', 'App\Controllers\Search\index', 1);

$App->get('/admin/users', 'App\Controllers\Admin\users', 5);
$App->get('/account', 'App\Controllers\Account\index', 1);


## API ##

$App->post('/api/users/update', 'App\Controllers\API\Users\modify', 1);
$App->get('/api/users', 'App\Controllers\API\Users\get', 5);
$App->delete('/api/users/{id}', 'App\Controllers\API\Users\delete', 5);
$App->post('/api/users/{id}', 'App\Controllers\API\Users\post', 5);


## USERS ##

$App->get('/login', 'App\Controllers\Login\index');
$App->post('/login', 'App\Controllers\Login\check');
$App->get('/logout', 'App\Controllers\Login\logout', 1);
$App->get('/reset', 'App\Controllers\Users\reset_page');
$App->post('/reset', 'App\Controllers\Users\invite');
$App->get('/reset/{token}', 'App\Controllers\Users\get_change_password');
$App->post('/reset/{token}', 'App\Controllers\Users\post_change_password');
$App->get('/invite', 'App\Controllers\Users\invite_page', 5);
$App->post('/invite', 'App\Controllers\Users\invite', 5);
$App->get('/create/{token}', 'App\Controllers\Users\get_create');
$App->post('/create/{token}', 'App\Controllers\Users\post_create');