<?php

use App\Http\Controllers\AdminAjaxController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

//login, register
Route::middleware('admin_auth')->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {
    //dashboard
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    Route::middleware(['admin_auth'])->group(function(){

        //category
        Route::group(['prefix'=>'category'],function(){
            Route::get('list/',[CategoryController::class,'listPage'])->name('categroy#listPage');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'createCategory'])->name('category#createItem');
            Route::get('delete/{id}',[CategoryController::class,'deleteCategory'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'editPage'])->name('category#editPage');
            Route::post('update/',[CategoryController::class,'editItem'])->name('category#editItem');
        });

        //admin account
        //    Route::prefix('admin')->group(function(){
        //        Route::get('password/changePage',[AuthController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        //    });
       Route::group(['prefix'=>'password'],function(){
            //password
            Route::get('changePasswordPage/',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('changePassword/',[AdminController::class,'changePassword'])->name('admin#changePassword');
       });

       //admin acount
       Route::group(['prefix' => 'account'],function(){
            //account
            Route::get('details',[AdminController::class,'details'])->name("admin#details");
            Route::get('editPage',[AdminController::class,'editPage'])->name('admin#editPage');
            Route::post('update/{id}',[AdminController::class,'updateAccount'])->name('admin#update');

            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRolePage/{id}',[AdminController::class,'changeRolePage'])->name('admin#changeRolePage');
            Route::post('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
       });

       //products
       Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'productListPage'])->name('product#listPage');
            Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'createPizza'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'deletePizza'])->name('product#delete');
            Route::get('detail/{id}',[ProductController::class,'detailPizzaPage'])->name('product#detailPage');
            Route::get('editPage/{id}',[ProductController::class,'editPizzaPage'])->name('product#editPage');
            Route::post('update',[ProductController::class,'updatePizza'])->name('product#updatePizza');

        });

        //oreder
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('order#listPage');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('order#changeStatus');
            Route::get('ajax/status/change',[OrderController::class,'ajaxChangeStatus'])->name('order#ajaxChangeStatus');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('order#listInfo');
       });

       //user list
       Route::prefix('user')->group(function(){
            Route::get('list',[UserController::class,'userList'])->name('user#listPage');
            Route::get('change/role',[UserController::class,'changeRole'])->name('user#changeRole');
            Route::get('contact',[UserController::class,'contactPage'])->name('user#contactPage');
            Route::get('delete/user/{id}',[UserController::class,'deleteUser'])->name('user#deleteUser');
       });

       Route::prefix('ajax')->group(function(){
            Route::get('change/role',[AjaxController::class,'changeRole'])->name('ajax#adminChangeRole');
       });
    });


    //user
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        //direct home page
        Route::get('/homePage',[UserController::class,'homePage'])->name('user#homePage');
        Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class,'historyPage'])->name('user#history');
        Route::get('contact/form',[UserController::class,'contactForm'])->name('user#contactForm');
        Route::post('send/message',[UserController::class,'sendMessage'])->name('user#sendMessage');

        Route::prefix('password')->group(function(){
            Route::get('changePasswordPage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('changePassword',[UserController::class,'changePassword'])->name('user#changePassword');
        });

        Route::prefix('account')->group(function(){
            Route::get('accountChangePage',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('accountChange/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });

        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#details');
        });

        Route::prefix('cart')->group(function(){
            Route::get('lists',[UserController::class,'cartList'])->name('user#cartList');
        });

    });

});




//user
