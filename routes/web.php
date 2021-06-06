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
Route::get('/', 'InicialController@index')->name('inicial');

Route::get('/tasks', 'TaskController@exportCsv')->name('export.dweller');

Route::get ('/product/{slug}', [App\Http\Controllers\InicialController::class, 'single'] )->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/loja/{slug}', 'StoreController@index')->name('store.single');
Route::get('/consulta', [App\Http\Controllers\InicialController::class, 'find'])->name('consulta.find');

Route::prefix('cart')->name('cart.')->group(function(){
	Route::get('/', 'CartController@index')->name('index');
	Route::post('add', 'CartController@add')->name('add');

	Route::get('remove/{slug}', 'CartController@remove')->name('remove');
	Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
	Route::get('/', 'CheckoutController@index')->name('index');
	Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
	Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');

	Route::post('/notification', 'CheckoutController@notification')->name('notification');
});

Route::get('pedidos', 'UserOrderController@index')->name('user.orders')->middleware('auth');

Route::get('enderecosx', 'InicialController@enderecos')->name('user.address')->middleware('auth');
Route::get('enderecosx/edit/{id}', 'InicialController@endedit')->name('enderecos.edit')->middleware('auth');
Route::post('enderecosx/update/{id}', 'InicialController@endupdate')->name('enderecos.update')->middleware('auth');
Route::get('enderecosx/add', 'InicialController@endadd')->name('enderecos.add')->middleware('auth');
Route::post('enderecosx/store/{id}', 'InicialController@endstore')->name('enderecos.store')->middleware('auth');

Route::resource('address', 'AddressController')->middleware('auth');
Route::resource('street', 'StreetController')->middleware('auth');
Route::resource('situation', 'SituationController')->middleware('auth');
Route::resource('dweller', 'DwellerController')->middleware('auth');
Route::get('listagem', 'InicialController@listagem')->name('listagem.dweller');
Route::get('datatable', 'InicialController@datatable')->name('datatable.dweller');

Route::get('mapa', function () {
    return view('dweller.mapa');
})->name('mapa.dweller');;

//Route::get('dweller', [App\Http\Controllers\DwellerController::class, 'find'])->name('dweller.find');

Route::get('user/edit/{id}', 'InicialController@edit')->name('user.edit')->middleware('auth');
Route::post('user/update/{id}', 'InicialController@update')->name('user.update')->middleware('auth');

Route::group(['middleware' => ['auth','access.control.store.admin']], function(){

	Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){

		Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
		Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
		Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');

//	Route::prefix('stores')->name('stores.')->group(function(){
//
//		Route::get('/', 'StoreController@index')->name('index');
//		Route::get('/create', 'StoreController@create')->name('create');
//		Route::post('/store', 'StoreController@store')->name('store');
//		Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
//		Route::post('/update/{store}', 'StoreController@update')->name('update');
//		Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
//AccessControlStore
//	});
		Route::resource('stores', 'StoreController')->middleware('access.control.store');
		Route::resource('products', 'ProductController')->middleware('access.control.products');
		Route::resource('categories', 'CategoryController');

		Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');

		Route::get('orders/my', 'OrdersController@index')->name('orders.my');
	});

});

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth','access.control.store.admin']);

Auth::routes();


Route::get('/model/{id}', function($id){

	$store = \App\Models\Store::find($id);
	$products = $store->products;

	foreach ($products as $prod) {

		$product = \App\Models\Product::find($prod->id);
		$price = $product->price;

		$product->update([
			'price' => $price + 20
		]);
	
	}

	return 'ok';
});

Route::get('/teste', function(){

	$product = \App\Models\Product::find(49);

	return $product->categories;
});

Route::get('/not', function(){

	$user = \App\Models\User::find(41);
	$user->notify(new \App\Notifications\StoreReceiveNewOrder());

	$notification = $user->unreadNotifications->first();
	$notification->markAsRead();

	return $user->readNotifications;
});

Route::get('/storage', function(){

	return \Illuminate\Support\Facades\Artisan::call('storage:link');
});

Route::get('/ver', function(){

	//return \Illuminate\Support\Facades\Artisan::call('storage:link');
	Artisan::call('storage:link');

});

Route::get('/app-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache cleared.';
});

Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Config cache cleared.';
}); 

Route::get('/route-cache', function() {
    Artisan::call('route:cache');
    return 'Routes cache cleared.';
});

Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache cleared.';
});


