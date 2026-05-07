<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index()
    {
        $destinations = \App\Models\Destinasi::orderBy('rating', 'desc')->get();
        return view('wisata', compact('destinations'));
    }
}
