<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TareaPendiente;
use App\TareaHistorial;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ControlProtocoloController extends Controller
{
    public function index()
    {
        return view('lestoma.ControlProtocolos.index');
    }

    public function data(Request $request)
    {
        
    }

    public function enviar_protocolo(Request $request)
    {
        $tarea = new TareaPendiente();
        $tarea->fk_protocolo = $request->get('id_protocolo');
        $tarea->fk_user = Auth::user()->id;
        $tarea->save();

        return response([
            'msg' => 'Protocolo enviado exitosamente.',
            'title' => '¡Protocolo enviado!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }

    public function enviar_tareas_pendientes()
    {
        $tarea = TareaPendiente::with('protocolo')
            ->orderBy('created_at', 'asc')
            ->take(1)
            ->get();

        return view('lestoma.ControlProtocolos.enviar_arduino', compact('tarea'));
    }


    public function terminar_tarea($id)
    {
        $tarea = TareaPendiente::with('protocolo')
            ->where('id', '=', $id)
            ->get();
        $tarea_historial = new TareaHistorial();
        $tarea_historial->nombre_tarea = $tarea[0]->protocolo->nombre;
        $tarea_historial->protocolo = $tarea[0]->protocolo->protocolo;
        $tarea_historial->fk_users = $tarea[0]->fk_user;
        $tarea_historial->save();

        TareaPendiente::destroy($id);

        return('exito');
    }

    public function tareasTerminadas()
    {
        return view('lestoma.DatosHistoricos.tareas_terminadas');
    }

    public function tareasTerminadasData(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $tareasTerminadas = TareaHistorial::with('user')
                ->orderBy('created_at' , 'asc')
                ->get();
            return DataTables::of($tareasTerminadas)
                ->addColumn('usuario', function ($tareaTerminada) {
                    return $tareaTerminada->user->name . ' ' . $tareaTerminada->user->lastname;
                })
                ->make(true);

        }
    }
}
