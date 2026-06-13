<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Guru - EduSpace</title>
    <meta name="description" content="Halaman login untuk guru dan admin EduSpace.">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #10162A;
            --bg-card: #20273D;
            --bg-input: #0B101E;
            --text-main: #F8FAFC;
            --text-muted: #828B9F;
            --accent-purple: #929CFA;
            --border-glass: rgba(255, 255, 255, 0.05);
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Outfit', sans-serif; }
        
        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            background-image: 
                radial-gradient(1px 1px at 10% 20%, rgba(255,255,255,0.1) 1px, transparent 0),
                radial-gradient(1px 1px at 30% 40%, rgba(255,255,255,0.1) 1px, transparent 0),
                radial-gradient(1.5px 1.5px at 80% 50%, rgba(255,255,255,0.1) 1px, transparent 0),
                radial-gradient(1px 1px at 60% 80%, rgba(255,255,255,0.1) 1px, transparent 0),
                radial-gradient(circle at 50% 50%, rgba(146, 156, 250, 0.05) 0%, transparent 50%);
            background-size: cover;
        }

        .login-card {
            background-color: var(--bg-card);
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            padding: 50px 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-glass);
            position: relative;
            z-index: 10;
        }

        .icon-top {
            width: 48px; height: 48px;
            background-color: var(--bg-input);
            border-radius: 50%;
            display: flex; justify-content: center; align-items: center;
            margin: 0 auto 20px;
            box-shadow: inset 0 2px 4px rgba(255,255,255,0.05);
        }
        .header-title {
            text-align: center;
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex; justify-content: center; align-items: center; gap: 8px;
        }
        .header-subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: 35px;
            padding: 0 10px;
        }

        .form-group { margin-bottom: 20px; }
        .form-header { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .form-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .form-link {
            font-size: 0.75rem;
            color: var(--accent-purple);
            text-decoration: none;
            font-weight: 600;
        }
        
        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-icon {
            position: absolute;
            left: 15px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            pointer-events: none;
        }
        .input-icon-right {
            position: absolute;
            right: 15px;
            color: var(--text-muted);
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }
        .input-icon-right:hover { color: var(--text-main); }
        .form-control {
            width: 100%;
            background-color: var(--bg-input);
            border: 1px solid var(--border-glass);
            border-radius: 8px;
            padding: 14px 45px 14px 45px;
            color: var(--text-main);
            font-size: 0.95rem;
            outline: none;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: rgba(146, 156, 250, 0.5);
            box-shadow: 0 0 0 2px rgba(146, 156, 250, 0.1);
        }
        
        .error-message {
            color: #ef4444; font-size: 0.8rem; margin-top: 5px; text-align: left;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #A4B1FF, #8794FA);
            color: #10162A;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-size: 1rem;
            font-weight: 700;
            margin-top: 20px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(135, 148, 250, 0.3);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(135, 148, 250, 0.4);
        }

        .divider { height: 1px; background-color: var(--border-glass); margin: 30px 0 20px; }
        
        .card-footer {
            text-align: center;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 5px;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }
        .register-link a {
            color: var(--accent-purple);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        .register-link a:hover { color: #A4B1FF; }

        .page-footer {
            margin-top: 30px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .status-dot {
            width: 6px; height: 6px; background-color: #10B981; border-radius: 50%;
            box-shadow: 0 0 8px #10B981;
        }
    </style>
</head>
<body>

    <div class="login-card">
        
        <div class="icon-top">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F8FAFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M10 12a2 2 0 104 0 2 2 0 00-4 0z"/></svg>
        </div>

        <div class="header-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#A4B1FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Area Guru
        </div>
        <div class="header-subtitle">
            Masuk ke dashboard untuk mengelola materi & kuis
        </div>

        @if (session('status'))
            <div style="color: #34D399; font-size: 0.85rem; text-align: center; margin-bottom: 15px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <div class="form-header">
                    <label for="email" class="form-label">Email</label>
                </div>
                <div class="input-group">
                    <div class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 006 0v-1a10 10 0 10-3.92 7.94"/></svg>
                    </div>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="guru@eduspace.com">
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-header">
                    <label for="password" class="form-label">Sandi</label>
                </div>
                <div class="input-group">
                    <div class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    </div>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="••••••••••••">
                    <button type="button" class="input-icon-right" id="togglePassword" aria-label="Tampilkan/sembunyikan sandi">
                        <!-- Eye-off icon (default: password hidden) -->
                        <svg id="eyeOff" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24M1 1l22 22"/>
                        </svg>
                        <!-- Eye icon (shown when password is visible) -->
                        <svg id="eyeOn" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <input type="checkbox" name="remember" checked style="display:none;">

            <button type="submit" class="btn-submit">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 019.9-1"/></svg>
                Masuk Dashboard
            </button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>

        <div class="divider"></div>

        <div class="card-footer">
            KONEKSI AMAN<br>
            HANYA UNTUK GURU & ADMIN
        </div>
    </div>

    <div class="page-footer">
        <div class="status-dot"></div> SISTEM AKTIF &nbsp;&nbsp;&nbsp; EduSpace v2.0
    </div>

    <!-- Toggle Password Script -->
    <script>
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOff = document.getElementById('eyeOff');
        const eyeOn = document.getElementById('eyeOn');

        toggleBtn.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOff.style.display = 'none';
                eyeOn.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                eyeOff.style.display = 'block';
                eyeOn.style.display = 'none';
            }
        });
    </script>

    <!-- SweetAlert2 Notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak!',
                    text: '{{ session('error') }}',
                    background: '#20273D',
                    color: '#F8FAFC',
                    confirmButtonColor: '#929CFA',
                    iconColor: '#ef4444'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: 'Email atau kata sandi yang Anda masukkan salah. Silakan coba lagi.',
                    background: '#20273D',
                    color: '#F8FAFC',
                    confirmButtonColor: '#929CFA',
                    iconColor: '#ef4444'
                });
            @endif

            @if(session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Info',
                    text: '{{ session('status') }}',
                    background: '#20273D',
                    color: '#F8FAFC',
                    confirmButtonColor: '#929CFA'
                });
            @endif
        });
    </script>
</body>
</html>
