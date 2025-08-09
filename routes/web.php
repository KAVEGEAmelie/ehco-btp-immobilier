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

// Route de connexion par défaut - redirige vers admin
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Route de test pour vérifier les utilisateurs admin
Route::get('/test-users', function() {
    $users = \App\Models\User::all();
    return $users->map(function($user) {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'created_at' => $user->created_at
        ];
    });
});

// Page de test d'authentification
Route::get('/test-auth', function() {
    return view('test-auth');
});

// Route pour forcer la création d'un admin
Route::get('/create-admin', function() {
    try {
        // Supprimer tous les utilisateurs existants
        \App\Models\User::truncate();
        
        // Créer un nouvel admin
        $admin = \App\Models\User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'main_admin',
            'email_verified_at' => now(),
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Admin créé avec succès',
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => $admin->role
            ],
            'credentials' => [
                'email' => 'admin@test.com',
                'password' => 'password123'
            ]
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
});

// Route de test pour vérifier l'authentification
Route::post('/test-auth', function(\Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');
    
    // Chercher l'utilisateur
    $user = \App\Models\User::where('email', $credentials['email'])->first();
    
    if (!$user) {
        return response()->json(['error' => 'Utilisateur non trouvé', 'email' => $credentials['email']]);
    }
    
    // Tester le mot de passe
    $passwordCheck = \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password);
    
    return response()->json([
        'user_found' => true,
        'password_correct' => $passwordCheck,
        'user_role' => $user->role,
        'is_admin' => in_array($user->role, ['admin', 'main_admin']),
        'credentials_provided' => $credentials
    ]);
});

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
