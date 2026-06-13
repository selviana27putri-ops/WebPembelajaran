<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpace TKJ - Belajar Teknik Komputer & Jaringan</title>
    <meta name="description" content="Platform belajar interaktif khusus TKJ dan Teknik Informatika. Materi Jaringan, Pemrograman, Hardware, dan lainnya.">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0A0F1E;
            --bg-secondary: #111827;
            --accent-blue: #38BDF8;
            --accent-purple: #818CF8;
            --accent-pink: #F472B6;
            --accent-green: #34D399;
            --accent-orange: #FB923C;
            --accent-yellow: #FBBF24;
            --glass-bg: rgba(17, 24, 39, 0.6);
            --glass-border: rgba(255,255,255,0.07);
            --text-main: #F0F4FF;
            --text-muted: #8B96B0;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        body { background:var(--bg-primary); color:var(--text-main); min-height:100vh; overflow-x:hidden; position:relative; }

        /* Grid bg pattern */
        body::before {
            content:''; position:fixed; inset:0; z-index:-2;
            background-image: linear-gradient(rgba(56,189,248,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(56,189,248,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .glow1 { position:fixed; top:-20%; left:-10%; width:55vw; height:55vw; background:radial-gradient(circle, rgba(129,140,248,0.12) 0%, transparent 60%); border-radius:50%; z-index:-1; filter:blur(60px); }
        .glow2 { position:fixed; bottom:-20%; right:-10%; width:60vw; height:60vw; background:radial-gradient(circle, rgba(56,189,248,0.1) 0%, transparent 60%); border-radius:50%; z-index:-1; filter:blur(70px); }
        .glow3 { position:fixed; top:40%; left:50%; transform:translateX(-50%); width:40vw; height:40vw; background:radial-gradient(circle, rgba(244,114,182,0.05) 0%, transparent 60%); border-radius:50%; z-index:-1; filter:blur(60px); }

        /* Navbar */
        nav { display:flex; justify-content:space-between; align-items:center; padding:18px 5%; background:rgba(10,15,30,0.8); backdrop-filter:blur(20px); border-bottom:1px solid var(--glass-border); position:sticky; top:0; z-index:100; }
        .logo { font-size:1.6rem; font-weight:800; background:linear-gradient(to right,var(--accent-blue),var(--accent-purple)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; display:flex; align-items:center; gap:10px; text-decoration:none; }
        .logo-badge { font-size:0.55rem; font-weight:700; letter-spacing:0.1em; background:rgba(56,189,248,0.15); color:var(--accent-blue); padding:3px 7px; border-radius:4px; -webkit-text-fill-color:var(--accent-blue); border:1px solid rgba(56,189,248,0.3); }
        .nav-links { display:flex; gap:20px; align-items:center; }
        .nav-link { color:var(--text-muted); text-decoration:none; font-weight:500; font-size:0.9rem; transition:color 0.2s; }
        .nav-link:hover { color:var(--text-main); }

        /* Hero */
        .hero { text-align:center; padding:80px 20px 50px; }
        .hero-tag { display:inline-flex; align-items:center; gap:8px; background:rgba(56,189,248,0.1); border:1px solid rgba(56,189,248,0.25); color:var(--accent-blue); padding:6px 16px; border-radius:20px; font-size:0.8rem; font-weight:700; letter-spacing:0.06em; margin-bottom:24px; animation:fadeIn 0.6s forwards; }
        .hero h1 { font-size:clamp(2.4rem,5vw,4.2rem); font-weight:800; line-height:1.1; letter-spacing:-1.5px; margin-bottom:20px; animation:fadeIn 0.8s forwards; }
        .hero h1 .grad { background:linear-gradient(135deg,var(--accent-blue),var(--accent-purple),var(--accent-pink)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .hero p { color:var(--text-muted); font-size:1.15rem; max-width:580px; margin:0 auto 40px; line-height:1.7; animation:fadeIn 1s forwards; }

        /* Search */
        .search-wrap { max-width:520px; margin:0 auto 40px; display:flex; background:rgba(255,255,255,0.04); border:1px solid var(--glass-border); border-radius:50px; padding:6px 6px 6px 22px; backdrop-filter:blur(10px); transition:all 0.3s; }
        .search-wrap:focus-within { border-color:var(--accent-purple); box-shadow:0 0 30px rgba(129,140,248,0.15); }
        .search-wrap input { flex:1; background:transparent; border:none; color:white; outline:none; font-size:1rem; font-family:'Outfit'; }
        .search-wrap input::placeholder { color:var(--text-muted); }
        .search-btn { background:linear-gradient(135deg,var(--accent-purple),var(--accent-blue)); border:none; padding:11px 28px; border-radius:40px; color:white; font-weight:700; cursor:pointer; font-size:0.9rem; transition:all 0.3s; font-family:'Outfit'; }
        .search-btn:hover { transform:scale(1.05); box-shadow:0 8px 20px rgba(129,140,248,0.3); }

        /* Filter Mapel */
        .filter-section { text-align:center; margin-bottom:50px; }
        .filter-label { color:var(--text-muted); font-size:0.8rem; font-weight:600; letter-spacing:0.08em; text-transform:uppercase; margin-bottom:14px; }
        .filter-tags { display:flex; justify-content:center; flex-wrap:wrap; gap:10px; }
        .filter-btn { padding:8px 18px; border-radius:20px; font-size:0.85rem; font-weight:600; border:1px solid var(--glass-border); background:rgba(255,255,255,0.04); color:var(--text-muted); cursor:pointer; transition:all 0.25s; font-family:'Outfit'; }
        .filter-btn:hover { background:rgba(255,255,255,0.08); color:var(--text-main); }
        .filter-btn.active { color:white; border:none; background:linear-gradient(135deg,var(--accent-purple),var(--accent-blue)); }

        /* Section */
        .section-hdr { display:flex; align-items:center; justify-content:center; gap:12px; font-size:1.5rem; font-weight:700; margin-bottom:28px; }

        /* Cards grid */
        .grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(310px,1fr)); gap:24px; padding:0 5%; max-width:1280px; margin:0 auto 80px; }
        .card { background:var(--glass-bg); border:1px solid var(--glass-border); border-radius:20px; padding:24px; backdrop-filter:blur(12px); transition:all 0.4s cubic-bezier(.175,.885,.32,1.275); text-decoration:none; color:inherit; position:relative; overflow:hidden; display:block; }
        .card::before { content:''; position:absolute; top:0; left:-100%; width:50%; height:100%; background:linear-gradient(to right,transparent,rgba(255,255,255,0.03),transparent); transform:skewX(-20deg); transition:0.6s; }
        .card:hover::before { left:150%; }
        .card:hover { transform:translateY(-8px); border-color:rgba(255,255,255,0.15); box-shadow:0 20px 40px rgba(0,0,0,0.4); }

        .card-mapel { display:inline-flex; align-items:center; gap:6px; padding:5px 12px; border-radius:16px; font-size:0.75rem; font-weight:700; letter-spacing:0.04em; text-transform:uppercase; margin-bottom:16px; }
        .mapel-jaringan { background:rgba(56,189,248,0.12); color:var(--accent-blue); border:1px solid rgba(56,189,248,0.25); }
        .mapel-pemrograman { background:rgba(129,140,248,0.12); color:var(--accent-purple); border:1px solid rgba(129,140,248,0.25); }
        .mapel-hardware { background:rgba(251,146,60,0.12); color:var(--accent-orange); border:1px solid rgba(251,146,60,0.25); }
        .mapel-sistem-operasi { background:rgba(52,211,153,0.12); color:var(--accent-green); border:1px solid rgba(52,211,153,0.25); }
        .mapel-basis-data { background:rgba(244,114,182,0.12); color:var(--accent-pink); border:1px solid rgba(244,114,182,0.25); }
        .mapel-keamanan-jaringan { background:rgba(251,191,36,0.12); color:var(--accent-yellow); border:1px solid rgba(251,191,36,0.25); }

        .card h3 { font-size:1.4rem; font-weight:700; line-height:1.3; margin-bottom:10px; }
        .card p { color:var(--text-muted); font-size:0.95rem; margin-bottom:24px; line-height:1.6; }
        .card-foot { display:flex; justify-content:space-between; align-items:center; border-top:1px solid var(--glass-border); padding-top:16px; }
        .card-stats { font-size:0.85rem; color:var(--text-muted); display:flex; align-items:center; gap:5px; }
        .card-btn { background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12); padding:7px 18px; border-radius:16px; color:white; font-size:0.85rem; font-weight:600; display:flex; align-items:center; gap:6px; transition:all 0.25s; }
        .card:hover .card-btn { background:white; color:var(--bg-primary); }

        .no-results { grid-column:1/-1; text-align:center; padding:60px 20px; color:var(--text-muted); display:none; }
        .no-results h3 { font-size:1.2rem; color:var(--text-main); margin:12px 0 6px; }

        /* ===== LEADERBOARD SECTION ===== */
        .leaderboard-section { max-width:900px; margin:0 auto 80px; padding:0 5%; }
        .leaderboard-card { background:var(--glass-bg); border:1px solid var(--glass-border); border-radius:20px; overflow:hidden; backdrop-filter:blur(12px); }
        .lb-header { padding:24px 28px; border-bottom:1px solid var(--glass-border); display:flex; justify-content:space-between; align-items:center; }
        .lb-title { font-size:1.2rem; font-weight:700; display:flex; align-items:center; gap:10px; }
        .lb-filter { display:flex; gap:8px; }
        .lb-filter-btn { padding:6px 14px; border-radius:10px; font-size:0.8rem; font-weight:600; border:1px solid var(--glass-border); background:transparent; color:var(--text-muted); cursor:pointer; transition:all 0.2s; font-family:'Outfit'; }
        .lb-filter-btn.active { background:linear-gradient(135deg,var(--accent-purple),var(--accent-blue)); color:white; border:none; }

        table.lb-table { width:100%; border-collapse:collapse; }
        .lb-table thead th { padding:12px 24px; text-align:left; color:var(--text-muted); font-size:0.75rem; text-transform:uppercase; letter-spacing:0.08em; font-weight:700; border-bottom:1px solid var(--glass-border); }
        .lb-table tbody td { padding:14px 24px; border-bottom:1px solid rgba(255,255,255,0.04); font-size:0.95rem; }
        .lb-table tbody tr:last-child td { border-bottom:none; }
        .lb-table tbody tr:hover { background:rgba(255,255,255,0.03); }

        .rank-badge { width:30px; height:30px; border-radius:8px; display:inline-flex; align-items:center; justify-content:center; font-weight:800; font-size:0.85rem; }
        .rank-1 { background:linear-gradient(135deg,#FBBF24,#F59E0B); color:#1A0A00; }
        .rank-2 { background:linear-gradient(135deg,#94A3B8,#64748B); color:white; }
        .rank-3 { background:linear-gradient(135deg,#FB923C,#EA580C); color:white; }
        .rank-other { background:rgba(255,255,255,0.06); color:var(--text-muted); }

        .score-pill { display:inline-block; padding:4px 12px; border-radius:12px; font-weight:800; font-size:0.95rem; }
        .score-high { background:rgba(52,211,153,0.15); color:var(--accent-green); }
        .score-mid { background:rgba(251,191,36,0.15); color:var(--accent-yellow); }
        .score-low { background:rgba(248,113,113,0.15); color:#F87171; }

        .lb-empty { text-align:center; padding:40px; color:var(--text-muted); font-style:italic; }

        /* ===== HISTORY SECTION =====  */
        .history-section { max-width:600px; margin:0 auto 80px; padding:0 5%; }
        .history-card { background:var(--glass-bg); border:1px solid var(--glass-border); border-radius:20px; padding:28px; backdrop-filter:blur(12px); }
        .history-title { font-size:1.1rem; font-weight:700; margin-bottom:20px; display:flex; align-items:center; gap:10px; }
        .history-input-row { display:flex; gap:10px; margin-bottom:20px; }
        .history-input { flex:1; background:rgba(15,23,42,0.6); border:1px solid var(--glass-border); border-radius:10px; padding:11px 16px; color:white; outline:none; font-size:0.95rem; transition:border-color 0.2s; font-family:'Outfit'; }
        .history-input:focus { border-color:var(--accent-blue); }
        .history-input::placeholder { color:var(--text-muted); }
        .history-search-btn { background:linear-gradient(135deg,var(--accent-purple),var(--accent-blue)); border:none; padding:11px 20px; border-radius:10px; color:white; font-weight:700; cursor:pointer; font-family:'Outfit'; white-space:nowrap; transition:all 0.2s; }
        .history-search-btn:hover { transform:translateY(-2px); }
        #historyResults { display:none; }
        .history-item { display:flex; justify-content:space-between; align-items:center; padding:12px 0; border-bottom:1px solid var(--glass-border); }
        .history-item:last-child { border-bottom:none; }
        .history-materi { font-weight:600; font-size:0.95rem; }
        .history-meta { color:var(--text-muted); font-size:0.8rem; margin-top:2px; }

        /* FAQ / Tentang Section */
        .features-section { max-width:1100px; margin:0 auto 80px; padding:0 5%; }
        .features-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:20px; }
        .feature-card { background:var(--glass-bg); border:1px solid var(--glass-border); border-radius:16px; padding:24px; backdrop-filter:blur(10px); }
        .feature-icon { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:16px; }
        .feature-title { font-size:1rem; font-weight:700; margin-bottom:8px; }
        .feature-desc { color:var(--text-muted); font-size:0.9rem; line-height:1.6; }

        footer { text-align:center; padding:40px; color:var(--text-muted); border-top:1px solid var(--glass-border); font-size:0.85rem; line-height:1.8; }
        footer a { color:var(--text-muted); text-decoration:none; opacity:0.4; font-size:0.75rem; transition:opacity 0.2s; }
        footer a:hover { opacity:0.7; }

        @keyframes fadeIn { from{opacity:0;transform:translateY(15px)} to{opacity:1;transform:translateY(0)} }
        .fade-in { animation:fadeIn 0.7s ease forwards; }
        .delay-1 { animation-delay:0.1s; }
        .delay-2 { animation-delay:0.2s; }
        .delay-3 { animation-delay:0.3s; }
    </style>
</head>
<body>
<div class="glow1"></div><div class="glow2"></div><div class="glow3"></div>

<!-- Navbar -->
<nav>
    <a href="/" class="logo">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
        EduSpace
        <span class="logo-badge">TKJ</span>
    </a>
    <div class="nav-links">
        <a href="#materi" class="nav-link">Materi</a>
        <a href="#leaderboard" class="nav-link">Leaderboard</a>
        <a href="#riwayat" class="nav-link">Riwayat Nilai</a>
    </div>
</nav>

<!-- Hero -->
<header class="hero">
    <div class="hero-tag">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
        PLATFORM BELAJAR TKJ & INFORMATIKA
    </div>
    <h1>Kuasai <span class="grad">Dunia Digital</span><br>Mulai dari Sini! 🚀</h1>
    <p>Materi MS Office, Desain Grafis, Multimedia, dan Jaringan yang disajikan dengan cara yang seru dan interaktif.</p>
    <div class="search-wrap">
        <input type="text" id="searchInput" placeholder="Cari materi... (Word, Animasi, Jaringan...)" autocomplete="off">
        <button class="search-btn" id="searchBtn">🔍 Cari</button>
    </div>
</header>

<!-- Filter Mapel -->
<div class="filter-section" id="materi">
    <div class="filter-label">Filter Mata Pelajaran</div>
    <div class="filter-tags">
        <button class="filter-btn active" data-filter="all">🌐 Semua</button>
        @foreach($mapels as $mapel)
        <button class="filter-btn" data-filter="{{ strtolower($mapel) }}">📚 {{ $mapel }}</button>
        @endforeach
    </div>
</div>

<!-- Section Header -->
<div class="section-hdr fade-in">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--accent-blue)" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
    Materi Pelajaran
</div>

<!-- Cards Grid -->
<main class="grid" id="materiGrid">
    @forelse($materis as $materi)
    @php
        $mapelKey = strtolower(str_replace(' ', '-', $materi->mapel));
        $mapelLower = strtolower($materi->mapel);
    @endphp
    <a href="{{ route('materi.show', $materi->id) }}" class="card fade-in materi-card"
       data-judul="{{ $mapelLower }}" data-mapel="{{ $mapelLower }}">
        <span class="card-mapel mapel-{{ $mapelKey }}">
            @if($mapelLower == 'jaringan') 🔗
            @elseif($mapelLower == 'pemrograman') 💻
            @elseif($mapelLower == 'hardware') 🖥️
            @elseif($mapelLower == 'sistem operasi') ⚙️
            @elseif($mapelLower == 'basis data') 🗄️
            @elseif($mapelLower == 'keamanan jaringan') 🔒
            @else 📚 @endif
            {{ $materi->mapel }}
        </span>
        <h3>{{ $materi->judul }}</h3>
        <p>{{ Str::limit(strip_tags($materi->konten), 100) }}</p>
        <div class="card-foot">
            <div class="card-stats">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                {{ $materi->soals_count }} Soal
            </div>
            <div class="card-btn">Mulai <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
        </div>
    </a>
    @empty
    <div style="grid-column:1/-1;text-align:center;color:var(--text-muted);padding:60px 20px;">
        <h3 style="margin-bottom:8px;">Belum ada materi</h3>
        <p>Minta guru untuk menambahkan materi TKJ terbaru.</p>
    </div>
    @endforelse

    <div class="no-results" id="noResults">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <h3>Materi tidak ditemukan</h3>
        <p>Coba kata kunci lain ya!</p>
    </div>
</main>

<!-- Fitur Unggulan -->
<div class="section-hdr fade-in">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--accent-purple)" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
    Kenapa EduSpace TKJ?
</div>
<div class="features-section">
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(56,189,248,0.12);color:var(--accent-blue)">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
            </div>
            <div class="feature-title">Timer Kuis</div>
            <div class="feature-desc">Setiap soal ada timer untuk melatih kecepatan berpikir kamu seperti ujian sungguhan.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(251,191,36,0.12);color:var(--accent-yellow)">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            </div>
            <div class="feature-title">Papan Peringkat</div>
            <div class="feature-desc">Lihat siapa pelajar terbaik! Leaderboard diperbarui real-time setiap ada yang mengerjakan kuis.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(52,211,153,0.12);color:var(--accent-green)">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
            </div>
            <div class="feature-title">Riwayat Nilai</div>
            <div class="feature-desc">Cek semua nilai kamu hanya dengan memasukkan nama. Pantau progresmu dari waktu ke waktu!</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(129,140,248,0.12);color:var(--accent-purple)">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
            </div>
            <div class="feature-title">Fokus IT & Desain</div>
            <div class="feature-desc">Materi dikurasi khusus untuk keterampilan esensial: MS Office, Desain Grafis, Multimedia, dan Jaringan.</div>
        </div>
    </div>
</div>

<!-- Leaderboard -->
<div class="section-hdr fade-in" id="leaderboard">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--accent-yellow)" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
    Papan Peringkat
</div>
<div class="leaderboard-section">
    <div class="leaderboard-card">
        <div class="lb-header">
            <div class="lb-title">🏆 Top Siswa Berprestasi</div>
            <div class="lb-filter">
                <button class="lb-filter-btn active" data-lb="all">Semua</button>
                @foreach($materis->take(5) as $m)
                <button class="lb-filter-btn" data-lb="{{ $m->id }}">{{ Str::limit($m->judul,12) }}</button>
                @endforeach
            </div>
        </div>
        <table class="lb-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Materi</th>
                    <th style="text-align:center">Skor</th>
                </tr>
            </thead>
            <tbody id="lbBody">
                @forelse($topNilais as $i => $nilai)
                <tr>
                    <td>
                        <span class="rank-badge {{ $i==0 ? 'rank-1' : ($i==1 ? 'rank-2' : ($i==2 ? 'rank-3' : 'rank-other')) }}">
                            {{ $i==0 ? '🥇' : ($i==1 ? '🥈' : ($i==2 ? '🥉' : $i+1)) }}
                        </span>
                    </td>
                    <td style="font-weight:600">{{ $nilai->nama_siswa }}</td>
                    <td style="color:var(--text-muted);font-size:0.9rem">{{ $nilai->materi ? Str::limit($nilai->materi->judul,30) : '-' }}</td>
                    <td style="text-align:center">
                        <span class="score-pill {{ $nilai->skor>=80 ? 'score-high' : ($nilai->skor>=50 ? 'score-mid' : 'score-low') }}">
                            {{ $nilai->skor }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="lb-empty">Belum ada data. Jadilah yang pertama mengerjakan kuis! 🚀</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Riwayat Nilai -->
<div class="section-hdr fade-in" id="riwayat">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--accent-green)" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
    Cek Riwayat Nilai Kamu
</div>
<div class="history-section">
    <div class="history-card">
        <div class="history-title">
            📋 Riwayat Nilai Siswa
        </div>
        <div class="history-input-row">
            <input type="text" id="historyName" class="history-input" placeholder="Ketik namamu di sini...">
            <button class="history-search-btn" id="historyBtn" onclick="cariRiwayat()">Cari Nilai</button>
        </div>
        <div id="historyResults">
            <div id="historyContent"></div>
        </div>
    </div>
</div>

<footer>
    &copy; 2026 EduSpace TKJ — Platform Belajar Teknik Komputer & Jaringan<br>
    Dikembangkan untuk siswa Teknik Informatika &amp; TKJ 💙<br><br>
    <a href="/login">Log Masuk Guru / Admin</a>
</footer>

<script>
// ===== SEARCH & FILTER =====
const searchInput = document.getElementById('searchInput');
const filterBtns = document.querySelectorAll('.filter-btn');
const cards = document.querySelectorAll('.materi-card');
const noResults = document.getElementById('noResults');
let activeFilter = 'all';

function applyFilter() {
    const query = searchInput.value.toLowerCase().trim();
    let visible = 0;
    
    cards.forEach(card => {
        const judul = card.querySelector('h3').innerText.toLowerCase();
        const desc = card.querySelector('p').innerText.toLowerCase();
        const mapel = card.getAttribute('data-mapel') || '';
        
        const matchSearch = !query || judul.includes(query) || mapel.includes(query) || desc.includes(query);
        const matchFilter = activeFilter === 'all' || mapel === activeFilter;
        
        if (matchSearch && matchFilter) {
            card.style.display = 'block';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });
    
    noResults.style.display = (visible === 0) ? 'block' : 'none';
}

searchInput.addEventListener('input', applyFilter);

document.getElementById('searchBtn').addEventListener('click', () => {
    applyFilter();
    document.getElementById('materi').scrollIntoView({ behavior: 'smooth', block: 'start' });
});

searchInput.addEventListener('keydown', e => { 
    if(e.key === 'Enter') {
        applyFilter();
        document.getElementById('materi').scrollIntoView({ behavior: 'smooth', block: 'start' });
        e.target.blur(); // Hide keyboard on mobile
    }
});

filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        activeFilter = btn.getAttribute('data-filter');
        applyFilter();
    });
});

// ===== LEADERBOARD FILTER =====
document.querySelectorAll('.lb-filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.lb-filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        // For now, just visual (server-side full leaderboard shown)
    });
});

// ===== RIWAYAT NILAI =====
function cariRiwayat() {
    const nama = document.getElementById('historyName').value.trim();
    if (!nama) { alert('Masukkan namamu dulu ya!'); return; }

    const btn = document.getElementById('historyBtn');
    btn.innerText = 'Mencari...';
    btn.disabled = true;

    fetch('/riwayat-nilai?nama=' + encodeURIComponent(nama))
        .then(r => r.json())
        .then(data => {
            const div = document.getElementById('historyResults');
            const content = document.getElementById('historyContent');
            div.style.display = 'block';
            if (!data.length) {
                content.innerHTML = '<p style="color:var(--text-muted);text-align:center;padding:20px 0;">Tidak ada nilai ditemukan untuk nama "<strong>' + nama + '</strong>".</p>';
                return;
            }
            let html = '';
            data.forEach(item => {
                const colorClass = item.skor >= 80 ? 'score-high' : (item.skor >= 50 ? 'score-mid' : 'score-low');
                html += `<div class="history-item">
                    <div>
                        <div class="history-materi">${item.materi}</div>
                        <div class="history-meta">${item.kelas} • ${item.tanggal}</div>
                    </div>
                    <span class="score-pill ${colorClass}">${item.skor}</span>
                </div>`;
            });
            content.innerHTML = html;
        })
        .catch(() => {
            document.getElementById('historyContent').innerHTML = '<p style="color:#F87171;padding:12px 0;">Terjadi kesalahan. Coba lagi.</p>';
            document.getElementById('historyResults').style.display = 'block';
        })
        .finally(() => {
            btn.innerText = 'Cari Nilai';
            btn.disabled = false;
        });
}

document.getElementById('historyName').addEventListener('keydown', e => {
    if (e.key === 'Enter') cariRiwayat();
});
</script>
</body>
</html>
