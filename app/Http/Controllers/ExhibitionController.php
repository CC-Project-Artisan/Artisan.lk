<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    public function create()
    {
        return view('exhibition.exhibition-form');
    }
}