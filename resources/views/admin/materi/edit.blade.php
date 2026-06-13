@extends('layouts.admin')

@section('page-title', 'Edit Materi')

@section('top-actions')
    <a href="{{ route('admin.dashboard') }}" class="top-bar-link btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Kembali
    </a>
@endsection

@section('content')
    <div class="form-card">
        <form action="{{ route('admin.materi.update', $materi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Judul Materi</label>
                    <input type="text" name="judul" class="form-control" required value="{{ old('judul', $materi->judul) }}">
                    @error('judul') <div style="color: var(--accent-red); font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Mata Pelajaran</label>
                    <div class="select-wrap">
                        <select name="mapel" class="form-control" required>
                            <option value="MS Office" {{ $materi->mapel == 'MS Office' ? 'selected' : '' }}>MS Office</option>
                            <option value="Desain Grafis" {{ $materi->mapel == 'Desain Grafis' ? 'selected' : '' }}>Desain Grafis</option>
                            <option value="Multimedia" {{ $materi->mapel == 'Multimedia' ? 'selected' : '' }}>Multimedia</option>
                            <option value="Jaringan" {{ $materi->mapel == 'Jaringan' ? 'selected' : '' }}>Jaringan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Materi</label>
                <textarea name="konten" rows="8" class="form-control" required>{{ old('konten', $materi->konten) }}</textarea>
                @error('konten') <div style="color: var(--accent-red); font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div> @enderror
            </div>

            <hr class="form-divider">

            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 24px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--accent-purple)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                <span style="font-size: 1.1rem; font-weight: 700;">Soal Kuis</span>
                <span style="color: var(--text-muted); font-size: 0.85rem;">({{ $materi->soals->count() }} soal saat ini)</span>
            </div>

            <div id="soal-container">
                @foreach($materi->soals as $index => $soal)
                <div class="soal-block" id="soal-existing-{{ $soal->id }}">
                    <div class="soal-header">
                        <div class="soal-title">Pertanyaan {{ $index + 1 }}</div>
                        @if($index > 0)
                        <button type="button" onclick="hapusSoal('soal-existing-{{ $soal->id }}')" class="soal-delete">Hapus</button>
                        @endif
                    </div>
                    <input type="hidden" name="soals[{{ $index }}][id]" value="{{ $soal->id }}">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <input type="text" name="soals[{{ $index }}][teks]" class="form-control" required value="{{ $soal->pertanyaan }}">
                    </div>
                    <div class="opsi-grid">
                        <div class="opsi-item">
                            <span class="opsi-label">A.</span>
                            <input type="text" name="soals[{{ $index }}][a]" class="form-control" required value="{{ $soal->opsi_a }}">
                        </div>
                        <div class="opsi-item">
                            <span class="opsi-label">B.</span>
                            <input type="text" name="soals[{{ $index }}][b]" class="form-control" required value="{{ $soal->opsi_b }}">
                        </div>
                        <div class="opsi-item">
                            <span class="opsi-label">C.</span>
                            <input type="text" name="soals[{{ $index }}][c]" class="form-control" required value="{{ $soal->opsi_c }}">
                        </div>
                        <div class="opsi-item">
                            <span class="opsi-label">D.</span>
                            <input type="text" name="soals[{{ $index }}][d]" class="form-control" required value="{{ $soal->opsi_d }}">
                        </div>
                    </div>
                    <div class="jawaban-benar-row">
                        <span class="jawaban-label">Jawaban Benar:</span>
                        <div class="select-wrap" style="flex: 1;">
                            <select name="soals[{{ $index }}][benar]" class="form-control">
                                <option value="A" {{ $soal->jawaban_benar == 'A' ? 'selected' : '' }}>Opsi A</option>
                                <option value="B" {{ $soal->jawaban_benar == 'B' ? 'selected' : '' }}>Opsi B</option>
                                <option value="C" {{ $soal->jawaban_benar == 'C' ? 'selected' : '' }}>Opsi C</option>
                                <option value="D" {{ $soal->jawaban_benar == 'D' ? 'selected' : '' }}>Opsi D</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="button" onclick="tambahSoalBaru()" class="btn-add-soal">+ Tambah Pertanyaan Baru</button>

            <div class="form-actions">
                <a href="{{ route('admin.dashboard') }}" class="top-bar-link btn-secondary">Batal</a>
                <button type="submit" class="top-bar-link btn-primary" style="border: none; cursor: pointer; font-family: 'Outfit';">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    let newSoalCount = {{ $materi->soals->count() }};
    function tambahSoalBaru() {
        const container = document.getElementById('soal-container');
        const idx = newSoalCount;
        const num = newSoalCount + 1;
        const html = `
            <div class="soal-block" id="soal-new-${num}">
                <div class="soal-header">
                    <div class="soal-title">Pertanyaan Baru ${num}</div>
                    <button type="button" onclick="hapusSoal('soal-new-${num}')" class="soal-delete">Hapus</button>
                </div>
                <input type="hidden" name="soals[${idx}][id]" value="">
                <div class="form-group" style="margin-bottom: 16px;">
                    <input type="text" name="soals[${idx}][teks]" class="form-control" required placeholder="Tuliskan pertanyaannya...">
                </div>
                <div class="opsi-grid">
                    <div class="opsi-item"><span class="opsi-label">A.</span><input type="text" name="soals[${idx}][a]" class="form-control" placeholder="Opsi A" required></div>
                    <div class="opsi-item"><span class="opsi-label">B.</span><input type="text" name="soals[${idx}][b]" class="form-control" placeholder="Opsi B" required></div>
                    <div class="opsi-item"><span class="opsi-label">C.</span><input type="text" name="soals[${idx}][c]" class="form-control" placeholder="Opsi C" required></div>
                    <div class="opsi-item"><span class="opsi-label">D.</span><input type="text" name="soals[${idx}][d]" class="form-control" placeholder="Opsi D" required></div>
                </div>
                <div class="jawaban-benar-row">
                    <span class="jawaban-label">Jawaban Benar:</span>
                    <div class="select-wrap" style="flex: 1;">
                        <select name="soals[${idx}][benar]" class="form-control">
                            <option value="A">Opsi A</option><option value="B">Opsi B</option><option value="C">Opsi C</option><option value="D">Opsi D</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        newSoalCount++;
    }
    function hapusSoal(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }
</script>
@endsection
