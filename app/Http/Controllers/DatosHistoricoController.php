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
        $temperatura_ambiente = $request->query('temperatura_ambiente');
        $temperatura_agua = $request->query('temperatura_agua');
        $ph = $request->query('ph');
        $humedad = $request->query('humedad');
        $id_sede = $request->query('sede');

        $datos_historicos = new DatosHistorico();
        $datos_historicos->temperatura_ambiente = $temperatura_ambiente;
        $datos_historicos->temperatura_agua = $temperatura_agua;
        $datos_historicos->ph = $ph;
        $datos_historicos->humedad = $humedad;
        $datos_historicos->fk_sede = $id_sede;
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
