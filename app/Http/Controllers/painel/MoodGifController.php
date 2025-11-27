<?php

namespace App\Http\Controllers\painel;

use App\Http\Controllers\Controller;
use App\Models\MoodGif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodGifController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image_url' => 'required|string',
        ]);

        MoodGif::create([
            'user_id' => Auth::id(),
            'gif_url' => $request->image_url,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'GIF salvo com sucesso!',
        ]);
    }
}
