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
        $tipo = collect([
            ['nombre' => 'Temperatura ambiente'],
            ['nombre' => 'Temperatura agua'],
            ['nombre' => 'PH'],
            ['nombre' => 'Conductividad'],
            ['nombre' => 'Turbiedad'],
            ['nombre' => 'Calidad del aire'],
            ['nombre' => 'Propano'],
            ['nombre' => 'Monoxido de carbono'],
            ['nombre' => 'Flujo del agua'],
            ['nombre' => 'Luminosidad'],
            ['nombre' => 'Flujo lluvia'],
            ['nombre' => 'Flujo tanque'],
            ['nombre' => 'Voltaje']
        ]);

        $tipos = $tipo->pluck('nombre', 'nombre');
        return view('lestoma.Graficas.index', compact('fechaInicio', 'tipos'));
    }

    public function obtenerDatos(Request $request)
    {

        $fechaInicio = Carbon::createFromFormat('d/m/Y', $request->get('fecha_inicio'));
        $fechaFin = Carbon::createFromFormat('d/m/Y', $request->get('fecha_fin'));
        $datos = DatosHistorico::whereDate('created_at', '>=', $fechaInicio)
            ->whereDate('created_at', '<=', $fechaFin)
            ->where('fk_sede', '=', session()->get('id_sede'))
            ->get();

        $data_grafica = [];
        $fechas = [];

        foreach ($datos as $key => $data) {
            $array = json_decode($data->atributos, true);
            if(isset($array[$request->get('tipo')])){
                array_push($data_grafica, $array[$request->get('tipo')]);
                array_push($fechas, (string)$data->created_at);
            }
        }

        $datos = [];
        $datos['data'] = array($data_grafica);
        $datos['fechas'] = $fechas;
        $datos['tipo'] = $request->get('tipo');
        
        return json_encode($datos);
    }

}
