<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

//Import Package Shinobi Role
use Caffeinated\Shinobi\Models\Role;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return \view('managers.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return \view('managers.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        //Obtener todos los roles del sistema
        $roles = Role::get();
        alert()->warning('Alert: ','Acontinuación podra editar la información de un usuario y el acceso al sistema, use la herramienta de selección de role especial o la asignacion personalizada de
        permisos del sistema');

        return \view ('managers.users.edit', compact('user', 'roles'));

    }

    public function update(UpdateUserRequest $request, $id)
    {
        //Actualizar usuario:
        $user = User::find($id);
        
        //Actualizar roles
        $user->update($request->all());
        $user->roles()->sync($request->get('roles'));
        return redirect()->route('managers.index');
    
    }
}
