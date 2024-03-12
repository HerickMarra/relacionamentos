<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Emotion;
use Illuminate\Http\Request;

class EmotionController extends Controller
{
    public function createEmotion(Request $request){
        $emotion = $request->emotion;
        $emotion['user_id'] = Auth()->user()->id;

        Emotion::create($emotion);
        return response()->json([
            "status" => true,
        ]);
    }
}
