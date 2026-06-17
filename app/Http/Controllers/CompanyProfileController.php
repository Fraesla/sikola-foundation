<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index()
    {
        return view('frontend/home');
    }

    public function beranda()
    {
        return view('frontend/home');
    }

    public function tentang()
    {
        return view('frontend/tentang');
    }

    public function beritaIndex()
    {
        return view('frontend/berita');
    }

    public function beritaShow($slug)
    {
        $news = (object)[
            'title' => 'Seminar Pendidikan Untuk Generasi Muda',
            'slug' => $slug,
            'thumbnail' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f',
            'views' => 1250,
            'created_at' => now(),
            'content' => '
                <p>
                    Seminar pendidikan merupakan salah satu kegiatan
                    yang bertujuan meningkatkan wawasan generasi muda.
                </p>

                <p>
                    Dalam kegiatan ini peserta mendapatkan berbagai
                    materi mengenai pendidikan, teknologi, dan pengembangan diri.
                </p>

                <h2>Tujuan Kegiatan</h2>

                <ul>
                    <li>Meningkatkan motivasi belajar</li>
                    <li>Mengembangkan soft skill</li>
                    <li>Membangun jaringan kolaborasi</li>
                </ul>
            '
        ];

        return view('frontend.berita-detail', compact('news'));
    }

    public function eventIndex()
    {
        $events = [

            [
                'slug' => 'seminar-pendidikan-2026',
                'title' => 'Seminar Pendidikan 2026',
                'date' => '20 Januari 2026',
                'location' => 'Padang, Sumatera Barat',
                'quota' => 100,
                'registered' => 65,
                'status' => 'upcoming',
                'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865'
            ],

            [
                'slug' => 'workshop-laravel',
                'title' => 'Workshop Laravel',
                'date' => '15 Februari 2026',
                'location' => 'Bukittinggi',
                'quota' => 50,
                'registered' => 30,
                'status' => 'upcoming',
                'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d'
            ],

            [
                'slug' => 'bakti-sosial-2025',
                'title' => 'Bakti Sosial 2025',
                'date' => '12 Agustus 2025',
                'location' => 'Agam',
                'quota' => 150,
                'registered' => 150,
                'status' => 'archive',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c'
            ]

        ];

        return view('frontend.event', compact('events'));
    }

    public function eventShow($slug)
    {
        $events = [

            'seminar-pendidikan-2026' => [
                'title' => 'Seminar Pendidikan 2026',
                'date' => '20 Januari 2026',
                'location' => 'Padang, Sumatera Barat',
                'quota' => 100,
                'registered' => 65,
                'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865',
                'description' => '
                    <p>
                        Seminar pendidikan nasional yang menghadirkan
                        berbagai pembicara dari kalangan akademisi.
                    </p>

                    <h2>Agenda Kegiatan</h2>

                    <ul>
                        <li>Seminar Pendidikan</li>
                        <li>Diskusi Panel</li>
                        <li>Networking Session</li>
                    </ul>
                '
            ],

            'workshop-laravel' => [
                'title' => 'Workshop Laravel',
                'date' => '15 Februari 2026',
                'location' => 'Bukittinggi',
                'quota' => 50,
                'registered' => 30,
                'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d',
                'description' => '
                    <p>
                        Pelatihan Laravel untuk mahasiswa dan pelajar.
                    </p>
                '
            ],

            'bakti-sosial-2025' => [
                'title' => 'Bakti Sosial 2025',
                'date' => '12 Agustus 2025',
                'location' => 'Agam',
                'quota' => 150,
                'registered' => 150,
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c',
                'description' => '
                    <p>
                        Kegiatan bakti sosial yang melibatkan relawan
                        dari berbagai daerah untuk membantu masyarakat.
                    </p>

                    <h2>Kegiatan</h2>

                    <ul>
                        <li>Pembagian sembako</li>
                        <li>Pemeriksaan kesehatan gratis</li>
                        <li>Edukasi masyarakat</li>
                    </ul>
                '
            ],

        ];

        abort_unless(isset($events[$slug]), 404);

        $event = (object) $events[$slug];

        return view('frontend.event-detail', compact('event'));
    }

    public function donasi()
    {
        return view('frontend/donasi');
    }

    public function merchandise()
    {
        return view('frontend/merchandise');
    }

    public function tim()
    {
        return view('frontend/tim');
    }

    public function relawan()
    {
        return view('frontend/relawan');
    }

    public function kontak()
    {
        return view('frontend/kontak');
    }

    public function login()
    {
        return view('login');
    }

    public function dashboard(Request $request)
    {
        // sementara langsung masuk dashboard
        return redirect()->route('admin.dashboard');
    }

}
