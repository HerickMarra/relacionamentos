<?php

use App\Models\Emotion;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');




Artisan::command('not', function () {
    $em = Emotion::all();

    foreach ($em as $key => $emotion) {
        echo "oi\n";
        $user = User::where('id' , '!=',  $emotion->user_id)->first();
        $user2 = User::where('id' ,  $emotion->user_id)->first();
        $iconClass = ($emotion->emotion == 'alert')
        ? 'bi bi-exclamation-triangle-fill'
        : (($emotion->emotion == 'serious')
        ? 'bi bi-exclamation-octagon-fill'
        : 'bi bi-emoji-heart-eyes-fill');


        $cor = ($emotion->emotion == 'alert')
        ? '#FFB800'
        : (($emotion->emotion == 'serious')
        ? '#FC1A1A'
        : '#3BB900');

        Notification::create([
            'image'=> $user2->profile_picture,
            'color'=> $cor,
            'subdesc'=> $emotion->level."/10",
            'desc'=> $emotion->description,
            'notification'=> '',
            'status'=> 'pendente',
            'title'=> $user2->name,
            'icon' =>$iconClass,
            'user_id' => $user->id ,
        ]);
    }
})->purpose('Display an inspiring quote');
