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

// Route::get('/', function () {
     
//     $name = '北京欢迎你';
//     return view('welcome',['name'=>$name]);
// });
// Route::get('/show', function (){
    
//      echo "<h3>这里是商品详情页<h3>";
//      //echo $show_id;
//  });
// Route::get('/show/{id?}', function ($show_id=null) {
    
//    // echo "<h3>这里是商品详情页<h3>";
//     echo $show_id;
// });
// Route::get('/show/{id}/{name}', function ($show_id,$name) {
    
//   //  echo "<h3>这里是商品详情页<h3>";
//     echo $show_id;
//     echo $name;
// });
// // Route::get('/shows','userController@show');

// Route::view('/shows','shows.show',['aa'=>'商品详情页']);
// Route::view('/category','shows.show');

// Route::get('/cartgory/add', function(){
//     $fid = '服装';
//     return view('cartgory/add',['fid'=>$fid]);
//  });


// Route::view('/brand','brand.add');
// Route::get('/brands','UserController@brands');


// Route::get('/user','userController@index');

// Route::get('/adduser','userController@add');
// Route::post('/adddo','userController@adddo')->name('do');

// Route::post('/adddo','userController@adddo');

// Route::get('/jian/{id}/{name}', function ($id,$name) {
    
//       echo "商品id";
//       echo $id;
//       echo '商品名称';
//       echo $name;
//   })->where(['name'=>'\w+']);

//   //外来务工人员统计
//   Route::prefix('people')->group(function(){

//   Route::get('create','PeopleController@create');
//   Route::post('store','PeopleController@store');
//   Route::get('/','PeopleController@index');
//   Route::get('edit/{id}','PeopleController@edit');
//   Route::post('update/{id}','PeopleController@update');
//   Route::get('destroy/{id}','PeopleController@destroy');
//   });

//   //学生表
//   Route::prefix('student')->middleware('checklogin')->group(function(){

//   Route::get('create','StudentController@create');
//   Route::post('store','StudentController@store');
//   Route::get('/','StudentController@index');
//   Route::get('edit/{id}','StudentController@edit');
//   Route::post('update/{id}','StudentController@update');
//   Route::get('destroy/{id}','StudentController@destroy');
// // });
Route::get('/','Index\IndexController@index');
Route::get('/product','Index\IndexController@product');

Route::view('/login','index.login');
Route::view('/register','index.register');
Route::get('/setcookie','Index\IndexController@setcookie');
Route::get('/send','Index\IndexController@ajaxsend');


  //品牌表
  Route::prefix('brand')->group(function(){

  Route::get('create','BrandController@create');
  Route::post('store','BrandController@store');
  Route::get('/','BrandController@index');
  Route::get('edit/{id}','BrandController@edit');
  Route::post('update/{id}','BrandController@update');
  Route::get('destroy/{id}','BrandController@destroy');

});
// Route::view('/login','login');
// Route::post('logindo','LoginController@logindo');

//新闻表
// Route::prefix('title')->group(function(){

//   Route::get('create','TitleController@create');
//   Route::post('store','TitleController@store');
//   Route::get('/','TitleController@index');
//   Route::get('edit/{id}','TitleController@edit');
//   Route::post('update/{id}','TitleController@update');
//   Route::get('destroy/{id}','TitleController@destroy');
//   Route::post('checkOnly','TitleController@checkOnly');

// });
// Route::view('/login','login');
// Route::post('logindo','LoginController@logindo');



//分类
Route::prefix('category')->group(function(){

  Route::get('create','CategoryController@create');
  Route::post('store','CategoryController@store');
  Route::get('/','CategoryController@index');
  Route::get('edit/{id}','CategoryController@edit');
  Route::post('update/{id}','CategoryController@update');
  Route::get('destroy/{id}','CategoryController@destroy');
  Route::post('checkOnly','CategoryController@checkOnly');

});
//商品表
Route::prefix('goods')->group(function(){

  Route::get('create','GoodsController@create');
  Route::post('store','GoodsController@store');
  Route::get('/','GoodsController@index');
  Route::get('edit/{id}','GoodsController@edit');
  Route::post('update/{id}','GoodsController@update');
  Route::get('destroy/{id}','GoodsController@destroy');
  Route::post('checkOnly','GoodsController@checkOnly');

});

//管理员
Route::prefix('user')->group(function(){

  Route::get('create','UserController@create');
  Route::post('store','UserController@store');
  Route::get('/','UserController@index');
  Route::get('edit/{id}','UserController@edit');
  Route::post('update/{id}','UserController@update');
  Route::get('destroy/{id}','UserController@destroy');
  Route::post('checkOnly','UserController@checkOnly');

});
Route::post('/regdo','Index\LoginController@regdo');
Route::prefix('login')->group(function(){

  // Route::post('dologin','Index\LoginController@dologin');
  
 
});

Route::prefix('staff')->middleware('checklogin')->group(function(){


  
  Route::get('/show/{id}','StaffController@show');
  Route::get('/','StaffController@list');
  Route::get('delete/{id}','StaffController@delete');
  Route::get('addshow','StaffController@addshow');
  Route::post('doadd','StaffController@doadd');
});
Route::get('staff/login','StaffController@login');
Route::post('staff/add','StaffController@add');

Route::get('/login','Index\LoginController@login');
Route::post('/dologin','Index\LoginController@dologin');

//发送短信
Route::get('/send','Index\LoginController@ajaxsend');
Route::get('/reg','Index\LoginController@reg');
//邮件
// Route::get('/sendemail','Index\LoginController@sendemail');