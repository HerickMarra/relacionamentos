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


    public function getItens(Request $request){
        $pag = $request->pag;
        $not = Notification::where('user_id', auth()->user()->id)->skip(0)->take(50)->orderBy('id', 'desc')->get();
        if($pag == 1){
            Notification::where('user_id', auth()->user()->id)->update([
                'status' => 'visualizada'
            ]);
        }
        return response()->json($not);
    }

    public function getItem(Request $request){
        $not = Notification::where('id', $request->id)->first();

        return response()->json($not);
    }
}
