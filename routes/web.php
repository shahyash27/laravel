<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use OpenAI\Laravel\Facades\OpenAI;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\TicketController;

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

	/* create */
	/*$insertRes = Db::insert("INSERT INTO users (username,email,password) values('test','test@gmail.com','tP45412')");
	dd($insertRes);*/ 
   
	/* update */
	/*$updateRes = Db::update("UPDATE users SET email='test2@gmail.com' WHERE id=2");
	dd($updateRes);*/

	/* delete */
	/*$deleteRes = Db::delete("DELETE FROM users WHERE id=2");
	dd($deleteRes);*/

	/* read */
	//$users = DB::select("SELECT * FROM users");

	/*$insert = DB::table('users')->insert(['username' => 'test3','email' => 'test3@gmail.com','password' => 'test2148']);*/

	//$update = DB::table('users')->where('id',4)->update(['email' => 'test2edit@gmail.com']);

	//$delete = DB::table('users')->where('id',6)->delete();

	// $users = DB::table('users')->get();

	//$userObj = new User();
	//dd(get_class_methods($userObj));
	//$users = User::all();
	//dd($users);

	//$user = User::create(['username' => 'test5','email' => 'test11@gmail.com','password' => 'test21444']);
	//$user = User::find(13);
	//echo $user->username;
	//echo '<br>';
	//dd($name);
	//echo $user->email;
	//$update = $user->update(['email' => 'test2editagain@gmail.com']);

	//dd($userCreate);

	//$user->delete();
	//dd($user);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/image',[ProfileController::class,'image'])->name('profile.image');
});

Route::get('/openai',function(){
	$result = OpenAI::images()->create([
    //'model' => 'text-davinci-003',
    'prompt' => 'Create avatar for user with name '.auth()->user()->username,
    'n'=> 1,
    'size' => '256x256'
]);
	/*echo '<pre>';
	print_r($result);
	exit;
	echo $result['choices'][0]['text'];*/ // an open-source, widely-used, server-side scripting language.
});


require __DIR__.'/auth.php';
 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    // $user->token
});


Route::middleware('auth')->group(function() {
	//Route::get('/ticket/create',[TicketController::class,'create'])->name('ticket.create');
	//Route::post('/ticket/create',[TicketController::class,'store'])->name('ticket.store');
	Route::resource('ticket',TicketController::class);
});

//dd($user);
//parmarjay41@gmail.com
//Pj@411995

/*MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=shahyash2790@gmail.com
MAIL_PASSWORD=Ys@151995*/