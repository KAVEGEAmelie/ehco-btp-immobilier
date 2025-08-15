<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienImmobilierController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminBienController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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

// Route pour la page d'accueil
Route::get('/', [PageController::class, 'accueil'])->name('home');

// Routes pour les pages de contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/bien/{bien}', [ContactController::class, 'contactBien'])->name('contact.bien');

// Routes pour les Biens Immobiliers (nouvelle version)
Route::get('/biens', [BienController::class, 'index'])->name('biens.index');
Route::get('/biens/{bien}', [BienController::class, 'show'])->name('biens.show');
Route::get('/biens/{bien}/photos', [BienController::class, 'getPhotos'])->name('biens.photos');

// Route de connexion par défaut - redirige vers admin
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Routes d'authentification admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Routes non protégées (connexion)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    
    // Routes protégées par le middleware admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        
        // Gestion du profil utilisateur
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
        
        // Gestion des biens immobiliers
        Route::resource('biens', AdminBienController::class);
        Route::post('/biens/photo/delete', [AdminBienController::class, 'deletePhoto'])->name('biens.photo.delete');
        
        // Routes réservées au main admin uniquement
        Route::middleware('main-admin')->group(function () {
            Route::resource('users', AdminUserController::class);
        });
    });
});

// --- Routes anciennes (à supprimer plus tard) ---
// Route::get('/biens-old', [BienImmobilierController::class, 'index'])->name('biens-old.index');
// Route::get('/biens-old/{bien}', [BienImmobilierController::class, 'show'])->name('biens-old.show');
