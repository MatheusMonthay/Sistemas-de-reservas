<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Exibe o formulário de edição do perfil
    public function editProfile()
    {
        $user = Auth::user(); // Obtém o usuário autenticado
        return view('user.profile', compact('user'));
    }

    // Atualiza os dados do perfil
    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Obtém o usuário autenticado
        
        // Valida os dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'cpf' => 'required|string|unique:users,cpf,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Atualiza os dados do usuário
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => $request->password ? $request->password : $user->password,
        ]);

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }
}