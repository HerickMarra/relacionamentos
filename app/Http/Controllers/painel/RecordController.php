<?php

namespace App\Http\Controllers\painel;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(){
        return view('record.index');
    }


    public function get(Request $request){
        $pageNumber = $request->page ?? 1;
        $records = Record::with('user')
        ->orderBy('id', 'desc')
        ->paginate(10, ['*'], 'page', $pageNumber);

        return response()->json($records);
    }

    public function create(Request $request){
        $base64Image = $request->input('image');

        // Verifique se a string base64 começa com a marcação correta
        if (strpos($base64Image, 'data:image') === 0) {
            // Remova o cabeçalho
            $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);

            // Decodifique a string base64 em binário
            $imageData = base64_decode($base64Image);

            // Nomeie o arquivo de forma única
            $filename = uniqid('image_') . '.png';

            // Salve o binário em um arquivo
            $path = public_path('uploads/records/' . $filename);
            file_put_contents($path, $imageData);
            Record::create([
                'picture' => '/uploads/records/' . $filename,
                'date' => now(),
                'desc' => $request->desc ?? '',
                'user_id' => auth()->user()->id,
            ]);
            // Retorne o caminho do arquivo salvo
            return response()->json(['path' => '/uploads/records/' . $filename]);
        } else {
            // Retorna uma resposta de erro se a marcação não estiver correta
            return response()->json(['error' => 'Base64 data is not in the correct format'], 400);
        }
    }
}
