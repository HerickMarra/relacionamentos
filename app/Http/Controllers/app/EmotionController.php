<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Emotion;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class EmotionController extends Controller
{

    public function index(Request $request, $id){

        $emotions = User::where('id', $id)->with(['emotions' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->first();
        return view('emotion.index', compact('emotions'));
    }


    public function createEmotion(Request $request){
        $emotion = $request->emotion;
        $emotion['user_id'] = Auth()->user()->id;

        Emotion::create($emotion);
        $user = User::where('id' , '!=',  $emotion['user_id'])->first();

        $iconClass = ($emotion['emotion'] == 'alert')
        ? 'bi bi-exclamation-triangle-fill'
        : (($emotion['emotion'] == 'serious')
        ? 'bi bi-exclamation-octagon-fill'
        : 'bi bi-emoji-heart-eyes-fill');


        $cor = ($emotion['emotion'] == 'alert')
        ? '#FFB800'
        : (($emotion['emotion'] == 'serious')
        ? '#FC1A1A'
        : '#3BB900');

        Notification::create([
            'image'=> auth()->user()->profile_picture,
            'color'=> $cor,
            'subdesc'=> $emotion['level']."/10",
            'desc'=> $emotion['description'],
            'notification'=> '',
            'status'=> 'pendente',
            'title'=> auth()->user()->name,
            'icon' =>$iconClass,
            'user_id' => $user->id ,
        ]);
        return response()->json([
            "status" => true,
        ]);
    }
}
