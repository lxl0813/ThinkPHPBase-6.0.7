<?php

use think\facade\Route;

/**
*   @api v1
*/
Route::group( 'api/v1',function () {
    //用户模块
    Route::group('users',function (){
        //用户登录注册
        Route::group('auth',function (){
            Route::get('login', 'userLogin');
            Route::get('register', 'userRegister');
        })->prefix('v1.controller.Auth/');

        //用户
        Route::group('xxx',function(){

        });

    });


    Route::group('',function () {

    });

});

