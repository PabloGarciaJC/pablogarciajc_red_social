<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function agregarContacto()
    {
        echo 'agregar contacto';
    }

    public function borrarContacto()
    {
        echo 'borrar contacto';
    }
}
