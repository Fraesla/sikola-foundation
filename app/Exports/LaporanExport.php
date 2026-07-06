<?php

namespace App\Exports;

use App\Models\Donasi;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return Donasi::with('user')
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Donatur' => $item->user?->name,
                    'Jumlah'       => $item->jumlah,
                    'Status'       => $item->status,
                    'Tanggal'      => $item->created_at->format('d-m-Y'),
                ];
            }
        );
    }
}
