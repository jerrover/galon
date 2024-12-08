<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $search = $request->input('search', '');
            
            $query = DB::table('pegawai');
            
            if (!empty($search)) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('no_hp', 'like', "%{$search}%");
            }
            
            $totalData = $query->count();
            $pegawai = $query->orderBy('nama', 'asc')->paginate($perPage);
            
            $from = $pegawai->firstItem() ?? 0;
            $to = $pegawai->lastItem() ?? 0;

            return view('datapegawai.index', compact(
                'pegawai', 
                'perPage', 
                'totalData',
                'from',
                'to'
            ));
        } catch (\Exception $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengambil data');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
            ]);

            DB::table('pegawai')->insert([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pegawai berhasil ditambahkan'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $pegawai = DB::table('pegawai')->where('id', $id)->first();

            if (!$pegawai) {
                throw new \Exception('Data pegawai tidak ditemukan');
            }

            return response()->json($pegawai);
        } catch (\Exception $e) {
            Log::error('Error in edit method: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
            ]);

            $result = DB::table('pegawai')
                ->where('id', $id)
                ->update([
                    'nama' => $request->nama,
                    'no_hp' => $request->no_hp
                ]);

            if ($result === 0) {
                throw new \Exception('Tidak ada perubahan data');
            }

            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in update method: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $result = DB::table('pegawai')->where('id', $id)->delete();

            if (!$result) {
                throw new \Exception('Gagal menghapus data');
            }

            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in destroy method: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}