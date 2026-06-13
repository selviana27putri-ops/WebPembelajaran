<?php

namespace Database\Seeders;

use App\Models\Materi;
use App\Models\Soal;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $m1 = Materi::create([
            'judul' => 'Pengenalan MS Office',
            'mapel' => 'MS Office',
            'konten' => '<p>Microsoft Office adalah paket aplikasi perkantoran buatan Microsoft. Beberapa aplikasi utama di dalamnya adalah MS Word (pengolah kata), MS Excel (pengolah angka), dan MS PowerPoint (presentasi).</p>'
        ]);
        Soal::create(['materi_id' => $m1->id, 'pertanyaan' => 'Aplikasi manakah yang digunakan untuk mengolah angka?', 'opsi_a' => 'MS Word', 'opsi_b' => 'MS Excel', 'opsi_c' => 'MS PowerPoint', 'opsi_d' => 'MS Access', 'jawaban_benar' => 'B']);
        Soal::create(['materi_id' => $m1->id, 'pertanyaan' => 'Aplikasi yang paling tepat untuk membuat presentasi adalah?', 'opsi_a' => 'MS Excel', 'opsi_b' => 'Notepad', 'opsi_c' => 'MS PowerPoint', 'opsi_d' => 'Paint', 'jawaban_benar' => 'C']);
        Soal::create(['materi_id' => $m1->id, 'pertanyaan' => 'Apa ekstensi file default untuk dokumen MS Word versi baru?', 'opsi_a' => '.docx', 'opsi_b' => '.xlsx', 'opsi_c' => '.pptx', 'opsi_d' => '.pdf', 'jawaban_benar' => 'A']);
        Soal::create(['materi_id' => $m1->id, 'pertanyaan' => 'Fungsi utama dari aplikasi MS Word adalah sebagai perangkat lunak...', 'opsi_a' => 'Pengolah Kata', 'opsi_b' => 'Pengolah Angka', 'opsi_c' => 'Pemutar Video', 'opsi_d' => 'Database', 'jawaban_benar' => 'A']);
        Soal::create(['materi_id' => $m1->id, 'pertanyaan' => 'Shortcut keyboard untuk mencetak dokumen (Print) adalah?', 'opsi_a' => 'Ctrl + S', 'opsi_b' => 'Ctrl + C', 'opsi_c' => 'Ctrl + P', 'opsi_d' => 'Ctrl + V', 'jawaban_benar' => 'C']);

        $m2 = Materi::create([
            'judul' => 'Dasar Desain Grafis',
            'mapel' => 'Desain Grafis',
            'konten' => '<p>Desain grafis adalah proses komunikasi menggunakan elemen visual seperti tipografi, fotografi, serta ilustrasi. Dibagi menjadi dua jenis utama: Bitmap (pixel) dan Vektor.</p>'
        ]);
        Soal::create(['materi_id' => $m2->id, 'pertanyaan' => 'Software yang sangat populer untuk membuat desain grafis vektor adalah?', 'opsi_a' => 'Adobe Premiere', 'opsi_b' => 'Microsoft Word', 'opsi_c' => 'Adobe Illustrator', 'opsi_d' => 'Notepad', 'jawaban_benar' => 'C']);
        Soal::create(['materi_id' => $m2->id, 'pertanyaan' => 'Elemen terkecil penyusun gambar digital bertipe bitmap disebut?', 'opsi_a' => 'Pixel', 'opsi_b' => 'Vektor', 'opsi_c' => 'Kurva', 'opsi_d' => 'Garis', 'jawaban_benar' => 'A']);
        Soal::create(['materi_id' => $m2->id, 'pertanyaan' => 'Format gambar yang mendukung latar belakang transparan adalah?', 'opsi_a' => 'JPG', 'opsi_b' => 'PNG', 'opsi_c' => 'BMP', 'opsi_d' => 'MP4', 'jawaban_benar' => 'B']);
        Soal::create(['materi_id' => $m2->id, 'pertanyaan' => 'Model warna yang digunakan untuk standar percetakan (printing) adalah?', 'opsi_a' => 'RGB', 'opsi_b' => 'Hexcode', 'opsi_c' => 'Grayscale', 'opsi_d' => 'CMYK', 'jawaban_benar' => 'D']);
        Soal::create(['materi_id' => $m2->id, 'pertanyaan' => 'Proses pengolahan akhir dari desain/animasi menjadi file jadi disebut?', 'opsi_a' => 'Editing', 'opsi_b' => 'Compositing', 'opsi_c' => 'Rendering', 'opsi_d' => 'Sketching', 'jawaban_benar' => 'C']);

        $m3 = Materi::create([
            'judul' => 'Konsep Multimedia',
            'mapel' => 'Multimedia',
            'konten' => '<p>Multimedia adalah kombinasi dari teks, seni, suara, animasi, dan video yang disampaikan kepada audiens menggunakan perangkat komputer.</p>'
        ]);
        Soal::create(['materi_id' => $m3->id, 'pertanyaan' => 'Berikut ini yang BUKAN merupakan elemen multimedia adalah?', 'opsi_a' => 'Teks', 'opsi_b' => 'Udara', 'opsi_c' => 'Audio', 'opsi_d' => 'Video', 'jawaban_benar' => 'B']);
        Soal::create(['materi_id' => $m3->id, 'pertanyaan' => 'Gabungan dari elemen audio dan rangkaian gambar bergerak disebut?', 'opsi_a' => 'Video', 'opsi_b' => 'Fotografi', 'opsi_c' => 'Tipografi', 'opsi_d' => 'Teks', 'jawaban_benar' => 'A']);
        Soal::create(['materi_id' => $m3->id, 'pertanyaan' => 'Dalam animasi dan video, apa kepanjangan dari FPS?', 'opsi_a' => 'First Person Shooter', 'opsi_b' => 'Frames Per Second', 'opsi_c' => 'File Per System', 'opsi_d' => 'Format Pixel Size', 'jawaban_benar' => 'B']);
        Soal::create(['materi_id' => $m3->id, 'pertanyaan' => 'Aplikasi standar industri dari Adobe untuk mengedit video adalah?', 'opsi_a' => 'Adobe Premiere Pro', 'opsi_b' => 'Adobe Photoshop', 'opsi_c' => 'Adobe Audition', 'opsi_d' => 'Adobe Reader', 'jawaban_benar' => 'A']);
        Soal::create(['materi_id' => $m3->id, 'pertanyaan' => 'Format file audio digital yang paling umum digunakan adalah?', 'opsi_a' => 'JPEG', 'opsi_b' => 'AVI', 'opsi_c' => 'DOCX', 'opsi_d' => 'MP3', 'jawaban_benar' => 'D']);

        $m4 = Materi::create([
            'judul' => 'Pengantar Jaringan Komputer',
            'mapel' => 'Jaringan',
            'konten' => '<p>Jaringan komputer adalah kumpulan perangkat yang saling terhubung untuk berbagi sumber daya dan informasi. Jenis cakupannya meliputi LAN, MAN, dan WAN.</p>'
        ]);
        Soal::create(['materi_id' => $m4->id, 'pertanyaan' => 'Apa kepanjangan dari LAN dalam konteks jaringan?', 'opsi_a' => 'Local Area Network', 'opsi_b' => 'Large Area Network', 'opsi_c' => 'Long Area Network', 'opsi_d' => 'Logical Area Network', 'jawaban_benar' => 'A']);
        Soal::create(['materi_id' => $m4->id, 'pertanyaan' => 'Perangkat keras yang digunakan untuk menghubungkan jaringan dengan segmen/IP berbeda adalah?', 'opsi_a' => 'Switch', 'opsi_b' => 'Hub', 'opsi_c' => 'Router', 'opsi_d' => 'Kabel UTP', 'jawaban_benar' => 'C']);
        Soal::create(['materi_id' => $m4->id, 'pertanyaan' => 'Alamat unik berupa angka yang dimiliki setiap perangkat jaringan dinamakan?', 'opsi_a' => 'MAC Address', 'opsi_b' => 'IP Address', 'opsi_c' => 'Email Address', 'opsi_d' => 'URL', 'jawaban_benar' => 'B']);
        Soal::create(['materi_id' => $m4->id, 'pertanyaan' => 'Topologi jaringan komputer yang bentuknya menyerupai cincin/lingkaran disebut?', 'opsi_a' => 'Topologi Star', 'opsi_b' => 'Topologi Bus', 'opsi_c' => 'Topologi Mesh', 'opsi_d' => 'Topologi Ring', 'jawaban_benar' => 'D']);
        Soal::create(['materi_id' => $m4->id, 'pertanyaan' => 'Media transmisi kabel jaringan yang menggunakan serat kaca dan sangat cepat adalah?', 'opsi_a' => 'Kabel Coaxial', 'opsi_b' => 'Kabel UTP', 'opsi_c' => 'Fiber Optic', 'opsi_d' => 'Bluetooth', 'jawaban_benar' => 'C']);
    }
}
