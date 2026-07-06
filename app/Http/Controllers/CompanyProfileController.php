<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;  
use App\Models\Postingan;
use App\Models\TeamMember;
use App\Models\Merchandise;
use App\Models\Banner;
use App\Models\DonationCategory;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $banners = Banner::where('urutan', 1)
                    ->where('is_aktif', true)
                    ->orderBy('id', 'desc')
                    ->get();

        return view('frontend.home', compact('banners'));
    }

    public function beranda()
    {
        $banners = Banner::where('urutan', 1)
                    ->where('is_aktif', true)
                    ->orderBy('id', 'desc')
                    ->get();

        return view('frontend.home', compact('banners'));
    }

    public function tentang()
    {
        $bannerTentang = Banner::where('urutan', 2)
                    ->where('is_aktif', true)
                    ->orderBy('id', 'desc')
                    ->get();

        return view('frontend.tentang', compact('bannerTentang'));
    }

    public function beritaIndex(Request $request)
    {
        $query = Postingan::query();

        // filter status
        if ($request->status && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        // search
        if ($request->search) {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }

        $posts = $query
            ->latest('published_at')
            ->paginate(5)
            ->withQueryString();

        $bannerBerita = Banner::where('urutan', 6)
                    ->where('is_aktif', true)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view(
            'frontend.berita',
            compact('posts','bannerBerita')
        );
    }

    public function beritaShow($slug)
    {
        $news = Postingan::where('slug', $slug)
            ->where('status', 'publikasi')
            ->firstOrFail();

        // tambah views otomatis
        $news->increment('views');

        // berita terbaru untuk sidebar
        $latestNews = Postingan::where('status', 'publikasi')
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view(
            'frontend.berita-detail',
            compact('news', 'latestNews')
        );
    }

    public function eventIndex(Request $request)
    {
        $query = Event::query();

        // Filter status
        if ($request->status == 'mendatang') {
            $query->whereDate('tanggal_mulai', '>=', now());
        }

        if ($request->status == 'arsip') {
            $query->whereDate('tanggal_mulai', '<', now());
        }

        // Search
        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $events = $query
            ->orderBy('tanggal_mulai', 'asc')
            ->paginate(9)
            ->withQueryString();

        $bannerEvent = Banner::where('urutan', 3)
                        ->where('is_aktif', true)
                        ->orderBy('id', 'asc')
                        ->get();

        return view('frontend.event', compact('events','bannerEvent'));
    } 

    public function eventShow($slug)
    {
        $event = Event::where('slug', $slug)
        ->firstOrFail();

        return view('frontend.event-detail', compact('event'));
    }

    public function donasi()
    {
        $bannerDonasi = Banner::where('urutan', 4)
                    ->where('is_aktif', 1)
                    ->orderBy('created_at')
                    ->get();

        $kategoriDonasi = DonationCategory::where('is_aktif',1)
                            ->latest()
                            ->get();


        return view('frontend.donasi', compact(
            'bannerDonasi',
            'kategoriDonasi'
        ));
    }

    public function merchandise(Request $request)
    {
        $query = Merchandise::where('is_aktif', true);

        // Filter kategori
        if ($request->filled('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        $merchandises = $query
                        ->latest()
                        ->paginate(8)
                        ->withQueryString();

        $categories = Merchandise::where('is_aktif', true)
                        ->select('kategori')
                        ->distinct()
                        ->pluck('kategori');
        
        $bannerMerchandise = Banner::where('urutan', 7)
                        ->where('is_aktif', true)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view(
            'frontend.merchandise',
            compact('merchandises', 'categories','bannerMerchandise')
        );
    }

    public function tim()
    {
        $teams = TeamMember::where('is_aktif', true)
                    ->orderBy('urutan')
                    ->get();

        $bannerTeam = Banner::where('urutan', 8)
                    ->where('is_aktif', true)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('frontend.tim', compact('teams','bannerTeam'));
    }

    public function relawan()
    {
        $bannerRelawan = Banner::where('urutan', 5)
                            ->where('is_aktif', true)
                            ->orderBy('id')
                            ->get();

        return view('frontend.relawan', compact('bannerRelawan'));
    }

    public function kontak()
    {
        $bannerKontak = Banner::where('urutan', 9)
                            ->where('is_aktif', true)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('frontend.kontak', compact(
            'bannerKontak'
        ));
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
