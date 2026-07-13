<?php

namespace App;

enum KategoriPoin:string
{
    case REGISTRASI = 'registrasi';

    case DONASI_SEKALI = 'donasi_sekali';

    case DONASI_BULANAN = 'donasi_bulanan';

    case MERCHANDISE = 'merchandise';

    case EVENT = 'event';

    case REWARD = 'reward';

    case MANUAL = 'manual';

    public function label(): string
    {
        return match($this){

            self::REGISTRASI => 'Bonus Registrasi',

            self::DONASI_SEKALI => 'Donasi Sekali',

            self::DONASI_BULANAN => 'Donasi Bulanan',

            self::MERCHANDISE => 'Pembelian Merchandise',

            self::EVENT => 'Mengikuti Event',

            self::REWARD => 'Penukaran Reward',

            self::MANUAL => 'Manual Admin',

        };
    }
}
