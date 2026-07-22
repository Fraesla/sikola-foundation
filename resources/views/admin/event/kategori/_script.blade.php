@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const judul       = document.getElementById('judul');
    const slug        = document.getElementById('slug');

    const input       = document.getElementById('gambar');
    const preview     = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');
    const dropzone    = document.getElementById('dropzone');

    /*
    |--------------------------------------------------------------------------
    | AUTO SLUG
    |--------------------------------------------------------------------------
    */

    if (judul && slug) {

        let slugManual = slug.value !== '';

        slug.addEventListener('input', function () {

            slugManual = true;

        });

        judul.addEventListener('keyup', function () {

            if (slugManual) return;

            slug.value = convertToSlug(this.value);

        });

    }

    function convertToSlug(text)
    {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g,'')
            .replace(/\s+/g,'-')
            .replace(/--+/g,'-');
    }

    /*
    |--------------------------------------------------------------------------
    | PREVIEW IMAGE
    |--------------------------------------------------------------------------
    */

    if (dropzone && input) {

        dropzone.addEventListener('click', function () {

            input.click();

        });

        input.addEventListener('change', function () {

            previewImage(this.files[0]);

        });

    }

    function previewImage(file)
    {
        if (!file) return;

        /*
        |--------------------------------------------------------------------------
        | VALIDASI FILE
        |--------------------------------------------------------------------------
        */

        if (!file.type.startsWith('image/')) {

            alert('File harus berupa gambar.');

            input.value = '';

            return;

        }

        /*
        |--------------------------------------------------------------------------
        | MAX 2 MB
        |--------------------------------------------------------------------------
        */

        if (file.size > 2 * 1024 * 1024) {

            alert('Ukuran gambar maksimal 2 MB.');

            input.value = '';

            return;

        }

        const reader = new FileReader();

        reader.onload = function (e) {

            preview.src = e.target.result;

            preview.classList.remove('hidden');

            placeholder.classList.add('hidden');

        };

        reader.readAsDataURL(file);
    }

    /*
    |--------------------------------------------------------------------------
    | DRAG & DROP
    |--------------------------------------------------------------------------
    */

    if (dropzone) {

        [
            'dragenter',
            'dragover'
        ].forEach(event => {

            dropzone.addEventListener(event, function(e){

                e.preventDefault();

                dropzone.classList.add(
                    'border-red-500',
                    'bg-red-50'
                );

            });

        });

        [
            'dragleave',
            'drop'
        ].forEach(event => {

            dropzone.addEventListener(event,function(e){

                e.preventDefault();

                dropzone.classList.remove(
                    'border-red-500',
                    'bg-red-50'
                );

            });

        });

        dropzone.addEventListener('drop', function(e){

            const files = e.dataTransfer.files;

            if(files.length){

                input.files = files;

                previewImage(files[0]);

            }

        });

    }

});

</script>

@endpush