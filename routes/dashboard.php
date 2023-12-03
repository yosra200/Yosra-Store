<?php

use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\profileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ImportProductsController;

route::group([
   'middleware'=> ['auth:admin,web' ],
   // 'as' => 'dashboard.',
   'prefix' => '/admin/dashboard',

],function(){
    Route::get('/profile', [profileController::class, 'edit'])
    ->name('profile.edit');
   
    Route::patch('/profile', [profileController::class, 'update'])
    ->name('profile.update');

    Route::get('/',[DashboardController::class,'index'])
       ->name('dashboard');

    Route::get('change/lang/{lang}', 'HomeController@changeLang')->name('change.lang');

   

   Route::get('/categories/trash', [CategoriesController::class, 'trash'])
       ->name('categories.trash');
   Route::put('categories/{category}/restore', [CategoriesController::class, 'restore'])
       ->name('categories.restore');
   Route::delete('categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
       ->name('categories.force-delete');
       
   Route::get('products/import', [ImportProductsController::class, 'create'])
       ->name('products.import');
   Route::post('products/import', [ImportProductsController::class, 'store']);


    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products', ProductsController::class);
    Route::resource('/roles',RolesController::class);

    Route::resource('/admins',AdminsController::class);
    Route::resource('/users',UsersController::class);



    

});



?>