<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OcorrenciaController extends Controller
{
    public function index()
    {
        return view('ocorrencia.index');
    }
}