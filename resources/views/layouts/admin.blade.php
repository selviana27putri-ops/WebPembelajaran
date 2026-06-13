<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduSpace</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0F172A;
            --bg-secondary: #1E293B;
            --bg-sidebar: #0B101E;
            --accent-blue: #38BDF8;
            --accent-purple: #818CF8;
            --accent-pink: #F472B6;
            --accent-green: #34D399;
            --accent-yellow: #FBBF24;
            --accent-red: #F87171;
            --glass-bg: rgba(30, 41, 59, 0.5);
            --glass-border: rgba(255, 255, 255, 0.08);
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
            --sidebar-width: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        
        body {
            background-color: var(--bg-primary);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Ambient Glow */
        .ambient-1 {
            position: fixed; top: -15%; right: -10%; width: 50vw; height: 50vw;
            background: radial-gradient(circle, rgba(129, 140, 248, 0.08) 0%, transparent 60%);
            border-radius: 50%; z-index: 0; filter: blur(60px); pointer-events: none;
        }
        .ambient-2 {
            position: fixed; bottom: -20%; left: 20%; width: 40vw; height: 40vw;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.06) 0%, transparent 60%);
            border-radius: 50%; z-index: 0; filter: blur(50px); pointer-events: none;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--glass-border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 50;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-header {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--glass-border);
        }
        .sidebar-logo {
            font-size: 1.5rem; font-weight: 800;
            background: linear-gradient(to right, var(--accent-blue), var(--accent-purple));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .sidebar-badge {
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em;
            background: rgba(129, 140, 248, 0.15); color: var(--accent-purple);
            padding: 3px 8px; border-radius: 4px; border: 1px solid rgba(129, 140, 248, 0.3);
            -webkit-text-fill-color: var(--accent-purple);
        }

        .sidebar-nav {
            flex: 1; padding: 20px 12px;
            display: flex; flex-direction: column; gap: 4px;
        }
        .nav-label {
            font-size: 0.7rem; font-weight: 700; color: var(--text-muted);
            letter-spacing: 0.12em; text-transform: uppercase;
            padding: 12px 12px 8px; margin-top: 8px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 16px; border-radius: 10px;
            color: var(--text-muted); text-decoration: none;
            font-weight: 500; font-size: 0.95rem;
            transition: all 0.2s ease;
            position: relative;
        }
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
        }
        .nav-item.active {
            background: linear-gradient(135deg, rgba(129, 140, 248, 0.15), rgba(56, 189, 248, 0.1));
            color: var(--text-main);
            border: 1px solid rgba(129, 140, 248, 0.2);
        }
        .nav-item.active::before {
            content: '';
            position: absolute; left: 0; top: 50%; transform: translateY(-50%);
            width: 3px; height: 20px; border-radius: 0 3px 3px 0;
            background: linear-gradient(to bottom, var(--accent-purple), var(--accent-blue));
        }
        .nav-icon { width: 20px; height: 20px; flex-shrink: 0; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--glass-border);
        }
        .user-info {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 16px; border-radius: 10px;
            background: rgba(255,255,255, 0.03);
            margin-bottom: 8px;
        }
        .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.9rem; color: white; flex-shrink: 0;
        }
        .user-name { font-weight: 600; font-size: 0.9rem; }
        .user-role { color: var(--text-muted); font-size: 0.75rem; }

        .logout-btn {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 16px; border-radius: 10px;
            color: var(--accent-red); text-decoration: none;
            font-weight: 500; font-size: 0.9rem;
            transition: all 0.2s;
            background: none; border: none; width: 100%; cursor: pointer;
            font-family: 'Outfit', sans-serif;
        }
        .logout-btn:hover { background: rgba(248, 113, 113, 0.1); }

        /* ===================== MAIN CONTENT ===================== */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .top-bar {
            padding: 20px 32px;
            border-bottom: 1px solid var(--glass-border);
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 40;
        }
        .top-bar h1 {
            font-size: 1.5rem; font-weight: 700;
        }
        .top-bar-actions { display: flex; gap: 12px; align-items: center; }
        .top-bar-link {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px; border-radius: 10px;
            font-weight: 600; font-size: 0.9rem;
            text-decoration: none; transition: all 0.2s;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            color: white; border: none;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(129, 140, 248, 0.3); }
        .btn-secondary {
            background: rgba(255,255,255, 0.05); color: var(--text-main);
            border: 1px solid var(--glass-border);
        }
        .btn-secondary:hover { background: rgba(255,255,255, 0.1); }
        .btn-danger {
            background: rgba(248, 113, 113, 0.1); color: var(--accent-red);
            border: 1px solid rgba(248, 113, 113, 0.2);
        }
        .btn-danger:hover { background: rgba(248, 113, 113, 0.2); }

        .page-content {
            padding: 32px;
        }

        /* Success Alert */
        .alert-success {
            background: rgba(52, 211, 153, 0.1);
            border: 1px solid rgba(52, 211, 153, 0.3);
            color: var(--accent-green); border-radius: 12px;
            padding: 14px 20px; margin-bottom: 24px;
            font-weight: 500; display: flex; align-items: center; gap: 10px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px; margin-bottom: 32px;
        }
        .stat-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px; padding: 24px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .stat-card:hover { transform: translateY(-4px); border-color: rgba(255,255,255,0.15); }
        .stat-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
        }
        .stat-icon.purple { background: rgba(129, 140, 248, 0.15); color: var(--accent-purple); }
        .stat-icon.blue { background: rgba(56, 189, 248, 0.15); color: var(--accent-blue); }
        .stat-icon.green { background: rgba(52, 211, 153, 0.15); color: var(--accent-green); }
        .stat-icon.pink { background: rgba(244, 114, 182, 0.15); color: var(--accent-pink); }
        .stat-value { font-size: 2rem; font-weight: 800; margin-bottom: 4px; }
        .stat-label { color: var(--text-muted); font-size: 0.9rem; }

        /* Table */
        .table-container {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px; overflow: hidden;
            backdrop-filter: blur(10px);
        }
        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--glass-border);
            display: flex; justify-content: space-between; align-items: center;
        }
        .table-title { font-size: 1.1rem; font-weight: 700; }

        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 14px 24px; text-align: left;
            color: var(--text-muted); font-size: 0.75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.08em;
            border-bottom: 1px solid var(--glass-border);
            background: rgba(0,0,0,0.15);
        }
        tbody td {
            padding: 16px 24px; border-bottom: 1px solid var(--glass-border);
            font-size: 0.95rem;
        }
        tbody tr { transition: background 0.2s; }
        tbody tr:hover { background: rgba(255,255,255, 0.03); }
        tbody tr:last-child td { border-bottom: none; }

        .tag-badge {
            display: inline-block; padding: 4px 12px; border-radius: 20px;
            font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .tag-fisika { background: rgba(56, 189, 248, 0.15); color: var(--accent-blue); }
        .tag-biologi { background: rgba(52, 211, 153, 0.15); color: var(--accent-green); }
        .tag-sejarah { background: rgba(244, 114, 182, 0.15); color: var(--accent-pink); }
        .tag-matematika { background: rgba(129, 140, 248, 0.15); color: var(--accent-purple); }

        .action-btns { display: flex; gap: 8px; }
        .action-btn {
            padding: 6px 14px; border-radius: 8px; font-size: 0.8rem;
            font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; text-decoration: none;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-edit { background: rgba(56, 189, 248, 0.15); color: var(--accent-blue); }
        .btn-edit:hover { background: rgba(56, 189, 248, 0.25); }
        .btn-delete { background: rgba(248, 113, 113, 0.15); color: var(--accent-red); }
        .btn-delete:hover { background: rgba(248, 113, 113, 0.25); }

        .empty-state {
            text-align: center; padding: 60px 20px; color: var(--text-muted);
        }
        .empty-state svg { margin-bottom: 12px; opacity: 0.4; }
        .empty-state h3 { margin-bottom: 6px; color: var(--text-main); font-size: 1.1rem; }

        /* Form Styles */
        .form-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px; padding: 32px;
            backdrop-filter: blur(10px);
        }
        .form-group { margin-bottom: 24px; }
        .form-label {
            display: block; margin-bottom: 8px;
            color: var(--text-muted); font-size: 0.85rem;
            font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em;
        }
        .form-control {
            width: 100%; background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--glass-border); border-radius: 10px;
            padding: 12px 16px; color: white; font-size: 1rem;
            outline: none; transition: border-color 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .form-control:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 2px rgba(56, 189, 248, 0.15); }
        .form-control::placeholder { color: var(--text-muted); }
        
        select.form-control { appearance: none; cursor: pointer; }
        .select-wrap { position: relative; }
        .select-wrap::after {
            content: "▼"; position: absolute; right: 16px; top: 50%;
            transform: translateY(-50%); color: var(--text-muted);
            pointer-events: none; font-size: 0.7rem;
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 640px) { .form-row { grid-template-columns: 1fr; } }

        .form-divider {
            border: none; height: 1px; background: var(--glass-border); margin: 32px 0;
        }

        .soal-block {
            background: rgba(129, 140, 248, 0.05);
            border: 1px solid rgba(129, 140, 248, 0.15);
            border-radius: 12px; padding: 24px; margin-bottom: 16px;
        }
        .soal-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;
        }
        .soal-title { font-weight: 700; color: var(--accent-purple); }
        .soal-delete {
            background: rgba(248, 113, 113, 0.15); color: var(--accent-red);
            border: none; padding: 6px 12px; border-radius: 6px;
            cursor: pointer; font-size: 0.8rem; font-weight: 600;
            transition: background 0.2s; font-family: 'Outfit';
        }
        .soal-delete:hover { background: rgba(248, 113, 113, 0.25); }

        .opsi-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px;
        }
        .opsi-item { display: flex; align-items: center; gap: 8px; }
        .opsi-label {
            font-weight: 700; color: var(--text-muted); width: 24px; flex-shrink: 0;
        }
        .jawaban-benar-row {
            display: flex; align-items: center; gap: 12px;
            background: rgba(0,0,0,0.2); padding: 12px 16px; border-radius: 8px;
        }
        .jawaban-label { font-weight: 700; color: var(--text-muted); font-size: 0.85rem; white-space: nowrap; }

        .btn-add-soal {
            background: rgba(129, 140, 248, 0.1); color: var(--accent-purple);
            border: 1px dashed rgba(129, 140, 248, 0.3);
            padding: 14px; border-radius: 10px; width: 100%;
            font-weight: 600; font-size: 0.95rem; cursor: pointer;
            transition: all 0.2s; margin-bottom: 24px;
            font-family: 'Outfit', sans-serif;
        }
        .btn-add-soal:hover { background: rgba(129, 140, 248, 0.2); border-color: rgba(129, 140, 248, 0.5); }

        .form-actions {
            display: flex; justify-content: flex-end; gap: 12px;
            padding-top: 24px; border-top: 1px solid var(--glass-border);
        }

        /* Search in table */
        .table-search {
            background: rgba(15, 23, 42, 0.5); border: 1px solid var(--glass-border);
            border-radius: 8px; padding: 8px 14px; color: white;
            font-size: 0.9rem; outline: none; width: 240px;
            transition: border-color 0.2s;
        }
        .table-search:focus { border-color: var(--accent-blue); }
        .table-search::placeholder { color: var(--text-muted); }

        /* Score colors */
        .score-high { color: var(--accent-green); }
        .score-mid { color: var(--accent-yellow); }
        .score-low { color: var(--accent-red); }

        /* Mobile sidebar */
        .sidebar-toggle {
            display: none;
            background: var(--glass-bg); border: 1px solid var(--glass-border);
            border-radius: 8px; padding: 8px 12px; color: white;
            cursor: pointer; font-size: 1.2rem;
        }
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.5); z-index: 45;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .main-content { margin-left: 0; }
            .sidebar-toggle { display: block; }
            .page-content { padding: 20px; }
            .stats-grid { grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; }
            .opsi-grid { grid-template-columns: 1fr; }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeIn 0.5s ease forwards; }
    </style>
</head>
<body>

    <div class="ambient-1"></div>
    <div class="ambient-2"></div>

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/" class="sidebar-logo">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                EduSpace
                <span class="sidebar-badge">ADMIN</span>
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Menu Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.materi.index') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.materi.create') }}" class="nav-item {{ request()->routeIs('admin.materi.create') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                Tambah Materi
            </a>
            <a href="{{ route('admin.nilai.index') }}" class="nav-item {{ request()->routeIs('admin.nilai.index') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                Rekap Nilai
            </a>

        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">Guru / Admin</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <div style="display: flex; align-items: center; gap: 12px;">
                <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
                </button>
                <h1>@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="top-bar-actions">
                @yield('top-actions')
            </div>
        </div>

        <div class="page-content fade-in">
            @if(session('success'))
                <div class="alert-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
    </script>
    @yield('scripts')
</body>
</html>
