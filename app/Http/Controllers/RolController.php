<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;

class RolController extends Controller
{
    public function index()
    {
        // Obtenemos todos los roles de la base de datos
        $roles = Role::all();

        // Retornaremos una vista que crearemos a continuación
        return view('roles.index', compact('roles'));
    }
}
