<?php

function lastLogin($date){
    $dataInicial = new DateTime($date);
    $dataAtual = new DateTime();
    // Calcule a diferença entre as datas
    $diferenca = $dataInicial->diff($dataAtual);
    // dd($diferenca);
    if($diferenca->days > 0 && $diferenca->days< 7){
        $plural = $diferenca->days > 1 ? 's' : '';
        return "Ultimo login a $diferenca->days dia".$plural;
    }

    if($diferenca->h > 0 && $diferenca->h< 24){
        $plural = $diferenca->h > 1 ? 's' : '';
        return "Ultimo login a $diferenca->h hora".$plural;
    }

    if($diferenca->i > 1 && $diferenca->i< 60){
        $plural = $diferenca->i > 1 ? 's' : '';
        return "Ultimo login a $diferenca->m minuto".$plural;
    }

    return "ONLINE";

}
