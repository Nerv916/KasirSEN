<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $indomaret = \App\Models\IndomaretTrx::latest()->get();
        $pertamina = \App\Models\PertaminaTrx::latest()->get();
        $alfamart = \App\Models\AlfamartTrx::latest()->get();

        return view('laporan.index', compact('indomaret', 'pertamina', 'alfamart'));
    }
}
