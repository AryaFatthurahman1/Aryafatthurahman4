<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display the reservation page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('reservation.index');
    }
}
