<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Guru - EduSpace</title>
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
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            position: relative;
            background-image: 
                radial-gradient(1px 1px at 10% 20%, rgba(255,255,255,0.1) 1px, transparent 0),
                radial-gradient(1px 1px at 30% 40%, rgba(255,255,255,0.1) 1px, transparent 0),
                radial-gradient(1.5px 1.5px at 80% 50%, rgba(255,255,255,0.1) 1px, transparent 0),
                radial-gradient(1px 1px at 60% 80%, rgba(255,255,255,0.1) 1px, transparent 0),
                radial-gradient(circle at 50% 50%, rgba(146, 156, 250, 0.05) 0%, transparent 50%);
        }

        .register-card {
            background-color: var(--bg-card);
            border-radius: 16px; width: 100%; max-width: 420px;
            padding: 45px 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-glass);
            z-index: 10;
        }

        .icon-top {
            width: 48px; height: 48px; background-color: var(--bg-input);
            border-radius: 50%; display: flex; justify-content: center; align-items: center;
            margin: 0 auto 20px;
            box-shadow: inset 0 2px 4px rgba(255,255,255,0.05);
        }
        .header-title {
            text-align: center; font-size: 1.5rem; font-weight: 700; margin-bottom: 8px;
            display: flex; justify-content: center; align-items: center; gap: 8px;
        }
        .header-subtitle {
            text-align: center; color: var(--text-muted); font-size: 0.9rem;
            line-height: 1.4; margin-bottom: 30px;
        }

        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block; font-size: 0.75rem; font-weight: 600; color: var(--text-muted);
            letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 8px;
        }
        .input-group { position: relative; display: flex; align-items: center; }
        .input-icon {
            position: absolute; left: 15px; color: var(--text-muted);
            display: flex; align-items: center; pointer-events: none;
        }
        .input-icon-right {
            position: absolute; right: 15px; color: var(--text-muted);
            cursor: pointer; background: none; border: none; padding: 4px;
            display: flex; align-items: center; transition: color 0.2s;
        }
        .input-icon-right:hover { color: var(--text-main); }
        .form-control {
            width: 100%; background-color: var(--bg-input);
            border: 1px solid var(--border-glass); border-radius: 8px;
            padding: 13px 15px 13px 45px; color: var(--text-main);
            font-size: 0.95rem; outline: none; transition: all 0.2s;
        }
        .form-control:focus {
            border-color: rgba(146, 156, 250, 0.5);
            box-shadow: 0 0 0 2px rgba(146, 156, 250, 0.1);
        }
        .error-message { color: #ef4444; font-size: 0.8rem; margin-top: 5px; }

        .btn-submit {
            width: 100%; background: linear-gradient(135deg, #A4B1FF, #8794FA);
            color: #10162A; border: none; border-radius: 8px; padding: 14px;
            font-size: 1rem; font-weight: 700; margin-top: 15px; cursor: pointer;
            display: flex; justify-content: center; align-items: center; gap: 10px;
            transition: all 0.2s; box-shadow: 0 4px 15px rgba(135, 148, 250, 0.3);
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(135, 148, 250, 0.4); }

        .login-link {
            text-align: center; margin-top: 20px; font-size: 0.85rem; color: var(--text-muted);
        }
        .login-link a { color: var(--accent-purple); text-decoration: none; font-weight: 600; }
        .login-link a:hover { color: #A4B1FF; }

        .page-footer {
            margin-top: 25px; font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem; letter-spacing: 0.05em; color: var(--text-muted);
            display: flex; align-items: center; gap: 10px;
        }
        .status-dot { width: 6px; height: 6px; background-color: #10B981; border-radius: 50%; box-shadow: 0 0 8px #10B981; }
    </style>
</head>
<body>

    <div class="register-card">
        <div class="icon-top">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F8FAFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
        </div>

        <div class="header-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#A4B1FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            Daftar Akun Guru
        </div>
        <div class="header-subtitle">
            Buat akun baru untuk mengelola materi & kuis
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <div class="input-group">
                    <div class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama Guru">
                </div>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <div class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 006 0v-1a10 10 0 10-3.92 7.94"/></svg>
                    </div>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="guru@sekolah.com">
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Sandi</label>
                <div class="input-group">
                    <div class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    </div>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 karakter">
                    <button type="button" class="input-icon-right" onclick="togglePw('password','eyeOff1','eyeOn1')" aria-label="Tampilkan sandi">
                        <svg id="eyeOff1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24M1 1l22 22"/></svg>
                        <svg id="eyeOn1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Sandi</label>
                <div class="input-group">
                    <div class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    </div>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang sandi">
                    <button type="button" class="input-icon-right" onclick="togglePw('password_confirmation','eyeOff2','eyeOn2')" aria-label="Tampilkan sandi">
                        <svg id="eyeOff2" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24M1 1l22 22"/></svg>
                        <svg id="eyeOn2" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                Daftar Sekarang
            </button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

    <div class="page-footer">
        <div class="status-dot"></div> SISTEM AKTIF &nbsp;&nbsp;&nbsp; EduSpace v2.0
    </div>

    <script>
        function togglePw(inputId, offId, onId) {
            const input = document.getElementById(inputId);
            const off = document.getElementById(offId);
            const on = document.getElementById(onId);
            if (input.type === 'password') {
                input.type = 'text';
                off.style.display = 'none';
                on.style.display = 'block';
            } else {
                input.type = 'password';
                off.style.display = 'block';
                on.style.display = 'none';
            }
        }
    </script>

</body>
</html>
