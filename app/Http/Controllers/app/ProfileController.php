<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->name = $request->name;

        if ($request->image) {
            $user->profile_picture = $request->image; // Base64 handling
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Perfil atualizado com sucesso!'
        ]);
    }
}
