<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    // public function index($idEmpresa){
    //     $users = User::all();
    //     $roles = Role::all();
    //     return view('roles', compact('users','roles','idEmpresa'));
    // }

    public function store(Request $request, $idEmpresa){
        $user = User::find($request->user_id);
        $user->assignRole($request->role);

        return redirect()->back()->with('message', 'Rol asignado correctamente');
    }

    public function update(Request $request, $id, $idEmpresa){
        $user = User::find($id);
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('message', 'Rol actualizado correctamente');
    }

    public function destroy($id, $idEmpresa){
        $user = User::find($id);
        $user->removeRole([$id]);

        return redirect()->back()->with('message', 'Rol eliminado correctamente');
    }
}
