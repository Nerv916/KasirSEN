<?php

namespace App\Http\Controllers;

use App\Models\indomaretTrx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ControllerTrxIndomaret extends Controller
{
    public function index()
    {
        return view('indomaret.home');
    }

    public function simpan(Request $request)
    {
        try {
            $data = $request->input('transaksi');
            $userId = Auth::id(); // Pastikan user login

            if (!$userId) {
                return response()->json(['message' => 'User tidak terautentikasi'], 401);
            }

            if (!is_array($data) || empty($data)) {
                return response()->json(['message' => 'Data transaksi kosong'], 400);
            }

            DB::beginTransaction();

            foreach ($data as $item) {
                DB::table('indomaret_trxes')->insert([
                    'user_id' => $userId,
                    'nama_barang' => $item['nama_barang'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                    'total' => $item['total'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Berhasil disimpan',
                'data' => $data,
                'total' => array_sum(array_column($data, 'total')),
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function printStruk($id)
    {
        $data = indomaretTrx::with('details')->findOrFail($id);
        return view('indomaret.struk', compact('data'));
    }
}
