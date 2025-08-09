<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Vérifier si l'utilisateur a un rôle admin
            if (in_array($user->role, ['admin', 'main_admin'])) {
                $user->update(['last_login' => now()]);
                $request->session()->regenerate();
                
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Connexion réussie ! Bienvenue dans l\'espace admin.');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Accès non autorisé. Seuls les administrateurs peuvent accéder à cette section.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        // Statistiques pour le dashboard
        $stats = [
            'total_biens' => \App\Models\BienImmobilier::count(),
            'biens_actifs' => \App\Models\BienImmobilier::where('statut', 'disponible')->count(),
            'total_photos' => \App\Models\Photo::count(),
            'total_admins' => User::whereIn('role', ['admin', 'main_admin'])->count(),
        ];
        
        return view('admin.dashboard', compact('user', 'stats'));
    }
}
