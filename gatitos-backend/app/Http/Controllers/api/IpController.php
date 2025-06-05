<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IpController extends Controller
{
    #no se olvide generar el request con la validacion
     /**
     * Genera todas las posibles direcciones ip validas dada una cadena de digitos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function construirCasitas(Request $request){
        $cadenaJuguetes = $request->input('cadenaJuguetes');
        //validación de la cadena de jueguetes
        if(!$cadenaJuguetes || !preg_match('/^\d{1,20}$/', $cadenaJuguetes)){
            return response()->json(['error' => 'Cadena de jugentes invalida. La cadena de juguetes debe contener solo números y tener entre 1 y 20 dígitos'], 400);
        }
        //Realiza las posibles combinaciones
        $ips = $this->generateIps($cadenaJuguetes, 0, []);
        return response()->json($ips);
    }

    /**
     * Función para generar posibles combinaciones de ips validas
     *
     * @param string $cadenaOriginal Cadena de dígitos original
     * @param int $index indice actual desde donde comienza la siguiente casita
     * @param array $casitas Segmentos actuales de la ip construida
     * @return array $ips Arreglo que almacena todas las ips validas generadas
     */
    private function generateIps($cadenaOriginal, $index, $casitas){
        $ips = [];
        //valida si tiene las 4 casitas
        if(count($casitas) === 4){
            //valida que se hayan usado todos los digitos
            if($index === strlen($cadenaOriginal))
                $ips[] = implode('.', $casitas); // adiciona una nueva ip con las casitas separadas por .
            return $ips;
        }
        //forma casitas de 1 a 3 dpigitos
        for($long = 1; $long <= 3; $long++){
            //rompe el ciclo en caso que sea el ultimo dígito y no se complete los 3 juguetes
            if($index + $long > strlen($cadenaOriginal))
                break;
            //segmento a evaluar
            $segmento = substr($cadenaOriginal, $index, $long);
            //valida que el segmento solo tenga el juguete 0 o jueguetes entre 1 y 255
            if((strlen($segmento) > 1 && $segmento[0] === '0') || (int)$segmento > 255)
                continue;
            //crea nuevo array de casitas y agrega el segmento valido
            $nuevasCasitas = [...$casitas, $segmento];
            //agrega la nueva ip valida al array o inicia la creacion de un nuevo segmento valido
            $ips = array_merge($ips, $this->generateIps($cadenaOriginal, $index + $long, $nuevasCasitas));
        }
        return $ips;
    }
}
