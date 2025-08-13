<?php

namespace App\Http\Controllers;

use App\Models\AlfamartTrx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AlfamartTrxController extends Controller
{
    public function index()
    {
        return view('alfamart.index');
    }

    public function simpan(Request $request)
    {
        try {
            $data = $request->input('transaksi');
            $userId = Auth::id();

            if (!$userId) {
                return response()->json(['message' => 'User tidak terautentikasi'], 401);
            }

            if (!is_array($data) || empty($data)) {
                return response()->json(['message' => 'Data transaksi kosong'], 400);
            }

            DB::beginTransaction();

            foreach ($data as $item) {
                AlfamartTrx::create([
                    'user_id' => $userId,
                    'nama_barang' => $item['nama_barang'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                    'total' => $item['total'],
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Berhasil disimpan']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
