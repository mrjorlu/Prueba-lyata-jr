<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DesifrarMaullidoRequest;

class DesifrarMaullidoController extends Controller
{
    //Maximo de frases posibles
    private const MAX_FRASES = 100000;
    /**
     * Devuelve la posibles frases segun el maullido
     * @param  App\Http\Requests\Api\DesifrarMaullidoRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function descifrarMaullido(DesifrarMaullidoRequest $request){
        $maullido           = $request->input('maullido');
        //convierte el array en un diccionario sin datos repetidos
        $diccionarioFelino  = array_flip(array_unique($request->input('diccionarioFelino')));
        //memoria de frases hechas
        $memoria =[];
        $contador = 0;
        $frases = $this->generarFrases($maullido, $diccionarioFelino, $memoria, $contador);

        return response()->json(['maullidoSecreto' => $frases]);
    }

    /**
     * Genera las posibles frases a partir del diccionario
     * @param string $maullido Maullido codificado
     * @param array $diccionarioFelino Array de palabras felinas
     * @param array &$memoria Array para almacenar resultados
     * @param int &$contator Integer para saber cuantas frases se han desifrado
     * @return array $frases Posibles frases desifradas del maullido
     */
    private function generarFrases(String $maullido, array $diccionarioFelino, array &$memoria, int &$contador){
        if(isset($memoria[$maullido])){
            return $memoria[$maullido];
        }
        $frases = [];
        //el maullido completo es una posible frase
        if(isset($diccionarioFelino[$maullido])){
            //si no se ha alcanzado el maximo de frases posibles se sigue almacenado frases
            if($contador < self::MAX_FRASES) {
                $frases[] = $maullido;
                $contador++;
            }else
                return $memoria[$maullido] = $frases;
        }
        //busca posibles frases del maullido
        for($i = 1; $i < strlen($maullido); $i++){
            //rompe ciclo si alcanza el maximo de frases posibles:10^5
            if($contador >= self::MAX_FRASES)break;
            //divide el maullido en partes
            $izq = substr($maullido,0, $i);
            $der = substr($maullido, $i);
            //si existe en el diccionario la frase iz comienza a buscar el resto de la frase
            if(isset($diccionarioFelino[$izq])){
                $frasesDer = $this->generarFrases($der, $diccionarioFelino, $memoria, $contador);
                foreach($frasesDer as $frase){
                    if($contador >= self::MAX_FRASES)
                        break;
                    $frases[]= $izq. ' '.$frase;
                    $contador++;
                }
            }
        }
        return $memoria[$maullido] = $frases;
    }
}
