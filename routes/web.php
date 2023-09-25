<?php

use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
   //$users = DB::table('users')->where('id, 1')->get();
//    $user = DB::table('users')->insert([
//     'name' => 'Nuel',
//     'email' => 'add1@NBC.com',
//     'password' => 'password'
//    ]);
// $users = User::create([
//     'name' => 'Nuel1',
//     'email'=> 'deez@NBC.com',
//     'password' => 'password'
// ]);
//$users = User::find(4);
//$users = User::all();
 //  dd($users->name);
 });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
});

require __DIR__.'/auth.php';
