@extends('layouts.admin')

@section('page-title', 'Tambah Materi Baru')

@section('top-actions')
    <a href="{{ route('admin.dashboard') }}" class="top-bar-link btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Kembali
    </a>
@endsection

@section('content')
    <div class="form-card">
        <form action="{{ route('admin.materi.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Judul Materi</label>
                    <input type="text" name="judul" class="form-control" required placeholder="Cth: Hukum Newton" value="{{ old('judul') }}">
                    @error('judul') <div style="color: var(--accent-red); font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Mata Pelajaran</label>
                    <div class="select-wrap">
                        <select name="mapel" class="form-control" required>
                            <option value="MS Office" {{ old('mapel') == 'MS Office' ? 'selected' : '' }}>MS Office</option>
                            <option value="Desain Grafis" {{ old('mapel') == 'Desain Grafis' ? 'selected' : '' }}>Desain Grafis</option>
                            <option value="Multimedia" {{ old('mapel') == 'Multimedia' ? 'selected' : '' }}>Multimedia</option>
                            <option value="Jaringan" {{ old('mapel') == 'Jaringan' ? 'selected' : '' }}>Jaringan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Materi</label>
                <textarea name="konten" rows="8" class="form-control" required placeholder="Ketik ringkasan materi di sini. Anda bisa menggunakan tag HTML dasar.">{{ old('konten') }}</textarea>
                @error('konten') <div style="color: var(--accent-red); font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div> @enderror
            </div>

            <hr class="form-divider">

            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 24px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--accent-purple)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                <span style="font-size: 1.1rem; font-weight: 700;">Tambahkan Soal Kuis</span>
            </div>

            <div id="soal-container">
                <div class="soal-block" id="soal-1">
                    <div class="soal-header">
                        <div class="soal-title">Pertanyaan 1</div>
                    </div>
                    <div class="form-group" style="margin-bottom: 16px;">
                        <input type="text" name="pertanyaans[0][teks]" class="form-control" required placeholder="Tuliskan pertanyaannya...">
                    </div>
                    <div class="opsi-grid">
                        <div class="opsi-item">
                            <span class="opsi-label">A.</span>
                            <input type="text" name="pertanyaans[0][a]" class="form-control" placeholder="Opsi A" required>
                        </div>
                        <div class="opsi-item">
                            <span class="opsi-label">B.</span>
                            <input type="text" name="pertanyaans[0][b]" class="form-control" placeholder="Opsi B" required>
                        </div>
                        <div class="opsi-item">
                            <span class="opsi-label">C.</span>
                            <input type="text" name="pertanyaans[0][c]" class="form-control" placeholder="Opsi C" required>
                        </div>
                        <div class="opsi-item">
                            <span class="opsi-label">D.</span>
                            <input type="text" name="pertanyaans[0][d]" class="form-control" placeholder="Opsi D" required>
                        </div>
                    </div>
                    <div class="jawaban-benar-row">
                        <span class="jawaban-label">Jawaban Benar:</span>
                        <div class="select-wrap" style="flex: 1;">
                            <select name="pertanyaans[0][benar]" class="form-control">
                                <option value="A">Opsi A</option>
                                <option value="B">Opsi B</option>
                                <option value="C">Opsi C</option>
                                <option value="D">Opsi D</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" onclick="tambahSoal()" class="btn-add-soal">+ Tambah Pertanyaan Lagi</button>

            <div class="form-actions">
                <a href="{{ route('admin.dashboard') }}" class="top-bar-link btn-secondary">Batal</a>
                <button type="submit" class="top-bar-link btn-primary" style="border: none; cursor: pointer; font-family: 'Outfit';">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                    Simpan & Terbitkan
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    let soalCount = 1;
    function tambahSoal() {
        const container = document.getElementById('soal-container');
        const idx = soalCount;
        const num = soalCount + 1;
        const html = `
            <div class="soal-block" id="soal-${num}">
                <div class="soal-header">
                    <div class="soal-title">Pertanyaan ${num}</div>
                    <button type="button" onclick="hapusSoal('soal-${num}')" class="soal-delete">Hapus</button>
                </div>
                <div class="form-group" style="margin-bottom: 16px;">
                    <input type="text" name="pertanyaans[${idx}][teks]" class="form-control" required placeholder="Tuliskan pertanyaannya...">
                </div>
                <div class="opsi-grid">
                    <div class="opsi-item"><span class="opsi-label">A.</span><input type="text" name="pertanyaans[${idx}][a]" class="form-control" placeholder="Opsi A" required></div>
                    <div class="opsi-item"><span class="opsi-label">B.</span><input type="text" name="pertanyaans[${idx}][b]" class="form-control" placeholder="Opsi B" required></div>
                    <div class="opsi-item"><span class="opsi-label">C.</span><input type="text" name="pertanyaans[${idx}][c]" class="form-control" placeholder="Opsi C" required></div>
                    <div class="opsi-item"><span class="opsi-label">D.</span><input type="text" name="pertanyaans[${idx}][d]" class="form-control" placeholder="Opsi D" required></div>
                </div>
                <div class="jawaban-benar-row">
                    <span class="jawaban-label">Jawaban Benar:</span>
                    <div class="select-wrap" style="flex: 1;">
                        <select name="pertanyaans[${idx}][benar]" class="form-control">
                            <option value="A">Opsi A</option><option value="B">Opsi B</option><option value="C">Opsi C</option><option value="D">Opsi D</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        soalCount++;
    }
    function hapusSoal(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }
</script>
@endsection
