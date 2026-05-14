<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\HomeController; 
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- ROTAS PÚBLICAS ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- SISTEMA DE AUTENTICAÇÃO MANUAL (Resolve o erro do auth.php em falta) ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/products');
    }

    return back()->withErrors([
        'email' => 'As credenciais não coincidem com nossos registros.',
    ])->onlyInput('email');
})->name('login.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');


// --- GRUPO PROTEGIDO (SÓ PARA LOGADOS) ---
Route::middleware(['auth'])->group(function () {
    
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    
    Route::get('/products/new', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products/new', [ProductsController::class, 'store'])->name('products.store');

    Route::get('/products/update/{id}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::post('/products/update', [ProductsController::class, 'update'])->name('products.update');
    
    Route::get('/products/delete/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

    Route::get('/products/report', [ProductsController::class, 'report'])->name('products.report');
    Route::get('/products/report/pdf', [ProductsController::class, 'reportPdf'])->name('products.reportPdf');
});