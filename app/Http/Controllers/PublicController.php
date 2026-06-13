<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Nilai;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $materis = Materi::withCount('soals')->latest()->get();
        // Fetch top 10 scores with their related materi titles
        $topNilais = Nilai::with('materi')->orderBy('skor', 'desc')->latest()->take(10)->get();
        
        $mapels = Materi::select('mapel')->distinct()->pluck('mapel');

        return view('welcome', compact('materis', 'topNilais', 'mapels'));
    }

    public function riwayat(Request $request)
    {
        $nama = $request->query('nama');
        if (!$nama) return response()->json([]);

        $nilais = Nilai::with('materi')
            ->where('nama_siswa', 'like', '%' . $nama . '%')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($n) {
                return [
                    'materi' => $n->materi ? $n->materi->judul : 'Materi Dihapus',
                    'kelas' => $n->kelas,
                    'skor' => $n->skor,
                    'tanggal' => $n->created_at->format('d M Y H:i')
                ];
            });

        return response()->json($nilais);
    }

    public function show($id)
    {
        $materi = Materi::with('soals')->findOrFail($id);
        return view('materi', compact('materi'));
    }

    public function submitQuiz(Request $request, $id)
    {
        $materi = Materi::with('soals')->findOrFail($id);
        
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
        ]);

        $benar = 0;
        $total = $materi->soals->count();

        foreach ($materi->soals as $soal) {
            $jawabanSiswa = $request->input('q' . $soal->id);
            if ($jawabanSiswa === $soal->jawaban_benar) {
                $benar++;
            }
        }

        $skor = $total > 0 ? round(($benar / $total) * 100) : 0;

        Nilai::create([
            'materi_id' => $materi->id,
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'skor' => $skor
        ]);

        return response()->json([
            'success' => true,
            'namaSiswa' => $request->nama_siswa,
            'skor' => $skor
        ]);
    }
}
