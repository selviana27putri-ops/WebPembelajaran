<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $materi->judul }} - EduSpace</title>
    <meta name="description" content="{{ Str::limit(strip_tags($materi->konten), 155) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-primary: #0F172A;
            --bg-secondary: #1E293B;
            --bg-surface: rgba(30, 41, 59, 0.4);
            --accent-blue: #38BDF8;
            --accent-purple: #818CF8;
            --accent-green: #34D399;
            --accent-red: #F87171;
            --accent-yellow: #FBBF24;
            --glass-border: rgba(255, 255, 255, 0.08);
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }

        body {
            background-color: var(--bg-primary);
            color: var(--text-main);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            line-height: 1.6;
        }

        .ambient-glow {
            position: fixed; top: -20%; left: 50%; transform: translateX(-50%); width: 80vw; height: 50vw;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 60%);
            border-radius: 50%; z-index: -1; filter: blur(60px);
        }

        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 5%;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--glass-border);
            position: sticky; top: 0; z-index: 100;
        }
        .logo { font-size: 1.5rem; font-weight: 800; background: linear-gradient(to right, var(--accent-blue), var(--accent-purple)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-decoration: none; display: flex; align-items: center; gap: 8px; }
        .back-btn { color: var(--text-muted); text-decoration: none; display: flex; align-items: center; gap: 5px; font-weight: 500; transition: color 0.2s; }
        .back-btn:hover { color: white; }

        .container {
            max-width: 800px;
            margin: 40px auto 100px;
            padding: 0 20px;
            animation: fadeIn 0.8s ease forwards;
        }

        .article-header { border-bottom: 1px solid var(--glass-border); padding-bottom: 30px; margin-bottom: 30px; }
        .tag { display: inline-block; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; color: var(--accent-blue); background: rgba(56, 189, 248, 0.15); border: 1px solid rgba(56, 189, 248, 0.3); margin-bottom: 15px; }
        h1 { font-size: clamp(2rem, 4vw, 3rem); line-height: 1.2; font-weight: 800; margin-bottom: 15px; }
        .meta { color: var(--text-muted); font-size: 0.9rem; }

        .content { font-size: 1.1rem; color: #CBD5E1; }
        .content p { margin-bottom: 20px; }
        .content h3 { color: white; margin: 30px 0 15px; font-size: 1.5rem; }
        .content img { max-width: 100%; border-radius: 12px; margin: 20px 0; border: 1px solid var(--glass-border); }

        hr { border: none; height: 1px; background: var(--glass-border); margin: 60px 0; }

        .quiz-container {
            background: var(--bg-surface);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        .quiz-title { display: flex; align-items: center; gap: 10px; font-size: 1.6rem; color: var(--accent-purple); font-weight: 700; margin-bottom: 30px; }
        
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: var(--text-muted); font-size: 0.95rem; }
        .form-control { width: 100%; background: rgba(15, 23, 42, 0.5); border: 1px solid var(--glass-border); padding: 12px 15px; border-radius: 12px; color: white; outline: none; font-size: 1rem; transition: border-color 0.2s; }
        .form-control:focus { border-color: var(--accent-blue); }
        .select-wrapper { position: relative; }
        .select-wrapper select { appearance: none; cursor: pointer; }
        .select-wrapper::after { content: "▼"; position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: var(--text-muted); pointer-events: none; font-size: 0.8rem; }

        .question-block { margin-top: 40px; }
        .question-text { font-size: 1.1rem; font-weight: 600; margin-bottom: 15px; }
        .options { display: flex; flex-direction: column; gap: 10px; }
        .option-label { 
            display: flex; align-items: center; gap: 12px; padding: 12px 20px; 
            border: 1px solid var(--glass-border); border-radius: 12px; 
            cursor: pointer; transition: all 0.2s; background: rgba(255,255,255,0.02);
        }
        .option-label:hover { background: rgba(255,255,255,0.05); }
        input[type="radio"] { width: 18px; height: 18px; accent-color: var(--accent-purple); cursor: pointer; }
        input[type="radio"]:checked + .option-text { font-weight: 600; color: var(--accent-blue); }

        /* Correct/Wrong feedback */
        .option-label.correct { border-color: var(--accent-green); background: rgba(52, 211, 153, 0.1); }
        .option-label.wrong { border-color: var(--accent-red); background: rgba(248, 113, 113, 0.1); }

        /* Timer */
        .timer-bar {
            position: sticky; top: 70px; z-index: 50;
            background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border); border-radius: 12px;
            padding: 12px 20px; margin-bottom: 30px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .timer-label { color: var(--text-muted); font-size: 0.85rem; font-weight: 600; }
        .timer-display {
            font-size: 1.4rem; font-weight: 800; color: var(--accent-green);
            font-family: 'JetBrains Mono', monospace;
            transition: color 0.3s;
        }
        .timer-display.warning { color: var(--accent-yellow); }
        .timer-display.danger { color: var(--accent-red); animation: pulse 0.5s infinite alternate; }
        .timer-progress { flex: 1; height: 6px; background: rgba(255,255,255,0.08); border-radius: 3px; margin: 0 16px; overflow: hidden; }
        .timer-progress-bar { height: 100%; border-radius: 3px; background: var(--accent-green); transition: width 1s linear, background 0.3s; }

        @keyframes pulse { from{opacity:1} to{opacity:0.5} }

        .submit-btn { 
            display: block; width: 100%; margin-top: 40px; padding: 16px; 
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue)); 
            border: none; border-radius: 12px; color: white; font-size: 1.1rem; 
            font-weight: 700; cursor: pointer; transition: transform 0.2s; 
        }
        .submit-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(129, 140, 248, 0.3); }
        .submit-btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

        /* Modal */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(10px);
            z-index: 1000; display: flex; justify-content: center; align-items: center;
            opacity: 0; pointer-events: none; transition: opacity 0.4s ease;
        }
        .modal-overlay.active { opacity: 1; pointer-events: all; }
        
        .modal-content {
            background: var(--bg-secondary); border: 1px solid var(--glass-border);
            border-radius: 24px; padding: 50px 30px; text-align: center; max-width: 400px; width: 90%;
            transform: scale(0.8) translateY(20px); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }
        .modal-overlay.active .modal-content { transform: scale(1) translateY(0); }
        
        .score-circle {
            width: 120px; height: 120px; border-radius: 50%; margin: 0 auto 20px;
            display: flex; justify-content: center; align-items: center;
            font-size: 3rem; font-weight: 800; color: white;
            transition: background 0.3s, box-shadow 0.3s;
        }
        .score-high {
            background: radial-gradient(circle, var(--accent-green) 0%, rgba(52, 211, 153, 0.4) 100%);
            box-shadow: 0 0 30px rgba(52, 211, 153, 0.4);
        }
        .score-mid {
            background: radial-gradient(circle, var(--accent-yellow) 0%, rgba(251, 191, 36, 0.4) 100%);
            box-shadow: 0 0 30px rgba(251, 191, 36, 0.4);
        }
        .score-low {
            background: radial-gradient(circle, var(--accent-red) 0%, rgba(248, 113, 113, 0.4) 100%);
            box-shadow: 0 0 30px rgba(248, 113, 113, 0.4);
        }
        .modal-title { font-size: 1.8rem; margin-bottom: 10px; font-weight: 700; }
        .modal-desc { color: var(--text-muted); margin-bottom: 30px; line-height: 1.5; }
        .modal-btn { 
            display: inline-block; padding: 12px 30px; background: rgba(255,255,255,0.1); 
            border: 1px solid rgba(255,255,255,0.2); border-radius: 30px; color: white; 
            text-decoration: none; font-weight: 600; transition: all 0.2s; 
        }
        .modal-btn:hover { background: white; color: var(--bg-primary); }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }

    </style>
</head>
<body>

    <div class="ambient-glow"></div>

    <nav class="navbar">
        <a href="/" class="logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            EduSpace
        </a>
        <a href="/" class="back-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali
        </a>
    </nav>

    <main class="container">
        
        <article>
            <div class="article-header">
                <span class="tag tag-{{ strtolower($materi->mapel) }}">{{ $materi->mapel }}</span>
                <h1>{{ $materi->judul }}</h1>
                <div class="meta">Diposting oleh Guru Admin • Otomatis</div>
            </div>

            <div class="content">
                {!! $materi->konten !!}
            </div>
        </article>

        <hr>

        <div class="quiz-container">
            <div class="quiz-title">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M9 12l2 2 4-4"/></svg>
                Uji Pemahamanmu!
            </div>

            @if($materi->soals->count() > 0)
            <!-- Timer Bar -->
            <div class="timer-bar" id="timerBar">
                <span class="timer-label">⏱️ Sisa Waktu</span>
                <div class="timer-progress">
                    <div class="timer-progress-bar" id="timerBar2" style="width:100%"></div>
                </div>
                <div class="timer-display" id="timerDisplay">{{ $materi->soals->count() * 90 }}s</div>
            </div>
            @endif
            
            <form id="quizForm">
                @csrf
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Nama Panggilan atau Lengkap</label>
                        <input type="text" id="studentName" name="nama_siswa" class="form-control" placeholder="Cth: Budi Santoso" required>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <div class="select-wrapper">
                            <select id="studentClass" name="kelas" class="form-control" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                <option value="10 IPA">10 IPA</option>
                                <option value="11 IPA">11 IPA</option>
                                <option value="12 IPA">12 IPA</option>
                            </select>
                        </div>
                    </div>
                </div>

                @forelse($materi->soals as $index => $soal)
                <div class="question-block" id="question-{{ $soal->id }}">
                    <div class="question-text">{{ $index + 1 }}. {{ $soal->pertanyaan }}</div>
                    <div class="options">
                        <label class="option-label" data-answer="A">
                            <input type="radio" name="q{{ $soal->id }}" value="A" required> 
                            <span class="option-text">{{ $soal->opsi_a }}</span>
                        </label>
                        <label class="option-label" data-answer="B">
                            <input type="radio" name="q{{ $soal->id }}" value="B"> 
                            <span class="option-text">{{ $soal->opsi_b }}</span>
                        </label>
                        <label class="option-label" data-answer="C">
                            <input type="radio" name="q{{ $soal->id }}" value="C"> 
                            <span class="option-text">{{ $soal->opsi_c }}</span>
                        </label>
                        <label class="option-label" data-answer="D">
                            <input type="radio" name="q{{ $soal->id }}" value="D"> 
                            <span class="option-text">{{ $soal->opsi_d }}</span>
                        </label>
                    </div>
                </div>
                @empty
                <div class="question-block" style="color: var(--text-muted); font-style: italic; text-align: center;">
                    Guru belum menambahkan soal untuk materi ini.
                </div>
                @endforelse

                @if($materi->soals->count() > 0)
                <button type="submit" class="submit-btn" id="submitBtn">Kirim Jawaban & Lihat Hasil</button>
                @endif
            </form>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal-overlay" id="resultModal">
        <div class="modal-content">
            <div class="score-circle score-high" id="scoreCircle">0</div>
            <h2 class="modal-title" id="modalTitle">Bagus!</h2>
            <p class="modal-desc" id="modalDesc">Nilaimu sudah otomatis masuk ke buku nilai guru.</p>
            <a href="/" class="modal-btn">Kembali ke Halaman Utama</a>
        </div>
    </div>

    <script>
        // ====== TIMER KUIS ======
        const totalSoal = {{ $materi->soals->count() }};
        const totalWaktu = totalSoal * 90; // 90 detik per soal
        let sisaWaktu = totalWaktu;
        let timerInterval = null;
        let timerHabis = false;

        function startTimer() {
            if (totalSoal === 0) return;
            const display = document.getElementById('timerDisplay');
            const bar = document.getElementById('timerBar2');

            timerInterval = setInterval(() => {
                sisaWaktu--;
                if (display) display.innerText = sisaWaktu + 's';
                if (bar) bar.style.width = ((sisaWaktu / totalWaktu) * 100) + '%';

                // Color changes
                if (display) {
                    display.className = 'timer-display';
                    if (sisaWaktu <= 30) {
                        display.classList.add('danger');
                        if(bar) bar.style.background = '#F87171';
                    } else if (sisaWaktu <= 60) {
                        display.classList.add('warning');
                        if(bar) bar.style.background = '#FBBF24';
                    }
                }

                if (sisaWaktu <= 0) {
                    clearInterval(timerInterval);
                    timerHabis = true;
                    
                    // Fill required fields so auto-submit doesn't fail HTML validation
                    const namaInput = document.getElementById('studentName');
                    const kelasInput = document.getElementById('studentClass');
                    if (!namaInput.value.trim()) namaInput.value = 'Siswa Tanpa Nama (Waktu Habis)';
                    if (!kelasInput.value) kelasInput.value = '10 IPA'; // Default
                    
                    // Remove required attributes from radio buttons so form can submit even if empty
                    document.querySelectorAll('input[type="radio"]').forEach(radio => radio.required = false);
                    
                    // Auto-submit when time runs out
                    document.getElementById('quizForm').requestSubmit();
                }
            }, 1000);
        }

        // Start timer when page loads
        window.addEventListener('load', startTimer);

        // ====== SUBMIT KUIS ======
        document.getElementById('quizForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (timerInterval) clearInterval(timerInterval);

            const btn = document.getElementById('submitBtn');
            const form = this;
            
            btn.disabled = true;
            btn.innerText = timerHabis ? '⏰ Waktu Habis! Menghitung...' : 'Menghitung Nilai...';

            const formData = new FormData(form);

            fetch("{{ route('materi.submit', $materi->id) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error('Network error');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const skor = data.skor;
                    const nama = data.namaSiswa;
                    
                    const scoreCircle = document.getElementById('scoreCircle');
                    scoreCircle.innerText = skor;
                    scoreCircle.className = 'score-circle';
                    
                    if (skor >= 80) {
                        scoreCircle.classList.add('score-high');
                        document.getElementById('modalTitle').innerHTML = 'Hebat Sekali, ' + nama + '! 🎉';
                        document.getElementById('modalDesc').innerText = 'Luar biasa! Skor ' + skor + '/100. Kamu sangat menguasai materi ini. Nilaimu otomatis masuk ke rekap guru!';
                    } else if (skor >= 50) {
                        scoreCircle.classList.add('score-mid');
                        document.getElementById('modalTitle').innerHTML = 'Lumayan, ' + nama + '! 👍';
                        document.getElementById('modalDesc').innerText = 'Skor ' + skor + '/100. Masih bisa ditingkatkan! Coba baca ulang materinya dan kerjakan lagi nanti.';
                    } else {
                        scoreCircle.classList.add('score-low');
                        document.getElementById('modalTitle').innerHTML = 'Semangat, ' + nama + '! 💪';
                        document.getElementById('modalDesc').innerText = 'Skor ' + skor + '/100. Jangan menyerah! Pelajari lagi materinya dengan teliti, kamu pasti bisa!';
                    }
                    
                    document.getElementById('resultModal').classList.add('active');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerText = 'Kirim Jawaban & Lihat Hasil';
            });
        });
    </script>
</body>
</html>
