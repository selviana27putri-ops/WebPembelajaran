<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Nilai;
use App\Models\Soal;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::withCount('soals')->latest()->get();
        $totalMateri = Materi::count();
        $totalSoal = Soal::count();
        $totalSiswa = Nilai::count();
        $rataRata = Nilai::count() > 0 ? round(Nilai::avg('skor')) : 0;

        return view('admin.materi.index', compact('materis', 'totalMateri', 'totalSoal', 'totalSiswa', 'rataRata'));
    }

    public function create()
    {
        return view('admin.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
            'konten' => 'required',
            'pertanyaans' => 'nullable|array',
        ]);

        $materi = Materi::create([
            'judul' => $request->judul,
            'mapel' => $request->mapel,
            'konten' => $request->konten,
        ]);

        if ($request->has('pertanyaans')) {
            foreach ($request->pertanyaans as $p) {
                if (!empty($p['teks'])) {
                    Soal::create([
                        'materi_id' => $materi->id,
                        'pertanyaan' => $p['teks'],
                        'opsi_a' => $p['a'],
                        'opsi_b' => $p['b'],
                        'opsi_c' => $p['c'],
                        'opsi_d' => $p['d'],
                        'jawaban_benar' => $p['benar']
                    ]);
                }
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Materi dan soal berhasil ditambahkan!');
    }

    public function edit(Materi $materi)
    {
        $materi->load('soals');
        return view('admin.materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
            'konten' => 'required',
            'soals' => 'nullable|array',
        ]);

        $materi->update([
            'judul' => $request->judul,
            'mapel' => $request->mapel,
            'konten' => $request->konten,
        ]);

        // Track which soal IDs are in the submitted form
        $submittedSoalIds = [];

        if ($request->has('soals')) {
            foreach ($request->soals as $soalData) {
                if (empty($soalData['teks'])) continue;

                if (!empty($soalData['id'])) {
                    // Update existing soal
                    $soal = Soal::find($soalData['id']);
                    if ($soal && $soal->materi_id === $materi->id) {
                        $soal->update([
                            'pertanyaan' => $soalData['teks'],
                            'opsi_a' => $soalData['a'],
                            'opsi_b' => $soalData['b'],
                            'opsi_c' => $soalData['c'],
                            'opsi_d' => $soalData['d'],
                            'jawaban_benar' => $soalData['benar'],
                        ]);
                        $submittedSoalIds[] = $soal->id;
                    }
                } else {
                    // Create new soal
                    $newSoal = Soal::create([
                        'materi_id' => $materi->id,
                        'pertanyaan' => $soalData['teks'],
                        'opsi_a' => $soalData['a'],
                        'opsi_b' => $soalData['b'],
                        'opsi_c' => $soalData['c'],
                        'opsi_d' => $soalData['d'],
                        'jawaban_benar' => $soalData['benar'],
                    ]);
                    $submittedSoalIds[] = $newSoal->id;
                }
            }
        }

        // Delete soals that were removed from the form
        $materi->soals()->whereNotIn('id', $submittedSoalIds)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Materi $materi)
    {
        $materi->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Materi berhasil dihapus!');
    }
}
