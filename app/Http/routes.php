<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
  return view('home');
}); 

Route::get('/popup', function(){
  return view('layout.popup');
}); 

Route::get('/login', function(){
  return view('home');
}); 


Route::get('/outubro0', function(){
  return view('outubro0');
}); 

Route::post('/interesse', 'InteresseController@store'); 
Route::post('/ebook', 'InteresseController@ebook'); 

Route::group(['middleware' =>'forceSSL'],function(){ 
  //page de cadastro
   Route::get('/cadastro', 'UserController@register'); 
   Route::post('/user/save','UserController@SaveUser'); 
});

  Route::get('/queus','UserController@captura'); 
  Route::get('/sucess','UserController@paypalsucess'); 
  Route::get('/sucesso', function(){
     return view('sucessoebook');
  }); 

Route::get('/cancel', function(){
  return view('outubro0');
});

Route::get('/pagseguro', function(){
  return view('pg');
});


Route::get('/pagamentot', function(){
  return view('pagamentot');
}); 

Route::get('/pagamentostone', function(){
  return view('pagamento2');
}); 
 Route::get('/thank', 'UserController@thankyou'); 
  Route::get('/cancelar/{token}','UserController@cancela'); //,'forceSSL'



  Route::group(['middleware' =>['auth','forceSSL']],function(){ 

            Route::get('/pagamento', 'StoneController@pgpagamento'); 
          
            
            Route::get('/thankyou', 'UserController@thankyou'); 
            //stone
            Route::post('/order/payment', 'StoneController@authstone');
            Route::get('/order/capture', 'StoneController@stoneCaptureTransation');

            Route::get('/order/info', 'UserController@getInfoPayment');
            Route::post('/order/cupom','UserController@UseCupom');
 });


//ADMINISTRADOR

Route::group(['namespace' =>'Admin','prefix' => 'timeadmin'],function(){ 

            Route::get('/', 'loginController@index')->name('admin');
            Route::post('/logar', 'loginController@logIn')->name('admin-logar');
            
            Route::get('/dashboard','administratorController@index')->name('dashboard');
            Route::get('/cadastros','administratorController@cadastros')->name('cadastros');
            Route::get('/cadastrocsv/{tipo}','administratorController@downloadcsv')->name('downloadcsv');
            
            Route::get('/b-ebook','administratorController@ebook')->name('bebook');
             
             Route::resource('pagamentos', 'administratorController');
             
          
         
 });




//Route::post('/user/order','StoneController@SendOrderToStone');
