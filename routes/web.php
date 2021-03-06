<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', ['as' => 'index', 'uses' => 'SiteController@index'])->name('home');

Auth::routes();

Route::group([
    'middleware' => 'guest',
], function() {
    Route::get('register', function() {
        return view('auth.register');
    })->name('registerForm');

    Route::post('/register', 'Auth\RegisterController@register')->name('register');
});

Route::group([
    'middleware' => ['web', 'auth'],
], function() {

    Route::get('/verify_email/{token}', 'Auth\RegisterController@verify');

    Route::post('/user/update', 'UserController@updateUser')->name('updateUser');
    Route::any('/logout', 'UserController@logout')->name('logout');

    Route::get('/profile', 'ProfileController@getProfile')->name('getProfile');
    Route::get('user.magazin', 'ProfileController@getProducts')->name('magazinIndex');
    Route::post('user.change_avatar', 'ProfileController@changeAvatar')->name('changeAvatar');

    Route::get('cardgame:ability.index', 'AbilityController@index')->name('abilityIndex');

    Route::get('/provocation', 'ProvocationController@index')->name('provocationIndex');
    Route::post('/provocation/create', 'ProvocationController@create')->name('provocation');
    Route::any('provocation.destroy.{id}', 'ProvocationController@destroy')->name('provocationDelete');

});

// Contact
Route::get('contact', function() {
    return view('contact');
})->name('contact');

// Отправка электронной почты
//Route::post('send.simple.email','MailController@simplePHPEmail')->name('simplePHPEmail');
//Route::post('send.row.email','MailController@rowEmail')->name('rowEmail');
//Route::post('send.basic.email','MailController@basicEmail')->name('basicEmail');
//Route::post('send.html.email','MailController@htmlEmail')->name('htmlEmail');
//Route::post('send.attachment.email','MailController@attachmentEmail')->name('attachmentEmail');

Route::group([
    'middleware' => ['web', 'admin'],
], function() {
    Route::resource('file', 'FileController', [
        'only' => [
            'store',
            'update',
            'destroy',
        ],
        [
            'names' => [
                'store' => 'file.store',
                'update' => 'file.update',
                'destroy' => 'file.destroy',
            ]
        ]
    ]);
});

