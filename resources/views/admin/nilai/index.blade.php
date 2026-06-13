@extends('layouts.admin')

@section('page-title', 'Rekap Nilai Siswa')

@section('top-actions')
    <a href="{{ route('admin.dashboard') }}" class="top-bar-link btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Kembali
    </a>
@endsection

@section('content')
    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            </div>
            <div class="stat-value">{{ $nilais->count() }}</div>
            <div class="stat-label">Total Pengerjaan</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
            </div>
            <div class="stat-value">{{ $nilais->count() > 0 ? round($nilais->avg('skor')) : 0 }}</div>
            <div class="stat-label">Rata-rata Skor</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            </div>
            <div class="stat-value">{{ $nilais->where('skor', '>=', 80)->count() }}</div>
            <div class="stat-label">Skor ≥ 80</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon pink">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div class="stat-value">{{ $nilais->where('skor', '<', 50)->count() }}</div>
            <div class="stat-label">Skor &lt; 50</div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-header">
            <div class="table-title">📊 Data Nilai Siswa</div>
            <input type="text" class="table-search" id="searchNilai" placeholder="Cari nama / materi...">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Waktu Submit</th>
                    <th>Nama Siswa</th>
                    <th style="text-align: center;">Kelas</th>
                    <th>Materi Ujian</th>
                    <th style="text-align: center;">Nilai</th>
                </tr>
            </thead>
            <tbody id="nilaiTableBody">
                @foreach($nilais as $nilai)
                <tr class="nilai-row" data-nama="{{ strtolower($nilai->nama_siswa) }}" data-materi="{{ strtolower($nilai->materi ? $nilai->materi->judul : '') }}">
                    <td style="color: var(--text-muted); font-size: 0.9rem;">{{ $nilai->created_at->format('d/m/Y H:i') }}</td>
                    <td style="font-weight: 600;">{{ $nilai->nama_siswa }}</td>
                    <td style="text-align: center;">
                        <span class="tag-badge" style="background: rgba(255,255,255,0.08); color: var(--text-main);">{{ $nilai->kelas }}</span>
                    </td>
                    <td>{{ $nilai->materi ? $nilai->materi->judul : '⚠️ Materi Dihapus' }}</td>
                    <td style="text-align: center; font-weight: 800; font-size: 1.1rem;" class="{{ $nilai->skor >= 80 ? 'score-high' : ($nilai->skor >= 50 ? 'score-mid' : 'score-low') }}">
                        {{ $nilai->skor }}
                    </td>
                </tr>
                @endforeach

                @if($nilais->isEmpty())
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                            <h3>Belum ada data nilai</h3>
                            <p>Belum ada siswa yang mengerjakan kuis. Sebarkan halaman publik!</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('searchNilai').addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        document.querySelectorAll('.nilai-row').forEach(row => {
            const nama = row.getAttribute('data-nama');
            const materi = row.getAttribute('data-materi');
            row.style.display = (nama.includes(query) || materi.includes(query)) ? '' : 'none';
        });
    });
</script>
@endsection
