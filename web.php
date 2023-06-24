<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\baseballController;
use App\Http\Middleware\HelloMiddleware;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\WorldController;
use App\Http\Middleware\WorldMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('hello',function(){
//   return '<html><body><h1>Hello</h1><p>This is sample page.</p></body></html>';
// });


// $html=<<<EOF
// <html>
// <head>
// <title>Hello</title>
// <style>
// body {font-size:16pt; color:#999; }
// h1 { font-size;100pt; text-align:right; color:#eee; margin:-40px,0px,-50px,0px}
// </style>
// </head>
// <body>
// <h1>Hello</h1>
// <p>This is sample page.</p>
// <p>{$msg}}</p>
//
// </body>
// </html>
// EOF;

// Route::get('hello/{msg?}',function($msg='No Message.') {
//   $html=<<<EOF
//   <html>
//   <head>
//   <title>Hello</title>
//   <style>
//   body {font-size:16pt; color:#999; }
//   h1 { font-size;100pt; text-align:right; color:#eee; margin:-40px,0px,-50px,0px}
//   </style>
//   </head>
//   <body>
//   <h1>Hello</h1>
//   <p>{$msg}</p>
//
//   </body>
//   </html>
//   EOF;
//
//   return $html;
// });

// Route::get('hello/{id?}/{pass?}','App\http\Controllers\HelloController@index');

// Route::get('hello','App\http\Controllers\HelloController@index');
// Route::get('hello','App\http\Controllers\HelloController@index');
// ->middleware(HelloMiddleware::class);
// Route::get('hello','App\http\Controllers\HelloController@index')
// ->middleware('helo');
// Route::get('hello','App\http\Controllers\HelloController@index')->middleware('auth');
Route::get('hello','App\http\Controllers\HelloController@index');
Route::post('hello','App\http\Controllers\HelloController@post');

// Route::get('hello/{id?}','App\http\Controllers\HelloController@index');
// Route::get('hello','App\http\Controllers\HelloController@index');
// Route::get('hello',function(){
//   return view('hello.index');
// });

Route::get('hello/other','App\http\Controllers\HelloController@other');
// Route::get('hello','App\http\Controllers\HelloController');

Route::get('test','App\http\Controllers\TestController@index');

//Display all current record.
Route::get('baseball','App\http\Controllers\baseballController@index')->name('baseball');

//Add new record.
Route::get('baseball_add','App\http\Controllers\baseballController@add');
Route::post('baseball_add','App\http\Controllers\baseballController@create');

//Updating existing record.
Route::get('baseball_edit','App\http\Controllers\baseballController@edit');
Route::post('baseball_edit','App\http\Controllers\baseballController@update');

Route::get('baseball_readCsv','App\http\Controllers\baseballController@readCsv');
Route::get('baseball_sort','App\http\Controllers\baseballController@sort')->name('sort');
Route::get('baseball_csvupload','App\http\Controllers\baseballController@csvUploadDisp')->name('baseball_csvupload');
Route::post('baseball_csvupload','App\http\Controllers\baseballController@csvUploadProcess')->name('baseball_csvupload');
Route::get('baseball_model','App\http\Controllers\baseballController@model');
Route::get('baseball/find','App\http\Controllers\baseballController@find');
Route::post('baseball/find','App\http\Controllers\baseballController@search');

//Delete certain record from table.
Route::get('baseball_del','App\http\Controllers\baseballController@del');
Route::post('baseball_del','App\http\Controllers\baseballController@remove');

Route::get('baseball/show','App\http\Controllers\baseballController@show');
Route::get('baseball/showSearch','App\http\Controllers\baseballController@showSearch');
Route::get('baseball/showBetween','App\http\Controllers\baseballController@showBetween');
Route::get('baseball/order','App\http\Controllers\baseballController@indexOrder');
Route::get('baseball/offlim','App\http\Controllers\baseballController@showOffLim');

Route::get('person','App\http\Controllers\PersonController@index');

Route::get('person/find','App\http\Controllers\PersonController@find');
Route::post('person/find','App\http\Controllers\PersonController@search');

Route::get('person/add','App\http\Controllers\PersonController@add');
Route::post('person/add','App\http\Controllers\PersonController@create');

Route::get('person/edit','App\http\Controllers\PersonController@edit');
Route::post('person/edit','App\http\Controllers\PersonController@update');

Route::get('person/del','App\http\Controllers\PersonController@delete');
Route::post('person/del','App\http\Controllers\PersonController@remove');

Route::get('board','App\http\Controllers\BoardController@index');
Route::get('board/add','App\http\Controllers\BoardController@add');
Route::post('board/add','App\http\Controllers\BoardController@create');

Route::resource('rest','App\http\Controllers\RestappController');

Route::get('hello/rest','App\http\Controllers\HelloController@rest');

Route::get('hello/session','App\http\Controllers\HelloController@ses_get');
Route::post('hello/session','App\http\Controllers\HelloController@ses_put');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('hello/auth','App\http\Controllers\HelloController@getAuth');
Route::post('hello/auth','App\http\Controllers\HelloController@postAuth');

Route::get('no_route','App\http\Controllers\HelloController@test');

// Route::get('world','App\http\Controllers\WorldController@index')->name('World');
// Route::get('world/other','App\http\Controllers\WorldController@other');
// Route::get('world/{id}','App\http\Controllers\WorldController@index')->where('id','[0-9]+');

// Route::middleware([WorldMiddleware::class])->group(function(){
//   Route::get('/world','App\http\Controllers\WorldController@index');
//   Route::get('/world/other','App\http\Controllers\WorldController@other');
// });

// Route::namespace('App\http\Controllers\Sample')->group(function(){
//   Route::get('/sample','SampleController@index');
//   Route::get('/sample/other','SampleController@other');
// });

// Route::get('world/{person}','App\http\Controllers\WorldController@index');

// Route::get('/world','App\http\Controllers\WorldController@index');
// Route::get('/world/other','App\http\Controllers\WorldController@other');
Route::get('/sample','App\http\Controllers\Sample\SampleController@index')->name('sample');

// Route::get('/world','App\http\Controllers\WorldController@index')->name('world');
// Route::get('/world/{msg}','App\http\Controllers\WorldController@other');
// Route::post('/world/other','App\http\Controllers\WorldController@other');

// Route::get('/world','App\http\Controllers\WorldController@index');
// Route::post('/world','App\http\Controllers\WorldController@index');

// Route::get('/world/other','App\http\Controllers\WorldController@other');
// Route::get('/world','App\http\Controllers\WorldController@index');

// Route::get('/world/{id}','App\http\Controllers\WorldController@index');

// Route::get('/world/','App\http\Controllers\WorldController@index')->name('world');

// Route::get('/world','App\http\Controllers\WorldController@index')->middleware(App\Http\Middleware\MyMiddleware::class);
// Route::get('/world/{id}','App\http\Controllers\WorldController@index')->middleware(App\Http\Middleware\MyMiddleware::class);

// Route::get('/world','App\Http\Controllers\WorldController@index')->middleware('MyMW')->name('world');
Route::get('/world','App\Http\Controllers\WorldController@index')->name('world');
Route::post('/world','App\Http\Controllers\WorldController@send');
// Route::get('/world/{id}','App\http\Controllers\WorldController@index')->middleware('MyMW');
// Route::get('/world/{id}/{name}','App\http\Controllers\WorldController@save');
// Route::get('world/other','App\http\Controllers\WorldController@other');

Route::get('/world/json','App\http\Controllers\WorldController@json');
Route::get('/world/json/{id}','App\http\Controllers\WorldController@json');
Route::get('/world/{person}','App\http\Controllers\WorldController@index');

?>
