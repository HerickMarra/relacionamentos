<?php

namespace App\Http\Controllers\painel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(){
        return view('record.index');
    }
}
