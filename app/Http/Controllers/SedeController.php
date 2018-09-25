<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sede;
use DataTables;

class SedeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    /**
     * Permisos asignados en el constructor del controller para poder controlar las diferentes
     * acciones posibles en la aplicación como los son:
     * Acceder, ver, crea, modificar, eliminar
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lestoma.sedes.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * Esta funcion muestra en el datatable todos los usuarios
     * depende de si eres administrador
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $sedes = Sede::all();
            return DataTables::of($sedes)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Cuando se crea un usuario se debe saber de que programa va a ser
     * y que rol va a tener
     * depende si es administrador
     */
    public function create()
    {
        return view('lestoma.Sedes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Esta funcion crea los usuarios
     */
    public function store(Request $request)
    {
        $sede = new Sede();
        $sede->nombre = $request->get('nombre');
        $sede->descripcion = $request->get('descripcion');
        $sede->save();

        return response([
            'msg' => 'Sede registrada correctamente.',
            'title' => '¡Registro exitoso!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Esta funcion muestra en el datatable todos los usuarios
     * depende de si eres administrador
     */
    /**
     * Cuando se edita un usuario se debe saber de que programa va a ser
     * y que rol va a tener
     * depende si es administrador
     */
    public function edit($id)
    {
        $sede = Sede::findOrFail($id);
        return view(
            'lestoma.Sedes.edit',
            compact('sede')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Esta funcion edita los usuarios
     */
    public function update(Request $request, $id)
    {
        $sede = Sede::find($id);
        $sede->nombre = $request->get('nombre');
        $sede->descripcion = $request->get('descripcion');
        $sede->update();

        return response([
            'msg' => 'La sede se ha sido modificado exitosamente.',
            'title' => 'Sede Modificada!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Esta funcion elimina
     */
    public function destroy($id)
    {
        Sede::destroy($id);

        return response([
            'msg' => 'La sede se ha sido eliminado exitosamente.',
            'title' => 'Sede Eliminada!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }
}
