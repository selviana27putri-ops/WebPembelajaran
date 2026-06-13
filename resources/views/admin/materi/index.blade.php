@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('top-actions')
    <a href="{{ route('admin.materi.create') }}" class="top-bar-link btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
        Tambah Materi
    </a>
@endsection

@section('content')
    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
            </div>
            <div class="stat-value">{{ $totalMateri }}</div>
            <div class="stat-label">Total Materi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div class="stat-value">{{ $totalSoal }}</div>
            <div class="stat-label">Total Soal Kuis</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            </div>
            <div class="stat-value">{{ $totalSiswa }}</div>
            <div class="stat-label">Siswa Mengerjakan</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon pink">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
            </div>
            <div class="stat-value">{{ $rataRata }}</div>
            <div class="stat-label">Rata-rata Skor</div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-header">
            <div class="table-title">📚 Daftar Materi & Kuis</div>
            <input type="text" class="table-search" id="searchMateri" placeholder="Cari materi...">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Judul Materi</th>
                    <th>Mapel</th>
                    <th>Total Soal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="materiTableBody">
                @foreach($materis as $materi)
                <tr class="materi-row" data-judul="{{ strtolower($materi->judul) }}" data-mapel="{{ strtolower($materi->mapel) }}">
                    <td style="font-weight: 600;">{{ $materi->judul }}</td>
                    <td>
                        <span class="tag-badge tag-{{ strtolower($materi->mapel) }}">{{ $materi->mapel }}</span>
                    </td>
                    <td style="font-weight: 700;">{{ $materi->soals_count }} Soal</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.materi.edit', $materi->id) }}" class="action-btn btn-edit">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" onsubmit="return confirm('Peringatan: Seluruh soal & nilai siswa di materi ini akan ikut terhapus! Hapus materi ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach

                @if($materis->isEmpty())
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                            <h3>Belum ada materi</h3>
                            <p>Silakan tambah materi baru untuk memulai.</p>
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
    document.getElementById('searchMateri').addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        document.querySelectorAll('.materi-row').forEach(row => {
            const judul = row.getAttribute('data-judul');
            const mapel = row.getAttribute('data-mapel');
            row.style.display = (judul.includes(query) || mapel.includes(query)) ? '' : 'none';
        });
    });
</script>
@endsection
