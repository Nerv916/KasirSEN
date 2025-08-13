<?php

namespace App\Http\Controllers;

use App\Models\PertaminaTrx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerPertaminaTrx extends Controller
{
   public function index()
    {
        return view('pertamina.index');
    }

    public function simpan(Request $request)
    {
        try {
            $data = $request->validate([
                'jenis_bbm' => 'required|string|max:50',
                'liter' => 'required|numeric|min:0.01',
                'harga_per_liter' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0'
            ]);

            $data['user_id'] = Auth::id();

            PertaminaTrx::create($data);

            return response()->json(['message' => 'Berhasil disimpan']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan', 'error' => $e->getMessage()], 500);
        }
    }
}
