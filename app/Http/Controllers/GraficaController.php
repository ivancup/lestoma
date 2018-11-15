<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\DatosHistorico;
use Illuminate\Support\Facades\Session;

class GraficaController extends Controller
{
    public function index()
    {
        $fechaInicio = Carbon::now();
        return view('lestoma.Graficas.index', compact('fechaInicio'));
    }

    public function obtenerDatos(Request $request)
    {
        $fechaInicio = Carbon::createFromFormat('d/m/Y', $request->get('fecha_inicio'));
        $fechaFin = Carbon::createFromFormat('d/m/Y', $request->get('fecha_fin'));
        $datos = DatosHistorico::whereDate('created_at', '>=', $fechaInicio)
            ->whereDate('created_at', '<=', $fechaFin)
            ->where('fk_sede', '=', session()->get('id_sede'))
            ->get();

        $temperatura_ambiente = [];
        $temperatura_agua = [];
        $ph = [];
        $humedad = [];
        $fechas = [];

        foreach ($datos as $key => $data) {
            array_push($temperatura_ambiente, $data->temperatura_ambiente);
            array_push($temperatura_agua, $data->temperatura_agua);
            array_push($ph, $data->ph);
            array_push($humedad, $data->humedad);
            array_push($fechas, (string)$data->created_at);
        }

        $datos = [];
        $datos['temperaturas'] = array($temperatura_ambiente, $temperatura_agua);
        $datos['ph'] = array($ph);
        $datos['humedad'] = array($humedad);
        $datos['fechas'] = $fechas;
        
        return json_encode($datos);
    }

}
