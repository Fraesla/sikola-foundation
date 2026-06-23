<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;  
use App\Models\Postingan;
use App\Models\TeamMember;
use App\Models\Merchandise;

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

        return view(
            'frontend.berita',
            compact('posts')
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

        return view('frontend.event', compact('events'));
    } 

    public function eventShow($slug)
    {
        $event = Event::where('slug', $slug)
        ->firstOrFail();

        return view('frontend.event-detail', compact('event'));
    }

    public function donasi()
    {
        return view('frontend/donasi');
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

        return view(
            'frontend.merchandise',
            compact('merchandises', 'categories')
        );
    }

    public function tim()
    {
        $teams = TeamMember::where('is_aktif', true)
                    ->orderBy('urutan')
                    ->get();

        return view('frontend.tim', compact('teams'));
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
