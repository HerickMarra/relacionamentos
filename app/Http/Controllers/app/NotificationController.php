<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function count(){
        return response()->json([
            'status' => true,
            'count' => Notification::where('user_id', Auth()->user()->id)->where('status', 'pendente')->count()
        ]);
    }
}
