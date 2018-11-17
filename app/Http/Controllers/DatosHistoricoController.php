<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DatosHistorico;
use DataTables;
use Illuminate\Support\Facades\Session;

class DatosHistoricoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lestoma.DatosHistoricos.index');
    }

    public function guardarDatos(Request $request)
    {
        $datos = [];
        if($request->query('temperatura_ambiente')){
            $datos['Temperatura ambiente'] = $request->query('temperatura_ambiente');
        }
        if ($request->query('temperatura_agua')) {
            $datos['Temperatura agua'] = $request->query('temperatura_agua');
        }
        if ($request->query('ph')) {
            $datos['PH'] = $request->query('ph');
        }
        if ($request->query('conductividad')) {
            $datos['Conductividad'] = $request->query('conductividad');
        }
        if ($request->query('turbiedad')) {
            $datos['Turbiedad'] = $request->query('turbiedad');
        }
        if ($request->query('calidad_aire')) {
            $datos['Calidad del aire'] = $request->query('calidad_aire');
        }
        if ($request->query('propano')) {
            $datos['Propano'] = $request->query('propano');
        }
        if ($request->query('monoxido_carbono')) {
            $datos['Monoxido de carbono'] = $request->query('monoxido_carbono');
        }
        if ($request->query('flujo_agua')) {
            $datos['Flujo del agua'] = $request->query('flujo_agua');
        }
        if ($request->query('luminosidad')) {
            $datos['Luminosidad'] = $request->query('luminosidad');
        }
        if ($request->query('flujo_lluvia')) {
            $datos['Flujo lluvia'] = $request->query('flujo_lluvia');
        }
        if ($request->query('flujo_tanque')) {
            $datos['Flujo tanque'] = $request->query('flujo_tanque');
        }
        if ($request->query('voltaje')) {
            $datos['Voltaje'] = $request->query('voltaje');
        }
        
        $id_sede = $request->query('sede');

        $datos_historicos = new DatosHistorico();
        $datos_historicos->fk_sede = $id_sede;
        $datos_historicos->atributos = json_encode($datos);
        $datos_historicos->save();

    }
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $datos_historicos = DatosHistorico::where('fk_sede', session('id_sede'));
            return DataTables::of($datos_historicos)
                ->make(true);
        }
    }
}
