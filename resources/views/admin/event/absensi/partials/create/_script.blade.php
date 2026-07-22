<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const hariKe = document.querySelector('[name="hari_ke"]');

    const tanggal = document.querySelector('[name="tanggal"]');

    const totalHadir = document.getElementById('totalHadir');

    const totalTidakHadir = document.getElementById('totalTidakHadir');

    const form = document.getElementById('formAbsensi');

    /*
    |--------------------------------------------------------------------------
    | TANGGAL EVENT
    |--------------------------------------------------------------------------
    */

    const tanggalMulai = new Date("{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('Y-m-d') }}");

    const tanggalSelesai = new Date("{{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('Y-m-d') }}");

    /*
    |--------------------------------------------------------------------------
    | HITUNG HADIR
    |--------------------------------------------------------------------------
    */

    function hitungAbsensi()
    {

        let hadir = 0;

        let tidak = 0;

        document.querySelectorAll('input[type=radio]:checked')
            .forEach(function(item){

                if(item.value === 'hadir'){

                    hadir++;

                }

                if(item.value === 'tidak_hadir'){

                    tidak++;

                }

            });

        totalHadir.innerHTML = hadir;

        totalTidakHadir.innerHTML = tidak;

    }

    /*
    |--------------------------------------------------------------------------
    | HARI -> TANGGAL
    |--------------------------------------------------------------------------
    */

    function updateTanggal()
    {

        if(!hariKe || !tanggal){

            return;

        }

        let hari = parseInt(hariKe.value);

        if(isNaN(hari)){

            return;

        }

        let result = new Date(tanggalMulai);

        result.setDate(result.getDate() + (hari - 1));

        let y = result.getFullYear();

        let m = String(result.getMonth() + 1).padStart(2,'0');

        let d = String(result.getDate()).padStart(2,'0');

        tanggal.value = y + '-' + m + '-' + d;

    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI RANGE
    |--------------------------------------------------------------------------
    */

    function validasiTanggal()
    {

        if(!tanggal){

            return;

        }

        let pilih = new Date(tanggal.value);

        if(pilih < tanggalMulai){

            alert('Tanggal tidak boleh kurang dari tanggal mulai event.');

            updateTanggal();

        }

        if(pilih > tanggalSelesai){

            alert('Tanggal tidak boleh melebihi tanggal selesai event.');

            updateTanggal();

        }

    }

    /*
    |--------------------------------------------------------------------------
    | CONFIRM SUBMIT
    |--------------------------------------------------------------------------
    */

    if(form){

        form.addEventListener('submit',function(e){

            if(!confirm('Simpan absensi peserta?')){

                e.preventDefault();

            }

        });

    }

    /*
    |--------------------------------------------------------------------------
    | EVENT
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('input[type=radio]')
        .forEach(function(item){

            item.addEventListener('change', hitungAbsensi);

        });

    if(hariKe){

        hariKe.addEventListener('change',updateTanggal);

    }

    if(tanggal){

        tanggal.addEventListener('change',validasiTanggal);

    }

    /*
    |--------------------------------------------------------------------------
    | LOAD
    |--------------------------------------------------------------------------
    */

    updateTanggal();

    hitungAbsensi();

});
</script>