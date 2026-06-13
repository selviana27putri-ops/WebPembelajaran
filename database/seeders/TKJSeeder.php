<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Soal;
use App\Models\User;
use App\Models\Nilai;
use Illuminate\Support\Facades\Hash;

class TKJSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Admin if not exists
        if (!User::where('email', 'admin@eduspace.com')->exists()) {
            User::create([
                'name' => 'Guru Admin TKJ',
                'email' => 'admin@eduspace.com',
                'password' => Hash::make('password'),
            ]);
        }

        // 2. Clear existing Materi/Soal/Nilai to start fresh for TKJ focus
        Materi::truncate();
        Soal::truncate();
        Nilai::truncate();

        // 3. Materi Jaringan Komputer
        $m1 = Materi::create([
            'judul' => 'Pengenalan Topologi Jaringan',
            'mapel' => 'Jaringan',
            'konten' => '<p>Topologi jaringan adalah hal yang menjelaskan hubungan geometris antara unsur-unsur dasar penyusun jaringan, yaitu node, link, dan station.</p>
                        <ul>
                            <li><strong>Topologi Bus:</strong> Menggunakan satu kabel pusat.</li>
                            <li><strong>Topologi Star:</strong> Setiap node terhubung ke hub/switch pusat.</li>
                            <li><strong>Topologi Mesh:</strong> Setiap node terhubung ke setiap node lainnya.</li>
                        </ul>
                        <p>Pemilihan topologi sangat bergantung pada skala jaringan dan biaya yang tersedia.</p>',
        ]);

        Soal::create([
            'materi_id' => $m1->id,
            'pertanyaan' => 'Topologi manakah yang paling tahan terhadap kegagalan satu jalur kabel?',
            'opsi_a' => 'Star',
            'opsi_b' => 'Bus',
            'opsi_c' => 'Mesh',
            'opsi_d' => 'Ring',
            'jawaban_benar' => 'C'
        ]);

        Soal::create([
            'materi_id' => $m1->id,
            'pertanyaan' => 'Perangkat pusat pada topologi Star biasanya menggunakan...',
            'opsi_a' => 'Router',
            'opsi_b' => 'Switch atau Hub',
            'opsi_c' => 'Repeater',
            'opsi_d' => 'Transceiver',
            'jawaban_benar' => 'B'
        ]);

        // 4. Materi Pemrograman
        $m2 = Materi::create([
            'judul' => 'Dasar Variabel Python',
            'mapel' => 'Pemrograman',
            'konten' => '<p>Variabel adalah lokasi memori yang dipesan untuk menyimpan nilai-nilai. Di Python, kita tidak perlu mendeklarasikan tipe data secara eksplisit.</p>
                        <pre><code>nama = "EduSpace"\numur = 17\nprint(nama)</code></pre>
                        <p>Aturan penamaan variabel: Harus diawali huruf atau underscore, tidak boleh diawali angka, dan bersifat case-sensitive.</p>',
        ]);

        Soal::create([
            'materi_id' => $m2->id,
            'pertanyaan' => 'Manakah penamaan variabel yang SALAH di Python?',
            'opsi_a' => '_data1',
            'opsi_b' => '1data',
            'opsi_c' => 'data_baru',
            'opsi_d' => 'DataBaru',
            'jawaban_benar' => 'B'
        ]);

        // 5. Materi Hardware
        $m3 = Materi::create([
            'judul' => 'Komponen Utama Motherboard',
            'mapel' => 'Hardware',
            'konten' => '<p>Motherboard adalah papan sirkuit cetak utama yang menghubungkan semua komponen komputer.</p>
                        <p>Komponen penting: Socket CPU, Slot RAM, Chipset (Northbridge/Southbridge), dan BIOS/UEFI chip.</p>',
        ]);

        Soal::create([
            'materi_id' => $m3->id,
            'pertanyaan' => 'Komponen yang berfungsi mengontrol komunikasi antara CPU dan RAM adalah...',
            'opsi_a' => 'Southbridge',
            'opsi_b' => 'Northbridge / Memory Controller',
            'opsi_c' => 'BIOS',
            'opsi_d' => 'Slot Ekspansi',
            'jawaban_benar' => 'B'
        ]);

        // 6. Add some dummy Leaderboard data
        $users = ['Ahmad', 'Siti', 'Budi', 'Dewi', 'Eko'];
        foreach ($users as $u) {
            Nilai::create([
                'materi_id' => rand($m1->id, $m3->id),
                'nama_siswa' => $u,
                'kelas' => 'XII TKJ 1',
                'skor' => rand(70, 100),
                'created_at' => now()->subDays(rand(1, 5))
            ]);
        }
    }
}
