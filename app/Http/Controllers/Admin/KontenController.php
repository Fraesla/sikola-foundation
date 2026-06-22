<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;  
use App\Models\Postingan;  
use App\Models\TeamMember;  

class KontenController extends Controller
{
   public function index()
   {
        $totalBanner = Banner::count();

        $bannerAktif = Banner::where('is_aktif',1)->count();

        $bannerNonaktif = Banner::where('is_aktif',0)->count();

        $persenAktif = $totalBanner > 0
            ? round(($bannerAktif / $totalBanner) * 100)
            : 0;

        $bannerTerbaru = Banner::latest()->first();

        $totalPostingan = Postingan::count();

        $totalTeam = TeamMember::count();
        $postinganTerbaru = Postingan::latest()
                        ->take(5)
                        ->get();

        return view('admin.konten.index', compact(
            'totalBanner',
            'bannerAktif',
            'bannerNonaktif',
            'persenAktif',
            'bannerTerbaru',
            'totalPostingan',
            'totalTeam',
            'postinganTerbaru'
        ));
    }
}
