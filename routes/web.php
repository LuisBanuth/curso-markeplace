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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/{slug}', 'HomeController@single')->name('product.single');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add','CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
});


Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
        // Route::prefix('stores')->name('stores.')->group(function(){
        //     Route::get('/', 'StoreController@index')->name('index');
        //     Route::get('/create', 'StoreController@create')->name('create');
        //     Route::post('/store', 'StoreController@store')->name('store');
        //     Route::post('/update/{store}', 'StoreController@update')->name('update');
        //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
        // });

        Route::resource('stores', 'StoreController');

        Route::resource('products', 'ProductController');

        Route::resource('categories', 'CategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
        
    });
});




Route::get('/model', function () {
    $model = \App\User::all();
    //$model = \App\User::find(1); //por id
    //$model = \App\User::where('name', 'Oscar Mayert Jr.')->get(); //por atributo
    $paginate = \App\User::paginate(10); //paginacao
    //return $paginate;

    $user_store = \App\User::find(1);
    //return $user_store->store; //retorna o objeto da relação com store

    $loja = \App\Store::find(1);
    //return $loja->products()->where('id', 1)->get(); //Uma pra muitos. Retorna uma coleção, sendo possível filtrar por atributo

    //Criar loja para usuario
        // $user = \App\User::find(10);
        // $loja = $user->store()->create([
        //     'name' => 'Loja teste',
        //     'description' => 'Teste de loja',
        //     'mobile_phone' => 'xxxxx' ,
        //     'phone' => '3213213',
        //     'slug' =>   'loja-teste',
        // ]);

        // return $loja;
    
    //criar produto para uma loja
        // $store = \App\Store::find(41);
        // $produto = $store->products()->create([
        //     'name' => 'Produto teste',
        //     'description' => 'Teste de Produto',
        //     'body' => 'xxxxx' ,
        //     'price' => '3213213',
        //     'slug' =>   'produto-teste',
        // ]);
        // dd($produto);

    //criar categoria
        // \App\Category::create([
        //     'name' => 'Games',
        //     'description' => 'Games',
        //     'slug' => 'games'
        // ]);

        // \App\Category::create([
        //     'name' => 'Notebooks',
        //     'description' => 'Notebooks',
        //     'slug' => 'notebooks'
        // ]);

        // return \App\Category::all();
    
    //Adicionar produto a categoria
        $product = \App\Product::find(12);
        $product->categories()->attach([1]); //para remover detach
        $product->categories()->sync([1]); //remove o que tem e adiciona o que foi passado

        return $product;
});
 

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
