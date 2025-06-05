<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecuenciaFelinaController extends Controller
{
    /**
     * Devuelve la Secuencia de Siesta Felina mas larga
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function longitudSiesta(Request $request){
        $collares = $request->input('collares', []);
        //validar collares
        if(!is_array($collares)){
            return response()->json(['error', 'El campo collares debe ser un arreglo']);
        }
        //convierte el array en un diccionario y elimina datos dublicados
        $diccionario = array_flip($collares);


        $maxLongitud = 0;

        foreach ($collares as $collar){
            //valida que no tenga antecesor
            if(!isset($diccionario[$collar - 1])){
                $actual     = $collar;
                $longActual = 1;
            }
            //busca numeros consecutivos
            while (isset($diccionario[$actual + 1])){
                $actual++;
                $longActual++;
            }
            $maxLongitud = max($maxLongitud, $longActual);
        }
        return response()->json(['secuencia' => $maxLongitud]);
    }
}
