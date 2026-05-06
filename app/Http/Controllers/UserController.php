<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }
        $usuarios = User::all();
        return view('admin.users.index', compact('usuarios'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
            'municipio' => 'nullable|string|max:255'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'municipio' => $request->municipio
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado exitosamente');
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }
        $usuario = User::findOrFail($id);
        return view('admin.users.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }

        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
            'municipio' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8'
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'municipio' => $request->municipio
        ]);

        if ($request->filled('password')) {
            $usuario->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }

        $usuario = User::findOrFail($id);

        if ($usuario->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'No puedes eliminar tu propio usuario');
        }

        $usuario->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }
}
