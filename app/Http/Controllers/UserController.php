<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PerfilUsuarioRequest;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Estado;

class UserController extends Controller
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
        return view('lestoma.Users.index');
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

            $users = User::where('id', '!=', Auth::id());
            return DataTables::of($users)
                ->addColumn('roles', function ($users) {
                    if (!$users->roles) {
                        return '';
                    }
                    return $users->roles->map(function ($rol) {
                        return str_limit($rol->name, 30, '...');
                    })->implode(', ');
                })
                ->rawColumns(['estado'])
                ->removeColumn('cedula')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->removeColumn('id_estado')
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
        $roles = Role::pluck('name', 'name');
        $estados = Estado::pluck('nombre', 'id');
        return view('lestoma.Users.create', compact('estados', 'roles'));
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
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->id_estado = $request->get('id_estado');
        $user->save();

        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        return response([
            'msg' => 'Usuario registrado correctamente.',
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

        $estados = Estado::pluck('nombre', 'id');
        $roles = Role::pluck('name', 'name');
        $user = User::findOrFail($id);
        $edit = true;
        return view(
            'lestoma.Users.edit',
            compact('user', 'estados', 'roles', 'edit', 'programa')
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
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->except('password'));

        if ($request->get('password')) {
            $user->password = $request->get('password');
        }

        $user->update();

        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return response([
            'msg' => 'El usuario ha sido modificado exitosamente.',
            'title' => '¡Usuario Modificado!'
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
     * Esta funcion elimina los usuarios
     */
    public function destroy($id)
    {
        User::destroy($id);

        return response([
            'msg' => 'El usuario se ha sido eliminado exitosamente.',
            'title' => '¡Usuario Eliminado!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }

    public function perfil()
    {
        $estados = Estado::pluck('ESD_Nombre', 'PK_ESD_Id');
        $roles = Role::pluck('name', 'name');
        $user = User::findOrFail(Auth::id());
        $edit = true;
        return view(
            'lestoma.SuperAdministrador.Users.perfil',
            compact('user', 'estados', 'roles', 'edit')
        );
    }

    public function modificarPerfil(PerfilUsuarioRequest $request)
    {
        $user = User::find(Auth::id());
        $user->fill($request->except('password'));

        if ($request->get('password')) {
            $user->password = $request->get('password');
        }

        if ($request->get('PK_ESD_Id')) {
            $user->id_estado = $request->get('PK_ESD_Id') ? $request->get('PK_ESD_Id') : null;
        }
        $user->update();

        if ($request->input('roles')) {
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->syncRoles($roles);
        }

        return response([
            'msg' => 'El usuario se ha sido modificado exitosamente.',
            'title' => '¡Usuario Modificado!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');


    }
}
