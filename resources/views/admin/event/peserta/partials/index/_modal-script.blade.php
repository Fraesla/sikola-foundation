<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Helper Modal
    |--------------------------------------------------------------------------
    */

    window.openModal = function (id) {

        const modal = document.getElementById(id);

        if (!modal) return;

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');

    };

    window.closeModal = function (id) {

        const modal = document.getElementById(id);

        if (!modal) return;

        modal.classList.remove('flex');

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    };

    /*
    |--------------------------------------------------------------------------
    | Klik backdrop untuk menutup modal
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('[id$="Modal"]').forEach(function (modal) {

        modal.addEventListener('click', function (e) {

            if (e.target === this) {

                closeModal(this.id);

            }

        });

    });

    /*
    |--------------------------------------------------------------------------
    | ESC
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function (e) {

        if (e.key !== 'Escape') return;

        document.querySelectorAll('[id$="Modal"]').forEach(function (modal) {

            closeModal(modal.id);

        });

    });

    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    window.openStatus = function (button) {

        document.getElementById('statusForm').action = button.dataset.route;

        document.getElementById('status').value = button.dataset.status;

        openModal('statusModal');

    };

    /*
    |--------------------------------------------------------------------------
    | Point
    |--------------------------------------------------------------------------
    */

    window.openPoint = function (button) {

        document.getElementById('pointForm').action = button.dataset.route;

        document.getElementById('pointPeserta').value = button.dataset.nama;

        document.getElementById('poin').value = button.dataset.poin;

        openModal('pointModal');

    };

    /*
    |--------------------------------------------------------------------------
    | Catatan
    |--------------------------------------------------------------------------
    */

    window.openCatatan = function (button) {

        document.getElementById('catatanForm').action = button.dataset.route;

        document.getElementById('catatanPeserta').value = button.dataset.nama;

        document.getElementById('catatan').value = button.dataset.catatan ?? '';

        openModal('catatanModal');

    };

    /*
    |--------------------------------------------------------------------------
    | Upload Sertifikat
    |--------------------------------------------------------------------------
    */

    window.openUpload = function (button) {

        document.getElementById('uploadForm').action = button.dataset.route;

        document.getElementById('uploadPeserta').value = button.dataset.nama;

        document.getElementById('sertifikat').value = '';

        document.getElementById('uploadPreview').classList.add('hidden');

        document.getElementById('uploadFileName').textContent = '';

        openModal('uploadModal');

    };

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    window.openDelete = function (button) {

        document.getElementById('deleteForm').action = button.dataset.route;

        document.getElementById('deletePeserta').value = button.dataset.nama;

        openModal('deleteModal');

    };

    /*
    |--------------------------------------------------------------------------
    | Preview Upload PDF
    |--------------------------------------------------------------------------
    */

    const fileInput = document.getElementById('sertifikat');

    if (fileInput) {

        fileInput.addEventListener('change', function () {

            const preview = document.getElementById('uploadPreview');

            const filename = document.getElementById('uploadFileName');

            if (!this.files.length) {

                preview.classList.add('hidden');

                filename.textContent = '';

                return;

            }

            preview.classList.remove('hidden');

            filename.textContent = this.files[0].name;

        });

    }
    /*
    |--------------------------------------------------------------------------
    | Dropdown Action
    |--------------------------------------------------------------------------
    */

    window.toggleDropdown = function (event, id) {

        event.stopPropagation();

        document.querySelectorAll('[id^="dropdown-"]').forEach(function (menu) {

            if (menu.id !== id) {

                menu.classList.add('hidden');

            }

        });

        document.getElementById(id).classList.toggle('hidden');

    };

    document.addEventListener('click', function () {

        document.querySelectorAll('[id^="dropdown-"]').forEach(function (menu) {

            menu.classList.add('hidden');

        });

    });

});

</script>